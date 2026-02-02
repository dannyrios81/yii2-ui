<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

class Badge extends BaseWidget
{
    public $label;
    
    public $type = 'primary';
    
    public $pill = false;
    
    public $outline = false;
    
    public function init()
    {
        parent::init();
        
        $badgeClass = 'badge';
        
        if ($this->outline) {
            $badgeClass .= ' border border-' . $this->type . ' text-' . $this->type;
        } else {
            $badgeClass .= ' bg-' . $this->type;
        }
        
        if ($this->pill) {
            $badgeClass .= ' rounded-pill';
        }
        
        Html::addCssClass($this->options, $badgeClass);
    }
    
    public function run()
    {
        return Html::tag('span', $this->label, $this->options);
    }
}
