<?php
require_once 'API_Config.php';
require_once 'OpenTokSDK.php';
class Tokbox extends OpenTokSDK{
    private $API_KEY;
    private $API_SECRET;
    
    function __construct(){
        $this->API_KEY = Yii::app()->settings->tokbox_api_key;
        $this->API_SECRET = Yii::app()->settings->tokbox_api_secret;
        
        parent::__construct($this->API_KEY, $this->API_SECRET);
    }
    
    public function init(){
		
    }
    
}