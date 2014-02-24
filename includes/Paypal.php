<?php
class Paypal
{
    private $default     = array();
    private static $name = "PayPalNVP";
    
    var $params = array();
    var $ipn_data = array();
    
    function __construct()
    {
        $this->ipn_data = array();
        $this->default[self::$name] = Yii::app()->params['paypal'];
    }
    
     
    function withdraw($amount){
        global $base_url;
        $gateway = Payment::getUserGateway($this->user, Payment::GATEWAY_PAYPAL);
        $balance = Payment::getUserBanlance($this->user, $_GET['currency']);
        
        if (!$gateway->email){
            drupal_set_message(t('Please update your Paypal email to withdraw!'), 'warning');
            drupal_goto($base_url.'/transactions/methods');
        }
        
        $withdrawl_fees = $this->getAddfundCharge($_GET['currency'], $amount);
        
        if ($amount > 0){
            if ($amount > $balance - $withdrawl_fees){
                drupal_set_message(t('Amount must be smaller than Banlance and Withdrawal fee'), 'warning');
                drupal_goto($base_url.'/transactions');
            }
            $method_name = 'MassPay';
            $this->setDefault($method_name, array(
                'EMAILSUBJECT' => urlencode(t('Withdraw from Voodabay')),
                'RECEIVERTYPE' => $this->user->mail,
                'CURRENCYCODE' => $_GET['currency'],
                'L_EMAIL0' => $gateway->email,
				'L_AMT0' => $amount,
				'L_UNIQUEID0' => time(),
				'L_NOTE0' => t("Withdraw from Voodabay")                            
            ));
            //print_r($this);
            $response = $this->PPHttpPost($method_name);    
            
            if("Success" == $response["ACK"]) {            
                $transaction = array(
            	            'user_id' => Yii::app()->user->id,
                            'amount' => -1*$amount,
            				'currency' => $_GET['currency'],
            				'transactiontype_id' => Payment::TYPE_WITHDRAW,
                            'created' => date('Y-m-d H:i:s'),
                            'paymentstatus_id' => Payment::STATUS_APPROVED,
                            'paymentprocessor_id' => Payment::GATEWAY_PAYPAL,
                            'payment_transaction' => '',     
                            'charge' => $withdrawl_fees,                       
                            'options' => serialize($response));                                        	   
                $transaction_id = db_insert('transactions')->fields($transaction)->execute();                
                
                $transaction = array(
            	            'user_id' => Yii::app()->user->id,
                            'amount' => $withdrawl_fees * -1,
            				'currency' => $_GET['currency'],
            				'transactiontype_id' => Payment::TYPE_WITHDRAWL_FEES,
                            'created' => date('Y-m-d H:i:s'),
                            'paymentprocessor_id' => Payment::GATEWAY_PAYPAL,
                            'payment_transaction' => '', 
                            'options' => '',
                            'paymentstatus_id' => Payment::STATUS_APPROVED);  
                db_insert('transactions')->fields($transaction)->execute();
                
                drupal_set_message(t('Withdrawal success!'), 'status');
                drupal_goto($base_url.'/transactions');
            }
            else{
                drupal_set_message(str_replace(array('%20', '%27', '%2c'), array(' ', "'", ','), $response['L_LONGMESSAGE0']), 'warning');
            }        
        }
        //drupal_set_message(t('Invalid amount!'), 'warning');
        drupal_goto($base_url.'/transactions/withdraw');
    }

	function cancel()
	{  
	   global $base_url;
       drupal_goto($base_url.'/transactions');
	}
    
    
    
    ///////////////////////////////
    //used by children classes to set NVP
    function setDefault($action, $key, $value='')
    {
        if (is_array($key)){
            $this->default[$action] = $key;
        }
        else{
            $this->default[$action][$key] = $value;
        }
        
    }

    //set main NVP
    public function setPayPalNVP ($key, $value)
    {
        $this->default['PayPalNVP'][$key] = $value;
    }

    //used by PPHttpPost, to get needed values
    function getNVP ($action, $key = null)
    {
        if ($key == null) {
            return($this->default[$action]);
        } else {
            if (array_key_exists($key, $this->default[$action])) {
                return($this->default[$action][$key]);
            } else {
                throw new Exception("Value ".$key." cannot be found.");
            }
        }
    }

    function getEnvironment()
    {
        $environment = $this->getNVP(self::$name, "environment");
        if ($environment == 'live') {
            return "";
        } else {
            return $environment.".";
        }
    }

    function PPHttpPost($methodName_) 
    {
        $API_UserName = urlencode($this->getNVP(self::$name, "API_UserName"));
        $API_Password = urlencode($this->getNVP(self::$name, "API_Password"));
        $API_Signature = urlencode($this->getNVP(self::$name, "API_Signature"));
        $API_Endpoint = "https://api-3t.".$this->getEnvironment()."paypal.com/nvp";
        $version = urlencode($this->getNVP(self::$name, "version"));

        $nvpStr = '';
        $NVP = $this->getNVP($methodName_);
        foreach ($NVP as $key=>$value) {
            $nvpStr .= '&'.$key.'='.urlencode($value);
        }

        // setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        // turning off the server and peer verification(TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        // NVPRequest for submitting to server
        $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr";

        // setting the nvpreq as POST FIELD to curl
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

        // getting response from server
        $httpResponse = curl_exec($ch);

        if(!$httpResponse) {
            exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
        }

        // Extract the RefundTransaction response details
        $httpResponseAr = explode("&", $httpResponse);

        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if(sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
            }
        }

        if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
        }

        return $httpParsedResponseAr;
    }
}