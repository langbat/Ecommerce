<?php
/**
 * Tags controller Home page
 */
class TagsController extends SiteBaseController {
	
	const PAGE_SIZE = 16;
	/**
	 * Controller constructor
	 */
    public function init()
    {
        parent::init();
    }
	
	/**
	 * List of available actions
	 */
	public function actions()
	{
	   return array(
	      'captcha' => array(
	         'class' => 'CCaptchaAction',
	         'backColor' => 0xFFFFFF,
		     'minLength' => 3,
		     'maxLength' => 7,
			 'testLimit' => 3,
			 'padding' => array_rand( range( 2, 10 ) ),
	      ),
	   );
	}
	
	/**
	 * Detail action
	 */
    public function actionDetail( $slug ){
           $this->pageTitle[] = Yii::t('global','Tag cloud ').': '.$slug;
           $tags = Tags::model()->findByAttributes(array('slug' => $slug));
           if (!$tags) 
                $this->redirect('/');
           $product_ids = ProductTags::model()->getIdsOfTagProducts( $tags->id );
           $name_tags   = $tags->name;
           $products = new CActiveDataProvider('Products', array(
            'criteria' => array(
                'order' => 'created DESC',
                'condition' => "id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).") AND is_active = 1",
            )
            ));
           $products->pagination->pageSize=self::PAGE_SIZE;
           $this->render( 'tags', compact('tags','products') );
    }
}