<?php
/**
 * Email form model
 */
class EmailForm extends CFormModel
{
	public $email;
	public $nemail;
	public $nemail2;
    
	public function rules()
	{
		return array(
			array('nemail, nemail2', 'required'),
			array('nemail, nemail2', 'length', 'min' => 3, 'max' => 32),
			array('nemail2', 'compare', 'compareAttribute'=>'nemail'),
			array('email', 'checkOldEmail')
		);
	}
	public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }
	public function checkOldEmail()
	{
		if(Yii::app()->user->isGuest)
		{
			$this->addError('email', 'Invalid email');
			return false;
		}
		
		
		return true;
	}
	
	public function attributeLabels()
	{
		return array(
			'email' => Yii::t('members', 'Old Email'),
			'nemail' => Yii::t('members', 'New Email'),
			'nemail2' => Yii::t('members', 'Confirmation'),
		);
	}
}