<?php

class MembersController extends AdminBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Members') ] = array('members/index');
		$this->pageTitle[] = Yii::t('global', 'Members');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
         $user_id = $_GET['id'];
         $this->render('view',array(
			'model'=>$this->loadModel($id), 'user_id'=>$user_id
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Members;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Members']))
		{
			$model->attributes=$_POST['Members'];
            $model->password = Profile::model()->hashPassword($_POST['Profile']['password'], '');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionCreateAdmin()
    {
        $model=new Members('createadmin');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Members']))
        {
            $model->attributes=$_POST['Members'];
            $model->password = Profile::model()->hashPassword($_POST['Members']['password'], '');
            $model->country_id =  $_POST['Members']['country'];
            if($model->save())
                $this->redirect(array('admin','type'=>'admin'));
        }

        $this->render('create_admin',array(
            'model'=>$model,
        ));
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

		if(isset($_POST['Members']))
		{
			$model->attributes=$_POST['Members'];
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
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Members('search');
		$model->unsetAttributes();  // clear any default values
        $model->role = 'user';
        if(isset($_GET['Members']))
			$model->attributes=$_GET['Members'];
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Members('search');
		$model->unsetAttributes();  // clear any default values
        if(isset($_GET['Members']))
			$model->attributes=$_GET['Members'];
		$model->role = 'admin';
		//$this->render('index',array(
//			'model'=>$model,'type'=>'admin'
//		));
        $this->render('index',array(
			'model'=>$model,'type'=>'admin'
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Members::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='members-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    function actionHideMember(){
        $this->layout = false;
        $user_id = $_GET['id'];
        Members::model()->updateByPk($user_id, array('status'=>1));
        $model=new Members('search');
        $model->unsetAttributes();  // clear any default values
        $model->role = 'user';
        $this->render('index-ajax',array(
            'model'=>$model,'id'=>$user_id
        ));

    }

    function actionHideAdmin(){
        $this->layout = false;
        $user_id = $_GET['id'];
        Members::model()->updateByPk($user_id, array('status'=>1));
        $model=new Members('search');
        $model->unsetAttributes();  // clear any default values
        $model->role = 'admin';
        $this->render('index-ajax',array(
            'model'=>$model,'id'=>$user_id
        ));

    }
    
    function actionEvaluation(){
       $model = new Members();
       $this->render('analyse_evaluation',array(
            'model'=>$model,
        )); 
    }
    
    
    public function actionChangepass($id)
	{
		$my = Profile::model()->findByPk($id);
		$password = new PasswordFormAdmin;
		if( isset($_POST['PasswordFormAdmin']) )
		{
			$password->attributes = $_POST['PasswordFormAdmin'];
			if( $password->validate() )
			{
				// Save changes
				Profile::model()->updateByPk($my->id, array( 'password' => $my->hashPassword($password->npassword, '') ));
				
				// Redirect
				Yii::app()->user->setFlash('success', Yii::t('global', 'Changed password.')); 
                $username = Members::model()->getUser($id);
                $email = Members::model()->getEmails($id);
                $newpass = $_POST['PasswordFormAdmin']['npassword2'];
                $subject = Yii::t('global', 'Reset Password');
                $content =  Yii::t('global', 'Dear Mr/Ms '). $username . '<br>'. Yii::t('global', 'We have reset your password successfully.') . '<br>' . Yii::t('global', 'Your new password is: '). $newpass;
                Utils::sendMail(Yii::app()->params['emailout'], $email, $subject, $content); //isset($_POST['subject']) ? $_POST['subject'] : 'Newsletter', );
                $this->redirect($_POST['from_action']);
                //$this->redirect('index');
			}
			else
			{
				//$password->password = '';
				$password->npassword = '';
				$password->npassword2 = '';
			}
		}
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('global', 'Change Password');
		$this->breadcrumbs[Yii::t('global', 'Change Password') ] = '';
		
		$this->render('changepass', array('password'=>$password));
	}
   
}
