<?php

class ShopNewsletterController extends SiteBaseController {
    public $membershop, $productshop, $categoryshop, $product, $model, $userId, $ername, $eremail, $newname, $newemail, $sms, $err_sent, $sent;
    const PAGE_SIZE =5;
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Shop Newsletters') ] = array('shop-newsletter/index');
		$this->pageTitle[] = Yii::t('global', 'Shop Newsletters');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	   $this->layout = 'admin_shop';
	   $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
       if($checkuser == false){
            $this->redirect(Yii::app()->homeUrl);
       }else{ 
            $checknewletter = ShopNewsletter::model()->checkShopNewletter($checkuser->id, $id);
            if($checknewletter ==  false){
                $this->redirect(Yii::app()->homeUrl);
            }else{
                $model=new ShopNewsletter;
        		$this->render('view',array(
        			'model'=>$this->loadModel($id),
        		));
            }
       }
	}

	public function actionJoin($shop_id)
	{
        $this->layout = 'shop';
        $sms = 0;
		$model=new ShopNewsletter;
        $this->membershop = MemberShop::model()->getMemberShopById($shop_id);
        if (!$this->membershop->id)
            $this->redirect('/');
        if(isset($_POST['ShopNewsletter']))
		{
            $model->attributes=$_POST['ShopNewsletter'];
            $test = $_POST['ShopNewsletter']['email'];
            if(!preg_match("/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/",$test)){
               $sms = 3;
               $this->redirect(array('/shopNewsletter/join/'.$this->membershop->id.'?sms='.$sms));
            }
            $tmp = ShopNewsletter::model()->findAll();
            foreach($tmp as $value){
                if(($value->email) == trim($test)){
                    $sms = 2;
                    $this->redirect(array('/shopNewsletter/join/'.$this->membershop->id.'?sms='.$sms));
                }
            }
			if($model->save()){
                $sms = 0;
				$this->redirect(array('/shopNewsletter/join/'.$this->membershop->id.'?sms='.$sms));
            }
		}
        
        $this->render('join', compact('blogshop','model'));
  }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	   $this ->layout = 'admin_shop';
       $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
       if($checkuser == false){
            $this->redirect(Yii::app()->homeUrl);
       }else{ 
            $checknewletter = ShopNewsletter::model()->checkShopNewletter($checkuser->id, $id);
            if($checknewletter ==  false){
                $this->redirect(Yii::app()->homeUrl);
            }else{
        		$model=$this->loadModel($id);
        		if(isset($_POST['ShopNewsletter']))
        		{
        			$model->attributes=$_POST['ShopNewsletter'];
                    $test = $_POST['ShopNewsletter']['email'];
                    if(!preg_match("/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/",$test)){
                        //Yii::app()->user->setFlash('error', Yii::t('global', 'That language string was not found.'));
                        $this->render('update',array(
                			'model'=>$model,
                		));
                    }else{
                        if($model->save())
      				        $this->redirect(array('view','id'=>$model->id));
                    }
        			
        		}
        
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
	   $this ->layout = 'admin_shop';
       $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
       if($checkuser == false){
            $this->redirect(Yii::app()->homeUrl);
       }else{ 
            $checknewletter = ShopNewsletter::model()->checkShopNewletter($checkuser->id, $id);
            if($checknewletter ==  false){
                $this->redirect(Yii::app()->homeUrl);
            }else{
                if( isset($_GET['id']) && ( $model = ShopNewsletter::model()->findByPk($_GET['id']) ) )
        		{
        			$model->delete();
        			$this->redirect(array('index'));
        		}
        		else
        		{
        			$this->redirect(array('index'));
        		}
        		//if(Yii::app()->request->isPostRequest)
//        		{
//        			// we only allow deletion via POST request
//        			$this->loadModel($id)->delete();
//        
//        			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        			if(!isset($_GET['ajax']))
//        				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//        		}
//        		else
//        			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    	   }
        }
    }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   $this->layout = 'admin_shop';
       $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
       if($checkuser == false){
            $this->redirect(Yii::app()->homeUrl);
       }else{
        $model = ShopNewsletter::model()->getNewletterByIdShop($checkuser->id);
        $count = count($model->getData());
      
       //insert newletter
        if(isset($_POST['save']))
		{
			if((isset($_POST['name'])) && (trim($_POST['name']) != null)){
			     $this->newname = $_POST['name'];
			     $this->ername = 0;
			}else{
			     $this->ername = 1;
			}
            
            if((isset($_POST['email'])) && (trim($_POST['email']) != null)){
                $this->newemail = $_POST['email'];
			     $this->eremail = 0;
			}else{
			     $this->eremail = 1;
			}
            $tmp = ShopNewsletter::model()->findAll();
            foreach($tmp as $value){
                if(($value->email) == trim($_POST['email'])){
                    $this->eremail= 2;
                }
            }
            if(($this->eremail == null) && ($this->ername == null) ){
                $newletter = new ShopNewsletter();
                $newletter->name = $_POST['name'];
                $newletter->email = $_POST['email'];
                $newletter->shop_id = $checkuser->id;
                $newletter->joined = $_POST['joined'];
                $newletter->save();
                $this->sms = 1;
                $this->newname = "";
                $this->newemail ="";
            }
		}
        // Send newsletter
        $this->err_sent = -1;
        $this->sent = 0;
		if( isset($_POST['sendnewsletter']) && $_POST['sendnewsletter'] )
		{
			if( isset($_POST['content']) && $_POST['content'] != '' )
			{
				// Make sure there are enough email
				$emails = ShopNewsletter::model()->getNewletter($checkuser->id);
				if( $emails )
				{
					// Loop and send
					foreach($emails as $row)
					{
						Utils::sendMail(Yii::app()->params['emailout'], $row->email, isset($_POST['subject']) ? $_POST['subject'] : 'Newsletter', $_POST['content']);                        
						$this->sent++;
					} 
					$this->err_sent = 0;
				}
				else{
				    $this->err_sent = 1;
				}
			}
			else{
			     $this->err_sent = 2;
			}
		}
        $deleted = 0;
        // Did we submit the form and selected items?
		if( isset($_POST['bulkoperations']) && $_POST['bulkoperations'] != '' )
		{
			// Did we choose any values?
			if( isset($_POST['record']) && count($_POST['record']) )
			{
			 $deleted = count($_POST['record']);
				// What operation we would like to do?
				switch( $_POST['bulkoperations'] )
				{									
					case 'bulkdelete':
					// Load records
					$records = ShopNewsletter::model()->deleteByPk(array_keys($_POST['record']));
					// Done
                    //var_dump($deleted);
					//Yii::app()->user->setFlash('success', Yii::t('newsletter', '{count} items deleted.', array('{count}'=>$records)));
					break;
				
					default:
					// Nothing
					break;
				}
			}else{
			     $deleted = 6;
			}
		}
        //var_dump($deleted);
        
	   // Load items and display
		$criteria = new CDbCriteria;

		$pages = new CPagination($count);
		$pages->pageSize = self::PAGE_SIZE;
		
		$pages->applyLimit($criteria);
		$sort = new CSort('ShopNewsletter');
		$sort->defaultOrder = 'joined DESC';
		$sort->applyOrder($criteria);

		$sort->attributes = array(
		        'email'=>'email',
                'name'=>'name',
				'joined' =>'joined',
		);
        $criteria->condition = 'shop_id = '.$checkuser->id ;
		$items = ShopNewsletter::model()->findAll($criteria);
        $this->render('index', array( 'model' => $model, 'items' => $items, 'pages' => $pages, 'sort' => $sort, 'count' => $count, 'deleted'=>$deleted));
       
	}
    }
    
	public function loadModel($id)
	{
		$model=ShopNewsletter::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='shop-newsletter-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
