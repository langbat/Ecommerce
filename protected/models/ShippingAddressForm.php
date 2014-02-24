<?php
/**
 * Address form model
 */
class ShippingAddressForm extends CFormModel
{
	public $shipping_street;
	public $shipping_postcode;
	public $shipping_nr;
	public $shipping_city;
	
	
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