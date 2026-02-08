<?php

// Ensure we get report on all possible php errors
error_reporting(-1);

define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);
$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@iguazoft/ui', __DIR__ . '/../src');
Yii::setAlias('@tests', __DIR__);

new \yii\web\Application([
    'id' => 'test-app',
    'basePath' => __DIR__,
    'vendorPath' => dirname(__DIR__) . '/vendor',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'test-key',
            'scriptFile' => __FILE__,
            'scriptUrl' => '/',
        ],
        'assetManager' => [
            'basePath' => sys_get_temp_dir(),
            'baseUrl' => '/',
        ],
    ],
]);
