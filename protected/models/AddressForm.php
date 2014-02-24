<?php
/**
 * Address form model
 */
class AddressForm extends CFormModel
{
	public $street;
	public $postcode;
	public $nr;
	public $city;
	
	
	public function rules()
	{
		return array(
			
		);
	}
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }
	
	public function attributeLabels()
	{
		return array(
			
		);
	}
}