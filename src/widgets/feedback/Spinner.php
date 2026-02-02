<?php

namespace iguazoft\ui\widgets\feedback;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Spinner extends BaseWidget
{
    public $type = 'border';
    
    public $size = 'md';
    
    public $color = 'primary';
    
    public $label = 'Loading...';
    
    public $showLabel = false;
    
    public function init()
    {
        parent::init();
        
        $spinnerClass = 'spinner-' . $this->type;
        Html::addCssClass($this->options, $spinnerClass);
        
        if ($this->color) {
            Html::addCssClass($this->options, 'text-' . $this->color);
        }
        
        if ($this->size === 'sm') {
            Html::addCssClass($this->options, $spinnerClass . '-sm');
        }
        
        $this->options['role'] = 'status';
    }
    
    public function run()
    {
        $label = Html::tag('span', $this->label, ['class' => 'visually-hidden']);
        
        if ($this->showLabel) {
            return Html::tag('div', 
                Html::tag('div', $label, $this->options) . ' ' . $this->label,
                ['class' => 'd-flex align-items-center']
            );
        }
        
        return Html::tag('div', $label, $this->options);
    }
}
