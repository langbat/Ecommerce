<?php

class HelpsController extends AdminBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Helps') ] = array('helps/index');
		$this->pageTitle[] = Yii::t('global', 'Helps');
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
		$model=new Helps;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        
        //need copy
        if (isset($_GET['language'])) 
            $model->language = $_GET['language'];
        else
            $model->language = Yii::app()->language;            
        if (isset($_GET['alias'])) $model->alias = $_GET['alias'];
        //end copy

		if(isset($_POST['Helps']))
		{
			$model->attributes=$_POST['Helps'];
			if($model->save()){
                $newHelp = Helps::model()->findByPk($model->id);
                $getRank = count(Helps::model()->findAll('topic='.$newHelp->topic));
                $newHelp->rank = $getRank;
                $newHelp->save();
                $this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Helps']))
		{
			$model->attributes=$_POST['Helps'];
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
		$model=new Helps('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Helps']))
			$model->attributes=$_GET['Helps'];

        $topic= new Lookup('search');
        $topic->unsetAttributes();
        if(isset($_GET['Lookup']))
            $topic->attributes=$_GET['Lookup'];

        $this->render('index',array(
			'model'=>$model,
            'topic'=>$topic
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Helps');
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
		$model=Helps::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='helps-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

   /* protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='lookup-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }*/

    public function actionSetUp(){
            $id = $_GET['id'];
            $upRank = Helps::model()->findByPk($id);
            $downRank = Helps::model()->findByAttributes(array('rank'=>$upRank->rank -1,'language'=>Yii::app()->language,'topic'=>$upRank->topic));
            if($upRank->rank !=1){
            $downRank->rank = $upRank->rank;
            $upRank->rank = $upRank->rank - 1;
            $upRank->save();
            $downRank->save();
        }
    }
    public function actionSetDown(){
        $id = $_GET['id'];
        $downRank = Helps::model()->findByPk($id);
        $allRankTopic = count(Helps::model()->findAll('topic='.$downRank->topic));
        if($downRank->rank < $allRankTopic) {
            $upRank = Helps::model()->findByAttributes(array('rank'=>$downRank->rank +1,'language'=>Yii::app()->language,'topic'=>$downRank->topic));
            $upRank->rank =  $downRank->rank;
            $downRank->rank =  $downRank->rank + 1;
            $downRank->save();
            $upRank->save();
        }

    }
    public function actionCreateTopic()
    {
        $model=new Lookup;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Lookup']))
        {
            $position_current = Lookup::model()->findAllByAttributes(array('type'=>'HelpTopic'));
            $check_position = 0;
            foreach($position_current as $item){

                if($_POST['Lookup']['position'] == $item->position )  {
                    $check_position = 1;
                }
            }

            if($check_position ==0){
                $model->attributes=$_POST['Lookup'];
                $model->type='HelpTopic';
                $model->code = $_POST['Lookup']['position'];
                if($model->save())
                    $this->redirect(array('viewTopic','id'=>$model->id));
            } else {
                $mess = Yii::t('global','This position is available');
                $this->render('create_topic',array(
                    'model'=>$model,
                    'mess'=>$mess
                )); exit();
            }

        }
        $type = (isset($_GET['type']))?$_GET['type']:"";
        $this->render('create_topic',array(
            'model'=>$model,
            'mess'=>$type
        ));


    }
    public function actionViewTopic($id)
    {
        $this->render('view_topic',array(
            'model'=>$this->loadModelTopic($id),
        ));
    }
    public function loadModelTopic($id)
    {
        $model=Lookup::model()->findByPk((int)$id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionUpdateTopic($id)
    {
        $model=$this->loadModelTopic($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Lookup']))
        {

            $position_current = Lookup::model()->findAllByAttributes(array('type'=>'HelpTopic'));
            $check_position = 0;
            foreach($position_current as $item){

                if($_POST['Lookup']['position'] == $item->position && $_POST['Lookup']['position'] != $model->position )  {
                    $check_position =1;
                }
            }
            if($check_position ==0){
                $model->attributes=$_POST['Lookup'];
                if($model->save())
                    $this->redirect(array('viewTopic','id'=>$model->id));
            } else {
                $mess = Yii::t('global','This position is available');
                $this->render('update_topic',array(
                    'model'=>$model,
                    'mess'=>$mess
                )); exit();
            }

        }
        $this->render('update_topic',array(
            'model'=>$model,
        ));
    }

    public function actionDeleteTopic($id)
    {
        $this->loadModelTopic($id)->delete();
        $this->actionIndex();

    }
}
