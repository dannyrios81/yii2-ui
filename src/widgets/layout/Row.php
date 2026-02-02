<?php

namespace iguazoft\ui\widgets\layout;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Row extends BaseWidget
{
    public $content;
    
    public $gutters = true;
    
    public $align = null;
    
    public $justify = null;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'row');
        
        if (!$this->gutters) {
            Html::addCssClass($this->options, 'g-0');
        }
        
        if ($this->align) {
            Html::addCssClass($this->options, 'align-items-' . $this->align);
        }
        
        if ($this->justify) {
            Html::addCssClass($this->options, 'justify-content-' . $this->justify);
        }
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        if ($this->content !== null) {
            $content = $this->content;
        }
        
        return Html::tag('div', $content, $this->options);
    }
}
