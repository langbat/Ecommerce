<?php
if(function_exists("date_default_timezone_set") and
function_exists("date_default_timezone_get"))
@date_default_timezone_set(@date_default_timezone_get());
session_start();

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yiilite.php';
$config=dirname(__FILE__).'/protected/config/';



// Define root directory
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__FILE__) . '/');

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

$configFile = YII_DEBUG ? 'staging.php' : 'production.php';

require_once($yii);
Yii::createWebApplication($config . $configFile)->run();
