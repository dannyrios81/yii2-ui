<?php

namespace iguazoft\ui\widgets\feedback;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Modal extends BaseWidget
{
    public $title;
    
    public $content;
    
    public $footer;
    
    public $size = 'md';
    
    public $centered = false;
    
    public $scrollable = false;
    
    public $fullscreen = false;
    
    public $closeButton = true;
    
    public $backdrop = true;
    
    public $keyboard = true;
    
    public $headerOptions = [];
    
    public $bodyOptions = [];
    
    public $footerOptions = [];
    
    public $dialogOptions = [];
    
    public function init()
    {
        parent::init();
        
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'modal-' . uniqid();
        }
        
        Html::addCssClass($this->options, 'modal fade');
        $this->options['tabindex'] = '-1';
        $this->options['aria-hidden'] = 'true';
        
        if (!$this->backdrop) {
            $this->options['data-bs-backdrop'] = 'static';
        }
        
        if (!$this->keyboard) {
            $this->options['data-bs-keyboard'] = 'false';
        }
        
        Html::addCssClass($this->dialogOptions, 'modal-dialog');
        
        if ($this->size !== 'md') {
            Html::addCssClass($this->dialogOptions, 'modal-' . $this->size);
        }
        
        if ($this->centered) {
            Html::addCssClass($this->dialogOptions, 'modal-dialog-centered');
        }
        
        if ($this->scrollable) {
            Html::addCssClass($this->dialogOptions, 'modal-dialog-scrollable');
        }
        
        if ($this->fullscreen) {
            Html::addCssClass($this->dialogOptions, 'modal-fullscreen');
        }
        
        Html::addCssClass($this->headerOptions, 'modal-header');
        Html::addCssClass($this->bodyOptions, 'modal-body');
        Html::addCssClass($this->footerOptions, 'modal-footer');
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        if ($this->content !== null) {
            $content = $this->content;
        }
        
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->options);
        $parts[] = Html::beginTag('div', $this->dialogOptions);
        $parts[] = Html::beginTag('div', ['class' => 'modal-content']);
        
        if ($this->title !== null) {
            $parts[] = Html::beginTag('div', $this->headerOptions);
            $parts[] = Html::tag('h5', $this->title, ['class' => 'modal-title']);
            
            if ($this->closeButton) {
                $parts[] = Html::button('&times;', [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'modal',
                    'aria-label' => 'Close'
                ]);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = Html::tag('div', $content, $this->bodyOptions);
        
        if ($this->footer !== null) {
            $parts[] = Html::tag('div', $this->footer, $this->footerOptions);
        }
        
        $parts[] = Html::endTag('div');
        $parts[] = Html::endTag('div');
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
