<?php
/**
 * Admin base controller class
 */
class AdminBaseController extends BaseController {
	
	/**
	 * admins breadcrumbs
	 */
	public $breadcrumbs = array();
	
    /**
     * Class constructor
     *
     */
    public function init() {		
        $app = Yii::app();
        if (isset($_GET['lang'])) {
            $app->session['lang'] = $_GET['lang'];
        }
        if (isset($app->session['lang'])) {
                $app->language = $app->session['lang'];
        }
	
		// Add default page title which is the application name
        $this->pageTitle[] = Yii::t('global', Yii::app()->name);
		$this->pageTitle[] = Yii::t('global', 'Admin');
		
		// By default we register the robots to 'none'
        Yii::app()->clientScript->registerMetaTag( 'noindex, nofollow', 'robots' );

		// We add a meta 'language' tag based on the currently viewed language
		Yii::app()->clientScript->registerMetaTag( Yii::app()->language, 'language', 'content-language' );
		
		// Make sure we have access
		if(Yii::app()->user->isGuest)
		{
			$this->redirect('/admin-login');
		}
		elseif( ( Yii::app()->user->role != 'admin' || !Yii::app()->user->checkAccess('op_acp_access') ) )
		{
			Yii::app()->user->setFlash('error', Yii::t('global', 'Sorry, You are not allowed to enter the admin section.'));
			$this->redirect(Yii::app()->homeUrl);
		}
		
        Yii::app()->counter->refresh();
        
		/* Run init */
        parent::init();
    }
}