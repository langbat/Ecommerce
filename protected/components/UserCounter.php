<?php

class UserCounter extends CComponent{
    var $user_online;
    var $user_total;
	public function init()
	{
		
	}
    public function refresh()
    {
		//First we have to start the session only if it has not been started
    	if(!isset($_SESSION)){
    		session_start();
    	}
    	$session_id = session_id();	//We assign the session id to the variable $session_id    	
    	$time = time(); 	//We assign the current time to the variable $time    	
    	$time_limit = $time-600;	//We give the session only 10 minutes if it exists
        
        if (!Yii::app()->user->isGuest && Yii::app()->user->role == 'mod'){
            $num = Yii::app()->db->createCommand("SELECT COUNT(*) c FROM online_visitors WHERE session_id='{$session_id}' LIMIT 1")->queryScalar();
            
            if($num != 1){
                $session = Yii::app()->Tokbox->create_session();
                $sessionId = $session->getSessionId();
                $token = Yii::app()->Tokbox->generate_token($sessionId, 'moderator');
                                                            
        		$sql = "INSERT INTO online_visitors VALUES('{$session_id}','{$time}', '".Yii::app()->user->id."', '".$sessionId."', '".$token."')";            
        	}else{
        		$sql = "UPDATE online_visitors SET time='{$time}' WHERE session_id='{$session_id}'";
        	}
        
            Yii::app()->db->createCommand($sql)->execute();
        }    
        Yii::app()->db->createCommand("DELETE FROM online_visitors WHERE time<'{$time_limit}'")->execute();
   	}

	/**
	 * Getter für die Anzahl aller Besucher.
	 **/
	public function getTotal()
	{
		return Yii::app()->db->createCommand("SELECT COUNT(*) FROM members WHERE role <> 'admin'")->queryScalar();
	}

    /**
	 * Getter für die Anzahl der User, die gerade Online sind.
	 **/
	public function getOnline()
	{
		return Yii::app()->db->createCommand("SELECT COUNT(*) FROM online_visitors")->queryScalar();
	}
    
    public function getActiveOnline()	{
		$count = Yii::app()->db->createCommand("
            SELECT COUNT(DISTINCT user_id)
            FROM online_visitors
            GROUP BY user_id")->queryScalar();
        if ($count === false) $count = 0;
        
        return $count;
	}
    
    function getTokboxData($user_id = 0){
        if (!$user_id) $user_id = Yii::app()->user->id;
        
        return Yii::app()->db->createCommand("SELECT * FROM online_visitors WHERE user_id = '$user_id' ORDER BY time DESC")->queryRow();
    }
    
    function getUserMod( $limit = 1 ){
        return Yii::app()->db->createCommand("SELECT user_id FROM online_visitors ORDER BY session_id DESC LIMIT {$limit}")->queryRow();
    }
}
?>
