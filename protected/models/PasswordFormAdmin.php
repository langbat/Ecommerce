<?php
/**
 * Password form model
 */
class PasswordFormAdmin extends CFormModel
{
	public $npassword;
	public $npassword2;
    
	public function rules()
	{
		return array(
			array('npassword, npassword2', 'required'),
			array('npassword, npassword2', 'length', 'min' => 8, 'max' => 32),
			array('npassword2', 'compare', 'compareAttribute'=>'npassword'),
		);
	}
	public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }
	
	public function attributeLabels()
	{
		return array(
			'npassword' => Yii::t('members', 'New Password'),
			'npassword2' => Yii::t('members', 'Confirmation'),
		);
	}
}