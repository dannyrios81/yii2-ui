<?php

namespace iguazoft\ui\widgets\feedback;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Progress extends BaseWidget
{
    public $value = 0;
    
    public $max = 100;
    
    public $label;
    
    public $showLabel = false;
    
    public $type = 'primary';
    
    public $striped = false;
    
    public $animated = false;
    
    public $height;
    
    public $barOptions = [];
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'progress');
        
        if ($this->height) {
            $this->options['style'] = 'height: ' . $this->height;
        }
        
        Html::addCssClass($this->barOptions, 'progress-bar');
        
        if ($this->type) {
            Html::addCssClass($this->barOptions, 'bg-' . $this->type);
        }
        
        if ($this->striped) {
            Html::addCssClass($this->barOptions, 'progress-bar-striped');
        }
        
        if ($this->animated) {
            Html::addCssClass($this->barOptions, 'progress-bar-animated');
        }
        
        $this->barOptions['role'] = 'progressbar';
        $this->barOptions['aria-valuenow'] = $this->value;
        $this->barOptions['aria-valuemin'] = '0';
        $this->barOptions['aria-valuemax'] = $this->max;
        $this->barOptions['style'] = 'width: ' . ($this->value / $this->max * 100) . '%';
    }
    
    public function run()
    {
        $label = '';
        
        if ($this->showLabel) {
            $label = $this->label ?? ($this->value . '%');
        }
        
        $bar = Html::tag('div', $label, $this->barOptions);
        
        return Html::tag('div', $bar, $this->options);
    }
}
