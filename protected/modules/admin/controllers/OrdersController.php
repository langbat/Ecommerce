<?php

class OrdersController extends AdminBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Orders') ] = array('orders/index');
		$this->pageTitle[] = Yii::t('global', 'Orders');
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
		$model=new Orders;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
            $model->created = $_POST['Orders']['created'];
            $model->remaining_date = $_POST['Orders']['remaining_date'];
			if($model->save())
                $item = new OrderProcess;
                $item->order_id = $model->id;
                $item->status = $model->status;
                $item->save();
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
		$model=new Orders('search');
		$model->unsetAttributes();  // clear any default values
        $model->shop_id = Orders::ORDER_TOSELLO;
		if(isset($_GET['Orders']))
			$model->attributes=$_GET['Orders'];


		$this->render('index',array(
			'model'=>$model,
		));
	}
    
    public function actionOrderShop()
    {
        $model=new Orders('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Orders']))
            $model->attributes=$_GET['Orders'];
        $this->render('order_shop',array(
            'model'=>$model,
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Orders');
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
		$model=Orders::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='orders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionCustomerShop()
    {
        $model=new Orders('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Orders']))
            $model->attributes=$_GET['Orders'];
        $this->render('customerShop',array(
            'model'=>$model,
            'type'=>'customerShop'
        ));
    }
    public function actionVi_customer($id)
    {   
   	    $this->render('vi_customer',array(
			'model'=>$this->loadModel($id),
		));
    }
    
    public function actionUp_customer($id)
    {   
        $model=$this->loadModel($id);
		if(isset($_POST['Orders']))
		{
          Yii::app()->db
            ->createCommand("UPDATE members SET email =:email WHERE id=:id")
            ->bindValues(array(':email'=>$_POST['Orders']['email'], ':id' => $_POST['Orders']['user_id']))
            ->execute();
          $model->attributes=$_POST['Orders'];
          if($model->save())
        		$this->redirect(array('vi_customer','id'=>$model->id));
		}
   	    $this->render('up_customer',array(
			'model'=>$this->loadModel($id),
		));
    }
}
