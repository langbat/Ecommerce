<?php
/**
 * User controller Home page
 */
class UsersController extends SiteBaseController {
	
	const PAGE_SIZE = 50;
	
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
	 * Show all users
	 */
	public function actionIndex()
	{
		if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl.'login');
		}
        
        if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl.'login');
		}
		$members = Members::model();
			
		$newsleter = new Newsletter;
	
		$criteria=new CDbCriteria;
		$criteria->condition='email=:email';
		$criteria->params=array(':email'=> Yii::app()->user->email );
		
		if($newsleter->find($criteria)){
			$news = 1;
		}else{
			$news = '';
		}

		//$this->render('setting',array('newsleter'=>$news));
		
		$my = Members::model()->findByPk(Yii::app()->user->id);
		$account = new AccountForm;
		$account->photo = $my->photo;
		
		if( isset($_POST['AccountForm']) )
		{
			$account->attributes = $_POST['AccountForm'];
			if( $account->validate() )
			{
				if(basename($_FILES['photo']['name']) != '' && $_FILES['photo']['error'] != 1)
				{
					$target_path = ROOT_PATH.'uploads/avatar/';
					
					$avatar_ext = strtolower(substr($_FILES['photo']["name"], -4));
					
					if(in_array($avatar_ext, array('.jpg', '.png', '.gif', '.bmp', 'jpeg')))
					{
						if($avatar_ext == 'jpeg') $avatar_ext = '.jpg';
						
						$upload_filename = $my->id . '_' . date('YmdHis') . $avatar_ext;
						
						if(Members::resizeImage($_FILES['photo']["tmp_name"], $target_path.$upload_filename, 640, 640))
						{
							$files = array_merge(glob($target_path.$my->id.'_*'), glob($target_path.'t_'.$my->id.'_*'));
							foreach($files as $file)
							{
								if($file != $target_path.$upload_filename)
									unlink($file);
							}
							
							Members::resizeImage($_FILES['photo']["tmp_name"], $target_path.'t_'.$upload_filename, 200, 200);
							
							$account->photo = $upload_filename;
						}
					}
				}
				
				// Save changes
				Members::model()->updateByPk($my->id, $account->attributes);
				
				// Redirect
				Yii::app()->user->setFlash('success', Yii::t('global', 'Saved changes.'));
				$this->redirect(Yii::app()->homeUrl.'profile');
			}
		}
		else
		{
			foreach($account->attributes as $key=>$attr)
			{
				$account->$key = $my->$key;
			}
		}
		
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Edit Profile');
		$this->breadcrumbs[ Yii::t('global', 'Edit Profile') ] = '';
		
		$this->render('index', array('model'=>$account));
        
	}
    
    
    public function actioneditprofile()
    {
        $my = Members::model()->findByPk(Yii::app()->user->id);
		$account = new AccountForm;
		$account->photo = $my->photo;
		
		if( isset($_POST['AccountForm']) )
		{
			$account->attributes = $_POST['AccountForm'];
			if( $account->validate() )
			{
				if(basename($_FILES['photo']['name']) != '' && $_FILES['photo']['error'] != 1)
				{
					$target_path = ROOT_PATH.'uploads/avatar/';
					
					$avatar_ext = strtolower(substr($_FILES['photo']["name"], -4));
					
					if(in_array($avatar_ext, array('.jpg', '.png', '.gif', '.bmp', 'jpeg')))
					{
						if($avatar_ext == 'jpeg') $avatar_ext = '.jpg';
						
						$upload_filename = $my->id . '_' . date('YmdHis') . $avatar_ext;
						
						if(Members::resizeImage($_FILES['photo']["tmp_name"], $target_path.$upload_filename, 640, 640))
						{
							$files = array_merge(glob($target_path.$my->id.'_*'), glob($target_path.'t_'.$my->id.'_*'));
							foreach($files as $file)
							{
								if($file != $target_path.$upload_filename)
									unlink($file);
							}
							
							Members::resizeImage($_FILES['photo']["tmp_name"], $target_path.'t_'.$upload_filename, 200, 200);
							
							$account->photo = $upload_filename;
						}
					}
				}
				
				// Save changes
				Members::model()->updateByPk($my->id, $account->attributes);
				
				// Redirect
				Yii::app()->user->setFlash('success', Yii::t('global', 'Saved changes.'));
				$this->redirect(Yii::app()->homeUrl.'profile');
			}
		}
		else
		{
			foreach($account->attributes as $key=>$attr)
			{
				$account->$key = $my->$key;
			}
		}
		
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Edit Profile');
		$this->breadcrumbs[ Yii::t('global', 'Edit Profile') ] = '';
		
		$this->render('edit', array('model'=>$account));
    }
    
    
	
	public function actionchangepass()
	{
		if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl.'login');
		}
		
		$my = Members::model()->findByPk(Yii::app()->user->id);
		
		$password = new PasswordForm;
		if( isset($_POST['PasswordForm']) )
		{
			$password->attributes = $_POST['PasswordForm'];
			if( $password->validate() )
			{
				// Save changes

				Members::model()->updateByPk($my->id, array( 'password' => $my->hashPassword($password->npassword, '') ));
				
				// Redirect
				Yii::app()->user->setFlash('success', Yii::t('global', 'Changed password.'));
				$this->redirect(Yii::app()->homeUrl.'change-password');
			}
			else
			{
				$password->password = '';
				$password->npassword = '';
				$password->npassword2 = '';
			}
		}
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Change password');
		$this->breadcrumbs[ Yii::t('global', 'Change password') ] = '';
		
		$this->render('changepass', array('password'=>$password));
	}
	
	/**
	 * Profile action
	 */
    public function actionviewprofile() 
	{
		if( isset($_GET['id']) && isset($_GET['alias']) && $model = Members::model()->findByAttributes( array('id'=>$_GET['id'], 'seoname'=>$_GET['alias']) ) )
		{
			$commentsModel = new UserComments;
			
			// Can add comments?
			$addcomments = false;
			$autoaddcomments = false;
			if( Yii::app()->user->id )
			{
				$addcomments = true;
			}		

			if( $addcomments )
			{
				if( isset($_POST['UserComments']) )
				{
					$commentsModel->attributes = $_POST['UserComments'];
					$commentsModel->userid = $model->id;
					$commentsModel->visible = 1;
					if( $commentsModel->save() )
					{
						Yii::app()->user->setFlash('success', Yii::t('users', 'Comment Added.'));
						$this->redirect( Yii::app()->request->getUrlReferrer() );
					}
				}
			}

			// Grab the language data
			$criteria = new CDbCriteria;
			$criteria->condition = 'userid=:postid AND visible=:visible';
			$criteria->params = array( ':postid' => $model->id, ':visible' => 1 );
			$criteria->order = 'postdate DESC';

			// Load only approved
			if( Yii::app()->user->checkAccess('op_users_manage_comments')  )
			{
				$criteria->condition .= ' OR visible=0';
			}

			$totalcomments = UserComments::model()->count($criteria);
			$pages = new CPagination($totalcomments);
			$pages->pageSize = self::PAGE_SIZE;

			$pages->applyLimit($criteria);

			// Grab comments
			$comments = UserComments::model()->orderDate()->findAll($criteria);
			
			// Markdown
			$markdown = new MarkdownParser;
			
			// Add page breadcrumb and title
			$this->pageTitle[] = $model->getDisplayName() . " Profile";
			$this->breadcrumbs[ $model->getDisplayName() . " Profile" ] = '';
			
			$this->render('profile', array( 'model' => $model, 'markdown' => $markdown, 'addcomments' => $addcomments, 'pages' => $pages, 'commentsModel' => $commentsModel, 'totalcomments' => $totalcomments, 'comments'=>$comments ));
		}
		else
		{
			throw new CHttpException(404, Yii::t('global', 'Sorry, But we could not find that user.') );
		}
    }

    

	/**
	 * Change comment visibility status
	 */
	public function actiontogglestatus()
	{
		if( !Yii::app()->user->checkAccess('op_users_manage_comments')  )
		{
			$this->redirect( Yii::app()->request->getUrlReferrer() );
		}
		
		if( isset($_GET['id']) && ( $model = UserComments::model()->findByPk($_GET['id']) ) )
		{			
			$model->visible = $model->visible == 1 ? 0 : 1;
			$model->save();
			
			Yii::app()->user->setFlash('success', Yii::t('global', 'Comment Updated.'));
			$this->redirect( Yii::app()->request->getUrlReferrer() );
		}
		else
		{
			$this->redirect( Yii::app()->request->getUrlReferrer() );
		}
	}
	
	public function actionverify()
	{
		$email = isset($_POST['email']) ? $_POST['email'] : (isset($_GET['email']) ? $_GET['email'] : '');
		$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : '');
		$verierror = '';
		
		if($email != '')
		{
			if($member = Members::model()->findByAttributes(array('email'=>$email)))
			{
				if($member->vericode == '')
				{
					Yii::app()->user->setFlash('success', Yii::t('global', 'The email "'.$email.'" was already verified before.'));
					$this->redirect(Yii::app()->homeUrl);
				}
				elseif($member->vericode == $code)
				{
					Members::model()->updateByPk($member->id, array('vericode'=>''));
					Yii::app()->user->setFlash('success', Yii::t('global', 'Thank You. The email "'.$email.'" was verified.'));
					$this->redirect(Yii::app()->homeUrl);
				}
				else
				{
					$code = '';
					$verierror = 'Invalid code';
				}
			}
			else
			{
				$email == '';
				$code = '';
				$verierror = 'Invalid email or code';
			}
		}
		
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Verify Email Address');
		$this->breadcrumbs[ Yii::t('global', 'Verify Email Address') ] = '';
		
		$this->render('verify', array('email'=>$email, 'code'=>$code, 'verierror'=>$verierror));
	}
	
	/**
	 * Logout action
	 */
	public function actionlogout()
	{
		// Guests are not allowed
		if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl);
		}
        $session_id = session_id();
        Yii::app()->db->createCommand("DELETE FROM online_visitors WHERE session_id='{$session_id}'")->execute();
        
		
		Yii::app()->user->logout(true);
		Yii::app()->user->setFlash('success', Yii::t('global', 'You are now logged out.'));
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * Login action
	 */
	public function actionlogin()
	{
		// Do not allow logged in users here
		if( Yii::app()->user->id )
		{
			$this->redirect(Yii::app()->homeUrl);
		}
		
		$model = new LoginForm;
		
		if( isset($_POST['LoginForm']) )
		{
			$model->attributes = $_POST['LoginForm'];
			if( $model->validate() )
			{

				// Login
				$identity = new InternalIdentity($model->email, $model->password);
                
                $session_id = session_id();
                Yii::app()->db->createCommand("DELETE FROM online_visitors WHERE session_id='{$session_id}'")->execute();
                
				if($identity->authenticate() )
				{
                    // check role login
                    $check_role_login = Members::model()->checkRoleLogin($model->email);
                    if (isset($_POST['is_from_cart'])){
                        Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
                        unset(Yii::app()->session['guest_acount']);
                        $this->redirect('/cart/address');
                    }
                    elseif($check_role_login == 1){
                        // Member authenticated, Login
                        Yii::app()->user->setFlash('success', Yii::t('global', 'Thanks. You are now logged in.'));
                        Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
                        unset(Yii::app()->session['guest_acount']);
                        $this->redirect(Yii::app()->homeUrl);
                    } else {
                        $message = Yii::t('global','Please check your email to active account before login !');
                        $this->render('/profile/completed_atc',array('message'=>$message));
                    }

				}
			}
		}
		/*
		// Load facebook
		Yii::import('ext.facebook.facebookLib');
		$facebook = new facebookLib(array( 'appId' => Yii::app()->params['facebookappid'], 'secret' => Yii::app()->params['facebookapisecret'], 'cookie' => true, 'disableSSLCheck' => false ));
		facebookLib::$CURL_OPTS[CURLOPT_CAINFO] = Yii::getPathOfAlias('ext.facebook') . '/ca-bundle.crt';
		
		// Facebook link
		$facebookLink = $facebook->getLoginUrl(array('req_perms' => 'read_stream,email,offline_access', 'next' => Yii::app()->createAbsoluteUrl('/login/facebooklogin', array( 'lang' => false ) ), 'display'=>'popup') );
		
		$this->render('index', array('model'=>$model, 'facebookLink' => $facebookLink, 'facebook'=>$facebook));
		*/
		
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Login');
		$this->breadcrumbs[ Yii::t('global', 'Login') ] = '';
		
		$this->render('login', array('model'=>$model));
	}
	
	/**
	 * Facebook login page
	 *
	public function actionFacebookLogin()
	{
		
		// Load facebook
		Yii::import('ext.facebook.facebookLib');
		$facebook = new facebookLib(array( 'appId' => Yii::app()->params['facebookappid'], 'secret' => Yii::app()->params['facebookapisecret'], 'cookie' => true, 'disableSSLCheck' => false ));
		facebookLib::$CURL_OPTS[CURLOPT_CAINFO] = Yii::getPathOfAlias('ext.facebook') . '/ca-bundle.crt';
		
		// Do we have an access token?
		if( ( $session = $facebook->getSession() ) || ( isset($_GET['session']) && $_GET['session'] ) )
		{	
			$info = array( 'id' => 0, 'email' => '' );
			
			$info = $facebook->getInfo(null, array('access_token'=>$session['access_token']));
			
			// Did we submit the authenticate form?
			$facebookForm = new facebookForm;
			
			if( isset($_POST['facebookForm']) )
			{
				$facebookForm->attributes = $_POST['facebookForm'];
				if( $facebookForm->validate() )
				{
					// Member authenticated
					
					$identity = new InternalIdentity($facebookForm->email, $facebookForm->password);
					if($identity->authenticate())
					{
						// Member authenticated, Login
						Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
					}
					else
					{
						Yii::app()->user->setFlash( 'success', $identity->errorMessage );
					}
					
					// Update the fbuid and update the token
					// We got through save the a new token
					Members::model()->updateByPk( $identity->getId() , array( 'fbuid' => $info['id'], 'fbtoken' => $session['access_token'] ) );
					
					// Login & redirect
					Yii::app()->user->setFlash( 'success', Yii::t('login', 'Thank You. You are now logged in.') );
					//$this->render('facebookdone', array( 'link' => $this->createUrl('/index', array( 'lang' => false ) ) ) );
					$this->redirect('/index');
				}
			}
			
			// Did we submit the signup form?
			$facebookSignForm = new Members;
			
			if( isset($_POST['Members']) )
			{
				$facebookSignForm->attributes = $_POST['Members'];
				$facebookSignForm->role =  'member';
				$facebookSignForm->scenario = 'register';
				if( $facebookSignForm->save() )
				{
					$identity = new InternalIdentity($facebookSignForm->email, $_POST['Members']['password']);
					if($identity->authenticate())
					{
						// Member authenticated, Login
						Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
					}
					else
					{
						Yii::app()->user->setFlash( 'success', $identity->errorMessage );
					}
					
					// Update the fbuid and update the token
					// We got through save the a new token
					Members::model()->updateByPk( $facebookSignForm->id, array( 'fbuid' => $info['id'], 'fbtoken' => $session['access_token'] ) );
					
					// Login & redirect
					Yii::app()->user->setFlash( 'success', Yii::t('login', 'Thank You. You are now logged in.') );
					//$this->render('facebookdone', array( 'link' => $this->createUrl('/index', array( 'lang' => false ) ) ) );
					$this->redirect('/index');
				}
			}
			
			// Authenticate
			$identity = new facebookIdentity($info['id'], $info['email']);
			$auth = $identity->authenticate();
			
			// What did we discover?
			if( $identity->errorCode == facebookIdentity::ERROR_UNKNOWN_IDENTITY )
			{
				// fbuid was not found in the DB
				Yii::app()->user->setFlash( 'attention', Yii::t('login', 'We could not find any user associated with that facebook account in our records.') );
			}
			else if ( $identity->errorCode == facebookIdentity::ERROR_USERNAME_INVALID )
			{
				// Email addresses did not match
				Yii::app()->user->setFlash( 'attention', Yii::t('login', 'We found a user account associated with your facebook account, But the email used there is different, Please complete the form below to login as that user.') );
			}
			else
			{
				// We got through save the a new token
				Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
				Members::model()->updateByPk( $identity->getId(), array( 'fbtoken' => $session['access_token'] ) );
				Yii::app()->user->setFlash( 'success', Yii::t('login', 'Thank You. You are now logged in.') );
				$this->render('facebookdone', array( 'link' => $this->createUrl('/index', array( 'lang' => false ) ) ) );
				//$this->redirect('/index');
			}
			
			// Redirect if haven't done so
			if( !isset( $_GET['facebookRedirected'] ) )
			{
				$_GET['facebookRedirected'] = 'true';
				$this->render('facebookdone', array( 'link' => $this->createUrl('/login/facebooklogin', array_merge( $_GET, array( 'lang' => false ) ) ) ) );
			}
			
			// Default values
			$facebookForm->email = $facebookForm->email ? $facebookForm->email : $info['email'];
			$facebookSignForm->email = $facebookSignForm->email ? $facebookSignForm->email : $info['email'];
			$facebookSignForm->username = $facebookSignForm->username ? $facebookSignForm->username : $info['name'];
			
			$this->render('facebook_login', array( 'facebookSignForm' => $facebookSignForm, 'facebookForm' => $facebookForm,  'info' => $info ));
		}
		else
		{
			$this->redirect('/login');
		}
	}
	
	/**
	 * Lost password screen
	 */
	public function actionlostpassword()
	{	
		$model = new LostPasswordForm;
		
		if(isset($_POST['LostPasswordForm']))
	    {  
           $username  = isset($_POST['LostPasswordForm']['username'])?$_POST['LostPasswordForm']['username']:'';
           $email     = isset($_POST['LostPasswordForm']['email'])?$_POST['LostPasswordForm']['email']:'';
           if( $username == '' && $email == '' ){
                Yii::app()->user->setFlash('error', Yii::t('global', 'Please fix the following input errors'));
	            $this->redirect(Yii::app()->homeUrl.'users/lostpassword');
           }
           $model->attributes=$_POST['LostPasswordForm'];
	        if($model->validate())
			{					
                // Grab the member data
                if( $email != '' ){
				    $member = Members::model()->findByAttributes(array('email' => $model->email));
                    $message = Yii::t('global', "Dear {username},<br /><br />
									We have reseted your username successfully.<br /><br />
									You username is: <b>{username}</b><br />",
                    array( '{username}' => $member->username ));

                    $message .= Yii::t('global', '<br /><br />----------------<br />Regards,<br />The {team} Team.<br />', array('{team}'=>Yii::app()->name));
                    Utils::sendMail(Yii::app()->params['emailout'], $member->email, Yii::t('global', 'Username Reset Completed'), $message);
    
                    Yii::app()->user->setFlash('success', Yii::t('global', 'Thank You. Your username was send. Please check your email for you username.'));
                    $this->redirect(array('/profile/completed_atc'));
                }
	            else{
                    $member = Members::model()->findByAttributes(array('username' => $model->username));
               
    				// Create secret reset link
    				/*$random = $member->hashPassword( $member->email . $member->username , microtime(true) );
    				$link = $this->createAbsoluteUrl('/users/reset', array( 'q' => $random ));
    				
    				$message = Yii::t('global', "Dear {username},<br /><br />You've asked a reset for your password.<br /><br /> 
    											Please click the link below in order to perform the reset and get a new password emailed to you.<br /><br />
    											The reset link is:<br /><br />
    											----------------------<br />
    											{link}<br />
    											----------------------<br /><br /><br />
    											<em>If you did not request this reset then please ignore this email.</em>",
    											array( '{username}' => $member->username, '{link}' => $link ));
    											
    				$message .= Yii::t('global', '<br /><br />----------------<br />Regards,<br />The {team} Team.<br />', array('{team}'=>Yii::app()->name));							
    				
    				Utils::sendMail(Yii::app()->params['emailout'], $member->email,  Yii::t('global', 'Password Reset Request'), $message);
    
    				Members::model()->updateByPk($member->id, array('passwordreset'=>$random));*/
                    $password = $member->generatePassword(5, 10);
                    $hashedPassword = $member->hashPassword( $password, $member->email );
    
                    $message = Yii::t('global', "Dear {username},<br /><br />
    									We have reseted your password successfully.<br /><br />
    									You new password is: <b>{password}</b><br />",
                        array( '{username}' => $member->username, '{password}' => $password ));
    
                    $message .= Yii::t('global', '<br /><br />----------------<br />Regards,<br />The {team} Team.<br />', array('{team}'=>Yii::app()->name));
                    Utils::sendMail(Yii::app()->params['emailout'], $member->email, Yii::t('global', 'Password Reset Completed'), $message);
    
                    Members::model()->updateByPk($member->id, array('password'=>$hashedPassword));
    
                    Yii::app()->user->setFlash('success', Yii::t('global', 'Thank You. Your password was reset. Please check your email for you new generated password.'));
    				//$model = new LostPasswordForm();
                    $this->redirect(array('/profile/completed_atc'));
                 }
			}
	    }
	
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Reset your password');
		$this->breadcrumbs[ Yii::t('global', 'Forgot Password') ] = '';
		$this->render('lostpassword', array( 'model' => $model ));
	}
    
	/**
	 * Check the var in the password form and if it is ok 
	 * then reset the password and email the member the new one.
	 */
	public function actionreset()
	{
		$q = Yii::app()->format->text( $_GET['q'] );
		
		// Search for this in the DB
		$member = Members::model()->findByAttributes(array('passwordreset'=>$q));
		
		if( !$member )
		{
			Yii::app()->user->setFlash('error', Yii::t('global', 'Sorry, Nothing was found for that reset link.'));
        	$this->redirect(Yii::app()->homeUrl);
		}
		
		// We matched so now reset the reset link,
		// Create a new password and save it for that member
		// Email and redirect
		
		// Create secret reset link
		$password = $member->generatePassword(5, 10);
		$hashedPassword = $member->hashPassword( $password, $member->email );
		
		$message = Yii::t('global', "Dear {username},<br /><br />
									We have reseted your password successfully.<br /><br />
									You new password is: <b>{password}</b><br />",
									array( '{username}' => $member->username, '{password}' => $password ));
									
		$message .= Yii::t('global', '<br /><br />----------------<br />Regards,<br />The {team} Team.<br />', array('{team}'=>Yii::app()->name));							
        Utils::sendMail(Yii::app()->params['emailout'], $member->email, Yii::t('global', 'Password Reset Completed'), $message);
		
		Members::model()->updateByPk($member->id, array('passwordreset'=>'', 'password'=>$hashedPassword));
		
		Yii::app()->user->setFlash('success', Yii::t('global', 'Thank You. Your password was reset. Please check your email for you new generated password.'));
    	$this->redirect(Yii::app()->homeUrl.'login');
	}
	
	/**
	 * Register action
	 */
    
    public function actionsetting()
	{
		if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl.'login');
		}
		$members = Members::model();
			
		$newsleter = new Newsletter;
	
		$criteria=new CDbCriteria;
		$criteria->condition='email=:email';
		$criteria->params=array(':email'=> Yii::app()->user->email );
		
		if($newsleter->find($criteria)){
			$news = 1;
		}else{
			$news = '';
		}

		$this->render('setting',array('newsleter'=>$news));
	}
    
    public function actiondelete()
	{
		// Perms
		$user = Members::model()->findByPk(Yii::app()->user->id);
		if(isset($user))
		{	
			$user->delete();
		
				$this->redirect(array('/logout/index'));
			
		}
	}     
    
    public function actioncheckStatusOnline()
	{
        $members = new Members;
        $members->updateStatusOnline();
        
    }   
	
	/**
	 * Admin Login action
	 */
	public function actionadmin()
	{
        if(Yii::app()->user->role == 'admin') $this->redirect('/admin');
		$model = new LoginForm;
		
		if( isset($_POST['LoginForm']) )
		{
			$model->attributes = $_POST['LoginForm'];
			if( $model->validate() )
			{
				// Login
				$identity = new InternalIdentity($model->email, $model->password);
				if($identity->authenticate())
				{
					// Member authenticated, Login
					Yii::app()->user->setFlash('success', Yii::t('login', 'Thanks. You are now logged in.'));
					Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
				}
                else{
                    Yii::app()->user->setFlash('error', $identity->errorMessage);
                }
				
				// Redirect
				if(Yii::app()->user->role == 'admin') $this->redirect('/admin');
				else $this->redirect(Yii::app()->homeUrl);
			}
		}
		
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Login');
		// $this->breadcrumbs[ Yii::t('global', 'Login') ] = '';
		
		$this->renderPartial('admin', array('model'=>$model));
	}
	public function actiontogglenewsletter()
	{
		if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl.'login');
		}

		$newsletter = new Newsletter;

		$criteria=new CDbCriteria;
		$criteria->compare('email',Yii::app()->user->email);
		$newsletter = Newsletter::model()->find($criteria);
		
		if(!empty($newsletter)){

			$newsletter->delete();
			$this->redirect(array('index'));
		
		}else{
			$newsletter2 = new Newsletter;
			$data['email'] = Yii::app()->user->email;
			$newsletter2->attributes = $data;

			if($newsletter2->save()){
				$this->redirect(array('index'));
			}
			else{
				echo 'error';
			}
		}
	}
}