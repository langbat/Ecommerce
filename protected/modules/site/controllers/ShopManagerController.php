<?php

class ShopManagerController extends SiteBaseController
{
    public $ismemberShop;

    public function actionIndex()
    {
        // $arrmenberShop= MemberShop::model()->getMemberShop();
        //$dataProvider = new CActiveDataProvider('Shop Manager');

        if (Yii::app()->user->isGuest)
            $this->redirect('shopManager/detail');
        else {
            $membershop = MemberShop::model()->getMemberShopByIdMemberShop(Yii::app()->user->id);
            $this->redirect('shopManager/detail', compact('membershop'));
        }
    }


    /**
     * Shop controller Home page
     */


    const PAGE_SIZE = 16;

    public $member;
    public $err;
    /**
     * Controller constructor
     */
    public function init()
    {
        $this->ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id' =>Yii::app()->user->id));
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


    public function actionDetail()
    {   
        $this->layout = 'admin_shop';
        $model = new LoginForm;
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate()) {
                // Login
                $identity = new InternalIdentity($model->email, $model->password);
                if ($identity->authenticate()) {
                    // Member authenticated, Login
                    Yii::app()->user->setFlash('success', Yii::t('login','Thanks. You are now logged in.'));
                    Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24));
                }
                $user = Members::model()->findByAttributes(array('username' => $model->email));
                $user = !empty($user) ? $user : Members::model()->findByAttributes(array('email' =>$model->email));
                $membershop = MemberShop::model()->getMemberShopByIdMember(Yii::app()->user->id);
                $totalorder = Orders::model()->findAllByAttributes(array('shop_id' => $membershop->id));
                $totalrating = ShopRatings::model()->totalShopRating($membershop->id);
                $totalcustomer = Orders::model()->totalCustomerShop($membershop->id);
                $totalproducts = ProductsShop::model()->getTotalProductsShop($membershop->id);
                $this->render('detail', compact('membershop', 'totalorder', 'totalrating',
                    'totalcustomer', 'notify', 'totalproducts'));
            } else {
                $this->err = Yii::t('global', $model->errors);
                $this->render('login');
            }
        } else {

            if (Yii::app()->user->isGuest)
                $this->render('login');
            else
                if (empty($this->ismemberShop)) {
                    $this->redirect('/memberShop/create');
                } else {
                    $membershop = MemberShop::model()->getMemberShopByIdMember(Yii::app()->user->id);
                    $totalorder = Orders::model()->findAllByAttributes(array('shop_id' => $membershop->id));
                    $totalrating = ShopRatings::model()->totalShopRating($membershop->id);
                    $totalcustomer = Orders::model()->totalCustomerShop($membershop->id);
                    $notify = CustomPages::model()->getNotification();
                    $totalproducts = ProductsShop::model()->getTotalProductsShop($membershop->id);
                    $this->render('detail', compact('membershop', 'totalorder', 'totalrating',
                        'totalcustomer', 'notify', 'totalproducts'));
                }
        }
    }
}
