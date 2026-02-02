<?php

namespace iguazoft\ui;

use yii\web\AssetBundle;

class DashboardAsset extends AssetBundle
{
    public $sourcePath = '@iguazoft/ui/assets';
    
    public $css = [
        'css/dashboard.css',
    ];
    
    public $js = [
        'js/dashboard.js',
    ];
    
    public $depends = [
        'yii\bootstrap5\BootstrapAsset',
        'yii\bootstrap5\BootstrapPluginAsset',
    ];
}
