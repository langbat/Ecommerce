<?php

class ProductsController extends SiteBaseController
{
    const PAGE_SIZE = 16;
    const PAGE_SIZE_BASIC = 6;
    const PAGE_SIZE_COMMENT = 5;
    
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
    */
	function actionDetail( $id )
	{
        $product = Products::model()->findByPk( $id );
        if (!$product->id)
            $this->redirect('/');
        $this->pageTitle[] = Yii::t('global','Product Detail');
        //Communication
        if (isset($_GET['sessionId'])){
            $sessionId = $_GET['sessionId'];
            $token = $_GET['token'];
        }
        else{
            $session = Yii::app()->Tokbox->create_session();
            $sessionId = $session->getSessionId();
            $token = Yii::app()->Tokbox->generate_token($sessionId);
        }
        $gallery = ProductGalleries::model()->findAllByAttributes(array('product_id'=>$id));
        $criteria =  new CDbCriteria();
        $criteria->condition = 'item_id = '.$id;
        $count_ordered = OrderItems::model()->findAll($criteria);
        $schedule= ScheduleShows::model()->getSchedule($id);
        $checkSchedule = ScheduleShows::model()->checkSchedule($id);
        $commentProduct = ProductComments::model()->getCommentProduct($id);
        $commentProduct->pagination->pageSize =self::PAGE_SIZE_COMMENT;
        $last_product_tv = 0;
        if(isset($_GET['type']) && $_GET['type']=='lastview'){
            $criteria = new CDbCriteria();
            $criteria->order = 'created DESC';
            $last_product_tv= TokboxArchive::model()->find($criteria);
        }
        $this->render('detail', array('last_product_tv'=>$last_product_tv,'schedule'=>$schedule,'product'=>$product,'sessionId'=>$sessionId, 'token'=>$token,'gallery'=>$gallery,'ordered'=>$count_ordered,'checkSchedule'=>$checkSchedule,'commentProduct'=>$commentProduct ) );
	}
    
    
    function actionCategory($alias){
        $criteria = new CDbCriteria();
        $sort     = 'id DESC'; 
        if(isset($_POST['sort']))
           Yii::app()->session['sort'] = $_POST['sort'];
        $sort = isset(Yii::app()->session['sort'])?Yii::app()->session['sort']:$sort;
        $category = Categories::model()->findByAttributes(array('alias' => $alias));
        if (!$category) $this->redirect('/');
        $product_ids = Products::getIdsOfCategory($category->id);
        $criteria->order = $sort;
        $criteria->condition = "id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")";
        $products = new CActiveDataProvider('Products', array(
            'criteria' => $criteria
        ));
        $products->pagination->pageSize=self::PAGE_SIZE;
        $this->render('category', compact('category', 'products', 'product_ids'));
    }
    public function actionProductDetail(){
        $this->render('product_detail');
    }

    public function actionSaveRating(){
        $score      = intval( $_GET['score'] );
        $product_id = intval( $_GET['id'] );
        $type       = intval( $_GET['type'] );
        $ip         =  $_SERVER['REMOTE_ADDR'];
      
        $result = Ratings::model()->saveRating( $score, $product_id, $type,$ip);
        if($result == false) {
            echo 'false';
        } else {echo 'true';}


    }
    
    public function actionLabel( $id ){
        $label = ProductLabels::model()->findByPk( $id );
        if( !$label )
            $this->redirect('/');
        $products = new CActiveDataProvider('Products', array(
            'criteria'=>array(
                'order' => 'created DESC',
                'condition' => 'label_id ='.$id.' AND is_active = 1',
            )
        ));
        $this->render( 'labelproducts', compact('label', 'products') );
    }
   
   function actionloadProductByCate(){
        $cate_id        = intval( $_GET['id'] );
        $productviews   = Products::model()->getProductByCate( $cate_id, 5 );
        $this->renderPartial( 'product_by_cate_ajax', compact('productviews','cate_id') );
    }

   public function actionAddNewsletter(){
       $email = $_GET['email'];
       $checkExist = Newsletter::model()->checkEmail($email);
       if($checkExist->checkEmail >=1){
           echo Yii::t('global','This email was subscribe');
       } else {
           $newsLetter = new Newsletter();
           $newsLetter->email = $email;
           $newsLetter->joined = time();
           $newsLetter->save();
           echo Yii::t('global','Subscribe successful. Thank for subscribe');
       }
   }

   public function actionAddComment(){
        $id = $_GET['id'];
        $content = $_GET['content'];
        $productComment =  new ProductComments();
        $productComment->product_id = $id;
        $productComment->content = $content;
        $productComment->type = ProductComments::TYPE_PRODUCT;
        $productComment->save();
   }


    public function actionGetLastLiveshow(){
       $criteria = new CDbCriteria();
       $criteria->select = 'product_id';
       $criteria->condition = "end_time <= NOW()";
       $criteria->order = 'end_time ASC';
       $product_id= ScheduleShows::model()->find($criteria);
       echo $product_id->product_id.'?type=lastview';
    }
}