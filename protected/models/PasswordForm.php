<?php
/**
 * Password form model
 */
class PasswordForm extends CFormModel
{
	public $password;
	public $npassword;
	public $npassword2;
    
	public function rules()
	{
		return array(
			array('npassword, npassword2', 'required'),
			array('npassword, npassword2', 'length', 'min' => 8, 'max' => 32),
			array('npassword2', 'compare', 'compareAttribute'=>'npassword'),
			array('password', 'checkOldPassword')
		);
	}
	public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }
	public function checkOldPassword()
	{
		if(Yii::app()->user->isGuest)
		{
			$this->addError('password', 'Invalid password');
			return false;
		}
		
		$my = Members::model()->findByPk(Yii::app()->user->id);
		if($my->hashPassword($this->password, '') != $my->password)
		{
			$this->addError('password', 'Invalid password');
			return false;
		}
		
		return true;
	}
	
	public function attributeLabels()
	{
		return array(
			'password' => Yii::t('members', 'Old Password'),
			'npassword' => Yii::t('members', 'New Password'),
			'npassword2' => Yii::t('members', 'Confirmation'),
		);
	}
}