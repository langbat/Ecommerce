<?php

/**
 * This is the model class for table "shipping_clause".
 *
 * The followings are the available columns in table 'shipping_clause':
 * @property integer $id
 * @property string $shipping_fee_clause_inside
 * @property string $shipping_fee_clause_outside
 */
class ShippingClause extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShippingClause the static model class
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
		return 'shipping_clause';
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
			array('shipping_fee_clause_inside, shipping_fee_clause_outside', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shipping_fee_clause_inside, shipping_fee_clause_outside', 'safe', 'on'=>'search'),
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
			'shipping_fee_clause_inside' => Yii::t('global', 'Shipping Fee Clause Inside'),
			'shipping_fee_clause_outside' => Yii::t('global', 'Shipping Fee Clause Outside'),
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
		$criteria->compare('shipping_fee_clause_inside',$this->shipping_fee_clause_inside,true);
		$criteria->compare('shipping_fee_clause_outside',$this->shipping_fee_clause_outside,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}