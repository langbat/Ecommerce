<?php

/**
 * This is the model class for table "ratings".
 *
 * The followings are the available columns in table 'ratings':
 * @property integer $id
 * @property double $score
 * @property integer $product_id
 * @property integer $type
 * @property string $created
 * @property string $updated
 * @property string $ip
 */
class Ratings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ratings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ratings';
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
			//array('score, product_id, created, updated', 'required'),
			array('product_id, type', 'numerical', 'integerOnly'=>true),
			array('score', 'numerical'),
			array('ip', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, score, product_id, type, created, updated, ip', 'safe', 'on'=>'search'),
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
			'product_id' => Yii::t('global', 'Product'),
            'type' => Yii::t('global', 'Type'),
			'created' => Yii::t('global', 'Created'),
			'updated' => Yii::t('global', 'Updated'),
  	         'ip' => Yii::t('global', 'Ip'),
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
		$criteria->compare('score',$this->score);
		$criteria->compare('product_id',$this->product_id);
        $criteria->compare('type',$this->type);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
        $criteria->compare('ip',$this->ip,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function saveRating( $score, $product_id, $type = 0,$ip){
        $rating = new Ratings();
        $rating->product_id = $product_id;
        $rating->ip = $ip;
        $rating->score = $score;
        $rating->type  = $type;
        $date = date('Y-m-d');
        if(!self::model()->isRated($product_id,$type,$date,$ip)){
            $rating->save();
            return true;
        }else{
            return false;
        }
    }

    public function getRating( $product_id, $type = 0, $option = 0 ){
        $sql = 'SELECT COUNT(id) as id_count, SUM(score) as score_sum FROM ratings WHERE product_id='.$product_id." AND type = ".$type;
        $allRatingProduct = Yii::app()->db->createCommand($sql)->queryAll();
        $scoreCurrent = 0;
        if($allRatingProduct){
            if($allRatingProduct[0]['id_count'] !=0){
                $scoreCurrent = $allRatingProduct[0]['score_sum'] / $allRatingProduct[0]['id_count'];
            } else{
                $scoreCurrent = 0 ;
            }
        }
        if( $option == 1 )
            echo $scoreCurrent;
        else 
            return $scoreCurrent;
    }
    
    public function totalRating( $product_id, $type = 0 ){
        $sql = "SELECT COUNT(id) AS totalrating FROM ratings WHERE product_id = ".$product_id." AND type = ".$type;
        $totals = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($totals as $total){
            echo $total['totalrating'];
        }
    }
    public function isRated($product_id,$type,$created, $ip){
        $sql = "SELECT * FROM ratings WHERE product_id = ".$product_id." AND type = ".$type." AND created LIKE  '".$created."%' AND ip = '".$ip."'";
        $isRated = Yii::app()->db->createCommand($sql)->queryAll();
        if(count($isRated)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function get_client_ip() {
     $ipaddress = '';
     if ($_SERVER['HTTP_CLIENT_IP'])
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if($_SERVER['HTTP_X_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if($_SERVER['HTTP_X_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if($_SERVER['HTTP_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if($_SERVER['HTTP_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if($_SERVER['REMOTE_ADDR'])
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = 'UNKNOWN';

     return $ipaddress; 
}
    
}