<?php

/**
 * This is the model class for table "bids".
 *
 * The followings are the available columns in table 'bids':
 * @property integer $id
 * @property integer $auction_id
 * @property integer $bidder_id
 * @property double $price
 * @property string $created
 * @property integer $type
 * @property integer $placed_back
 * @property integer $placed_back_6
 * @property integer $is_win
 * @property integer $is_paid
 * @property integer $status
 * The followings are the available model relations:
 * @property Auctions $auction
 * @property Members $bidder
 * @property double $bid_price
 */
class Bids extends CActiveRecord
{
    const TYPE_NORMAL = 1;
    const TYPE_FREE = 2;
    const TYPE_HALF = 3;
    const TYPE_JOKER = 4;
    const TYPE_SPECIAL = 5;
    
    const STATUS_SINGLE = 1;
    const STATUS_MULTI = 2;
    const STATUS_LOWEST = 3;
    
    const PLACED_BACK_ACTIVE  = 1;
    const PLACED_BACK_DEFAULT = 0;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Bids the static model class
     */
    public $username,$amount, $rank,$totalbid;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bids';
    }
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('auction_id, bidder_id, type, placed_back, placed_back_6, is_win, is_paid, status', 'numerical', 'integerOnly'=>true),
            array('price, bid_price', 'numerical'),
            array('created', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, auction_id, bidder_id, price, created, type, placed_back, placed_back_6, is_win, is_paid, status, bid_price', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'auction' => array(self::BELONGS_TO, 'Auctions', 'auction_id'),
            'bidder' => array(self::BELONGS_TO, 'Members', 'bidder_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('global', 'ID'),
            'auction_id' => Yii::t('global', 'Auction'),
            'bidder_id' => Yii::t('global', 'Bidder'),
            'price' => Yii::t('global', 'Price'),
            'created' => Yii::t('global', 'Created'),
            'type' => Yii::t('global', 'Type'),
            'placed_back' => Yii::t('global', 'Placed Back'),
            'is_win' => Yii::t('global', 'Is Win'),
            'is_paid' => Yii::t('global', 'Is Paid'),
            'status' => Yii::t('global', 'Status'),
            'bid_price' => Yii::t('global', 'Bid Price'),            
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('auction_id',$this->auction_id);
        $criteria->compare('bidder_id',$this->bidder_id);
        $criteria->compare('price',$this->price);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('type',$this->type);
        $criteria->compare('placed_back',$this->placed_back);
        $criteria->compare('placed_back_6',$this->placed_back_6);
        $criteria->compare('is_win',$this->is_win);
        $criteria->compare('is_paid',$this->is_paid);
        $criteria->compare('status',$this->status);
        $criteria->compare('bid_price',$this->bid_price);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function findAllBid($auction_id)
    {
        $criteria=new CDbCriteria;
        $criteria->condition='auction_id = '.$auction_id.' AND placed_back = 0 AND  placed_back_6 = 0 AND (status = '.self::STATUS_SINGLE.' OR status = '.self::STATUS_LOWEST.')';
        $criteria->order='price ASC';
        $bids = new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
        $bids->pagination->pageSize= 30;
        return $bids;
    }

    public function findAllBidEnded($auction_id)
    {
        $criteria=new CDbCriteria;
        $criteria->select= " *, CASE STATUS WHEN '3' THEN '0' ELSE STATUS END AS sta";
        $criteria->condition='auction_id = '.$auction_id.' AND placed_back = 0  AND (status = '.self::STATUS_SINGLE.' OR status = '.self::STATUS_LOWEST.')';
        $criteria->order='sta,price ASC';
        $bids = new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
        $bids->pagination->pageSize= 30;
        return $bids;
    }
    public function findMyBid($auction_id,$bidder_id)
    {
        $criteria=new CDbCriteria;
        $criteria->select= " *, CASE STATUS WHEN '3' THEN '0' ELSE STATUS END AS sta ";
        $criteria->compare('bidder_id',$bidder_id);
        $criteria->compare('auction_id',$auction_id);
        $criteria->group = "price";
        $criteria->order='sta,placed_back,price ASC';
        $mybids = new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
        $mybids->pagination->pageSize= 10;
        return $mybids;
    }

    public function showRecentBidders($auction_id){
        $recentBidderName = Bids::model()->findAllBySql('SELECT username FROM (
                                                          SELECT DISTINCT  bidder_id
                                                                FROM bids
                                                                WHERE auction_id ='.$auction_id.'
                                                                ORDER BY bids.id DESC
                                                                LIMIT 5 ) AS a
                                                        INNER JOIN members b
                                                        ON a.bidder_id  = b.id'
        );
        return $recentBidderName;
    }
    function getPlacedBack($placed_back){
        if($placed_back==1)
            return Yii::t('global',"(Placed Back)");
    }

    function rangBids()
    {
        return $this->getStatus($this->status);
    }
    public function getCompleteAuctionsMyBid($user_id)
    {
        $criteria=new CDbCriteria;

        $criteria->with = array('auction');
        $criteria->condition="auction.countdown < 0";
        $criteria->compare('bidder_id',$user_id);
        $criteria->distinct = true;
        $criteria->group='auction_id';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    function getPrice(){
        return $this->bid_price;
    }
    function getAuctionBidPrice(){
        switch ($this->type){
            case self::TYPE_HALF:
                return $this->auction->bid_price/2;
            case self::TYPE_FREE:
                return 0;
            case self::TYPE_JOKER;
            
            default:
                return $this->auction->bid_price;
        }
    }
    
    function checkStatusBid( $auction_id, $price ){
        $bids_table = Bids::model()->tableName();
        $sql = "SELECT a.total,MIN(b.price) AS minbid
                FROM 
                (
                    SELECT COUNT(auction_id) AS total,auction_id 
                    FROM $bids_table
                    WHERE auction_id = ".$auction_id." AND price = ".$price."
                )   AS a
                RIGHT JOIN $bids_table AS b
                ON a.auction_id = b.auction_id
                WHERE b.auction_id = ".$auction_id." AND ( b.status = ".Bids::STATUS_SINGLE." OR b.status = ".Bids::STATUS_LOWEST." ) AND b.placed_back = ".Bids::PLACED_BACK_DEFAULT." ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    function getRankAuctionPerMem( $auction_id = 0, $user_id = 0 ){
        $sql = "SELECT Rankn 
                FROM (
                    SELECT @rownum := @rownum+1 AS Rankn,price,STATUS,bidder_id 
                    FROM bids, (SELECT @rownum := 0) AS r 
                    WHERE auction_id = '$auction_id' AND ( STATUS = ".Bids::STATUS_LOWEST." OR STATUS = ".Bids::STATUS_SINGLE." )  AND placed_back = ".Bids::PLACED_BACK_DEFAULT."
                    ORDER BY price ASC ) AS a 
                WHERE bidder_id = '$user_id' ORDER BY Rankn ASC LIMIT 1";

        $results = Yii::app()->db->createCommand($sql)->query();
        foreach ($results as $result){
            $rank  = $result['Rankn'];
        }
        return $rank;
        
    }
    
    function getTotalBids( $auction_id )
    {
        return Bids::model()->count( 'auction_id =:auction_id', array( ':auction_id' => $auction_id ) );
    }
    
    function statusPlacedBack( $user_id, $auction_id, $limit = 3 ){
        $bids_table = Bids::model()->tableName();
        $sql = "SELECT COUNT(a.bidder_id) AS total, MAX(a.price) AS maxprice
                FROM 
                (
                	SELECT id, auction_id, bidder_id, price, status, placed_back
                	FROM $bids_table  
                	ORDER BY id DESC
                	LIMIT $limit
                ) AS a
                INNER JOIN $bids_table  b
                ON a.id = b.id
                WHERE a.bidder_id = ".$user_id." AND a.auction_id = ".$auction_id." 
                    AND (a.status = ".Bids::STATUS_SINGLE." OR a.status = ".Bids::STATUS_LOWEST." ) AND a.placed_back = ".Bids::PLACED_BACK_DEFAULT;
       
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    function statusThereBids( $user_id, $auction_id ){
        $bids_table = Bids::model()->tableName();
        $countBid   = Bids::model()->count( 'auction_id =:auction_id AND bidder_id !=:bidder_id AND placed_back=:placed_back AND status=:status', array( ':auction_id' => $auction_id, ':bidder_id' => $user_id,':placed_back'=>Bids::PLACED_BACK_DEFAULT, ':status'=>Bids::TYPE_NORMAL ) );
        if( $countBid ){
            $sql = "SELECT COUNT(a.id) AS total, MAX(a.price) AS maxprice
                    FROM
                    (
                    	SELECT  id,auction_id,bidder_id,price,placed_back
                    	FROM $bids_table 
                    	WHERE (id > (SELECT MAX(id) FROM $bids_table WHERE bidder_id!= ".$user_id." ) 
                    		AND id<= (SELECT MAX(id) FROM $bids_table WHERE bidder_id =".$user_id.")) 
                    		AND placed_back = ".Bids::PLACED_BACK_DEFAULT." AND auction_id = ".$auction_id."
                    ) AS a
                    INNER JOIN $bids_table AS b
                    ON a.id =  b.id";
        }
        else{
            $sql = "SELECT COUNT(id) AS total, MAX(price) AS maxprice 
                    FROM bids 
                    WHERE auction_id = ".$auction_id." AND bidder_id = ".$user_id." AND placed_back = ".Bids::PLACED_BACK_DEFAULT;
        }
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    function statusThereBidsOrder( $user_id, $auction_id ){
        $bids_table = Bids::model()->tableName();
        $sql = "SELECT COUNT(a.mySeq) AS total, MAX(a.price) AS maxprice
                FROM (
                        SELECT
                            @rownum := @rownum+1 AS mySeq,bidder_id,price
                        FROM
                            $bids_table,(SELECT @rownum := 0) AS r
                        WHERE auction_id = ".$auction_id." AND placed_back = ".Bids::PLACED_BACK_DEFAULT." 
                              AND (status = ".Bids::STATUS_SINGLE." OR status =".Bids::STATUS_MULTI.")
                        ORDER BY price ASC ) AS a
                        WHERE 
                        a.mySeq >= ( SELECT MIN(b.mySeq) 
                                     FROM(
                                            SELECT
                                                @rownum := @rownum+1 AS mySeq,
                                                bidder_id,
                                                price
                                            FROM
                                                $bids_table,
                                                (SELECT @rownum := 0) AS r
                                            WHERE auction_id = ".$auction_id." AND placed_back = ".Bids::PLACED_BACK_DEFAULT." 
                                                  AND (status = ".Bids::STATUS_SINGLE." OR status =".Bids::STATUS_MULTI.")
                                            ORDER BY price ASC ) AS b
                                     WHERE b.bidder_id = ".$user_id." )
                        AND a.mySeq < ( SELECT MIN(c.mySeq) AS minId 
                                         FROM(
                                            SELECT
                                                @rownum := @rownum+1 AS mySeq,
                                                bidder_id,
                                                price
                                            FROM
                                                $bids_table,
                                                (SELECT @rownum := 0) AS r
                                            WHERE auction_id = ".$auction_id." AND placed_back = ".Bids::PLACED_BACK_DEFAULT."
                                            ORDER BY price ASC ) AS c
                                         WHERE c.bidder_id != ".$user_id.")";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    function getAnalyseRankList( $auction_id, $option = 0, $optiondashboard = 0, $optionanalyseall = 0, $minprice ){
        // $sql = "SELECT @rownum := @rownum+1 AS Rank, c.price,c.Statistic,c.bidder_id,placed_back 
        //                FROM( 
        //                    ( SELECT @sta := 1 AS STATUS, bidder_id, auction_id, price, @s := 1 AS Statistic ,placed_back 
        //                      FROM bids 
        //                      WHERE auction_id = ".$auction_id." AND (STATUS = ".Bids::STATUS_SINGLE." OR STATUS = ".Bids::STATUS_LOWEST.") 
        //                      ORDER BY price ASC ) 
        //                UNION 
        //                    ( SELECT @sta := 2 AS STATUS, @bidder := '' AS bidder_id, auction_id, price, COUNT(price) AS Statistic ,placed_back 
        //                      FROM bids 
        //                      WHERE auction_id = ".$auction_id." AND STATUS = ".Bids::STATUS_MULTI." 
        //                      GROUP BY auction_id, price 
        //                      ORDER BY price ASC ) 
        //                      ORDER BY price ASC ) AS c,(SELECT @rownum := 0) AS r 
        //                      WHERE c.price>= ".$minprice."  
        //                       ";
        $sqlcount = "SELECT COUNT(price) FROM(";
        $sql = "SELECT * FROM 
                (SELECT 
                   CASE 
                        WHEN bidder_id = '' THEN 'Mehrfach'        
                        WHEN placed_back = 0 THEN @rownum := @rownum+1
                        ELSE 'Zurückgestellt'
                    END
                AS Rank, c.price,c.Statistic,c.bidder_id,placed_back,auction_id 
                FROM( 
                ( SELECT @sta := 1 AS STATUS, bidder_id, auction_id, price, @s := 1 AS Statistic ,placed_back 
                FROM bids 
                WHERE auction_id = ".$auction_id." AND (STATUS = ".Bids::STATUS_SINGLE." OR STATUS = ".Bids::STATUS_LOWEST.") 
                ORDER BY price ASC ) 
                UNION 
                ( SELECT @sta := 2 AS STATUS, @bidder := '' AS bidder_id, auction_id, price, COUNT(price) AS Statistic ,placed_back 
                FROM bids 
                WHERE auction_id = ".$auction_id." AND STATUS = ".Bids::STATUS_MULTI."
                GROUP BY auction_id, price 
                ORDER BY price ASC ) 
                ORDER BY price ASC ) AS c,(SELECT @rownum := 0) AS r 
                ORDER BY STATUS,price ASC 
                )
                AS listv ";
        if( $optionanalyseall == 1 ){
            //$sql .= "WHERE price >= ".$minprice;
        }
        if( $option == 1 ) {
            $sql .= " ORDER BY price ASC";
        }       
        $sqlcount       .= $sql." ) AS a";
        $count          =   Yii::app()->db->createCommand($sqlcount)->queryScalar();
        if( $optiondashboard == 1 ){
            $dataProvider   =   new CSqlDataProvider( $sql, array(
            'totalItemCount'=>$count,
            'sort'=>array(
            'attributes'=>array(
                    'price', 'Statistic', 'bidder_id','Rank',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>5,
            ),
            ));
        }
        else{
            $dataProvider   =   new CSqlDataProvider( $sql, array(
                'totalItemCount'=>$count,
                'sort'=>array(
                'attributes'=>array(
                        'price', 'Statistic', 'bidder_id','Rank',
                    ),
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
        }
        return  $dataProvider;  
    }
    
    function getUserNameAnalyse( $auction_id, $price, $statistic ){
        if( $statistic == 1 ){
            return $statistic;
        }
        else{
            $sql = "SELECT members.username 
                    FROM members 
                    INNER JOIN bids 
                    ON members.id = bids.bidder_id 
                    WHERE bids.auction_id = ".$auction_id." AND bids.price = ".$price;
            $returns = Yii::app()->db->createCommand($sql)->queryAll();
            foreach( $returns as $return ){
                $name .= $return["username"]." &#013;";
            }
            return '<a href="#"  id="'.rand(0,999999).'" class="isw-left tipb" data-original-title="'.$name.'" title="'.$name.'"> <u>'.$statistic.'</u></a>';
        }
    }
    
       function getFrontEndRankList( $auction_id ){
        $sqlcount = "SELECT COUNT(price) FROM(";
        $sql = "SELECT * FROM 
                (SELECT 
                   CASE 
                        WHEN bidder_id = '' THEN 'Mehrfach'        
                        WHEN placed_back = 0 THEN @rownum := @rownum+1
                        ELSE 'Zurückgestellt'
                    END
                AS Rank, c.price,c.Statistic,c.bidder_id,placed_back,auction_id 
                FROM( 
                ( SELECT @sta := 1 AS STATUS, bidder_id, auction_id, price, @s := 1 AS Statistic ,placed_back 
                FROM bids 
                WHERE auction_id = ".$auction_id." AND (STATUS = ".Bids::STATUS_SINGLE." OR STATUS = ".Bids::STATUS_LOWEST.") AND placed_back = ".Bids::PLACED_BACK_DEFAULT." AND placed_back_6 = ".Bids::PLACED_BACK_DEFAULT."
                ORDER BY price ASC ) 
                UNION 
                ( SELECT @sta := 2 AS STATUS, @bidder := '' AS bidder_id, auction_id, price, COUNT(price) AS Statistic ,placed_back 
                FROM bids 
                WHERE auction_id = ".$auction_id." AND STATUS = ".Bids::STATUS_MULTI."
                GROUP BY auction_id, price 
                ORDER BY price ASC ) 
                ORDER BY price ASC ) AS c,(SELECT @rownum := 0) AS r 
                ORDER BY STATUS,price ASC 
                )
                AS listv ";
                    
        $sqlcount       .= $sql." ) AS a";
        $count          =   Yii::app()->db->createCommand($sqlcount)->queryScalar();
        $dataProvider   =   new CSqlDataProvider( $sql, array(
                'totalItemCount'=>$count,
                'sort'=>array(
                'attributes'=>array(
                        'price', 'Statistic', 'bidder_id','Rank',
                    ),
                ),
                'pagination'=>array(
                    'pageSize'=>30,
                ),
            ));
        return  $dataProvider;  
    }
    
    function getMinPrice( $auction_id ){
        $sql = "SELECT MIN(price) AS minprice FROM bids WHERE auction_id = ".$auction_id." AND (STATUS = ".Bids::STATUS_SINGLE." OR STATUS = ".Bids::STATUS_LOWEST.")";
        $resulta = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ( $resulta as $result ){
            return $minprice = ($result['minprice'])?$result['minprice']:0;
        }
    }
    
    function getAnalyseAll( $auction_id, $option = 0, $minprice ){
        $sqlmax = "SELECT MAX(analyses.price) AS maxprice FROM ( ";
        $sqlrank = "SELECT c.status, c.price,@rownum := @rownum+1 AS Rank FROM(  ";
        $sql = "( SELECT
                    @sta := 1 AS STATUS,
                    bidder_id,
                    auction_id,
                    price,
                    @s := 1 AS Statistic
                FROM
                    bids
                WHERE   auction_id = ".$auction_id." 
                        AND (STATUS = ".Bids::STATUS_SINGLE." OR STATUS = ".Bids::STATUS_LOWEST.")
                ORDER BY price ASC )
            UNION 
            	( SELECT
            	    @sta := 2 AS STATUS,
            	    @bidder := '' AS bidder_id,
            	    auction_id,
            	    price,
            	    COUNT(price) AS Statistic
            	FROM
            	   bids
            	WHERE auction_id = ".$auction_id." AND STATUS = ".Bids::STATUS_MULTI."
            	GROUP BY auction_id, price
            	ORDER BY price ASC )
            ORDER BY price ASC";
        $sqlrank .= $sql." ) AS c,(SELECT @rownum := 0) AS r WHERE c.price>= ".$minprice." ORDER BY c.price ASC";    
        $sqlmax .= $sql." ) AS analyses";
        if ( $option == 1 )
            return Yii::app()->db->createCommand($sqlmax)->queryAll();
        elseif ( $option == 2 )
            return Yii::app()->db->createCommand($sqlrank)->queryAll();
        else
            return Yii::app()->db->createCommand($sql)->queryAll();  
    }
    
    function getAnalyseAllNew( $auction_id, $minprice ){
        $sqlcount = "SELECT COUNT(Rank) FROM(";
        $sql = "SELECT Rank,price,Statistic,bidder_id FROM( 
                SELECT @rownum := @rownum+1 AS Rank, c.price,c.Statistic,c.bidder_id 
                FROM( ( SELECT @sta := 1 AS STATUS, bidder_id, auction_id, price, @s := 1 AS Statistic 
                        FROM bids WHERE auction_id = ".$auction_id." AND (STATUS = ".Bids::STATUS_SINGLE." OR STATUS = ".Bids::STATUS_LOWEST.") ORDER BY price ASC ) 
                        UNION 
                        ( SELECT @sta := 2 AS STATUS, @bidder := '' AS bidder_id, auction_id, price, COUNT(price) AS Statistic 
                        FROM bids 
                        WHERE auction_id = ".$auction_id." AND STATUS = ".Bids::STATUS_MULTI." 
                        GROUP BY auction_id, price ORDER BY price ASC ) 
                        ORDER BY price ASC ) AS c,(SELECT @rownum := 0) AS r 
                        WHERE c.price>= ".$minprice."
                UNION 
                (SELECT '' AS Rank, price, Statistic, bidder_id 
                FROM (SELECT @sta := 2 AS STATUS, @bidder := '' AS bidder_id, auction_id, price, COUNT(price) AS Statistic 
                FROM bids 
                WHERE auction_id = ".$auction_id." AND STATUS = ".Bids::STATUS_MULTI." AND price < ".$minprice."
                GROUP BY auction_id, price 
                ORDER BY price ASC ) AS b) ) 
                AS liststa ORDER BY price ASC ";
        $sqlcount       .= $sql." ) AS totalRecord";
        $count          =   Yii::app()->db->createCommand($sqlcount)->queryScalar();
        $dataProvider   =   new CSqlDataProvider( $sql, array(
            'totalItemCount'=>$count,
            'sort'=>array(
            //'attributes'=>array(
//                    'Rank','price','Statistic','bidder_id',
//                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        
        return  $dataProvider;  
    }
    
    function getTotalBidsMember( $auction_id, $bidder_id )
    {
        $sql = "SELECT COUNT(id) AS totalbid FROM bids WHERE auction_id = '$auction_id'  AND bidder_id = '$bidder_id' ";
        $results = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($results  as $result){
            $totalbid = $result['totalbid'];
        }
        return $totalbid;
    }
    
    function getTotalRankingList( $auction_id )
    {
        return Bids::model()->count( 'auction_id =:auction_id AND placed_back=:placed_back AND status=:status', array( ':auction_id' => $auction_id, ':placed_back'=>Bids::PLACED_BACK_DEFAULT, ':status'=>Bids::TYPE_NORMAL ) );
    }
    
    function getStatus($status){
        return Lookup::item('BidStatus', $status);
    }
    
    function getWinner($auction_id)
    {
        $criteria=new CDbCriteria;
        $criteria->condition="auction_id =".$auction_id;
        $criteria->compare('is_win',1);
        return Bids::model()->find($criteria);
    }
    
    function getAmountBids($auction_id)
    {
        $criteria=new CDbCriteria;
        $criteria->select ='SUM(bid_price) amount';
        $criteria->condition="auction_id = ".$auction_id;
        $result= Bids::model()->find($criteria);
        return $result['amount'];
    }

    function showBid($price, $user_id){
     if(Yii::app()->user->id == $user_id)
            return Utils::number_format($price);
     return '####';
    }
    
    function showBidFrondEnd($price, $user_id, $rank){
     if(Yii::app()->user->id == $user_id){
        if( $rank == 1 )
            return '<span class="fix-rangBid">'.Utils::number_format($price).'</span>';
        else
            return '<span class="fix-rangNewBid">'.Utils::number_format($price).'</span>';
     }
     else{  
        if( $rank == 1 )
            return '<span class="fix-rangBid">####</span>';
        else
           return '####';
     }
    }
    
    function getRankMyBid($auction_id,$bid_id,$status,$user_id=null){
        $conditions = "allBids.bidder_id =".$user_id." AND allBids.id = ".$bid_id;
        if($user_id==null) $conditions = "allBids.id = ".$bid_id;
        $sql = "SELECT *
                FROM(
                    SELECT @rownum := @rownum+1 AS rank,id,auction_id, bidder_id,price,@sta := 1 AS status,placed_back
                    FROM  bids,
                        (SELECT @rownum := 0) AS r
                        WHERE auction_id =".$auction_id." AND (status =".self::STATUS_SINGLE." OR status =".self::STATUS_LOWEST.") AND placed_back = 0 AND placed_back_6=0
                        ORDER BY price,STATUS,id DESC ) AS allBids
                    WHERE ".$conditions."
                    ORDER BY allBids.STATUS ASC";
        $result =   Yii::app()->db->createCommand($sql)->queryAll();
        if($status == self::STATUS_SINGLE || $status == self::STATUS_LOWEST) {
            foreach($result as $item)
                return $item['rank'].".";
        }
    }
    
    function checkMultiBids( $auction_id, $bidder_id, $price ){
    	return Bids::model()->exists('auction_id=:auction_id AND bidder_id=:bidder_id AND price=:price', array(':auction_id'=>$auction_id, ':bidder_id'=>$bidder_id, ':price'=>$price));
    }
    
    function updateMultiBids( $auction_id, $price ){
        $bids_table = Bids::model()->tableName();
        $minprice   = Utils::number_format_compare( $this->getMinPrice( $auction_id ) ); 
        if( $minprice == Utils::number_format_compare( $price ) ){
            Yii::app()->db->createCommand()
                ->update( $bids_table,
                    array( 'status' => Bids::STATUS_MULTI ),
                    'auction_id =:id  AND price=:price',
                    array( ':id'=> $auction_id, ':price'=> $price )
                );
            //Update lowest bid if multi Bid is lowest bid
            $minPriceRestore   = $this->getMinPrice( $auction_id ); 
            Yii::app()->db->createCommand()
                ->update( $bids_table,
                    array( 'status' => Bids::STATUS_LOWEST ),
                    'auction_id =:id  AND price=:price',
                    array( ':id'=> $auction_id, ':price'=> $minPriceRestore )
                );
             }
        else{
            Yii::app()->db->createCommand()
                ->update( $bids_table,
                    array( 'status' => Bids::STATUS_MULTI ),
                    'auction_id =:id  AND price=:price',
                    array( ':id'=> $auction_id, ':price'=> $price )
                );
        }  
        $user_id        = $this->getUserIdFirst( $auction_id );
        $listBidsOrders = $this->statusThereBidsOrder( $user_id, $auction_id );
        foreach( $listBidsOrders as $listBidsOrder){
            $totalBidOrder =  $listBidsOrder['total'];
        }
        if( $totalBidOrder < 3 ){
            $sql = "UPDATE ".$bids_table." AS a 
                        INNER JOIN 
                              ( SELECT  MIN(price) AS minprice,bidder_id,auction_id 
                                FROM ".$bids_table." 
                                WHERE auction_id = ".$auction_id." AND bidder_id != ".Yii::app()->user->id." AND placed_back = ".Bids::PLACED_BACK_ACTIVE." ORDER BY id ASC) AS b
                        ON a.price = b.minprice AND a.bidder_id = b.bidder_id AND a.auction_id = b.auction_id
                    SET a.placed_back = ".Bids::PLACED_BACK_DEFAULT."
                    WHERE a.status = ".Bids::STATUS_SINGLE;
            Yii::app()->db->createCommand($sql)->query();
        }
    }
    
    function priceTypeBids( $type, $auction_id ){
        $pricjoker = Auctions::model()->findByPk($auction_id);
        switch ( $type ){
            case self::TYPE_HALF:
                return $pricjoker->bid_price/2;
            case self::TYPE_FREE:
                return 0;
            case self::TYPE_JOKER:
                return $pricjoker->joker_bid_price;
                break;
            case self::TYPE_SPECIAL:
            default:
                return $pricjoker->bid_price;
        }
    }
    
    function getArraySingleBid( $auction_id ){
        $bids_table     = Bids::model()->tableName();
        $getSingleBid   = Yii::app()->db->createCommand()
                            ->select('price')
                            ->from($bids_table)
                            ->where('auction_id=:auction_id AND status=:status', array(':auction_id'=>$auction_id, ':status'=> Bids::STATUS_SINGLE ))
                            ->queryAll();
       return $getSingleBid; 
    }
    
    function getUserIdFirst( $auction_id ){
        $bids_table     = Bids::model()->tableName();
        $getUserId      = Yii::app()->db->createCommand()
                            ->select('bidder_id')
                            ->from($bids_table)
                            ->where('auction_id=:auction_id AND placed_back=:placed_back AND status=:status', array(':auction_id'=>$auction_id, ':placed_back'=>Bids::PLACED_BACK_DEFAULT, ':status'=>Bids::STATUS_SINGLE) )
                            ->order('price ASC')
                            ->limit(1)
                            ->queryAll();
        foreach($getUserId as $userId)
            return $userId['bidder_id'];
        
    }
    
    function CheckJokerbid( $auction_id ){
        $bids_table     = Bids::model()->tableName();
        $checkJokerBid  = Yii::app()->db->createCommand()
                            ->select('COUNT(id) as totalJoker,price')
                            ->from($bids_table)
                            ->where('auction_id=:auction_id AND bidder_id=:bidder_id AND type=:type', array(':auction_id'=>$auction_id, ':bidder_id'=>Yii::app()->user->id, ':type'=>Bids::TYPE_JOKER) )
                            ->queryAll();
        return $checkJokerBid;
    }
    
    function totalBidsOnDay(){
        $sqlcount = "SELECT COUNT(datebid) FROM(";
        $sql = "SELECT DATE_FORMAT(created, '%Y-%m-%d') AS datebid , COUNT(id) AS totalbid
                FROM bids
                GROUP BY datebid
                ORDER BY datebid DESC";
        $sqlcount       .= $sql." ) AS totalbidonday";
        $count          =   Yii::app()->db->createCommand($sqlcount)->queryScalar();
        $dataProvider   =   new CSqlDataProvider( $sql, array(
            'totalItemCount'=>$count,
            'sort'=>array(
            'attributes'=>array(
                    'datebid','totalbid',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        return $dataProvider;
    }

    function getMyBid($auction_id){
        $result[] = 0;
       if(!Yii::app()->user->isGuest ){
           $criteria=new CDbCriteria;
           $criteria->select ='id';
           $criteria->condition="auction_id = ".$auction_id."  AND placed_back = 0 AND bidder_id=".Yii::app()->user->id." AND (status =".self::STATUS_LOWEST." OR status =".self::STATUS_SINGLE.")";
           $data =  Bids::model()->findAll($criteria);
           foreach ($data as $d)
               $result[] = $d->id;
       }
        return $result;
    }
    function getRankFrontEnd( $bidder_id, $rank ){
        if( $rank == 1 )
            return "<span class='fix-rangBid'>".Yii::t('global','Lowest Single Bid')."</span>";
        else if( $bidder_id == Yii::app()->user->id )
            return "<span class='fix-rangNewBid'>".$rank." ".self::model()->rangBids()."</span>";
        else{
            $ranks = ( $rank == 'Mehrfach' ) ? Yii::t('global', 'Multi bid') :$rank;

            return $ranks." ".self::model()->rangBids();
        }
            
    }
    
    function getStyleBid($type,$auction_id,$bid_id,$status,$user_id = null,$bidder = null,$price=null,$bidder_id = null){
        $rankBid = $this->getRankMyBid($auction_id,$bid_id,$status,$user_id );
        $myBid = in_array($bid_id,$this->getMyBid($auction_id));
        if($type=='rank'){
            if($rankBid ==1) {
                return "<span class='fix-rangBid'>".Yii::t('global','Lowest Single Bid')."</span>";
            } else  if($myBid){
                return "<span class='fix-rangNewBid'>".$this->getRankMyBid($auction_id,$bid_id,$status,$user_id)." ".$this->rangBids()."</span>";
            } else {
                return $this->getRankMyBid($auction_id,$bid_id,$status,$user_id)." ".$this->rangBids();
            }
        } else if($type =='bidder') {
            if($rankBid ==1){
                return " <span class='fix-rangBid'> ".$bidder."</span>" ;
            } else  if($myBid){
                return " <span class='fix-rangNewBid'> ".$bidder."</span>" ;
            } else {
                return $bidder;
            }
        } else if($type=='bid'){
            if($rankBid ==1){
                return "<span class='fix-rangBid'> ".$this->showBid($price,$bidder_id)."</span>";
            } else  if($myBid){
                return "<span class='fix-rangNewBid'> ".$this->showBid($price,$bidder_id)."</span>";
            } else {
                return $this->showBid($price,$bidder_id);
            }
        }
    }

    function getStyleBidEnded($type,$auction_id,$bid_id,$status,$user_id = null,$bidder = null,$price=null,$bidder_id = null){
        $rankBid = $this->getRankMyBid($auction_id,$bid_id,$status,$user_id );
        if($type=='rank'){
            if($rankBid ==1) {
                return "<span class='fix-rangBid'>".Yii::t('global','Lowest Single Bid')."</span>";
            } else {
                return $this->getRankMyBid($auction_id,$bid_id,$status,$user_id)." ".$this->rangBids();
            }
        } else if($type =='bidder') {
            if($rankBid ==1){
                return " <span class='fix-rangBid'> ".$bidder."</span>" ;
            } else  if($status==Bids::STATUS_MULTI){
                return "";
            } else {
                return $bidder;
            }
        } else if($type=='bid'){
            if($rankBid ==1){
                return "<span class='fix-rangBid'> ".Utils::number_format($price)."</span>";
            } else {
                return Utils::number_format($price);
            }
        }
    }
}