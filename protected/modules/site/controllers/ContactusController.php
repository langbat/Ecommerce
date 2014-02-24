<?php
/**
 * Contact Us Controller
 */
class ContactusController extends SiteBaseController {
	/**
	 * initialize
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
	 * Show Form
	 */
    public function actionIndex() {
	
		$model = new ContactUs;
		
		if( isset($_POST['ContactUs']) )
		{
			$model->attributes = $_POST['ContactUs'];
			if( $model->save() )
			{
				// Do we need to email?
				if( Yii::app()->params['contactusemail'] )
				{
					// Build Message
                    $template = EmailTemplates::getAlias('contact-us');
                    $email = new EmailTemplates;
					$message = Yii::t('contactus', $email->email_content , array(
																						'{id}' => $model->id,
														 								'{name}' => $model->name,
																						'{email}' => $model->email,
																						'{subject}' => $model->subject,
																						'{msg}' => $model->content,
																						'{team}' => Yii::app()->name,
														 							  ));
                    Utils::sendMail(Yii::app()->params['emailout'], Yii::app()->params['emailin'],  $email->email_subject, $message);
				}
				
				Yii::app()->user->setFlash('success', Yii::t('contactus', 'Thank You. The form submitted successfully.') );
				$model = new ContactUs;
			}
		}
		
		// If we are a member then fill in
		if( Yii::app()->user->id )
		{
			$user = Members::model()->findByPk(Yii::app()->user->id);
			if( $user )
			{
				$model->name = $user->username;
				$model->email = $user->email;
			}
		}
		
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Contact Us');
		$this->breadcrumbs[ Yii::t('global', 'Contact Us') ] = '';
		
        $this->render('index', array( 'model' => $model ));
    }
}