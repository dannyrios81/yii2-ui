<?php

namespace iguazoft\ui\widgets\layout;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Col extends BaseWidget
{
    public $content;
    
    public $xs;
    
    public $sm;
    
    public $md;
    
    public $lg;
    
    public $xl;
    
    public $xxl;
    
    public $offset;
    
    public $order;
    
    public function init()
    {
        parent::init();
        
        $classes = [];
        
        if ($this->xs) $classes[] = 'col-' . $this->xs;
        if ($this->sm) $classes[] = 'col-sm-' . $this->sm;
        if ($this->md) $classes[] = 'col-md-' . $this->md;
        if ($this->lg) $classes[] = 'col-lg-' . $this->lg;
        if ($this->xl) $classes[] = 'col-xl-' . $this->xl;
        if ($this->xxl) $classes[] = 'col-xxl-' . $this->xxl;
        
        if (empty($classes)) {
            $classes[] = 'col';
        }
        
        if ($this->offset) {
            $classes[] = 'offset-' . $this->offset;
        }
        
        if ($this->order) {
            $classes[] = 'order-' . $this->order;
        }
        
        Html::addCssClass($this->options, $classes);
        
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
