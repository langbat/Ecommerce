<?php

class SupportController extends AdminBaseController {
    public $array_support;
    public function init()
	{
		parent::init();
		$this->array_support = array();
		$this->breadcrumbs[ Yii::t('global', 'Supports') ] = array('support/index');
		$this->pageTitle[] = Yii::t('global', 'Supports');
        
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Support;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Support']))
		{
			$model->attributes=$_POST['Support'];
            $model->date_create = date('Y-m-d H:i:s');
            if($_POST['options_video'] == 'link'){
                $model->linkyoutube = $_POST['Support']['linkyoutube'];
            }else if($_POST['options_video'] == 'upload'){
                $uploadedVideo=CUploadedFile::getInstance($model,'video');
                if(!empty($uploadedVideo)) {
                    $rnd = rand(0,9999);
                    $fileVideo = "{$rnd}-{$uploadedVideo}";  // random number + file name
                    $model->linkyoutube = $fileVideo;
                }
                else{
                    $fileVideo = '';
                }
            }
          
			if($model->save()){
			  if(!empty($uploadedVideo)) {
			    // var_dump($uploadedVideo);exit();
                    $uploadedVideo->saveAs(Yii::app()->basePath.'/../uploads/video/'.$fileVideo);
                    }$this->redirect(array('view','id'=>$model->id));
                    
			}
			
		}

		$this->render('create',array(
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
        
		if(isset($_POST['Support']))
		{
		  
			$model->attributes=$_POST['Support'];
            $model->date_create = date('Y-m-d H:i:s');
            if($_POST['options_video'] == 'link'){
                $model->linkyoutube = $_POST['Support']['linkyoutube'];
            }else if($_POST['options_video'] == 'upload'){
                $uploadedVideo=CUploadedFile::getInstance($model,'video');
                if(!empty($uploadedVideo)) {
                   $rnd = rand(0,9999);
                    $fileVideo = "{$rnd}-{$uploadedVideo}";  // random number + file name
                    $model->linkyoutube = $fileVideo;
                }
                else{
                    $fileVideo = '';
                }
            }
           
			if($model->save()){
			 if(!empty($uploadedVideo)) {
                    $uploadedVideo->saveAs(Yii::app()->basePath.'/../uploads/video/'.$fileVideo);
                }
                 $this->redirect(array('view','id'=>$model->id));
			}
				
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
		$model=new Support('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Support']))
			$model->attributes=$_GET['Support'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Support');
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
		$model=Support::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='support-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
