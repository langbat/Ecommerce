<?php

class MemberShopController extends SiteBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Member Shops') ] = array('member-shop/index');
		$this->pageTitle[] = Yii::t('global', 'Member Shops');
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
    public function actionView_shop_manager($id)
	{
        $this->layout='admin_shop';
        $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
        if($ismemberShop == null){
            $this->redirect(Yii::app()->homeUrl);
        }else{
            $membershop = MemberShop::model()->getMemberShopById($id);
    		$this->render('view_shop_manager',array(
    			'model'=>$this->loadModel($id),
                'membershop'=>$membershop
    		));
        }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MemberShop;
        $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MemberShop']))
		{
			$model->attributes=$_POST['MemberShop'];
            $model->user_id = Yii::app()->user->id;
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            if(!empty($uploadedFile)) {
                $rnd = rand(0,9999);
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->image = $fileName;
            }
            else{
                $fileName = '';
            }
            /*Banner*/
            $uploadedFileB       = CUploadedFile::getInstance($model,'banner');
            if(!empty($uploadedFileB)) {
                $rnd = rand(0,9999);
                $fileNameB       = "{$rnd}-{$uploadedFileB}";  // random number + file name
                $model->banner   = $fileNameB;
            }
            else{
                $fileNameB       = '';
            }
			if($model->save()) {
                if(!empty($uploadedFile)) {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../uploads/logoshop/'.$fileName);
                }
                if(!empty($uploadedFileB)) {
                    $uploadedFileB->saveAs(Yii::app()->basePath.'/../uploads/logoshop/'.$fileNameB);
                }
                $this->redirect(array('view','id'=>$model->id));
            }

		}
        if(!empty($ismemberShop)){
            $this->redirect(Yii::app()->homeUrl.'memberShop');
        }else{
		$this->render('create',array(
			'model'=>$model,
		));
        }
        
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $fl)
	{
	  
       
		$model=$this->loadModel($id);
        $old_image = $model->image;
        $old_banner = $model->banner;
         $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MemberShop']))
		{
			$model->attributes   = $_POST['MemberShop'];
            $uploadedFile        = CUploadedFile::getInstance($model,'image');
            $model->image        = $old_image;
            if(!empty($uploadedFile)) {
                $rnd = rand(0,9999);
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->image = $fileName;
            }
            else{
                $fileName = '';
            }
            /*Banner*/
            $uploadedFileB       = CUploadedFile::getInstance($model,'banner');
            $model->banner       = $old_banner;
            if(!empty($uploadedFileB)) {
                $rnd = rand(0,9999);
                $fileNameB       = "{$rnd}-{$uploadedFileB}";  // random number + file name
                $model->banner   = $fileNameB;
            }
            else{
                $fileNameB       = '';
            }
            if($model->save()) {
                if(!empty($uploadedFile)) {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../uploads/logoshop/'.$fileName);
                }
                if(!empty($uploadedFileB)) {
                    $uploadedFileB->saveAs(Yii::app()->basePath.'/../uploads/logoshop/'.$fileNameB);
                }
               // $this->layout ='admin_shop';
                $this->redirect(array('view_shop_manager','id'=>$model->id));
            }
		}
        if($model->user_id!==Yii::app()->user->id){
            $this->redirect(Yii::app()->homeUrl.'memberShop');
        }
        else{
                $this->layout='admin_shop';
                  if(empty($ismemberShop)){
               $this->redirect(Yii::app()->homeUrl.'memberShop/create');
                }else{
            	$this->render('update',array(
			'model'=>$model,'fl'=>$fl,
		));
        
        }
	
	}
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	   $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
         if($ismemberShop == null){
            $this->redirect(Yii::app()->homeUrl);
         }else{
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
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   $membershop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
       if(isset($_GET['MemberShop']))
            $model->attributes=$_GET['MemberShop'];
       if($membershop == null){
            $this->redirect(Yii::app()->homeUrl);
       }else{
            $model=new MemberShop('search');
            $model->unsetAttributes();  // clear any default values
            $model->user_id = Yii::app()->user->id;
            $numberproduct = ProductsShop::model()->countProductByIdMember(Yii::app()->user->id);
        	$this->render('index',array(
    		     'model'=>$model,
                 'membershop'=>$membershop,
                 'numberproduct'=>$numberproduct,
            ));
        }
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('MemberShop');
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
		$model=MemberShop::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='member-shop-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
