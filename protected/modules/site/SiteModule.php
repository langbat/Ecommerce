<?php
/**
 * Site module class
 */
class SiteModule extends MasterModule {
    /**
     * Module constructor - Builds the initial module data
     *
     * @author vadim
     */
    public function init() {


            if (!Yii::app()->request->isAjaxRequest)
                Yii::app()->session['lastest_visit'] = time();

           if (!defined('IS_CRON')){
               // Set theme url
                Yii::app()->themeManager->setBaseUrl( Yii::app()->theme->baseUrl );
                Yii::app()->themeManager->setBasePath( Yii::app()->theme->basePath );

                /* Make sure we run the master module init function */
                parent::init();
                Yii::app()->session['my_balance'] = Members::getBalance();
           }
		  
    }
}