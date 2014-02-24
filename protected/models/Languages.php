<?php
/**
 * Languages model
 */
class Languages extends CActiveRecord
{
	public static function model()
	{
		return parent::model(__CLASS__);
	}
	
	public function tableName()
	{
		return 'languages';
	}
	
	public function relations()
	{
		return array(
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'Code'),
			'name' => Yii::t('global', 'Name')
		);
	}
	
	public function beforeSave()
	{
		return parent::beforeSave();
	}
	
	public function rules()
	{
		return array(
			array('id, name', 'required'),
			array('id', 'length', 'min'=>1, 'max'=>2),
			array('name', 'length', 'min'=>1, 'max'=>50),
		);
	}
	
}