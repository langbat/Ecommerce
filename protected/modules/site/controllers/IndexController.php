<?php
/**
 * Index controller Home page
 */
class IndexController extends SiteBaseController {
	
	const PAGE_SIZE = 16;
	/**
	 * Controller constructor
	 */
    public function init()
    {
        parent::init();
    }
	
	/**
	 * List of available actions
	 */
	public function actions()
	{
	   return array(
	      'captcha' => array(
	         'class' => 'CCaptchaAction',
	         'backColor' => 0xFFFFFF,
		     'minLength' => 3,
		     'maxLength' => 7,
			 'testLimit' => 3,
			 'padding' => array_rand( range( 2, 10 ) ),
	      ),
	   );
	}
	
	/**
	 * Index action
	 */
    public function actionindex() {
        
        if (($_SERVER['SERVER_NAME']=='tosello.tv' || $_SERVER['SERVER_NAME']=='www.tosello.tv') && time() <= strtotime('2014-01-13 12:12:12'))
        {
            $success_message = '';
            if (isset($_POST['email'])){
                $email_to = "info@tosello.tv";
                $success_message = Yii::t('global', "Thank you for contacting us. We will get in touch shortly."); 
                $site_name = "tosello.tv"; // Replace this with your website name.
                
                $email = trim($_POST['email']);                
                if($email){
                	if($email === '' || $email === 'Enter your email address' ) {
                		$email_empty = true;
                		$error = true;
                	} elseif (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", $email)){
                		$email_unvalid = true;
                		$error = true;	
                	}
                }
                
                if(!isset($error)){
            		$subject = 'Newsletter Submission';
            		$body = "Email: $email";
            		$headers = 'From: ' . $site_name . ' <' . $email_to . '> ' . "\r\n" . 'Reply-To: ' . $email;
            		@mail($email_to, $subject, $body, $headers);
            	}
            }
            

            $this->layout = 'comingsoon';
            $this->render('comingsoon', compact('success_message'));
            return;
        }
	
		$this->pageTitle[] = Yii::t('global', 'Home');        
        $products = new CActiveDataProvider('Products',array(
            'pagination'=>false,
            'criteria'=>array(
                'limit' => self::PAGE_SIZE,
                'order' => 'id DESC ',
                'condition'=> "is_active = 1"
            )
        ));
        
        //Communication
       if (isset($_GET['sessionId'])){
            $sessionId = $_GET['sessionId'];
            $token = $_GET['token'];
        }
        else{
            $session = Yii::app()->Tokbox->create_session();
            $sessionId = $session->getSessionId();
            $token = Yii::app()->Tokbox->generate_token($sessionId);
        }


		$this->render('index', compact('products', 'sessionId', 'token'));
    }
    /*public function actionWait() {

        $this->pageTitle[] = Yii::t('global', 'Home');
        $this->layout = false;
        $this->render('wait');
    }*/
    
    function actionCheckTimeout(){
        echo Yii::app()->session['lastest_visit'];
    }
    
    
    function actionSaveTokboxArchive(){
        $archive = new TokboxArchive();
        $archive->user_id = Yii::app()->user->id;
        $archive->archive_id = $_GET['archive_id'];
        $archive->session_id = $_GET['session_id'];
        $archive->save();
    }
    
    function actionStopTokboxArchive(){
        Yii::app()->session['opened_tokbox'] = 0;
        $archive = TokboxArchive::model()->findByAttributes(array(
            'user_id' => Yii::app()->user->id,
            'archive_id' => $_GET['archive_id']
        ));
        $archive->stopped = 1;
        $archive->save();
        
        
        //reset other session
        $session_id = session_id();    	
        $session = Yii::app()->Tokbox->create_session();
        $sessionId = $session->getSessionId();
        $time = time();
        $token = Yii::app()->Tokbox->generate_token($sessionId, 'moderator');        
        Yii::app()->db->createCommand("DELETE FROM online_visitors WHERE session_id='{$session_id}'")->execute();                                                    
		$sql = "INSERT INTO online_visitors VALUES('{$session_id}','{$time}', '".Yii::app()->user->id."', '".$sessionId."', '".$token."')";
        Yii::app()->db->createCommand($sql)->execute();
    }
    
    function actionTokbox(){
        Yii::app()->session['opened_tokbox'] = 1;
        $this->renderPartial('tokbox');
    }
}