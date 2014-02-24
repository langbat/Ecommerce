<?php

/**
 * This is the model class for table "order_status".
 *
 * The followings are the available columns in table 'order_status':
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Orders[] $orders
 */
class OrderStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderStatus the static model class
	 */
    const WAIT_FOR_PAYMENT  =1;
    const PAYMENT_IS_RECEIVED =2;
    const DELIVERY_PROCESS =3;
    const SENT = 4;
    const CANCELLED = 5;
    const TERM_OF_PAYMENT_EXPIRED = 6;
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_status';
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
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Orders', 'status'),
            'orderProcesses' => array(self::HAS_MANY, 'OrderProcess', 'status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'name' => Yii::t('global', 'Name'),
			'description' => Yii::t('global', 'Description'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getStatusOrder(){
        $status = OrderStatus::model()->findAll();
        $result = array();
        foreach($status  as $key =>$item ){
            $result[$key+1]= Yii::t('global',$item['name']);
        }
        return $result;
    }
     public function getStatusOrderDashboard( $orderstatus_id ){
        $status = OrderStatus::model()->findAll($orderstatus_id);
        foreach($status  as $item ){
           return Yii::t('global',$item['name']);
        }
    }
}