<?php

/**
 * Shop controller Home page
 */
class ShopController extends SiteBaseController
{

    const PAGE_SIZE = 16;

    public $membershop;
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
        return array('captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'minLength' => 3,
                'maxLength' => 7,
                'testLimit' => 3,
                'padding' => array_rand(range(2, 10)),
                ), );
    }

    /**
     * Index action
     */
    public function actionindex()
    {
        $sort = 'member_shop.id DESC';
        if (isset($_POST['sortshop']))
            Yii::app()->session['sortshop'] = $_POST['sortshop'];
        $sort = isset(Yii::app()->session['sortshop']) ? Yii::app()->session['sortshop'] :$sort;
        $allshop = MemberShop::model()->getAllShop($sort);
        $this->render('shop', array('allshop' => $allshop));
    }
    public function actionMessagesShop()
    {
        $this->layout = 'shop';
        $this->membershop = MemberShop::model()->getMemberShopById($_GET['shop_id']);
        $model = new messagesShop;
        if (isset($_POST['messagesShop'])) {
            $model->attributes = $_POST['messagesShop'];
            $model->receiver = $this->membershop->user_id;
            $model->sender = Yii::app()->user->id;
            $model->sent = date('Y-m-d H:i:s');
            $model->status_message = '0';
            $model->is_read = '0';
            if ($model->save())
                $this->redirect('messagesShop?shop_id=' . $this->membershop->id);
        }
        $this->render('messagesShop/create', array('model' => $model));
    }
    public function actionDetail($shop_id)
    {
        $this->layout = 'shop';
        $this->membershop = MemberShop::model()->getMemberShopById($shop_id);
        $this->pageTitle[] = $this->membershop->name . ' ' . Yii::t('global','Shop Detail');
        $sort = 'id DESC';
        if (isset($_POST['sort']))
            Yii::app()->session['sort'] = $_POST['sort'];
        $sort = isset(Yii::app()->session['sort']) ? Yii::app()->session['sort'] : $sort;
        $productshop = ProductsShop::model()->getAllProductShop($shop_id, $sort);
        $this->render('detail', compact('productshop'));
    }

    public function actionRatingShop()
    {
        $score = intval($_GET['score']);
        $shop_id = intval($_GET['id']);
        ShopRatings::model()->saveRatingShop($score, $shop_id);
        
    }

    public function actionCategory($shop_id, $category_id)
    {
        $this->layout = 'shop';
        $this->membershop = MemberShop::model()->getMemberShopById($shop_id);
        if (!$this->membershop->id)
            $this->redirect('/');
        $this->pageTitle[] = $this->membershop->name . ' ' . Yii::t('global','Category Shop');
        $sort = 'id DESC';
        if (isset($_POST['sort']))
            Yii::app()->session['sort'] = $_POST['sort'];
        $sort = isset(Yii::app()->session['sort']) ? Yii::app()->session['sort'] : $sort;
        $productcategotyshop = ProductsShop::model()->getProductShopByCategory($shop_id, $category_id, $sort);
        $this->render('category', compact('productcategotyshop'));
    }

    public function actionFindproduct($shop_id, $price)
    {
        $this->layout = 'shop';
        $this->membershop = MemberShop::model()->getMemberShopById($shop_id);
        if (!$this->membershop->id)
            $this->redirect('/');
        $this->pageTitle[] = $this->membershop->name . ' ' . Yii::t('global','Find Product By Price') . ' : ' . $price . ' €';
        $criteria = new CDbCriteria();
        $sort = 'id DESC';
        if (isset($_POST['sort']))
            Yii::app()->session['sort'] = $_POST['sort'];
        $sort = isset(Yii::app()->session['sort']) ? Yii::app()->session['sort'] : $sort;
        $criteria->order = $sort;
        $productshopbyprice = ProductsShop::model()->getProductShopByPrice($shop_id, $price, $sort);
        $this->render('findproduct', compact('productshopbyprice'));
    }

    public function actionStar($shop_id, $star)
    {
        $this->layout = 'shop';
        $sort = 'id DESC';
        if (isset($_POST['sort']))
            Yii::app()->session['sort'] = $_POST['sort'];
        $this->membershop = MemberShop::model()->getMemberShopById($shop_id);
        $sort = isset(Yii::app()->session['sort']) ? Yii::app()->session['sort'] : $sort;
        if (!$this->membershop->id)
            $this->redirect('/');
        $this->pageTitle[] = $this->membershop->name . ' ' . Yii::t('global', 'Find Product By Star');
        $productshopstar = ProductsShop::model()->getProductShopByStar($shop_id, $star, $sort);
        $this->render('star', compact('productshopstar'));
    }

    public function actionContact($shop_id)
    {
        $this->layout = 'shop';
        $this->membershop = MemberShop::model()->getMemberShopById($shop_id);
        $this->pageTitle[] = $this->membershop->name . ' ' . Yii::t('global', 'Contact Us');
        if (!$this->membershop->id)
            $this->redirect('/');
        $infomembershop = MemberShop::model()->getInforMembershop($shop_id);
        $this->render('contact', compact('infomembershop'));
    }
    public function actionAdd()
    {
        $shop_id = $_GET['shop_id'];
        $qty = $_GET['qty-pshop'];
        $id = intval($_GET['id']);
        $cart = isset(Yii::app()->session['cart_' . $shop_id]) ? Yii::app()->session['cart_' .$shop_id] : array();
        if ($id && ProductsShop::model()->findByPk($id)) {
            if (isset($cart[$id]['qty'])) {

                $cart[$id]['qty'] += $qty;
            } else {
                $cart[$id]['qty'] = $qty;
            }
            $cart[$id]['added'] = time();

            Yii::app()->session['cart_' . $shop_id] = $cart;
            $cart_all = isset(Yii::app()->session['cart']) ? Yii::app()->session['cart'] :
                array();
            $cart_all['name'] = isset($cart_all['name']) ? $cart_all['name'] : array();
            if (!in_array('cart_' . $shop_id, $cart_all['name'])) {
                $cart_all['name'][] = 'cart_' . $shop_id;
            }
            if (isset($cart_all['qty'])) {
                $cart_all['qty'] += $qty;
            } else {
                $cart_all['qty'] = $qty;
            }
            Yii::app()->session['cart'] = $cart_all;
        }
    }

    function actionRemove()
    {
        $cart = isset(Yii::app()->session['cart_shop']) ? Yii::app()->session['cart_shop'] :array();
        $id = intval($_GET['id']);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Yii::app()->session['cart_shop'] = $cart;
        }
    }
   	public function actionSearch($shop_id, $condition)
	{
	   $sort = 'id DESC';
       if (isset($_POST['sort']))
            Yii::app()->session['sort'] = $_POST['sort'];
       $sort = isset(Yii::app()->session['sort']) ? Yii::app()->session['sort'] : $sort;
       $this->membershop = MemberShop::model()->getMemberShopById($shop_id);
       if($shop_id != 0){
            $this->layout = 'shop';
            if($condition != ''){
                $product = ProductsShop::model()->getSearchProductShop($shop_id, $condition, $sort);
            }else{
                $product = ProductsShop::model()->getAllProductShop($shop_id, $sort);
            }
       }
	   $this->render('search', compact('product'));
	}
}
