<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

class Alert extends BaseWidget
{
    public $type = 'info';
    
    public $title = null;
    
    public $message;
    
    public $dismissible = true;
    
    public $icon = null;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, ['alert', 'alert-' . $this->type]);
        
        if ($this->dismissible) {
            Html::addCssClass($this->options, 'alert-dismissible fade show');
        }
    }
    
    public function run()
    {
        $parts = [];
        
        if ($this->icon !== null) {
            $parts[] = Html::tag('span', $this->icon, ['class' => 'me-2']);
        }
        
        if ($this->title !== null) {
            $parts[] = Html::tag('strong', $this->title . ' ');
        }
        
        $parts[] = $this->message;
        
        if ($this->dismissible) {
            $parts[] = Html::button('&times;', [
                'type' => 'button',
                'class' => 'btn-close',
                'data-bs-dismiss' => 'alert',
                'aria-label' => 'Close'
            ]);
        }
        
        return Html::tag('div', implode('', $parts), $this->options);
    }
}
