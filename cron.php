<?php
if(function_exists("date_default_timezone_set") and
function_exists("date_default_timezone_get"))
@date_default_timezone_set(@date_default_timezone_get());


$_SERVER['SERVER_NAME'] = 'onecentdeal.toasternet-online.de'; 
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yiilite.php';
$config=dirname(__FILE__).'/protected/config/';
// Define root directory
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__FILE__) . '/');

define('IS_CRON', 1);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once($yii);
Yii::createWebApplication($config . 'cron.php')->run();
