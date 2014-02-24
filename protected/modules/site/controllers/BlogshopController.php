<?php

class BlogshopController extends SiteBaseController {
    public $userId, $membershop, $categoryshop, $product;
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Blogshops') ] = array('blogshop/index');
		$this->pageTitle[] = Yii::t('global', 'Blogshops');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	   $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
       if($checkuser == false){
            $this->redirect(Yii::app()->homeUrl);
       }else{
            $checkbloshop = Blogshop::model()->checkBlogShop($checkuser->id, $id);
            if($checkbloshop == false){
                $this->redirect(Yii::app()->homeUrl);
            }else{
    	       $this ->layout = 'admin_shop';
        		$this->render('view',array(
        			'model'=>$this->loadModel($id),
        		));
            }
        }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	   $this ->layout = 'admin_shop';
	  $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
       if($checkuser == false){
            $this->redirect(Yii::app()->homeUrl);
       }else{
           $this->userId = $checkuser->id; 
    	   $model= new Blogshop;
    		if(isset($_POST['Blogshop']))
    		{
                $model->attributes=$_POST['Blogshop'];
                $model->created_blog = date('Y-m-d H:i:s');
                $uploadedFile =CUploadedFile::getInstance($model,'image');
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
                            $uploadedFile->saveAs(Yii::app()->basePath.'/../uploads/blogshop/'.$fileName);
                        }
    				$this->redirect(array('view','id'=>$model->id));
                }
    		}
    		$this->render('create',array(
    			'model'=>$model,
                'userId'=>$this->userId
    		));
      }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	   $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
       if($checkuser == false){
            $this->redirect(Yii::app()->homeUrl);
       }else{
            $checkbloshop = Blogshop::model()->checkBlogShop($checkuser->id, $id);
            if($checkbloshop == false){
                $this->redirect(Yii::app()->homeUrl);
            }else{
        		$model=$this->loadModel($id);
                $model->shop_id = $checkuser->id;
        		if(isset($_POST['Blogshop']))
        		{
                    $model->attributes=$_POST['Blogshop'];
                    $uploadedFile=CUploadedFile::getInstance($model,'image');
                    if(!empty($uploadedFile)) {
                        $rnd = rand(0,9999);
                        $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                        $model->image = $fileName;
                    }else{
                        $modelold       = $this->loadModel($id);
                        $model->image   = $modelold->image ;
                    }
        			//var_dump($model->image); exit();
        			if($model->save()){
        			  if(!empty($uploadedFile)) {
                            $uploadedFile->saveAs(Yii::app()->basePath.'/../uploads/blogshop/'.$model->image);
                        }
                        $this->redirect(array('view','id'=>$model->id));
        			}
        				
        		}
                $this ->layout = 'admin_shop';
        		$this->render('update',array(
        			'model'=>$model,
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
	   $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
       if($checkuser == false){
            $this->redirect(Yii::app()->homeUrl);
       }else{
            $checkbloshop = Blogshop::model()->checkBlogShop($checkuser->id, $id);
            if($checkbloshop == false){
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
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   $this ->layout = 'admin_shop';
       $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
       if($checkuser == false){
            $this->redirect(Yii::app()->homeUrl);
       }else{
    		$model=new Blogshop('search');
            $model->unsetAttributes();  // clear any default values
            $model->shop_id = $checkuser->id;
    		if(isset($_GET['Blogshop']))
    			$model->attributes=$_GET['Blogshop'];
    		$this->render('index',array(
    			'model'=>$model,
    		));
        }
	}

	/**
	 * Manages all models.
	 
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Blogshop');
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
		$model=Blogshop::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='blogshop-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionDetail($shop_id)
    {
        $this->layout = 'shop';
        $this->membershop = MemberShop::model()->getMemberShopById($shop_id);
        if (!$this->membershop->id)
            $this->redirect('/');
        $this->pageTitle[] = $this->membershop->name.' '.Yii::t('global', 'Blog Shop');
        $blogshop = Blogshop::getBlogShop($shop_id);
        $this->render('detail', compact('blogshop'));
    }
    public function actionBlog($shop_id, $blog_id)
    {
        $this->layout = 'shop';
        $this->membershop = MemberShop::model()->getMemberShopById($shop_id);
        if (!$this->membershop->id)
            $this->redirect('/');
        $this->pageTitle[] = $this->membershop->name.' '.Yii::t('global', 'Blog Shop Detail');
        $blogshopdetail = Blogshop::getBlogShopDetail($blog_id);
        $allblog = Blogshop::model()->getAllBlogShop($shop_id);
        $this->render('blog', compact('blogshopdetail','allblog'));
    }
}
