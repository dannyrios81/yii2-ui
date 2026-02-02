<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

class Button extends BaseWidget
{
    public $label;
    
    public $url = '#';
    
    public $type = 'primary';
    
    public $size = 'md';
    
    public $icon = null;
    
    public $iconPosition = 'left';
    
    public $outline = false;
    
    public $rounded = true;
    
    public $block = false;
    
    public function init()
    {
        parent::init();
        
        $btnClass = 'btn';
        
        if ($this->outline) {
            $btnClass .= ' btn-outline-' . $this->type;
        } else {
            $btnClass .= ' btn-' . $this->type;
        }
        
        if ($this->size !== 'md') {
            $btnClass .= ' btn-' . $this->size;
        }
        
        if ($this->rounded) {
            $btnClass .= ' rounded-2';
        }
        
        if ($this->block) {
            $btnClass .= ' w-100';
        }
        
        Html::addCssClass($this->options, $btnClass);
    }
    
    public function run()
    {
        $content = '';
        
        if ($this->icon !== null && $this->iconPosition === 'left') {
            $content .= Html::tag('span', $this->icon, ['class' => 'me-2']);
        }
        
        $content .= $this->label;
        
        if ($this->icon !== null && $this->iconPosition === 'right') {
            $content .= Html::tag('span', $this->icon, ['class' => 'ms-2']);
        }
        
        return Html::a($content, $this->url, $this->options);
    }
}
