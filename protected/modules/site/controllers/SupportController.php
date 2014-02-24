<?php

/**
 * Shop controller Home page
 */
class SupportController extends SiteBaseController {

    const PAGE_SIZE = 16;

    public $membershop;
    public $categoryshop;
    public $productshop;
    public $productcategoryshop;
    public $Allsupport;
    /**
     * Controller constructor
     */
    public function init() {
        parent::init();
    }

    /**
     * List of available actions
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'minLength' => 3,
                'maxLength' => 7,
                'testLimit' => 3,
                'padding' => array_rand(range(2, 10)),
            ),
        );
    }

    /**
     * Index action
     */
    public function actionindex() {
        $this ->Allsupport= Support::model()->getAllSupport();
        //$dataProvider = new CActiveDataProvider('MemberShop');
       // $sql = "SELECT *  FROM (SELECT member_shop.*, 
        //COUNT(products_shop.id) AS totals FROM products_shop INNER JOIN member_shop ON products_shop.shop_id = member_shop.id
        //GROUP BY member_shop.id) AS ab WHERE ab.totals > 0";
       // $dataProvider = MemberShop::model()->findAllBySql($sql);
       $this->layout = 'support';
        $this->render('index');//, array(
            //'dataProvider' => $dataProvider,
        //));
    }
    public function actionblogvideo(){
        $this->layout = 'support';
        $dataProvider = new CActiveDataProvider('Support',array(    
                                                                    'pagination' => array('pageSize' =>8),
                                                                    'criteria'=>array(
                                                                    'condition'=>'categories=1',
                                                                    'order'=>'id DESC'),
                                                                )
                                                );
        $this->render('blogvideo', array(
            'dataProvider' => $dataProvider,));
        
    }
    public function actionmedialibrary(){
        //echo 'ok'; exit();
        // $this ->Allsupport= Support::model()->getAllSupport();
        $this->layout = 'support';
        $dataProvider = new CActiveDataProvider('Support',array(    
                                                                    'pagination' => array('pageSize' =>8),
                                                                    'criteria'=>array(
                                                                    'condition'=>'categories=0',
                                                                    'order'=>'id DESC'),
                                                                )
                                                );
        $this->render('medialibrary', array(
            'dataProvider' => $dataProvider,));
    }
    public function actionBlogdetail($id){
        $data=Support::model()->findByPk($id);
        $this->layout='support';
        $this->render('blogdetail',array('data'=>$data));
        
       
        }
        
        public function actionTutorials(){
            $this->layout = 'support';
            $dataProvider = new CActiveDataProvider('Support',array(    
                                                                    'pagination' => array('pageSize' =>8),
                                                                    'criteria'=>array(
                                                                    'condition'=>'categories=2',
                                                                    'order'=>'id DESC'),
                                                                )
                                                );
        $this->render('tutorials', array(
            'dataProvider' => $dataProvider,));
        }
         public function actionTutorialdetail($id){
        $data=Support::model()->findByPk($id);
        
        $this->layout='support';
        $this->render('tutorialdetail',array('data'=>$data));
        
       
        }
    
    }
    ?>