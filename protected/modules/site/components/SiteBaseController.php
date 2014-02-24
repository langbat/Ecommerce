<?php
/**
 * Site base controller class
 */
class SiteBaseController extends BaseController {
    /**
     * Javascript URL
     *
     * @var string
     */
    public $jsUrl = '';

    /**
     * Class constructor
     *
     */
    /*public  function beforeAction($action)
    {
        $controller = Yii::app()->controller->id;
        $action = $action->id;
        $allow = array(
            'index'=>array('wait'),
            'users'=>array('login','admin'),
        );

        $time = time()-strtotime('2013-12-12 12:12:00');
        if($time < 0){
            if(!isset(Yii::app()->user->role) || Yii::app()->user->role !='admin' ){
                if(!$this->checkAllowAction($controller,$action,$allow)){
                    $this->redirect('/index/wait');
                }
            }
        }

        return parent::beforeAction($action);
    }
     public function checkAllowAction($controller,$action,$allow=array()){
        if(isset($allow[$controller]) && isset($allow)){
            if($allow[$controller] == '*'){
                return true;
            } else if(in_array($action,$allow[$controller])){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }*/
    public function init() {

            $app = Yii::app();
            if (isset($_GET['lang'])) {
                $app->session['lang'] = $_GET['lang'];
            }
            if (isset($app->session['lang'])) {
                $app->language = $app->session['lang'];
            }

            // Add Js
            $this->jsUrl = Yii::app()->theme->baseUrl . '/scripts';

            // Add default page title which is the application name
            $this->pageTitle[] = Yii::t('global', Yii::app()->name);

            // By default we register the robots to 'all'
            // we wil override this when we need to
            Yii::app()->clientScript->registerMetaTag( 'all', 'robots' );

            // We add a meta 'language' tag based on the currently viewed language
            Yii::app()->clientScript->registerMetaTag( Yii::app()->language, 'language', 'content-language' );

            Yii::app()->counter->refresh();

            Visitors::run();

            /* Run init */
            parent::init();

    }


	/**
	 * @return array - List of filters
	 */
	public function filters()
	{
		return array(
					array(
						'application.filters.YXssFilter',
						'clean' => 'none',
						'tags' => 'soft',
						'actions' => 'all'
						)
					);
	}
}