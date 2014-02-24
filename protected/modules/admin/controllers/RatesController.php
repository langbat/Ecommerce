<?php
/**
 * Rates controller Home page
 */
class RatesController extends AdminBaseController {
	
	/**
	 * init
	 */
	public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('adminplans', 'Commission Rates') ] = array('rates/index');
		$this->pageTitle[] = Yii::t('adminplans', 'Commission Rates'); 
	}
	/**
	 * Index action
	 */
    public function actionIndex()
	{
        if( isset($_POST['rates']) && is_array($_POST['rates']) )
		{
			foreach($_POST['rates'] as $key=>$value)
			{
				$key = intval($key);
				$value = round(floatval($value), 2);
				if( $key > 0 && $value > 0 ) Rates::model()->updateByPk($key, array('rate'=>$value));
			}
			
			Yii::app()->user->setFlash('success', Yii::t('adminmembers', 'Updated.'));
			$this->redirect(array('rates/index'));
		}
		
		$rates = Rates::model()->findAll();
		
        $this->render('index', array( 'rates' => $rates ) );
    }

}