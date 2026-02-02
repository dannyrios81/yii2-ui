<?php

namespace iguazoft\ui\widgets\feedback;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Toast extends BaseWidget
{
    public $title;
    
    public $message;
    
    public $type = 'info';
    
    public $icon;
    
    public $time;
    
    public $autohide = true;
    
    public $delay = 5000;
    
    public $closeButton = true;
    
    public $headerOptions = [];
    
    public $bodyOptions = [];
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'toast');
        $this->options['role'] = 'alert';
        $this->options['aria-live'] = 'assertive';
        $this->options['aria-atomic'] = 'true';
        
        if ($this->autohide) {
            $this->options['data-bs-autohide'] = 'true';
            $this->options['data-bs-delay'] = $this->delay;
        } else {
            $this->options['data-bs-autohide'] = 'false';
        }
        
        Html::addCssClass($this->headerOptions, 'toast-header');
        
        if ($this->type !== 'info') {
            Html::addCssClass($this->headerOptions, 'bg-' . $this->type . ' text-white');
        }
        
        Html::addCssClass($this->bodyOptions, 'toast-body');
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->options);
        
        if ($this->title !== null) {
            $parts[] = Html::beginTag('div', $this->headerOptions);
            
            if ($this->icon) {
                $parts[] = Html::tag('span', $this->icon, ['class' => 'me-2']);
            }
            
            $parts[] = Html::tag('strong', $this->title, ['class' => 'me-auto']);
            
            if ($this->time) {
                $parts[] = Html::tag('small', $this->time);
            }
            
            if ($this->closeButton) {
                $parts[] = Html::button('&times;', [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'toast',
                    'aria-label' => 'Close'
                ]);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = Html::tag('div', $this->message, $this->bodyOptions);
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
