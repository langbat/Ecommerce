<?php

class MessagesShopManagerController extends SiteBaseController
{
    public $ismemberShop;

    public function init()
    {
        parent::init();

        $this->breadcrumbs[Yii::t('global', 'Messages Shops')] = array('messagesShopManager/index');
        $this->pageTitle[] = Yii::t('global', 'Messages Shops');
        $this->ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id' =>
                Yii::app()->user->id));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        //$ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));

        $message = messagesShop::model()->findByPk($id);
        //var_dump($message->is_read);exit();&& Yii::app()->user->id!==$message->sender
        if ($message->sender !== Yii::app()->user->id) {
            $connection = yii::app()->db;
            $sql = "UPDATE messages_shop SET is_read = 1 WHERE id=" . $id;
            $command = $connection->createCommand($sql);
            $command->execute();
        }
        if (!empty($this->ismemberShop)) {
            $this->layout = 'admin_shop';
        } else {
            $this->layout = 'main';
        }
        $this->render('view', array('model' => $this->loadModel($id), ));

    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id)
    {
        // $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
        $model = new messagesShop;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['messagesShop'])) {

            $model->attributes = $_POST['MessagesShop'];
            $model->receiver = $id;
            $model->sender = Yii::app()->user->id;
            $model->sent = date('Y-m-d H:i:s');
            $model->status_message = '1';
            $model->is_read = '0';
            //var_dump($model);
            // exit();
            if ($model->save())
                $this->redirect(array('index', 'id' => $model->id));
        }
        if (!empty($this->ismemberShop)) {
            $this->layout = 'admin_shop';
        } else {
            $this->layout = 'main';
        }
        $this->render('create', array('model' => $model, ));

    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        // $ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['messagesShop'])) {
            $model->attributes = $_POST['messagesShop'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
        if (!empty($this->ismemberShop)) {
            $this->layout = 'admin_shop';
        } else {
            $this->layout = 'main';
        }
        $this->render('update', array('model' => $model, ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        //$ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
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

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        //$ismemberShop = MemberShop::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
        $model = new messagesShop('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['id'])) {
            $_GET['id'] == '1' ? $dataprovider = new CActiveDataProvider($model, array('criteria' =>
                    array(
                    'condition' => 'sender=:sender',
                    'params' => array('sender' => Yii::app()->user->id),
                    'order' => 'id DESC',
                    ), )) : $dataprovider = new CActiveDataProvider($model, array('criteria' =>
                    array(
                    'condition' => 'receiver=:receiver',
                    'params' => array('receiver' => Yii::app()->user->id),
                    'order' => 'id DESC',
                    ), ));

        } else {
            $dataprovider = new CActiveDataProvider($model, array('criteria' => array(
                    'order' => 'id DESC',
                    'condition' => 'receiver=:receiver',
                    'params' => array('receiver' => Yii::app()->user->id),
                    ), ));


        }

        if (!empty($this->ismemberShop)) {
            $this->layout = 'admin_shop';
        } else {
            $this->layout = 'main';
        }
        $this->render('index', array('dataprovider' => $dataprovider, 'model' => $model));

    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $dataProvider = new CActiveDataProvider('messagesShop');
        $this->render('admin', array('dataProvider' => $dataProvider, ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = messagesShop::model()->findByPk((int)$id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'messages-shop-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
