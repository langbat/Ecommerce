<?php

class OrdersController extends SiteBaseController
{
    public function init()
    {
        parent::init();

        $this->breadcrumbs[Yii::t('global', 'Orders')] = array('orders/index');
        $this->pageTitle[] = Yii::t('global', 'Orders');
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->layout = 'admin_shop';
        $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
        if ($checkuser == false) {
            $this->redirect(Yii::app()->homeUrl);
        } else {
            $checkorder = Orders::model()->checkCustomer($checkuser->id, $id);
            if ($checkorder == false) {
                $this->redirect(Yii::app()->homeUrl);
            } else {
                $this->render('view', array('model' => $this->loadModel($id), ));
            }
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * public function actionCreate()
     * {
     * if(Yii::app()->user->isGuest)
     * $this->redirect(Yii::app()->homeUrl.'shopManager/detail');
     * else {
     * $model=new Orders;

     * // Uncomment the following line if AJAX validation is needed
     * // $this->performAjaxValidation($model);

     * if(isset($_POST['Orders']))
     * {
     * $model->attributes=$_POST['Orders'];
     * if($model->save())
     * $this->layout='admin_shop';
     * $this->redirect(array('view','id'=>$model->id));
     * }
     * $this->layout='admin_shop';
     * $this->render('create',array(
     * 'model'=>$model,
     * ));
     * }
     * 
     * }

     * /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {

        $this->layout = 'admin_shop';
        $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
        if ($checkuser == false) {
            $this->redirect(Yii::app()->homeUrl);
        } else {
            $checkorder = Orders::model()->checkCustomer($checkuser->id, $id);
            if ($checkorder == false) {
                $this->redirect(Yii::app()->homeUrl);
            } else {
                $model = $this->loadModel($id);

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if (isset($_POST['Orders'])) {
                    $model->attributes = $_POST['Orders'];
                    $model->created = $_POST['Orders']['created'];
                    $model->remaining_date = $_POST['Orders']['remaining_date'];
                    if ($model->save())
                        $item = new OrderProcess;
                    $item->order_id = $model->id;
                    $item->status = $model->status;
                    $item->save();
                    $this->layout = 'admin_shop';
                    $this->redirect(array('view', 'id' => $model->id));
                }
                $this->layout = 'admin_shop';
                $this->render('update', array('model' => $model, ));
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
        if ($checkuser == false) {
            $this->redirect(Yii::app()->homeUrl);
        } else {
            $checkcustomer = Orders::model()->checkCustomer($checkuser->id, $id);
            if ($checkcustomer == false) {
                $this->redirect(Yii::app()->homeUrl);
            } else {
                if (Yii::app()->request->isPostRequest) {
                    // we only allow deletion via POST request
                    $this->loadModel($id)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                } else
                    throw new CHttpException(400,
                        'Invalid request. Please do not repeat this request again.');
            }
        }
    }

    /**
     * Lists all models.
     * 
     * <<<<<<< .mine
     * //public function actionIndex()
     * //	{
     * //	  
     * //          $this->redirect(Yii::app()->homeUrl.'shopManager/detail');
     * //       
     * //	}
     * =======
     * public function actionIndex()
     * {
     * if(Yii::app()->user->isGuest)
     * $this->redirect(Yii::app()->homeUrl.'shopManager/detail');
     * else {
     * $this->layout = 'admin_shop';
     * $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
     * if($checkuser == false){
     * $this->redirect(Yii::app()->homeUrl);
     * }else{
     * $model=new Orders('search');
     * $model->shop_id = $checkuser[0]['id'];
     * $model->unsetAttributes();  // clear any default values
     * if(isset($_GET['Orders']))
     * $model->attributes=$_GET['Orders'];
     * 
     * $this->render('index',array(
     * 'model'=>$model,
     * ));
     * }
     * }
     * 
     * }
     * >>>>>>> .r962
     */
    public function actionOrderShop()
    {
        if (Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->homeUrl . 'shopManager/detail');
        else {
            $this->layout = 'admin_shop';
            $model = new Orders('search');
            $model->unsetAttributes(); // clear any default values
            if (isset($_GET['Orders']))
                $model->attributes = $_GET['Orders'];

            $this->render('order_shop', array('model' => $model, ));
        }

    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $dataProvider = new CActiveDataProvider('Orders');
        $this->render('admin', array('dataProvider' => $dataProvider, ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Orders::model()->findByPk((int)$id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orders-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function actionCustomerShop()
    {
        if (Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->homeUrl . 'shopManager/detail');
        else {
            $model = Orders::model()->getOrderShop();
            if (isset($_GET['Orders']))
                $model->attributes = $_GET['Orders'];
            $this->layout = 'admin_shop';
            $this->render('customerShop', array('model' => $model, ));
        }
    }
    public function actionCustomer($shop_id)
    {
        if (Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->homeUrl . 'shopManager/detail');
        else {
            $this->layout = 'admin_shop';
            $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
            if ($checkuser == false) {
                $this->redirect(Yii::app()->homeUrl);
            } else {
                if ($shop_id == $checkuser->id) {
                    $model = new Orders('search');
                    $model->unsetAttributes(); //clear any default values
                    $model->shop_id = $checkuser->id;
                    if (isset($_GET['Orders']))
                        $model->attributes = $_GET['Orders'];
                    $this->render('customer', array('model' => $model, ));
                } else {
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
        }
    }
    public function actionUp_customer($id)
    {
        if (Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->homeUrl . 'shopManager/detail');
        else {
            $this->layout = 'admin_shop';
            $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
            if ($checkuser == false) {
                $this->redirect(Yii::app()->homeUrl);
            } else {
                $checkcustomer = Orders::model()->checkCustomer($checkuser->id, $id);
                if ($checkcustomer == false) {
                    $this->redirect(Yii::app()->homeUrl);
                } else {
                    $model = $this->loadModel($id); //
                    if (isset($_POST['Orders'])) {
                        Yii::app()->db->createCommand("UPDATE members SET email =:email WHERE id=:id")->
                            bindValues(array(':email' => $_POST['Orders']['email'], ':id' => $_POST['Orders']['user_id']))->
                            execute();
                        $model->attributes = $_POST['Orders'];
                        if ($model->save())
                            $this->redirect(array('vi_customer', 'id' => $model->id));
                    }
                    $this->render('up_customer', array('model' => $this->loadModel($id), ));
                }
            }
        }
    }
    public function actionVi_customer($id)
    {

        $this->layout = 'admin_shop';
        $checkuser = MemberShop::model()->checkUser(Yii::app()->user->id);
        if ($checkuser == false) {
            $this->redirect(Yii::app()->homeUrl);
        } else {
            $checkcustomer = Orders::model()->checkCustomer($checkuser->id, $id);
            if ($checkcustomer == false) {
                $this->redirect(Yii::app()->homeUrl);
            } else {
                $this->render('vi_customer', array('model' => $this->loadModel($id), ));
            }
        }
    }

}
