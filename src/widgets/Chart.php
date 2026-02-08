<?php

namespace iguazoft\ui\widgets;

use iguazoft\ui\ChartAsset;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Chart renders a Chart.js chart inside a canvas element.
 *
 * The Chart.js library is automatically registered via [[ChartAsset]].
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Chart extends BaseWidget
{
    /** @var string chart type (line, bar, pie, doughnut, radar, polarArea, bubble, scatter) */
    public $type = 'line';

    /** @var array Chart.js data configuration (labels, datasets) */
    public $data = [];

    /** @var array Chart.js options configuration */
    public $chartOptions = [];

    /** @var string CSS height of the chart container */
    public $height = '200px';

    /** @var string CSS width of the chart container */
    public $width = '100%';

    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'chart-container');
        $this->options['style'] = 'height: ' . $this->height . '; width: ' . $this->width;
    }

    public function run()
    {
        ChartAsset::register($this->view);

        $id = $this->options['id'] ?? 'chart-' . uniqid();
        $this->options['id'] = $id;

        $canvas = Html::tag('canvas', '', ['id' => $id . '-canvas']);

        $chartConfig = [
            'type' => $this->type,
            'data' => $this->data,
            'options' => array_merge([
                'responsive' => true,
                'maintainAspectRatio' => false,
            ], $this->chartOptions)
        ];

        $js = "new Chart(document.getElementById('{$id}-canvas'), " . Json::encode($chartConfig) . ");";

        $this->view->registerJs($js, \yii\web\View::POS_READY);

        return Html::tag('div', $canvas, $this->options);
    }
}
