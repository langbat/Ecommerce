<?php

class ShopRatingsController extends SiteBaseController {
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Shop Ratings') ] = array('shop-ratings/index');
		$this->pageTitle[] = Yii::t('global', 'Shop Ratings');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
//	public function actionView($id)
//	{
//		$this->render('view',array(
//			'model'=>$this->loadModel($id),
//		));
//	}

	/**
	 * Lists all models.
	 */
	public function actionDetail($shop_id)
	{
        $this->layout = 'admin_shop';
        $model=ShopRatings::model()->getRatingByIdShop($shop_id);
        $membershop = MemberShop::model()->getMemberShopById($shop_id);
        $check = MemberShop::model()->checkMember($shop_id,Yii::app()->user->id );
        if($check != null){
    		$this->render('detail',array(
    			'model'=>$model,
                'membershop'=>$membershop
    		));
        }else{
            $this->redirect(Yii::app()->homeUrl);
        }
	}

	/**
	 * Manages all models.
	 */
	//public function actionAdmin()
//	{
//	   if(isset(Yii::app()->user->id)){
//    		$dataProvider=new CActiveDataProvider('ShopRatings');
//    		$this->render('admin',array(
//    			'dataProvider'=>$dataProvider,
//    		));
//      }else{
//        $this->redirect(Yii::app()->homeUrl);
//      }
//	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	//public function loadModel($id)
//	{
//		$model=ShopRatings::model()->findByPk((int)$id);
//		if($model===null)
//			throw new CHttpException(404,'The requested page does not exist.');
//		return $model;
//	}
//
//	/**
//	 * Performs the AJAX validation.
//	 * @param CModel the model to be validated
//	 */
//	protected function performAjaxValidation($model)
//	{
//		if(isset($_POST['ajax']) && $_POST['ajax']==='shop-ratings-form')
//		{
//			echo CActiveForm::validate($model);
//			Yii::app()->end();
//		}
//	}
}
