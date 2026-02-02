<?php

namespace iguazoft\ui\widgets\advanced;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Offcanvas extends BaseWidget
{
    public $title;
    
    public $content;
    
    public $placement = 'start';
    
    public $backdrop = true;
    
    public $scroll = false;
    
    public $closeButton = true;
    
    public $headerOptions = [];
    
    public $bodyOptions = [];
    
    public function init()
    {
        parent::init();
        
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'offcanvas-' . uniqid();
        }
        
        Html::addCssClass($this->options, ['offcanvas', 'offcanvas-' . $this->placement]);
        
        $this->options['tabindex'] = '-1';
        
        if (!$this->backdrop) {
            $this->options['data-bs-backdrop'] = 'false';
        }
        
        if ($this->scroll) {
            $this->options['data-bs-scroll'] = 'true';
        }
        
        Html::addCssClass($this->headerOptions, 'offcanvas-header');
        Html::addCssClass($this->bodyOptions, 'offcanvas-body');
        
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
        
        if ($this->title !== null) {
            $parts[] = Html::beginTag('div', $this->headerOptions);
            $parts[] = Html::tag('h5', $this->title, ['class' => 'offcanvas-title']);
            
            if ($this->closeButton) {
                $parts[] = Html::button('&times;', [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'offcanvas',
                    'aria-label' => 'Close'
                ]);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = Html::tag('div', $content, $this->bodyOptions);
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
