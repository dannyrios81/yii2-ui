<?php

namespace iguazoft\ui\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

abstract class BaseWidget extends Widget
{
    public $options = [];
    
    public $containerOptions = [];
    
    protected function initDefaultOptions()
    {
        Html::addCssClass($this->options, 'dashboard-widget');
    }
    
    protected function renderContainer($content)
    {
        return Html::tag('div', $content, $this->containerOptions);
    }
}
