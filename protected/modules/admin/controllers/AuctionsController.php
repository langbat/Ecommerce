<?php

class AuctionsController extends AdminBaseController {
    public function init()
    {
        parent::init();

        $this->breadcrumbs[ Yii::t('global', 'Auctions') ] = array('auctions/index');
        $this->pageTitle[] = Yii::t('global', 'Auctions');
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Auctions;
        $model->type = $_GET['type'];
        if (isset($_GET['product_id']))
            $model->product_id = $_GET['product_id'];

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Auctions']))
        {

            $model->attributes=$_POST['Auctions'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Auctions']))
        {
            $model->attributes=$_POST['Auctions'];

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        $this->render('update',array(
            'model'=>$model,
        ));
    }
    
    public function actionRestart($id)    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Auctions']))
        {
            $model = new Auctions;
            $model->attributes=$_POST['Auctions'];

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        $model->start_time = '';
        $model->end_time = '';
        $model->bid_quote = null;
        
        $this->render('restart',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
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

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model=new Auctions('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Auctions']))
            $model->attributes=$_GET['Auctions'];

        $model->type = Auctions::TYPE_LOWPRICE;
        $this->render('index',array(
            'model'=>$model,
        ));
    }

    public function actionBasic()
    {
        $this->breadcrumbs[ Yii::t('global', 'Auctions') ] = array('auctions/basic');
        $this->pageTitle[] = Yii::t('global', 'Basic Auctions');
        $model=new Auctions('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Auctions']))
            $model->attributes=$_GET['Auctions'];

        $model->type = Auctions::TYPE_BASIC;
        $this->render('basic',array(
            'model'=>$model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $dataProvider=new CActiveDataProvider('Auctions');
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
        $model=Auctions::model()->findByPk((int)$id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='auctions-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function actionVoted()
    {
        $model=new Auctions('search');
        $model->unsetAttributes();
        if(isset($_GET['Auctions']))
            $model->attributes=$_GET['Auctions'];
        $this->render('auction-votes',array('model'=>$model));
    }
    
    public function actionAnalyseAll()
    {
        $model=new Auctions('search');
        $model->unsetAttributes();
        if(isset($_GET['Auctions']))
            $model->attributes=$_GET['Auctions'];
        $this->render('analyse-all',array('model'=>$model));
    }
    
    public function actionAnalyseRank()
    {
        $model=new Auctions('search');
        $model->unsetAttributes();
        if(isset($_GET['Auctions']))
            $model->attributes=$_GET['Auctions'];
        $this->render('analyse-rank',array('model'=>$model));
    }
    
    public function actionevaluation()
    {
        $model=new Auctions();
        $this->render('evaluation',array('model'=>$model));
    }
    
    public function actionviewAnalyseAll( $id )
    {
        $auction        = Auctions::model()->findByPk( $id );
        if (!$auction->id)
            $this->redirect('/admin/auctions/analyseall');
        $bids  = new Bids();
        $this->render('view-analyse-all',array(
            'bids'=>$bids,'id'=>$id,
        ));
    }
    
    public function actionviewAnalyseRank( $id )
    {
        $auction        = Auctions::model()->findByPk( $id );
        if (!$auction->id)
            $this->redirect('/admin/auctions/analyserank');
        $bids  = new Bids();
        $this->render('view-analyse-rank',array(
            'bids'=>$bids,'id'=>$id,
        ));
    }

}
