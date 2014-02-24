<?php

/**
 * This is the model class for table "auctions".
 *
 * The followings are the available columns in table 'auctions':
 * @property integer $id
 * @property integer $product_id
 * @property double $max_price
 * @property double $bid_price
 * @property integer $countdown
 * @property string $start_time
 * @property string $end_time
 * @property integer $bid_quote
 * @property integer $is_featured
 * @property integer $as_banner
 * @property integer $special_bid
 * @property string $special_bid_start_time
 * @property string $special_bid_end_time
 * @property integer $special_bid_start_quote
 * @property integer $special_bid_end_quote
 * @property integer $half_price_bid
 * @property integer $half_price_bid_start_quote
 * @property integer $half_price_bid_end_quote
 * @property integer $free_bid
 * @property integer $free_bid_start_quote
 * @property integer $free_bid_end_quote
 * @property double $joker_bid_price
 * @property string $joker_bid_code
 * @property integer $joker_position_from
 * @property integer $joker_position_to
 * @property integer $cashback_position_2
 * @property integer $cashback_position_3
 * @property double $comfort_bid_credit
 * @property string $created
 * @property string $updated
 * @property integer $type
 * @property integer $basic_participant_min
 * @property integer $basic_participant_max
 * @property double $basic_join_fee
 * @property integer $basic_max_bids_number
 * @property integer $is_phase
 *
 * The followings are the available model relations:
 * @property AuctionViews[] $auctionViews
 * @property AuctionVotes[] $auctionVotes
 * @property Products $product
 * @property integer $producer_id
 * @property Bids[] $bids
 */
class Auctions extends CActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_UPCOMING = 2;
    const STATUS_FINISHED = 3;
    const STATUS_ACTIVE_UPCOMING = 4;

    const TYPE_LOWPRICE = 1;
    const TYPE_BASIC = 2;
    
    const PHASE_WITHOUT = 1;
    const PHASE_HOT = 2;
    const PHASE_ENDNOW = 3;
    const PHASE_ENDTODAY = 4;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Auctions the static model class
     */
    public $product_name, $yes_count, $no_count, $amount, $status, $joinCount,$status_active_upcoming,$remaindate;
    public $producer_name,$category,$bids_count, $phase, $max_bid_quote_new;
    //public $bid_count, $bid_amount, $join_count, $view_count;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'auctions';
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
            array('product_id, max_price, countdown, start_time, bid_quote', 'required'),
            array('product_id, countdown, bid_quote, is_featured, as_banner, special_bid, special_bid_start_quote, special_bid_end_quote, half_price_bid, half_price_bid_start_quote, half_price_bid_end_quote, free_bid, free_bid_start_quote, free_bid_end_quote, joker_position_from, joker_position_to, cashback_position_2, cashback_position_3, type, basic_join_fee, basic_participant_min, basic_participant_max, basic_max_bids_number, is_phase', 'numerical', 'integerOnly'=>true),
            array('max_price, bid_price, joker_bid_price, comfort_bid_credit', 'numerical'),
            array('joker_bid_code', 'length', 'max'=>12),
            array('end_time, special_bid_start_time, special_bid_end_time, created, updated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, product_id, max_price, bid_price, countdown, start_time, end_time, bid_quote, is_featured, as_banner, special_bid, special_bid_start_time, special_bid_end_time, special_bid_start_quote, special_bid_end_quote, half_price_bid, half_price_bid_start_quote, half_price_bid_end_quote, free_bid, free_bid_start_quote, free_bid_end_quote, joker_bid_price, joker_bid_code, joker_position_from, joker_position_to, cashback_position_2, cashback_position_3, comfort_bid_credit, created, updated, product_name, amount, status, type, basic_participant_min, basic_participant_max, basic_join_fee, basic_max_bids_number,status_active_upcoming,phase,is_phase', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
//        $result = array();
        $user_id = (isset(Yii::app()->user->id)?Yii::app()->user->id:0);
        return array(
            'auctionJoins' => array(self::HAS_MANY, 'AuctionJoins', 'auction_id'),
            'auctionViews' => array(self::HAS_MANY, 'AuctionViews', 'auction_id'),
            'auctionVotes' => array(self::HAS_MANY, 'AuctionVotes', 'auction_id'),
            'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
            'bids' => array(self::HAS_MANY, 'Bids', 'auction_id'),//,
            'bids_order_price' => array(self::HAS_MANY, 'Bids', 'auction_id', 'order' => 'price'),//,  
            
            'bids_single_order_price' => array(self::HAS_MANY, 'Bids', 'auction_id', 'order' => 'price','condition'=>'status ='.Bids::STATUS_SINGLE),
            'bids_owner_single_order_price' => array(self::HAS_MANY, 'Bids', 'auction_id', 'order' => 'price','condition'=>'bidder_id = '.$user_id.' AND status ='.Bids::STATUS_SINGLE),//,
            'bids_single_order_price_placed_back_6' => array(self::HAS_MANY, 'Bids', 'auction_id', 'order' => 'price','condition'=>'(status ='.Bids::STATUS_SINGLE.' OR status ='.Bids::STATUS_LOWEST.') AND placed_back = '.Bids::PLACED_BACK_DEFAULT.' AND placed_back_6 = '.Bids::PLACED_BACK_DEFAULT),
            'bids_order_id' => array(self::HAS_MANY, 'Bids', 'auction_id', 'order' => 'id ASC'),

            'lowest_bid' => array(self::HAS_ONE, 'Bids', 'auction_id','condition'=>'status ='.Bids::STATUS_LOWEST),
            'win_bid' => array(self::HAS_ONE, 'Bids', 'auction_id','condition'=>'is_win = 1'),

            'user_joined'=>array(self::STAT,'AuctionJoins','auction_id','select' =>'auction_id','condition'=>'user_id ='.$user_id),
            'join_count'=>array(self::STAT,'AuctionJoins','auction_id'),
            'view_count'=>array(self::STAT,'AuctionViews','auction_id'),
            'vote_count'=>array(self::STAT,'AuctionVotes','auction_id'),
            'bid_amount'=>array(self::STAT,'Bids','auction_id', 'select' => 'SUM(bid_price)'),
            'bid_count'=>array(self::STAT,'Bids','auction_id'),
            'bid_count_single'=>array(self::STAT,'Bids','auction_id','condition'=>'status ='.Bids::STATUS_SINGLE.' OR status ='.Bids::STATUS_LOWEST),
            'order_count' =>  array(self::STAT,'Bids','item_id', 'condition' => 'type='.OrderItems::DIRECT_BUY),
            'productCategories' => array(self::HAS_MANY, 'ProductCategories', 'product_id'),
            'productGalleries' => array(self::HAS_MANY, 'ProductGalleries', 'auction_id'),
            
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('global', 'ID'),
            'product_id' => Yii::t('global', 'Product'),
            'max_price' => Yii::t('global', 'Max Price'),
            'bid_price' => Yii::t('global', 'Bid Price'),
            'countdown' => Yii::t('global', 'Countdown'),
            'start_time' => Yii::t('global', 'Start Time'),
            'end_time' => Yii::t('global', 'End Time'),
            'bid_quote' => Yii::t('global', 'Bid quote'),
            'is_featured' => Yii::t('global', 'Is Featured'),
            'as_banner' => Yii::t('global', 'As Banner'),
            'special_bid' => Yii::t('global', 'Special bid'),
            'special_bid_start_time' => Yii::t('global', 'Special Bid Start Time'),
            'special_bid_end_time' => Yii::t('global', 'Special Bid End Time'),
            'special_bid_start_quote' => Yii::t('global', 'Special Bid Start Quote'),
            'special_bid_end_quote' => Yii::t('global', 'Special Bid End Quote'),
            'half_price_bid' => Yii::t('global', 'Half Price Bid'),
            'half_price_bid_start_quote' => Yii::t('global', 'Half Price Bid Start Quote'),
            'half_price_bid_end_quote' => Yii::t('global', 'Half Price Bid End Quote'),
            'free_bid' => Yii::t('global', 'Free Bid'),
            'free_bid_start_quote' => Yii::t('global', 'Free Bid Start Quote'),
            'free_bid_end_quote' => Yii::t('global', 'Free Bid End Quote'),
            'joker_bid_price' => Yii::t('global', 'Joker Bid Price'),
            'joker_bid_code' => Yii::t('global', 'Joker Bid Code'),
            'joker_position_from' => Yii::t('global', 'Joker Position From'),
            'joker_position_to' => Yii::t('global', 'Joker Position To'),
            'cashback_position_2' => Yii::t('global', 'Cashback Position 2'),
            'cashback_position_3' => Yii::t('global', 'Cashback Position 3'),
            'comfort_bid_credit' => Yii::t('global', 'Comfort Bid Credit'),
            'created' => Yii::t('global', 'Created'),
            'updated' => Yii::t('global', 'Updated'),
            'status' => Yii::t('global', 'Status'),
            'basic_participant_min' => Yii::t('global', 'Participant Min'),
            'basic_participant_max' => Yii::t('global', 'Participant Max'),
            'basic_join_fee' => Yii::t('global', 'Join Fee'),
            'basic_max_bids_number' => Yii::t('global', 'Max Bids Number'),
            'is_phase' => Yii::t('global', 'Is Phase'),
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
        $criteria->with = array('product', 'bid_amount', 'bid_count','product','bid_count_single');
        $criteria->together = true;
              
        $criteria->compare('t.id',$this->id);
        $criteria->compare('product_id',$this->product_id);
        $criteria->compare('max_price',$this->max_price);
        $criteria->compare('bid_price',$this->bid_price);
        $criteria->compare('countdown',$this->countdown);
        if ($this->start_time)
            $criteria->compare('DATE(start_time)',date('Y-m-d', strtotime($this->start_time)),true);
        $criteria->compare('end_time',$this->end_time,true);
        $criteria->compare('bid_quote',$this->bid_quote);
        $criteria->compare('is_featured',$this->is_featured);
        $criteria->compare('as_banner',$this->as_banner);
        $criteria->compare('special_bid',$this->special_bid);
        $criteria->compare('special_bid_start_time',$this->special_bid_start_time,true);
        $criteria->compare('special_bid_end_time',$this->special_bid_end_time,true);
        $criteria->compare('special_bid_start_quote',$this->special_bid_start_quote);
        $criteria->compare('special_bid_end_quote',$this->special_bid_end_quote);
        $criteria->compare('half_price_bid',$this->half_price_bid);
        $criteria->compare('half_price_bid_start_quote',$this->half_price_bid_start_quote);
        $criteria->compare('half_price_bid_end_quote',$this->half_price_bid_end_quote);
        $criteria->compare('free_bid',$this->free_bid);
        $criteria->compare('free_bid_start_quote',$this->free_bid_start_quote);
        $criteria->compare('free_bid_end_quote',$this->free_bid_end_quote);
        $criteria->compare('joker_bid_price',$this->joker_bid_price);
        $criteria->compare('joker_bid_code',$this->joker_bid_code,true);
        $criteria->compare('joker_position_from',$this->joker_position_from);
        $criteria->compare('joker_position_to',$this->joker_position_to);
        $criteria->compare('cashback_position_2',$this->cashback_position_2);
        $criteria->compare('cashback_position_3',$this->cashback_position_3);
        $criteria->compare('comfort_bid_credit',$this->comfort_bid_credit);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('updated',$this->updated,true);
        $criteria->compare('product.name',$this->product_name,true);
        $criteria->compare('amount',$this->amount,true);
        $criteria->compare('is_phase',$this->is_phase);

        $criteria->compare("IF (end_time IS NOT NULL && end_time <> '0000-00-00 00:00:00', ".self::STATUS_FINISHED.", IF(start_time <= NOW(), ".self::STATUS_ACTIVE.", ".self::STATUS_UPCOMING."))",$this->status,true);
        //$criteria->compare("IF (bid_quote > 0 && bid_quote <= ".Yii::app()->settings->auction_hot.", ".self::PHASE_HOT.", IF(bid_quote = 0,".self::PHASE_ENDTODAY.", IF(bid_quote = ".Yii::app()->settings->auction_endnow.", ".self::PHASE_ENDNOW.",".self::PHASE_WITHOUT.")))",$this->phase,true);
        if($this->status_active_upcoming)
              $criteria->compare("IF(end_time IS NULL || end_time = '0000-00-00 00:00:00',".self::STATUS_ACTIVE_UPCOMING.",0)",$this->status_active_upcoming,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('basic_participant_min',$this->basic_participant_min);
        $criteria->compare('basic_participant_max',$this->basic_participant_max);
        $criteria->compare('basic_join_fee',$this->basic_join_fee);
        $criteria->compare('basic_max_bids_number',$this->basic_max_bids_number);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            
              'sort'=>array(
              'defaultOrder'=>'start_time DESC',
                'attributes'=>array(
                    'product_name'=>array(
                        'asc'=>'product.name',
                        'desc'=>'product.name DESC',
                    ),
                    'remaindate'=>array(
                        'asc'=>'(SELECT id FROM auctions WHERE  t.id = auctions.id )',
                        'desc'=>'(SELECT id FROM auctions WHERE  t.id = auctions.id ) DESC',
                    ),
                    'bids_count'=>array(
                        'asc'=>'(SELECT COUNT(bids.id) FROM bids
                                WHERE t.id = bids.auction_id
                                )',
                        'desc'=>'(SELECT COUNT(bids.id) FROM bids
                                  WHERE t.id = bids.auction_id
                                  ) DESC',
                    ),
                    'status'=>array(
                        'asc'=>"(SELECT IF (end_time IS NOT NULL && end_time <> '0000-00-00 00:00:00', ".self::STATUS_FINISHED.", IF(start_time <= NOW(), ".self::STATUS_ACTIVE.", ".self::STATUS_UPCOMING.")) FROM auctions WHERE  t.id = auctions.id )",
                        'desc'=>"(SELECT IF (end_time IS NOT NULL && end_time <> '0000-00-00 00:00:00', ".self::STATUS_FINISHED.", IF(start_time <= NOW(), ".self::STATUS_ACTIVE.", ".self::STATUS_UPCOMING.")) FROM auctions WHERE  t.id = auctions.id ) DESC",
                    ),
                    'max_bid_quote_new'=>array(
                        'asc'=>"(SELECT (( SELECT COUNT(id) FROM auction_joins WHERE auction_id = t.id) * basic_max_bids_number ) FROM auctions WHERE  t.id = auctions.id )",
                        'desc'=>"(SELECT (( SELECT COUNT(id) FROM auction_joins WHERE auction_id = t.id) * basic_max_bids_number ) FROM auctions WHERE  t.id = auctions.id ) DESC",
                    ),
                    '*',
                ),
            ),
        ));
    }

    public function beforeValidate(){
        if ($this->countdown){
            $tmp = explode(':', $this->countdown);
            $this->countdown = $tmp[0]*3600 + $tmp[1]*60;
        }
        return parent::beforeValidate();
    }
    public function afterFind(){
        if ($this->countdown){
            $hours = floor($this->countdown/3600);
            $mins = ($this->countdown%3600)/60;
            $this->countdown = "$hours:$mins";
        }
        else{
            $this->countdown = "02:00";
        }
        return parent::afterFind();
    }

    public function beforeSave(){
        if ($this->is_featured){
            Auctions::model()->updateAll(array('is_featured' => 0));
        }
        
        if (strpos($this->countdown, ':') !== false){
            $tmp = explode(':', $this->countdown);
            $this->countdown = $tmp[0]*3600 + $tmp[1]*60;
        }

        return parent::beforeSave();
    }

    function getCountDown(){
        $tmp = explode(':', $this->countdown);
        $countdown = $tmp[0]*3600 + $tmp[1]*60;
        $loop_times = ceil((time() - strtotime($this->start_time)) / $countdown);
        $end_time = strtotime($this->start_time) + $countdown*$loop_times;
        $duration = $end_time - time();
        $seconds = $duration%$countdown;
        $h = floor($seconds/3600);
        $m = floor(($seconds-$h*3600)/60);
        $s = $seconds%60;

        if (strlen($h) == 1) $h = '0'.$h;
        if (strlen($m) == 1) $m = '0'.$m;
        if (strlen($s) == 1) $s = '0'.$s;
        return "$h : $m : $s";
    }

    function getActiveStatus(){
        if ($this->bid_quote > 0 & $this->bid_quote <= Yii::app()->settings->auction_hot){
            return 'hot';
        }
        else if ($this->bid_quote == 0){
            $tmp = explode(':', $this->countdown);
            $countdown = $tmp[0]*3600 + $tmp[1]*60;

            $loop_times = ceil((time() - strtotime($this->start_time)) / $countdown);
            $end_time = strtotime($this->start_time) + $countdown*$loop_times;
            $duration = $end_time - time();

            $seconds = $duration%$countdown;
            if ($seconds <= Yii::app()->settings->auction_endnow)
                return 'endnow';
            if($seconds > Yii::app()->settings->auction_endtoday)
                return 'endtoday';
        }
        return '';
    }

    function isNew(){
        return strtotime(date("Y-m-d")) == strtotime(date("Y-m-d", strtotime($this->start_time)));
    }

    function findFeatured(){
        return self::model()->findByAttributes(array('is_featured' => 1),array('order'=>'id DESC', 'limit'=>1));
    }
    
    function getAuctionsViewed($auction_id,$user_id=null)
    {
        $auctionViewed = AuctionViews::model()->find(array(
                'condition'=>'auction_id=:auction_id AND user_id=:user_id',
                'params'=>array(':auction_id'=>$auction_id,':user_id'=>$user_id),
            )
        );
        return $auctionViewed['user_id'];
    }


    public function getEnded()
    {
        $criteria=new CDbCriteria;
        $criteria->with = array('bids');
        $criteria->order="t.end_time DESC";
        $criteria->condition="t.end_time IS NOT NULL OR end_time <> '0000-00-00 00:00:00'";
        $criteria->compare('is_win',1);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public function getEndedAuction($type)
    {
        $criteria=new CDbCriteria;
        $criteria->with = array('bids');
        $criteria->together = true;
        $criteria->condition="(end_time IS NOT NULL AND end_time <> '0000-00-00 00:00:00') AND t.type=$type";
        $criteria->compare('bids.is_win',1);
        $criteria->order = 'end_time DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function getAllEndedAuction()
    {
        $criteria=new CDbCriteria;
        $criteria->with = array('bids');
        $criteria->together = true;
        $criteria->condition="(end_time IS NOT NULL AND end_time <> '0000-00-00 00:00:00')";
        $criteria->compare('bids.is_win',1);
        $criteria->order = 'end_time DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    function statistics(){
        $sql = "SELECT status, COUNT(*) c FROM(
        	SELECT id, IF (end_time IS NOT NULL OR end_time <> '0000-00-00 00:00:00', ".self::STATUS_FINISHED.", IF(start_time <= NOW(), ".self::STATUS_ACTIVE.", ".self::STATUS_UPCOMING.")) status FROM auctions
        ) stas
        GROUP BY status";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function statisticBidStatus(){
        $sql = "SELECT status, COUNT(*) c FROM bids WHERE auction_id = {$this->id} GROUP BY status";
        $result =  Yii::app()->db->createCommand($sql)->queryAll();
        $sql1 = "SELECT bidder_id  FROM bids WHERE auction_id = {$this->id} GROUP BY bidder_id";
        $activeBidder =  Yii::app()->db->createCommand($sql1)->queryAll();
        $stas = array('total' => 0, Bids::STATUS_SINGLE => 0, Bids::STATUS_MULTI => 0, Bids::STATUS_LOWEST => 0,'activeBidder'=>count($activeBidder));
        foreach ($result as $r){
            $stas[$r['status']] = $r['c'];
            $stas['total'] += $r['c'];
        }

        return $stas;
    }

    function getStringStatus($status){

        return Lookup::item('AuctionStatus', $status);
    }
    
    function getStatus(){
            $date_current = $date = date('Y-m-d H:i:s');
            if ($this->end_time != '' && $this->end_time != '0000-00-00 00:00:00')
                return self::STATUS_FINISHED;
            if (strtotime($this->start_time) <= strtotime($date_current))
                return self::STATUS_ACTIVE;
            return self::STATUS_UPCOMING;
    }
    
    function getStatusBasic(){
            $date_current = $date = date('Y-m-d H:i:s');
            if ($this->end_time != '' && $this->end_time != '0000-00-00 00:00:00')
                return self::STATUS_FINISHED;
            return self::STATUS_ACTIVE;
    }
    
    function getRemainingDate( $auction_id ){
        $sql    = "SELECT IF(ab=1, '', start_time) AS remainingdate FROM (SELECT (CASE WHEN end_time!='' && end_time!='0000-00-00 00:00:00' THEN 1 ELSE 0 END) AS ab, id, start_time FROM auctions WHERE  auctions.id = '$auction_id' ) AS remaindate";
        $results = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($results as $result )
            $remainingdate = $result['remainingdate'];
        return $remainingdate;
    }
    
    function isFinished(){
        return $this->getStatus() == self::STATUS_FINISHED;
    }
    
    function findFeatureCheckEnd(){
         return self::model()->find(array(
            'condition'=>' is_featured = 1 AND (end_time IS NULL OR end_time = "0000-00-00 00:00:00") ORDER BY id DESC',
        ));
    }
    
    function updateIsPhase( $auction_id, $is_phase ){
        $auction_table = Auctions::tableName();
        Yii::app()->db->createCommand()
                ->update( $auction_table,
                    array( 'is_phase' => $is_phase ),
                    'id =:id',
                    array( ':id'=> $auction_id )
                );
    }
    
    function getActiveStatusPhase( $auction_id, $bid_quote, $inputcountdown,$start){
        error_reporting(0);
        if ($bid_quote > 0 & $bid_quote <= Yii::app()->settings->auction_hot){
            Auctions::updateIsPhase( $auction_id, Auctions::PHASE_HOT );
            return Yii::t('global','Hot');
        }
        else if ($bid_quote == 0){
            $tmp = explode(':', $inputcountdown);
            $countdown = $tmp[0]*3600 + $tmp[1]*60;

            $loop_times = ceil((time() - strtotime($start)) / $countdown);
            $end_time = strtotime($start) + $countdown*$loop_times;
            $duration = $end_time - time();

            $seconds = $duration%$countdown;
            if ($seconds <= Yii::app()->settings->auction_endnow){
                Auctions::updateIsPhase( $auction_id, Auctions::PHASE_ENDNOW );
                return Yii::t('global', 'End now');
                }
            if($seconds > Yii::app()->settings->auction_endtoday){
                Auctions::updateIsPhase( $auction_id, Auctions::PHASE_ENDTODAY );
                return Yii::t('global', 'End today');
                }
        }
        Auctions::updateIsPhase( $auction_id, Auctions::PHASE_WITHOUT );
        return Yii::t('global', 'Without phase');;
    }
    
    function getAuctionVotes()
    {
        $criteria=new CDbCriteria;
        $criteria->with = array('auctionVotes','product','product.producer','product.productCategories','product.productCategories.category');
        $criteria->together = true;
        $auctionVotes_table = AuctionVotes::model()->tableName();
        $votes_yes_count_sql = "(SELECT count(*) FROM $auctionVotes_table pt WHERE pt.auction_id = t.id and vote =".AuctionVotes::YES.")";
        $votes_no_count_sql = "(SELECT count(*) FROM $auctionVotes_table pt WHERE pt.auction_id = t.id and vote =".AuctionVotes::NO.")";

        $criteria->select = array(
            '*',
            $votes_yes_count_sql . " as yes_count ",
            $votes_no_count_sql . " as no_count",
        );
     
        $criteria->condition="t.id = auctionVotes.auction_id";
        $criteria->compare('t.id',$this->id);
        $criteria->compare('product.name',$this->product_name,true);
        $criteria->compare('yes_count',$this->yes_count);
        $criteria->compare('no_count',$this->no_count);
        $criteria->compare('producers.name',$this->producer_name,true);
        $criteria->compare('category.id',$this->category,true);
        $criteria->group = 't.id';
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'sort'=>array(
                'defaultOrder'=>'yes_count,no_count DESC',
                'attributes'=>array(
                    'product_name'=>array(
                        'asc'=>'product.name',
                        'desc'=>'product.name DESC',
                    ),
                    'yes_count'=>array(
                        'asc'=>'yes_count',
                        'desc'=>'yes_count DESC',
                    ),
                    'no_count'=>array(
                        'asc'=>'no_count',
                        'desc'=>'no_count DESC',
                    ),
                    'producer_name'=>array(
                        'asc'=>'producer.name',
                        'desc'=>'producer.name DESC',
                    ),
                    'category'=>array(
                        'asc'=>'category.name',
                        'desc'=>'category.name DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }


    function canDelete(){
        return $this->bid_count == 0;
    }
    
    
    //for activities
    function getBidAuctionIdsOfUser($user_id){
        if($user_id != null){
            $sql = "SELECT DISTINCT auction_id FROM bids WHERE bidder_id = $user_id";

            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $result = array();

            foreach ($data as $d)
                $result[] = $d['auction_id'];

            return $result;
        }

    }        
    function getUserActivities($user_id){
        $criteria=new CDbCriteria;
        $result = $this->getBidAuctionIdsOfUser($user_id);
        $criteria->condition="start_time <= NOW() AND (end_time IS NULL OR end_time = '0000-00-00 00:00:00') AND
            id IN (".implode(',', ($result)? $result : array(0) ).")";
        $criteria->order = 'bid_quote, countdown ';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>8,
            ),
        ));
    }
    
    function countUserActivities($user_id){
        $result = $this->getBidAuctionIdsOfUser($user_id);
        $auction_table = Auctions::model()->tableName();
        $sql = "SELECT Count(id) as totalActivities FROM $auction_table WHERE start_time <= NOW() AND (end_time IS NULL OR end_time = '0000-00-00 00:00:00') AND
            id IN (".implode(',', ($result)? $result : array(0) ).")";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }
    
    //end activities
    
    //for my finished auction
    function getWinAuctionIdsOfUser($user_id){
        $sql = "SELECT DISTINCT auction_id FROM bids WHERE bidder_id = $user_id AND is_win=1";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        $sql_join =  "SELECT aj.auction_id FROM auction_joins aj JOIN auctions au ON au.id=aj.auction_id JOIN bids b ON b.auction_id = au.id WHERE user_id = $user_id AND b.is_win=1";
        $data_join = Yii::app()->db->createCommand($sql_join)->queryAll();
        $result[] = 0;        
        foreach ($data as $d)
            $result[] = $d['auction_id'];
        foreach ($data_join  as $d_join)
            $result[] = $d_join['auction_id'];
        array_unique($result);
        return $result;
    }
    function getAuctionUserJoin($user_id){
        $sql = "SELECT DISTINCT auction_id FROM bids WHERE bidder_id = $user_id";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        $sql_join =  "SELECT aj.auction_id FROM auction_joins aj JOIN auctions au ON au.id=aj.auction_id JOIN bids b ON b.auction_id = au.id WHERE user_id = $user_id ";
        $data_join = Yii::app()->db->createCommand($sql_join)->queryAll();
        $result[] = 0;
        foreach ($data as $d)
            $result[] = $d['auction_id'];
        foreach ($data_join  as $d_join)
            $result[] = $d_join['auction_id'];
        array_unique($result);
        return $result;
    }
    
    function getUserCompleted($user_id){
        $result =  $this->getAuctionUserJoin($user_id);
        $criteria=new CDbCriteria;
        $criteria->condition="id IN (".implode(',', ($result)? $result: array(0)).") AND end_time IS NOT NULL AND end_time <>'0000-00-00 00:00:00' ";
        $criteria->order = 'end_time DESC ';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>8,
            ),
        ));
    }
    //end my finished auction
    
     function checkEnd($id){
        $sql = "SELECT COUNT(a.id) as checkAuction
                FROM auctions a 
                INNER JOIN bids b ON a.id = b.auction_id
                WHERE b.is_win = 1 AND a.end_time IS NOT NULL AND a.end_time != '0000-00-00 00:00:00' AND a.id = '$id'";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    function evaluationAuction( ){
        $sqlcount = "SELECT COUNT(id) FROM(";
        $sql = "SELECT infor.* , freeb.freebid
                FROM (    
                    SELECT geta.*,noof.noofbid
                    FROM
                	( SELECT aucti.*,memwin.bidder_id,memwin.username FROM	
                		( SELECT auct.* , free.singlebid, auct.totalbid - free.singlebid AS mutilbid
                		FROM (
                			SELECT a.*,b.* 
                			FROM
                				( 
                				SELECT au.id,au.start_time,au.end_time,au.bid_price,au.bid_quote,pro.name  
                				FROM auctions au
                				LEFT JOIN products pro
                				ON au.product_id = pro.id 
                				) AS a
                			LEFT JOIN 
                				(	
                				SELECT auction_id,COUNT(auction_id) AS totalbid 
                				FROM bids 
                				GROUP BY auction_id
                				) AS b 
                			ON a.id = b.auction_id
                			) AS auct
                		LEFT JOIN 
                		( 
                		 SELECT COUNT(STATUS) AS singlebid,auction_id FROM bids WHERE STATUS = 1 OR STATUS = 3 GROUP BY auction_id
                		) AS free
                		ON auct.id = free.auction_id) AS aucti
                		LEFT JOIN 			
            			(     
            				SELECT onemem.auction_id, onemem.bidder_id, membe.username FROM (
            					SELECT auction_id, bidder_id FROM bids WHERE STATUS = 3 GROUP BY auction_id ) AS onemem
            				LEFT JOIN 
            					( SELECT id,username FROM members ) AS membe
            				ON onemem.bidder_id = membe.id
            			 ) AS memwin
            		 ON aucti.id = memwin.auction_id ) AS geta
            	  LEFT JOIN 
            	      ( SELECT auction_id,bidder_id,COUNT(bidder_id) AS noofbid  FROM bids GROUP BY auction_id,bidder_id ) AS noof
            	  ON geta.bidder_id = noof.bidder_id AND geta.id = noof.auction_id
            	  ) AS infor
            	  LEFT JOIN 
            	  (
            		SELECT auction_id,COUNT(TYPE) AS freebid FROM bids WHERE TYPE = 2 GROUP BY auction_id
            	  ) AS freeb
            	  ON infor.id = freeb.auction_id";
                  //ORDER BY infor.totalbid DESC
        $sqlcount       .= $sql." ) AS a";
        $count          =   Yii::app()->db->createCommand($sqlcount)->queryScalar();
        $dataProvider   =   new CSqlDataProvider( $sql, array(
            'totalItemCount'=>$count,
            'sort'=>array(
            'attributes'=>array(
                    'name', 'singlebid', 'totalbid', 'username','noofbid','mutilbid','singlebid','freebid'
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        
        return  $dataProvider;  
    }
    
    function getBidQuote( $bid_quote, $totalbid ){
        if( $bid_quote >= 0 )
        return $bid_quote + $totalbid;
    }
    
    function myDivision( $a, $b ) {
                if($b == 0)
                    $c = 0;
                else
                    $c = @($a/$b); 
   
                return $c;
            }
    
    function getAdditionalBid( $total, $bid_quote ){
          $addbid = ( $total > $bid_quote )? $total - $bid_quote : 0;
          return $addbid;
    }
    
    function getDurationBid( $start, $end ){
        if( $end == NULL || $end == '0000-00-00 00:00:00' ){
           $endtime = date("Y-m-d H:i:s");
        }
        else{
           $endtime = $end;
        }
        $datetime1      = new DateTime($start);
        $datetime2      = new DateTime($endtime);
        $interval       = $datetime1->diff($datetime2);
        $res            = str_replace( '+', '', $interval->format('%R%a %R%h:%R%i') );
        $splitres       = explode( ' ', $res);
        return $splitres[0].' '.Yii::t('global','Day').' '.$splitres[1];
    }
    
    function getDayLeft(){
        $duration = strtotime($this->start_time) - time();
        $d = floor($duration/(86400));
        $h = floor(($duration-$d*86400)/3600);
        $m = intval(($duration/60)%60);
        $s = $duration%60;
        if (strlen($h) == 1) $h = '0'.$h;
        if (strlen($m) == 1) $m = '0'.$m;
        if (strlen($s) == 1) $s = '0'.$s;
        return "<span class='day_basic'>".$d."</span> <span class='time_basic'> ".$h." : ".$m." : ".$s."</span>";

    }

    function getTypeAuctions($type){
        if($type == self::TYPE_BASIC)
            return Yii::t('global','Basic');
        return Yii::t('global','Low-price');
    }
    function getTwoEndedNew(){
        $criteria=new CDbCriteria;
        $criteria->with = array('bids');
        $criteria->condition=" end_time IS NOT NULL AND end_time <> '0000-00-00 00:00:00'";
        $criteria->compare('is_win',1);
        $criteria->order = 'end_time DESC LIMIT 2';
        //$criteria->limit = 2;
        return $this->findAll($criteria);
    }
    
    function setEnd(){
        $win_bid = Bids::model()->findByAttributes(array(
            'auction_id' => $this->id,
            'status' => Bids::STATUS_LOWEST
        ));
        if ($win_bid){
            //set end for auction
            $this->end_time = date('Y-m-d H:i:s');
            $this->save();
            //set bid win
            $win_bid->is_win = 1;
            $win_bid->save();
            //send win mail
            $email = EmailTemplates::model()->findByAttributes(array('alias'=>'auction-win'));
            Utils::sendMail(Yii::app()->params['emailout'], $win_bid->bidder->email,  $email->email_subject, str_replace(
                array('{auction}'),
                array('<a href="'.Yii::app()->params['site_url'].'auctions/detail/'.$win_bid->auction->id.'">'.$win_bid->auction->product->name.'</a>'),
                $email->email_content
            ));
            //send mail and update cashback
            if ($position_2 = $this->cashback($win_bid, 2, array($win_bid->bidder_id))){
                $this->cashback($win_bid, 3, array($win_bid->bidder_id, $position_2->bidder_id));
            }
        }       
        
    }
    
    protected function cashback($win_bid, $position_index, $ids){
        $criteria = new CDbCriteria;  
        $criteria->condition ="auction_id = {$this->id} AND status=".Bids::STATUS_SINGLE." AND 
                bidder_id NOT IN (".implode(',', $ids).")";
        $criteria->order = 'price';
        
        $posistion = Bids::model()->findAll($criteria);
        if (count($posistion) && $posistion = $posistion[0]){
            $email = EmailTemplates::model()->findByAttributes(array('alias'=>'cashback'));
            
            file_put_contents('/mnt/home/onecentdeal/public_html/protected/runtime/cron_log.txt', date('Ymd H:i:s').': '.$position_index.':'.$posistion->id."\n", FILE_APPEND);
            $date = date("Y-m-d",strtotime($posistion->auction->end_time));
            $hour = date("H:i",strtotime($posistion->auction->end_time));
            if($position_index ==2) {
                $position_text = (Yii::app()->language=='en')?"second ":"Zweitbester";
                $price = $posistion->auction->cashback_position_2;
            } else {
                $position_text = (Yii::app()->language=='en')?"third":"Drittbester";
                $price = $posistion->auction->cashback_position_3;
            }
            Utils::sendMail(Yii::app()->params['emailout'], $posistion->bidder->email,
                str_replace(
                    array('{position}'),
                    array($position_text),
                    $email->email_subject
                ),
                str_replace(
                    array('{auction}', '{position}','{firstname}','{lastname}','{price}','{date}','{hour}'),
                    array('<a href="'.Yii::app()->params['site_url'].'auctions/detail/'.$win_bid->auction->id.'">'.$win_bid->auction->product->name.'</a>',
                        $position_text,
                        $posistion->bidder->fname,
                        $posistion->bidder->lname,
                        $price,
                        $date,
                        $hour
                    ),
                    $email->email_content
                )
            );
            
            //
            $cash_back_field = 'cashback_position_'.$position_index;
            if ($win_bid->auction->$cash_back_field != ''){
                $transaction = new Transactions; 
                $transaction->amount = $win_bid->auction->$cash_back_field;
                $transaction->user_id = $posistion->bidder_id;
                $transaction->currency = 'EUR';
                $transaction->transactiontype = $position_index==2?Transactions::TYPE_CASHBACK2:Transactions::TYPE_CASHBACK3;
                $transaction->payment_transaction = $win_bid->auction_id;
                $transaction->payment_method_id = PaymentMethods::SYSTEM;
                $transaction->options = '';
                $transaction->paymentstatus = Transactions::STATUS_APPROVED;
                $transaction->created = date('Y-m-d H:i:s');
                $transaction->insert();
            }
        }
        return $posistion;
    }

    public function getActiveAuctions()
    {
        $criteria=new CDbCriteria;
        $criteria->condition=" start_time <= NOW() AND (end_time IS NULL OR end_time = '0000-00-00 00:00:00')";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));

    }
    
    public function getAnalyseAuctions()
    {
        $criteria=new CDbCriteria;
        $criteria->with= 'product';
        $criteria->compare('t.id',$this->id);
        $criteria->compare('product.name',$this->product_name,true);
        $criteria->compare("IF (end_time IS NOT NULL && end_time <> '0000-00-00 00:00:00', ".self::STATUS_FINISHED.", IF(start_time <= NOW(), ".self::STATUS_ACTIVE.", ".self::STATUS_UPCOMING."))",$this->status,true);
        $criteria->compare('max_price',$this->max_price);
        $criteria->compare('bid_price',$this->bid_price);
        if ($this->start_time)
            $criteria->compare('DATE(start_time)',date('Y-m-d', strtotime($this->start_time)),true);
        if ($this->end_time)
            $criteria->compare('DATE(end_time)',date('Y-m-d', strtotime($this->end_time)),true);    
        //$criteria->order=" t.id DESC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
               'sort'=>array(
                'defaultOrder'=>'end_time DESC',
                       'attributes'=>array(
                    'product_name'=>array(
                        'asc'=>'product.name',
                        'desc'=>'product.name DESC',
                    ),
                    '*',
                ),
            ),
        ));

    }
    
    function getCountBidFirst( $auction_id ){
        $countBidFirst =  Bids::model()->findAll( 'auction_id=:id', array( ':id' => $auction_id ) );
        return count( $countBidFirst );
    }
    
    public function findBasicAuctionOverdue(){
        $sql = "SELECT id, start_time
                FROM 	auctions
                WHERE 	start_time < NOW() AND (end_time IS NULL OR end_time = '0000-00-00 00:00:00')
	                    AND (SELECT COUNT(id) FROM auction_joins WHERE auction_id = auctions.id)  < basic_participant_min";
        $auction_overdue =   Yii::app()->db->createCommand($sql)->queryAll();
        return $auction_overdue;


    }
    
       function setEndAuction($auction_id){
        $win_bid = Bids::model()->findByAttributes(array(
            'auction_id' => $auction_id,
            'status' => Bids::STATUS_LOWEST
        ));
        if ($win_bid){
            //set end for auction
            Auctions::model()->updateByPk($auction_id,array('end_time'=>date('Y-m-d H:i:s')));
            //set bid win
            $win_bid->is_win = 1;
            $win_bid->is_confirm = 1;
            $win_bid->save();
            //send win mail
            $email = EmailTemplates::model()->findByAttributes(array('alias'=>'auction-win'));
            Utils::sendMail(Yii::app()->params['emailout'], $win_bid->bidder->email,  $email->email_subject, str_replace(
                array('{auction}'),
                array('<a href="'.Yii::app()->params['site_url'].'auctions/detail/'.$win_bid->auction->id.'">'.$win_bid->auction->product->name.'</a>'),
                $email->email_content
            ));
            //send mail and update cashback
            if ($position_2 = $this->cashback($win_bid, 2, array($win_bid->bidder_id))){
                $this->cashback($win_bid, 3, array($win_bid->bidder_id, $position_2->bidder_id));
            }
            
        }       
        
    }
    
    public function updateAuctionOverdue(){
        $auction_overdue = $this->findBasicAuctionOverdue();
        // get basic auction day in setting.
        $basic_auction_day = Settings::model()->find('settingkey=:settingkey', array( ':settingkey' =>'basic_auction_days' ));
        foreach($auction_overdue as $item){
            $date=date_create($item['start_time']);
            date_add($date,date_interval_create_from_date_string("'".$basic_auction_day['default_value']." days'"));
            $new_start_time =  date_format($date,"Y-m-d h:i:s");
            $this->updateByPk($item['id'],array('start_time'=>$new_start_time));
        }
    }

    function getCountBid($auction_id,$bidder_id){
        $countBid =  Bids::model()->findAll('auction_id=:id AND bidder_id=:bidder_id',array(':id'=>$auction_id,':bidder_id'=>$bidder_id));
        return $countBid;
    }

    function saveBonus1stPlace($auction_id,$bidder,$amount){
        $transaction = new Transactions;
        $transaction->attributes = array(
            'user_id'               => $bidder,
            'amount'                => $amount,
            'currency'              => 'EUR',
            'paymentstatus'         => Transactions::STATUS_APPROVED,
            'created'               => date('Y-m-d H:i:s'),
            'transactiontype'       => Transactions::TYPE_BONUS_1STPLACE,
            'payment_transaction'   => $auction_id);
        $transaction->save();
    }

    function saveBid1st($bid_id,$amount){
        $bid_1st = new Bids1st;
        $bid_1st->bid_id = $bid_id;
        $bid_1st->created = date('Y-m-d H:i:s');
        $bid_1st->amount = $amount;
        $bid_1st->save();
    }

    function set1stPlace($auction_id){
        $allBid = Bids::model()->findAll('auction_id=:id AND status=:status',array(':id'=>$auction_id,':status'=>Bids::STATUS_LOWEST));
        if($allBid){
            foreach($allBid  as $bid){
                $sql = "SELECT t.id As bids FROM bids_1st t JOIN bids b ON b.id=t.bid_id WHERE b.auction_id=".$bid['auction_id']." AND b.bidder_id=".$bid['bidder_id'];
                $checkArchive = count(Yii::app()->db->createCommand($sql)->queryAll());
                if($checkArchive == 0){
                    $countBid = self::getCountBid($auction_id,$bid['bidder_id']);
                    $amount = Yii::app()->settings->bonus_1st_place + (count($countBid) * ($bid['auction']['bid_price']));
                    $this->saveBonus1stPlace($auction_id,$bid['bidder_id'],$amount);
                    $this->saveBid1st($bid['id'],$amount);
                    // send mail to user archive.
                    $email = EmailTemplates::model()->findByAttributes(array('alias'=>'1st-place'));
                    Utils::sendMail(Yii::app()->params['emailout'], $bid['bidder']['email'],
                        str_replace(
                            array('{auction}'),
                            array($bid['auction']['product']['name']),
                            $email->email_subject
                        ),
                        str_replace(
                            array('{auction}','{price}'),
                            array('<a href="'.Yii::app()->params['site_url'].'auctions/detail/'.$bid['auction_id'].'">'.$bid['auction']['product']['name'].'</a>',$amount),
                            $email->email_content
                        ));
                }
            }

        }
    }

    function SessionFreeBid($id){
        if( !Yii::app()->user->isGuest){
            $condition="user_id =".Yii::app()->user->id." AND auction_id = ".$id." AND DATE(created) = '".date('Y-m-d')."'";
            $checkSession = SessionFreeBid::model()->find($condition);
            if(count($checkSession) != 0)
                return true;
            return false;
        }
    }
    
    function getUserBidAmount($user_id = 0){
        if (!$user_id) $user_id = Yii::app()->user->id;
        $bids = Bids::model()->findAllByAttributes(array('auction_id' => $this->id, 'bidder_id' => $user_id));
        $amount = 0;
        foreach ($bids as $bid){
            switch ($bid->type){
                case Bids::TYPE_HALF:
                    $amount += $bid->bid_price/2;
                    break;
                case Bids::TYPE_FREE:
                    break;
                case Bids::TYPE_JOKER;
                default:
                    $amount += $bid->bid_price;
            }
        }            
        return $amount;
    }

    function getCreditBidAmount($auction_id){
        $user_id = Yii::app()->user->id;
        $bids = Bids::model()->findAllByAttributes(array('auction_id' => $auction_id, 'bidder_id' => $user_id));
        $amount = 0;
        foreach ($bids as $bid){
            switch ($bid->type){
                case Bids::TYPE_HALF:
                    $amount += $bid->bid_price/2;
                    break;
                case Bids::TYPE_FREE:
                    break;
                case Bids::TYPE_JOKER;
                default:
                    $amount += $bid->bid_price;
            }
        }
        return $amount;
    }

    function checkWinbid($items){
        $credit = 0;
        foreach($items as $item){
            $winnerAuction = self::model()->find('id=:id',array(':id'=>$item->item_id));
            if(isset($winnerAuction->win_bid->bidder_id)== Yii::app()->user->id){
                $credit+=self::getCreditBidAmount($item->item_id);
            }
        }
        return $credit;

    }

    function getBasicAuctionUpcoming(){
        return self::model()->find(array(
            'condition'=>"start_time > NOW() AND type =".Auctions::TYPE_BASIC
        ));
    }
    function getBasicAuctionActive(){
        return self::model()->find(array(
            'condition'=>"start_time <= NOW() AND (end_time IS NULL OR end_time = '0000-00-00 00:00:00') AND
                       type =".Auctions::TYPE_BASIC,
                       'with' =>'join_count',
        ));
    }
    
    function setBidsStatus($bid_price){
        error_reporting(0);
        $bids = $this->bids_order_price;
        //check status
        $singles = array(); 
        for ($i = 0; $i < count($bids); $i ++){
            $is_single = true;
            
            for ($j = 0; $j < count($bids); $j ++){
                if ($bids[$i]->price == $bids[$j]->price && $bids[$i]->id != $bids[$j]->id){ //not
                    $is_single = false;
                    break;        
                }    
            }
            if ($is_single) {
                $singles[] = $bids[$i];
                $bids[$i]->status = count($singles) == 1?Bids::STATUS_LOWEST:Bids::STATUS_SINGLE;
                $bids[$i]->placed_back = 0;
            }
            else{
                $bids[$i]->status = Bids::STATUS_MULTI;
            }
            $bids[$i]->save();
                
        } 
        ///set placed back 4 order price
        $bids = $this->bids_single_order_price;
        if (count($bids)){
            $current_bidder_id = $bids[0]->bidder_id;
            $count = 0;
            foreach ($bids as $i=>$bid){
                if ($current_bidder_id == $bid->bidder_id){
                    $count ++;
                    if ($count > 2){
                        $bid->placed_back = 1;
                        $bid->save();
                    }
                }
                else{
                    $count = 0;
                    $current_bidder_id = $bid->bidder_id;
                }
            }
        }
        
        ///set placed_back_6
     //   $bids       = $this->bids_single_order_price;
//        $numpage    = 30;
//        $total      = round( count($bids)/$numpage );
//        $totalnum   = $total*$numpage;
//        $count      = 0;
//        for( $i = 0; $i < $total; $i ++ ){
//            if( $i == 0 )
//                $v = 0;
//            else
//                $v = $numpage * ($total - 1);
//            for( $k = $v; $k < $totalnum; $k ++ ){
//                if( $bids[$k]->bidder_id == Yii::app()->user->id ){
//                    $count++;
//                    if( $count > 5 ){
//                        $bids[$k]->placed_back_6 = 1;
//                        $bids[$k]->save();
//                    }  
//                } 
//             }   
//        }
        
        $bids       = $this->bids_single_order_price_placed_back_6;
        $numpage    = 30;
        $count      = 0;
        for($i = 0; $i <= count($bids); $i ++ ){
            
            if( $bids[$i]->bidder_id == Yii::app()->user->id ){
                $count++;
                if( $count > 6 ){
                    $bids[$i]->placed_back_6 = 1;
                    $bids[$i]->save();
                }  
            }    
        }  
        //foreach ($bids as $i=>$bid){
        //if ($i > 5){
        //   $bid->placed_back_6 = 1;
        //   $bid->save();
        //   }
        //}
    }
  
}