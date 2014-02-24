<?php
return array(
    // This path may be different. You can probably get it from `config/main.php`.
    'basePath' => ROOT_PATH . 'protected/',
    'name'=>'Cron',
    
    'modules' => array(        
        'site' => array(
            'import' => array('site.components.*'),
            'layout' => 'main'
        ),
    ),
    'params' => array( 
    		'emailin' => 'info@tosello.tv',
    		'emailout' => 'info@tosello.tv',
            'site_url' => 'http://onecentdeal.toasternet-online.de/'
		 ),
    'preload'=>array('log'),
 
    'import'=>array(
        'application.components.*',
        'application.models.*',
    ),
    'defaultController' => 'site/cron/index', 
    // We'll log cron messages to the separate files
    'components'=>array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
            ),
        ),
        'email' => array(
                'class' => 'application.extensions.email.Email',
                'view' => 'email',
                'viewVars' => array(),
                //'layout' => '',
        ),
 
        // Your DB connection
        'db'=>array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=onecentdeal',
            'username' => 'onecentdeal',
            'password' => 'onecentdeal123',
            'charset' => 'UTF8',
            'tablePrefix' => '',
            'emulatePrepare' => true,
            'enableProfiling' => true,
            'schemaCacheID' => 'cache',
            'schemaCachingDuration' => 120
        ),
		'settings' => array(
				'class' => 'XSettings',
		),
    ),
);
