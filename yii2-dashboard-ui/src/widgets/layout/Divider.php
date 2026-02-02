<?php

namespace iguazoft\ui\widgets\layout;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Divider extends BaseWidget
{
    public $text;
    
    public $type = 'horizontal';
    
    public $margin = 3;
    
    public function init()
    {
        parent::init();
        
        if ($this->type === 'vertical') {
            Html::addCssClass($this->options, 'vr');
        }
    }
    
    public function run()
    {
        if ($this->type === 'vertical') {
            return Html::tag('div', '', $this->options);
        }
        
        if ($this->text) {
            $marginClass = 'my-' . $this->margin;
            return Html::tag('div', 
                Html::tag('hr', '', $this->options) . 
                Html::tag('span', $this->text, ['class' => 'text-muted']) . 
                Html::tag('hr', ''),
                ['class' => 'd-flex align-items-center ' . $marginClass]
            );
        }
        
        $marginClass = 'my-' . $this->margin;
        Html::addCssClass($this->options, $marginClass);
        
        return Html::tag('hr', '', $this->options);
    }
}
