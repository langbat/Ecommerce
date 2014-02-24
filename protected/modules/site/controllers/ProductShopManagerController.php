<?php

class ProductShopManagerController extends SiteBaseController {
    public $membershop, $productshop, $categoryshop;
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Products Shops') ] = array('productShopManager/index');
		$this->pageTitle[] = Yii::t('global', 'Products Shops');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	   $this->layout='admin_shop';
       $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
       if($ismemberShop == null){
            $this->redirect(Yii::app()->homeUrl);
        }else{
            $commentProductShop = ProductComments::model()->getCommentProductShop($id);
    	    $images = ProductGalleriesShop::model()->findAllByAttributes(array('product_shop_id' => $id));
            $this->render('view',array(
    			'model'     => $this->loadModel($id),
                'images'    => $images,
                'commentProductShop'=>$commentProductShop,
    		));
    	}
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	     
		$model=new ProductsShop;
        $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
       if($ismemberShop == null){
            $this->redirect(Yii::app()->homeUrl);
       }else{
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
                    $this->redirect(array('productShopManager/create'));
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
        $this->layout='admin_shop';
         if(empty($ismemberShop)){
               $this->redirect(Yii::app()->homeUrl.'memberShop/create');
                }else{
		$this->render('create',array(
			'model'=>$model,
		));
        }
	}
    }



	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
        $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
       if($ismemberShop == null){
            $this->redirect(Yii::app()->homeUrl);
       }else{
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $model=$this->loadModel($id);
        
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
         $this ->layout = 'admin_shop';
		$this->render('update',array(
			'model'=>$model,
		));
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
		if(!Yii::app()->user->isGuest && isset($id))
		{
			// we only allow deletion via POST request
			if($this->loadModel($id)->delete()){
			 ProductComments::model()->deleteAll('product_id = ? AND type = ?' , array($id, 0));  
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
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
	   $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
       if($ismemberShop == null){
            $this->redirect(Yii::app()->homeUrl);
       }else{
	       $model=new ProductsShop('search');
    		$model->unsetAttributes();  // clear any default values
            $shop = MemberShop::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
            $model->shop_id = isset($shop)?$shop->id:-1;
           	if(isset($_GET['ProductsShop']))
                $model->attributes=$_GET['ProductsShop'];
            $this->layout='admin_shop';
            $this->render('index',array(
          	     'model'=>$model,
           	));
	   }
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
    
    public function actionDeletecomment($id){
        $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
       if($ismemberShop == null){
            $this->redirect(Yii::app()->homeUrl);
       }else{
    	   if(!Yii::app()->user->isGuest && isset($id))
    		{
    			// we only allow deletion via POST request
    			$this->loadModelComment($id)->delete();
               
    			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    			if(!isset($_GET['ajax']))
    				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view'));
    		}
    		else
    			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	
        }
	}
    public function actionUpdatecomment($id,$id_pro)
	{
		$model=ProductComments::model()->findByPk((int)$id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductComments']))
		{
			$model->attributes=$_POST['ProductComments'];
            $model->created=date('Y-m-d H:i:s');
			if($model->save())
				$this->redirect(array('view','id'=>$id_pro));
		}
        $this->layout='comment';
		$this->render('updatecomment',array(
			'model'=>$model,
		));
	}
    public function actionDeleteGalleries($id,$pro_id){
         $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
           if($ismemberShop == null){
                $this->redirect(Yii::app()->homeUrl);
           }else{
        	   if(!Yii::app()->user->isGuest && isset($id))
        		{
        			// we only allow deletion via POST request
        			 ProductGalleriesShop::model()->findByPk($id)->delete();
                    	$this->redirect(Yii::app()->homeUrl.'productShopManager/update?id='.$pro_id);	
        		}
        		else
        			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        	
        }
	}
    
   	public function loadModelComment($id)
	{
		$model=ProductComments::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    function _saveGallery($model){
        $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
       if($ismemberShop == null){
            $this->redirect(Yii::app()->homeUrl);
       }else{
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
    }
    
    function actionUpload(){
        $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
       if($ismemberShop == null){
            $this->redirect(Yii::app()->homeUrl);
       }else{
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
    

}

