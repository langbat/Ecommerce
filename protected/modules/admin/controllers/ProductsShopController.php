<?php

class ProductsShopController extends AdminBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Products Shops') ] = array('productsShop/index');
		$this->pageTitle[] = Yii::t('global', 'Products Shops');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$images = ProductGalleriesShop::model()->findAllByAttributes(array('product_shop_id' => $id));
        $this->render('view',array(
			'model'     => $this->loadModel($id),
            'images'    => $images,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ProductsShop;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductsShop']))
		{
			$model->attributes=$_POST['ProductsShop'];
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            if(!empty($uploadedFile)) {
                $rnd = rand(0,9999);
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->image = $fileName;
            }
            else{
                $fileName = '';
            }
			if($model->save()){
                if(!empty($uploadedFile)) {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../uploads/product_shop/'.$fileName);
                }
                $checkcat = isset($_POST['ProductsShopCategory']);
                if( !$checkcat ){
                    Yii::app()->user->setFlash('error', Yii::t('adminmembers', 'Input category product shop'));
                    $this->redirect(array('productsShop/create'));
                }
                else{
    			     $cats = $_POST['ProductsShopCategory'];
                     foreach ($cats as $cat_id){
                        $cat = new ProductCategoriesShop;
                        $cat->product_id = $model->id;
                        $cat->category_id = $cat_id;
                        $cat->save();
                     }
                }
                $this->_saveGallery($model);
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

		if(isset($_POST['ProductsShop']))
		{
			$model->attributes=$_POST['ProductsShop'];
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            if(!empty($uploadedFile)) {
                $rnd = rand(0,9999);
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->image = $fileName;
            }
            else{
                $modelold       = $this->loadModel($id);
                $model->image   = $modelold->image ;
            }
			if($model->save()){
                ProductCategoriesShop::model()->deleteAll(
                    "product_id = :product_id",
                    array(':product_id' => $model->id)
                );
			    $checkcat = isset($_POST['ProductsShopCategory']);
                if( !$checkcat ){
                    Yii::app()->user->setFlash('error', Yii::t('adminmembers', 'Input category product shop')); 
                    $this->redirect(array('update','id'=>$model->id));
                }
                else{
                    $cats = $_POST['ProductsShopCategory'];
                    foreach ($cats as $cat_id){
                        $cat = new ProductCategoriesShop;
                        $cat->product_id = $model->id;
                        $cat->category_id = $cat_id;
                        $cat->save();
                    }
                }
                if(!empty($uploadedFile)) {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../uploads/product_shop/'.$model->image);
                } 
                $this->_saveGallery($model);
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
	  
	    if (isset($_GET['ajax']) && $_GET['ajax'] == 'product-galleries-grid'){
	      
           ProductGalleriesShop::model()->findByPk($id)->delete();
		}
        else if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
            if($this->loadModel($id)->delete()){
			 ProductComments::model()->deleteAll('product_id = ? AND type = ?' , array($id, 0));  
			}
          
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
		$model=new ProductsShop('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductsShop']))
			$model->attributes=$_GET['ProductsShop'];
        
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('ProductsShop');
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
		$model=ProductsShop::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='products-shop-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    function _saveGallery($model){
        $files = array();
        if (isset($_POST['uploader_count']) && $count = $_POST['uploader_count']){
            for ($i = 0 ; $i < $count; $i ++){
                if ($_POST["uploader_{$i}_status"] == 'done')
                    $files[] = date('Ymd').'/'.$_POST["uploader_{$i}_tmpname"];
            }
        }
        if (count($files)){
            ProductGalleriesShop::model()->updateAll(array('product_shop_id' => $model->id), "filename IN ('".implode("','", $files)."')");            
        }
    }
    
    function actionUpload(){
        $this->layout = '';
        if (isset($_POST['name']) && isset($_FILES['file'])){            
            $folder = Yii::app()->basePath.'/../uploads/product_gallery_shop/'.date('Ymd').'/';
            
            if (!is_dir($folder)){
                mkdir($folder, 0777);
            }
            $filename = date('Ymd').'/'.$_POST['name'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], $folder.$_POST['name'])){
                $gallery = new ProductGalleriesShop;
                $gallery->filename = $filename;
                $gallery->save();
            }
        }
        
    }
}
