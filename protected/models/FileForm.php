<?php
/**
 * File form model
 */
class FileForm extends CFormModel
{
	public $name;
	public $desc;
	public $cat_id;
	public $plan_id;
	
	public function rules()
	{
		return array(
			array('name, cat_id, plan_id', 'required'),
			array('name', 'length', 'min' => 3, 'max' => 32),
			array('desc', 'length', 'max' => 100),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'name' => Yii::t('files', 'First Name'),
			'desc' => Yii::t('files', 'Desc'),
			'cat_id' => Yii::t('files', 'Category'),
			'plan_id' => Yii::t('files', 'Type'),
		);
	}
}