<?php
/**
 * Index controller Home page
 */
class IndexController extends AdminBaseController {
	/**
	 * init
	 */
	public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('adminglobal', 'Dashboard') ] = array('index/index');
		$this->pageTitle[] = Yii::t('adminglobal', 'Dashboard'); 
	}
	/**
	 * Index action
	 */
    public function actionIndex() {
        
        $newest_members = Members::model()->findAll(array(
            'condition' => "role = '".Members::ROLE_USER."'",
            'order' => 'joined DESC', 'limit' => 20
        ));
        $this->render('index', compact('newest_members'));
    }
}