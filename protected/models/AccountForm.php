<?php
/**
 * Account form model
 */
class AccountForm extends CFormModel
{
	public $fname;
	public $lname;
	public $photo;
	public $address;
	public $city;
	public $phone;
	
	public function rules()
	{
		return array(
			array('phone', 'match', 'allowEmpty' => false, 'pattern' => '/^([+]?[0-9 \-]+)$/' ),
			array('fname, lname, address, city, phone', 'required'),
			array('fname, lname, city, phone', 'length', 'min' => 3, 'max' => 32),
			array('address', 'length', 'min' => 3, 'max' => 100),
		);
	}
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }
	
	public function attributeLabels()
	{
		return array(
			'fname' => Yii::t('members', 'First Name'),
			'lname' => Yii::t('members', 'Last Name'),
			'photo' => Yii::t('members', 'New Photo'),
			'address' => Yii::t('members', 'Address'),
			'city' => Yii::t('members', 'City'),
			'phone' => Yii::t('members', 'Phone'),
		);
	}
}