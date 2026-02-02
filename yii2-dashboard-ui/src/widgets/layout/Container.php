<?php

namespace iguazoft\ui\widgets\layout;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Container extends BaseWidget
{
    public $fluid = false;
    
    public $content;
    
    public function init()
    {
        parent::init();
        
        $class = $this->fluid ? 'container-fluid' : 'container';
        Html::addCssClass($this->options, $class);
        
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
