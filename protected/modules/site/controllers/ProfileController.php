<?php

class ProfileController extends BaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Profiles') ] = array('profile/index');
		$this->pageTitle[] = Yii::t('global', 'Profiles');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id=null,$err=null)
	{
        $this->pageTitle[] = Yii::t('global', 'My profile');
        if($id!= null){
            //$inpayment = new BonusInpayments();
            $user = $this->loadModel($id);
            $emailNewsletter = count(Newsletter::model()->findByAttributes(array('email'=>$user->email)));
            $this->render('view',array(
                'model'=>$user,'emailNewsletter'=>$emailNewsletter,'err'=>$err
            ));
        } else {

            $this->render('view');
        }

	}
    
    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionOrder_view($id)
	{
        $model = Orders::model()->findByPk($id);

        if (!$model || $model->user_id != Yii::app()->user->id)
            $this->redirect('/profile/orders');

        $this->pageTitle[] = Yii::t('global', 'My orders');
		$this->render('order-view',array(
			'model'=>$model,
		));
	}
    
    /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        if(isset($_POST['Members'])){
            $model=$this->loadModel(Yii::app()->user->id);
            //$model = Profile::model()->findByPk(Yii::app()->user->id);
            //$model->attributes= $_POST['Members'];
            $model->gender=$_POST['Members']['gender']; 
            $model->fname=$_POST['Members']['fname'];
            $model->lname=$_POST['Members']['lname'];
            $model->street=$_POST['Members']['street'];
            $model->nr=$_POST['Members']['nr'];
            $model->ext_information=$_POST['Members']['ext_information'];
            $model->postcode=$_POST['Members']['postcode'];
            $model->city=$_POST['Members']['city'];
            $model->country=$_POST['Members']['country'];
            $model->phone=$_POST['Members']['phone'];
            $model->email=$_POST['Members']['email'];
            $tmp = explode('.',$model->birthday);
            if($_POST['Members']['bday'] == null)
                $_POST['Members']['bday']=$tmp[0];
            if($_POST['Members']['bmonth'] == null)
                $_POST['Members']['bmonth']=$tmp[1];
            if($_POST['Members']['byear'] == null)
                $_POST['Members']['byear']=$tmp[2];
            $model->birthday = $_POST['Members']['byear'].'-'.$_POST['Members']['bmonth'].'-'.$_POST['Members']['bday'];
            if($_POST['Members']['password'] == null)
                $_POST['Members']['password'] =  $model->password;
            else {
                $password = Profile::model()->hashPassword($_POST['Members']['password'], '');
                if($password == $model->password){
                    $model->password = Profile::model()->hashPassword($_POST['Members']['npassword2'], '');
                } else {
                    $message = Yii::t('global','Password incorrect, Please type again!');
                    $this->actionView(Yii::app()->user->id,$message);exit();
                }
            }
            if($model->save()){
                // Redirect
                $emailNewsletter = count(Newsletter::model()->findByAttributes(array('email'=>$_POST['Members']['email'])));
                if(isset($_POST['Members']['subcriber']) == 1){
                    if($emailNewsletter ==0){
                        $model_newletter = new Newsletter;
                        $model_newletter->attributes = array(
                            'email'=>$_POST['Members']['email']
                        );
                        $model_newletter->save();
                    }

                } else {
                    if($emailNewsletter == 1){
                        self::actionRemoveNewsletter($model->id);
                    }
                }
                $message = Yii::t('global','Edit profile successful!');
                $this->actionView(Yii::app()->user->id,$message);exit();
            }
        } else
            $this->actionView(Yii::app()->user->id);

	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Profile('create');
        $error = '';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Profile']))
		{
            $model->gender=$_POST['Profile']['gender'];
            $model->country_id=$_POST['Profile']['country'];
            $_POST['Profile']['bday'] = Members::model()->getFormatDate( $_POST['Profile']['bday']);
            $_POST['Profile']['bmonth'] = Members::model()->getFormatDate( $_POST['Profile']['bmonth']);
            $tmp = array($_POST['Profile']['bday'],$_POST['Profile']['bmonth'],$_POST['Profile']['byear']);
            $model->birthday = implode('.',$tmp);
            $model->attributes=$_POST['Profile'];
            //$model->password = Profile::model()->hashPassword($_POST['Profile']['password'], '');
            $model->vericode = Members::model()->hashPassword( time(), $model->email );
            $model->role = 'guest';
            if($model->save())
            {
                if(isset($_POST['Profile']['subcriber']) ==1){
                    $model_newletter = new Newsletter;
                    $model_newletter->attributes = array(
                        'email'=>$_POST['Profile']['email']
                    );
                    $model_newletter->save();
                }

                $homelink = '<a href="' . $this->createAbsoluteUrl('/') . '" target="_blank">' . Yii::app()->name . '</a>';
                $actlink = $this->createAbsoluteUrl('/profile/verify') . '?vericode='.$model->vericode;
                $actlink = '<a href="'. $actlink . '" target="_blank">' . $actlink . '</a>';

               /* $template = EmailTemplates::getAlias('register-member');
                $email = new EmailTemplates;*/
                $email = EmailTemplates::model()->findByAttributes(array('alias'=>'register-member'));
                $message = Yii::t('global', $email->email_content,array(
                                                                        '{username}' => $model->username,
                                                                        '{team}'=>Yii::app()->name,
                                                                        '{homelink}' => $homelink,
                                                                        '{link}' => $actlink ));
                $message .= Yii::t('global', '<br /><br />----------------<br />Regards,<br />The {team} Team.<br />', array('{team}'=>Yii::app()->name));
                Utils::sendMail(Yii::app()->params['emailout'], $model->email,  $email->email_subject, $message);


                // Redirect
                $this->redirect('/profile/Completed_atc');
            }
		}
        $this->pageTitle[] = Yii::t('global', 'Register');
		$this->render('create',array(
			'model'=>$model,'error'=>$error,
		));
	}

    function actionCompleted_atc(){
        $success = Yii::t('global','Register completed, Please check your email to active your account!');
        $this->render('completed_atc',array('message'=>$success));
    }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Profile');
		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Profile::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionchangepass()
	{
		if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl.'login');
		}
		
		$my = Profile::model()->findByPk(Yii::app()->user->id);
		
		$password = new PasswordForm;
		if( isset($_POST['PasswordForm']) )
		{
			$password->attributes = $_POST['PasswordForm'];
			if( $password->validate() )
			{
				// Save changes
				Profile::model()->updateByPk($my->id, array( 'password' => $my->hashPassword($password->npassword, '') ));
				
				// Redirect
				Yii::app()->user->setFlash('success', Yii::t('global', 'Changed password.'));
				$this->redirect(Yii::app()->homeUrl);
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
    
    public function actionchangeemail()
	{
		if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl.'login');
		}
		
		$my = Profile::model()->findByPk(Yii::app()->user->id);
		
		$email = new EmailForm;
		if( isset($_POST['EmailForm']) )
		{
			$email->attributes = $_POST['EmailForm'];
			if( $email->validate() )
			{
				// Save changes
				Profile::model()->updateByPk($my->id, array( 'email' => $email->nemail, '' ));
				
				// Redirect
				Yii::app()->user->setFlash('success', Yii::t('global', 'Changed email.'));
				$this->redirect(Yii::app()->homeUrl);
			}
			else
			{
				$email->email = '';
				$email->nemail = '';
				$email->nemail2 = '';
			}
		}
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Change email');
		$this->breadcrumbs[ Yii::t('global', 'Change email') ] = '';
		
		$this->render('changeemail', array('email'=>$email));
	}
    
   
    public function actionchangeaddress()
    {
        if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl.'login');
		}
        $profile = Profile::model()->findByPk(Yii::app()->user->id);
        
        if(isset($_POST['Members']))
		{
    			$profile->attributes=$_POST['Members'];
                $profile->street=$_POST['Members']['street'];
                $profile->nr=$_POST['Members']['nr'];
                $profile->postcode=$_POST['Members']['postcode'];
                $profile->city=$_POST['Members']['city'];
                $profile->country_id=$_POST['Members']['country'];
    			if($profile->save(false))
    				$this->redirect(array('view','id'=>$profile->id));
        } 
    	$this->render('changeaddress',array('profile'=>$profile));
        
    }
    
    public function actionchangeshippingaddress()
    {
        if( Yii::app()->user->isGuest )
		{
			$this->redirect(Yii::app()->homeUrl.'login');
		}
        $profile = Profile::model()->findByPk(Yii::app()->user->id);
        if(isset($_POST['Members']))
		{
    			$profile->attributes=$_POST['Members'];
                $profile->shipping_street=$_POST['Members']['shipping_street'];
                $profile->shipping_nr=$_POST['Members']['shipping_nr'];
                $profile->shipping_postcode=$_POST['Members']['shipping_postcode'];
                $profile->shipping_city=$_POST['Members']['shipping_city'];
                $profile->shipping_country_id=$_POST['Members']['shipping_country_id'];
    			if($profile->save(false))
    				$this->redirect(array('view','id'=>$profile->id));
    		}  
    	$this->render('changeshippingaddress',array(
			'profile'=>$profile,
		));
        
    }
    
    public function actiondelete($id)
	{
            Members::model()->updateByPk($id, array('status'=>1));
		    $this->redirect(array('/logout/index'));
	}       
	
    
    ////
    function actionActivities(){
        if(!Yii::app()->user->isGuest){
            $auctions = Auctions::model()->getUserActivities(Yii::app()->user->id);
            $this->pageTitle[] = Yii::t('global', 'My activities');
            $this->render('activities', compact('auctions'));
        }

    }
    function actionCompleted_auctions(){
        if(!(Yii::app()->user->isGuest ))
            $auctions = Auctions::model()->getUserCompleted(Yii::app()->user->id);
        $this->pageTitle[] = Yii::t('global', 'My completed auctions');
        $this->render('completed_auctions', compact('auctions'));
    }
    function actionOrders(){
        if(!Yii::app()->user->isGuest){
            $model = new Orders('search');
            $model->unsetAttributes();  // clear any default values
            $model->user_id = Yii::app()->user->id;
            if(isset($_GET['Orders']))
                $model->attributes=$_GET['Orders'];
        }
        $this->pageTitle[] = Yii::t('global', 'My orders');
        $this->render('orders', compact('model'));
    }
    function actionCoupon_account(){
        $coupons=new Coupons();
        $this->render('coupon_account', array('coupons'=>$coupons));
        
    }
    function actionCharge(){
        $model = new BonusInpayments();
        $model->unsetAttributes();

        $this->pageTitle[] = Yii::t('global', 'Charge account');
        $this->render('charge',compact('model'));
    }
    function actionTransactions(){
        if(!Yii::app()->user->isGuest){
            $model=new Transactions('search');
            $model->unsetAttributes();
            $model->user_id = Yii::app()->user->id;
            $model->paymentstatus = Transactions::STATUS_APPROVED;
            if(isset($_GET['Transactions']))
                $model->attributes=$_GET['Transactions'];
        }
        $this->pageTitle[] = Yii::t('global', 'Account transactions');
        $this->render('transactions', compact('model'));
    }
    function actionView_auction(){
        
        $auctionsview=new AuctionViews();
        $this->render('view_auction', array('auctionsview'=>$auctionsview));
    }
    function actionCoupon(){
        $this->render('coupon');
    }

    function actionCheckUser(){
        $username = $_GET['username'];
        if($username){
            if(Members::model()->checkExistUser($username)){
                echo Yii::t('global','Username already exists');
            }
        }
    }
    public function actionVerify()
    {
        $code = $_GET['vericode'];
        if($code != '')
        {
            $vericode = Members::model()->findByAttributes(array('vericode'=>$code));
            if($vericode){
                Members::model()->updateByPk($vericode->id, array('role'=>'user'));
                $message=Yii::t('global','You have actived your account succesful. Please login to start!');
                $this->render('completed_atc', array('message'=>$message));
            }

        }

    }

    public function actionCheck(){

        $this->redirect('http://google.com');
    }

    public function actionAddNewsletter($user_id){

        $getUser = Members::model()->findByPk($user_id);
        if($getUser )
        {
            $model = new Newsletter;
            $model->attributes = array(
                'email'=>$getUser->email
            );
            $model->save();
        }
    }
    public function actionRemoveNewsletter($user_id){

        $getUser = Members::model()->findByPk($user_id);
        if($getUser )
        {
            $model =Newsletter::model()->findByAttributes(array('email'=>$getUser->email));
            $model->delete();

        }
    }


}
