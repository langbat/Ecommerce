<?php
/**
 * Cashout form model class
 */
class CashoutForm extends CFormModel
{	
	/**
	 * @var string - email
	 */
	public $amount;

	/**
	 * @var string - captcha
	 */
	public $verifyCode;
	
	/**
	 * table data rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('amount', 'required'),
			array('amount', 'checkAmount'),
			array('verifyCode', 'captcha'),
		);
	}
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }
	
	public function checkAmount()
	{
		if(!Yii::app()->user->isGuest && $this->amount && $this->amount >= Transactions::CASHOUT_MIN && $this->amount <= Transactions::CASHOUT_MAX)
		{
			$my = Members::model()->findByPk(Yii::app()->user->id);
			
			$mymaxcashout = Transactions::model()->sumEarning($my->id) + Transactions::model()->sumCashout($my->id) - Transactions::CASHOUT_FEE;
			
			if($mymaxcashout > Transactions::CASHOUT_MAX) $mymaxcashout = Transactions::CASHOUT_MAX;
			
			if($this->amount <= $mymaxcashout) return;
		}
		
		$this->addError('amount', "Invalid amount.");
	}
	
	/**
	 * Attribute values
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'amount' => Yii::t('transactions', 'Amount'),
			'verifyCode' => Yii::t('transactions', 'Security Code'),
		);
	}
	
}