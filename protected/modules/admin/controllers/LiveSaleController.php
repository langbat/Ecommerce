<?php

class LiveSaleController extends AdminBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Live Sales') ] = array('LiveSale/index');
		$this->pageTitle[] = Yii::t('global', 'Live Sales');
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
		$model=new LiveSale;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
          
		if(isset($_POST['LiveSale']))
		{
			$model->attributes=$_POST['LiveSale'];
            if (isset($_POST['name']) && isset($_FILES['file'])){   
                $folder = Yii::app()->basePath.'/../uploads/video/';
                $filename = date('Ymd').'/'.$_POST['name'];
                $model->image = $fileName;
                echo $filename.'fsdfhsdheoickhongcosanh';
                exit;
            }
            else{
                $fileName = '';
            }
          
			if($model->save()){
			   // if ( move_uploaded_file(isset($_FILES['file']['tmp_name']), $folder.isset($_POST['name']) )){
//                    $this->redirect(array('view','id'=>$model->id));
//                }
//                else{
//                    $this->redirect(array('view','id'=>$model->id));
//                }	
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

		if(isset($_POST['LiveSale']))
		{
			$model->attributes      = $_POST['LiveSale'];
            $list_product           = $_POST['dg'];
            $list_product_ids       = implode(',',$list_product);
            $model->list_product_id = $list_product_ids; 
            
            if($_POST['options_video'] == 'link'){
                $model->media = $_POST['LiveSale']['media'];
            } else if($_POST['options_video'] == 'upload'){
                $uploadedVideo=CUploadedFile::getInstance($model,'media2');
                if(!empty($uploadedVideo)) {
                    $rnd = rand(0,9999);
                    $fileVideo = "{$rnd}-{$uploadedVideo}";  // random number + file name
                    $model->media = $fileVideo;
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
		$model=new LiveSale('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LiveSale']))
			$model->attributes=$_GET['LiveSale'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('LiveSale');
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
		$model=LiveSale::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='live-sale-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
