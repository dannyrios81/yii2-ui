<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;
use yii\helpers\Json;

class Chart extends BaseWidget
{
    public $type = 'line';
    
    public $data = [];
    
    public $chartOptions = [];
    
    public $height = '200px';
    
    public $width = '100%';
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'chart-container');
        $this->options['style'] = 'height: ' . $this->height . '; width: ' . $this->width;
    }
    
    public function run()
    {
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
        
        $js = "
        if (typeof Chart !== 'undefined') {
            new Chart(document.getElementById('{$id}-canvas'), " . Json::encode($chartConfig) . ");
        }
        ";
        
        $this->view->registerJs($js, \yii\web\View::POS_READY);
        
        return Html::tag('div', $canvas, $this->options);
    }
}
