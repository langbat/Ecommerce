<?php
/**
 * Plans model
 */
class Plans extends CActiveRecord
{
	/**
	 * @return object
	 */
	public static function model()
	{
		return parent::model(__CLASS__);
	}
	
	/**
	 * @return string Table name
	 */
	public function tableName()
	{
		return 'plans';
	}
	public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }
	/**
	 * Relations
	 */
	public function relations()
	{
		return array(
		);
	}
	
	/**
	 * Attribute values
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'name' => Yii::t('plans', 'Name'),
			'desc' => Yii::t('plans', 'Description'),
			'price' => Yii::t('plans', 'Price'),
			'permonth' => Yii::t('plans', 'Downloads per Month')
		);
	}
	
	/**
	 * Before save handler
	 */
	public function beforeSave()
	{
		return parent::beforeSave();
	}
	
	/**
	 * table data rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array( 'name, price, permonth', 'required' ),
			array('name', 'length', 'min'=>3, 'max'=>55),
			array('price', 'numerical', 'min'=>1),
			array('permonth', 'numerical', 'min'=>1),
		);
	}
	
}