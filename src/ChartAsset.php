<?php

namespace iguazoft\ui;

use yii\web\AssetBundle;

/**
 * ChartAsset provides the Chart.js library as a Yii2 asset bundle.
 *
 * This bundle is automatically registered when using the Chart widget,
 * ensuring Chart.js is available in the page.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class ChartAsset extends AssetBundle
{
    /** @var string CDN base URL for Chart.js */
    public $sourcePath = null;

    public $js = [
        'https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js',
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
