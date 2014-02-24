<?php
/**
 * Register controller class
 */
class RegisterController extends SiteBaseController
{
	/**
	 * Controller constructor
	 */
	public function init()
	{
		// Do not allow logged in users here
		if( Yii::app()->user->id )
		{
			$this->redirect(Yii::app()->homeUrl);
		}
		
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Register');
		$this->breadcrumbs[ Yii::t('global', 'Register') ] = array('register/index');
		
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
	 * Register action
	 */
	public function actionindex()
	{
		$model = new RegisterForm;
		$refname = '';
		
		if( isset($_POST['RegisterForm']) )
		{
			$model->attributes = $_POST['RegisterForm'];
			if( $model->validate() )
			{
				// Save the member and redirect
				$user = new Members;
				$user->scenario = 'register';
				$user->role = 'member';
				$user->attributes = $_POST['RegisterForm'];
				
				if( $user->parent_id > 0 && $ref = Members::model()->find('vericode="" AND current_plan > 0 AND id=' . $user->parent_id) )
				{
					$refname = $ref->getDisplayName();
					//@Minh: send email to Affiliate user
					
					
				}
				else $user->parent_id = 0;
				
				$user->save();
				
				if(basename($_FILES['photo']['name']) != '' && $_FILES['photo']['error'] != 1)
				{
					$target_path = ROOT_PATH.'uploads/avatar/';
					
					$avatar_ext = strtolower(substr($_FILES['photo']["name"], -4));
					
					if(in_array($avatar_ext, array('.jpg', '.png', '.gif', '.bmp', 'jpeg')))
					{
						if($avatar_ext == 'jpeg') $avatar_ext = '.jpg';
						
						$upload_filename = 'photo' . '_' . $user->id . '_' . date('YmdHis') . $avatar_ext;
						
						if(Members::resizeImage($_FILES['photo']["tmp_name"], $target_path.$upload_filename, 640, 640))
						{
							$files = array_merge(glob($target_path.$user->id.'_*'), glob($target_path.'t_'.$user->id.'_*'));
							foreach($files as $file)
							{
								if($file != $target_path.$upload_filename)
									unlink($file);
							}
							
							Members::resizeImage($_FILES['photo']["tmp_name"], $target_path.'t_'.$upload_filename, 200, 200);
							
							$user->photo = $upload_filename;
							$user->update(array('photo'));
						}
					}
				}
				
				//@Minh: send verification email
				
				$homelink = '<a href="' . $this->createAbsoluteUrl('/', array('lang'=>false)) . '" target="_blank">' . Yii::app()->name . '</a>';
				$actlink = $this->createAbsoluteUrl('/verify', array('lang'=>false)) . '?email='.$user->email.'&code=' . $user->getVeriCode();
				$actlink = '<a href="'. $actlink . '" target="_blank">' . $actlink . '</a>';
				
				$message = Yii::t('register', "Dear {username},<br /><br />You've created an account on {homelink}.<br /><br /> 
											Please click the link below in order to confirm your email address and active your account.<br /><br />
											The activation link is:<br /><br />
											----------------------<br />
											{link}<br />
											----------------------<br />",
											array( '{username}' => $user->getDisplayName(), '{team}'=>Yii::app()->name, '{homelink}' => $homelink, '{link}' => $actlink ));
											
				$message .= Yii::t('global', '<br /><br />----------------<br />Regards,<br />The {team} Team.<br />', array('{team}'=>Yii::app()->name));							
				
				Utils::sendMail(Yii::app()->params['emailout'], $user->email,  Yii::t('register', 'Welcome to ' . Yii::app()->name), $message);
				
				// Redirect
				Yii::app()->user->setFlash('success', Yii::t('register', 'Registration Completed. Please sign in.'));
				$this->redirect(Yii::app()->homeUrl.'login');
			}
		}
		
		if( $model->parent_id > 0 && $user = Members::model()->find('vericode="" AND current_plan > 0 AND id=' . $model->parent_id) )
		{
			$refname = $user->getDisplayName() . ' (' . $user->username . ')';
		}
		elseif( isset($_GET['ref']) && intval($_GET['ref']) > 0 && $user = Members::model()->find('vericode="" AND current_plan > 0 AND id=' . intval($_GET['ref'])) )
		{
			$refname = $user->getDisplayName() . ' (' . $user->username . ')';
			$model->parent_id = $_SESSION['ref'] = intval($_GET['ref']);
		}
		elseif( isset($_SESSION['ref']) && intval($_SESSION['ref']) > 0 && $user = Members::model()->find('vericode="" AND current_plan > 0 AND id=' . intval($_SESSION['ref'])) )
		{
			$refname = $user->getDisplayName() . ' (' . $user->username . ')';
			$model->parent_id = intval($_SESSION['ref']);
		}
		
		$this->render('index', array('model'=>$model, 'refname'=>$refname));
	}
	
	public function actionajaxuser()
	{
		$q = isset($_GET['term']) ? trim($_GET['term']) : '';
		if(strlen($q) < 1 || !is_numeric($q)) exit(0);
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'vericode="" AND current_plan > 0 AND CAST(id as CHAR) LIKE "' . $q . '%"';
		
		$users = Members::model()->findAll($criteria);
		if(count($users))
		{
			$out = array();
			foreach($users as $user)
			{
				$out[] = array( 'value'=>$user->id, 'label'=>$user->getDisplayName() . ' (' . $user->username . ')' );
			}
			echo json_encode($out);
		}
		
		exit(0);
	}
}