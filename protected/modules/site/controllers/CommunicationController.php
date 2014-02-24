<?php
class CommunicationController extends SiteBaseController {
	
    public function actionindex() {
        if (isset($_GET['sessionId'])){
            $sessionId = $_GET['sessionId'];
            $token = $_GET['token'];
        }
        else{
            $session = Yii::app()->Tokbox->create_session();
            $sessionId = $session->getSessionId();
            $token = Yii::app()->Tokbox->generate_token($sessionId);
        }
		
        
        $this->render('index', compact('sessionId', 'token'));
    }
}