<?php

class LookupController extends AdminBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Help Topic') ] = array('lookup/index');
        $this->pageTitle[] = Yii::t('global', 'Help Topi');
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
		$model=new Lookup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Lookup']))
		{
			$model->attributes=$_POST['Lookup'];
            $model->code = $_POST['Lookup']['position'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
        $type = (isset($_GET['type']))?$_GET['type']:"";
		$this->render('create',array(
			'model'=>$model,
            'type'=>$type
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

		if(isset($_POST['Lookup']))
		{
			$model->attributes=$_POST['Lookup'];
            $model->code = $_POST['Lookup']['position'];
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
		$model=new Lookup('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Lookup']))
			$model->attributes=$_GET['Lookup'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Lookup');
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
		$model=Lookup::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='lookup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionSetUp(){
        $id = $_GET['id'];
        $upRank = Lookup::model()->findByPk($id);
        $downRank = Lookup::model()->findByAttributes(array('position'=>$upRank->position -1,'type'=>$upRank->type));
        if($upRank->position !=1){
            $downRank->position = $upRank->position;
            $upRank->position = $upRank->position - 1;
            $upRank->save();
            $downRank->save();
        }
    }
    public function actionSetDown(){
        $id = $_GET['id'];
        $downRank = Lookup::model()->findByPk($id);
        $allRankTopic = count(Lookup::model()->findAll('type="'.$downRank->type.'"'));
        if($downRank->position < $allRankTopic) {
            $upRank = Lookup::model()->findByAttributes(array('position'=>$downRank->position +1,'type'=>$downRank->type));
            $upRank->position =  $downRank->position;
            $downRank->position =  $downRank->position + 1;
            $downRank->save();
            $upRank->save();
        }

    }
}
