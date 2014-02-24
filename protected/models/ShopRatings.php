<?php

/**
 * This is the model class for table "shop_ratings".
 *
 * The followings are the available columns in table 'shop_ratings':
 * @property integer $id
 * @property double $score
 * @property integer $shop_id
 * @property string $created
 * @property string $ip_address
 * 
 */
class ShopRatings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShopRatings the static model class
	 */
     public $shopname; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_ratings';
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
			array('score, shop_id', 'required'),
			array('shop_id', 'numerical', 'integerOnly'=>true),
			array('score', 'numerical'),
			array('created, updated, ip_address', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, score, shop_id, created, updated, ip_address ', 'safe', 'on'=>'search'),
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
            'shop' => array(self::BELONGS_TO, 'MemberShop', 'shop_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'score' => Yii::t('global', 'Score'),
			'shop_id' => Yii::t('global', 'Shop'),
			'created' => Yii::t('global', 'Created'),
			'updated' => Yii::t('global', 'Updated'),
            'ip_address' => Yii::t('global', 'IP Address'),
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
        
        $criteria->together = true;
        $criteria->with     = array( 'shop');
		$criteria->compare('id',$this->id);
		$criteria->compare('score',$this->score);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
        $criteria->compare('ip_address',$this->ip_address,true);
        $criteria->compare('shop.name',$this->shopname);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.id DESC',
                 'attributes'=>array(
                    'shopname'=>array(
                        'asc'=>'shop.name',
                        'desc'=>'shop.name DESC',
                    ),
             
                    '*',
                ),
            ),
		));
	}
    
    public function saveRatingShop( $score, $shop_id){
        Yii::app()->session['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $check = 0;
        $allShopRating = ShopRatings::model()->findAll();
        $current = date('Y-m-d');
        foreach($allShopRating as $value){
            $temp= date('Y-m-d',strtotime($value['created']));
            if(($value['shop_id'] == $shop_id ) && ($temp == $current) && (Yii::app()->session['ip_address'] == $value['ip_address']))
                $check = 1;
        }
        if($check != 1){
            $rating = new ShopRatings();
            $rating->shop_id = $shop_id;
            $rating->score = $score;
            $rating->ip_address = Yii::app()->session['ip_address'];
            $rating->save();
            echo Yii::t('global', 'Thank you rating');
        }
    }

    public function getRatingShop($shop_id){
        $sql = 'SELECT COUNT(id) as id_count, SUM(score) as score_sum FROM shop_ratings WHERE shop_id='.$shop_id;
        $allRatingProduct = Yii::app()->db->createCommand($sql)->queryAll();
        $scoreCurrent = 0;
        if($allRatingProduct){
            if($allRatingProduct[0]['id_count'] !=0){
                $scoreCurrent = $allRatingProduct[0]['score_sum'] / $allRatingProduct[0]['id_count'];
            } else{
                $scoreCurrent = 0;
            }
        }

        return $scoreCurrent;
    }
    
    public function totalRatingShop( $shop_id ){
        $sql = "SELECT COUNT(id) AS totalrating FROM shop_ratings WHERE shop_id = ".$shop_id;
        $totals = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($totals as $total){
            echo $total['totalrating'];
        } 
    }
    public function totalShopRating($shop_id){
        $sql = "SELECT COUNT(id) AS totalrating FROM shop_ratings WHERE shop_id = ".$shop_id;
        $totals = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($totals as $total){
            return $total['totalrating'];
        } 
    }
    public function getRatingByIdShop($shop_id){
        $criteria=new CDbCriteria;
        $criteria->condition =  "shop_id = ". $shop_id;
        $shoprating=new CActiveDataProvider('ShopRatings', array(
            'criteria'=>$criteria,
        ));
        return $shoprating;
    }
}