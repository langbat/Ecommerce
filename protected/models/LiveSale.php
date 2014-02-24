<?php

/**
 * This is the model class for table "live_sale".
 *
 * The followings are the available columns in table 'live_sale':
 * @property integer $id
 * @property integer $shop_id
 * @property string $name
 * @property string $start
 * @property string $end
 * @property string $list_product_id
 * @property string $media
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property MemberShop $shop
 */
class LiveSale extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LiveSale the static model class
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
		return 'live_sale';
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
            array('name', 'required'),
			array('shop_id', 'numerical', 'integerOnly'=>true),
			array('name, list_product_id, media', 'length', 'max'=>255),
			array('start, end, created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shop_id, name, start, end, list_product_id, media, created, updated, shopname', 'safe', 'on'=>'search'),
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
			'shop_id' => Yii::t('global', 'Shop'),
			'name' => Yii::t('global', 'Name'),
			'start' => Yii::t('global', 'Start'),
			'end' => Yii::t('global', 'End'),
			'list_product_id' => Yii::t('global', 'List Product'),
			'media' => Yii::t('global', 'Media'),
			'created' => Yii::t('global', 'Created'),
			'updated' => Yii::t('global', 'Updated'),
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
        $criteria->with = array('shop');

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.shop_id',$this->shop_id);
		$criteria->compare('t.name',$this->name,true);
		if ($this->start)
		    $criteria->compare('t.start',date('Y-m-d ', strtotime($this->start)),true);
        if ($this->end)
		    $criteria->compare('t.end',date('Y-m-d ', strtotime($this->end)),true);
		$criteria->compare('list_product_id',$this->list_product_id,true);
		$criteria->compare('media',$this->media,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
        $criteria->compare('shop.name',$this->shopname,true);

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
    
    public function checkScheduleProductShop( $product_id ){
        $sql            = "SELECT * 
                           FROM(
                            	SELECT *, FIND_IN_SET(".$product_id.",list_product_id) AS check_product 
                            	FROM live_sale 
                            	ORDER BY id DESC ) 
                            AS list_live_sale 
                            WHERE list_live_sale.check_product > 0
                            LIMIT 1";
        $getSchedule    = Yii::app()->db->createCommand($sql)->queryAll();
        $result         = array( 'check'=> 0, 'time'=> 0, 'counttime'=> 0, 'video'=> '' );
        if($getSchedule){
            foreach($getSchedule as $item){
                if(strtotime($item['start']) <= time() && strtotime($item['end']) > time() ){
                    $time   = (strtotime($item['end']) - time()) * 1000;
                    $result = array('check'=>1,'time'=>$time,'counttime'=>1, 'video'=>$item['media']);
                    //break;
                } else {
                    if(time() < strtotime($item['start'])) {
                        if( $result['counttime'] ==  1){
                            $result['counttime']= (strtotime($item['start'])-time());
                            break;
                        } else {
                            $time = (strtotime($item['start']) - time()) * 1000;
                            $counttime = (strtotime($item['start'])-time());
                            $result = array('check'=>0,'time'=>$time,'counttime'=>$counttime, 'video'=> '');
                            break;
                        }
                    }
                }
            }
        }
        return $result;
    }
    
}