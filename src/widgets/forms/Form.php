<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Form extends BaseWidget
{
    public $action;
    
    public $method = 'post';
    
    public $enctype;
    
    public $title;
    
    public $description;
    
    public $submitButton = true;
    
    public $submitLabel = 'Submit';
    
    public $resetButton = false;
    
    public $resetLabel = 'Reset';
    
    public $cancelButton = false;
    
    public $cancelLabel = 'Cancel';
    
    public $cancelUrl;
    
    public $inline = false;
    
    public $validated = false;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'dashboard-form');
        
        if ($this->validated) {
            Html::addCssClass($this->options, 'needs-validation');
            $this->options['novalidate'] = true;
        }
        
        if ($this->action) {
            $this->options['action'] = $this->action;
        }
        
        $this->options['method'] = $this->method;
        
        if ($this->enctype) {
            $this->options['enctype'] = $this->enctype;
        }
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        $parts = [];
        
        $parts[] = Html::beginTag('form', $this->options);
        
        if ($this->title || $this->description) {
            $parts[] = Html::beginTag('div', ['class' => 'mb-4']);
            
            if ($this->title) {
                $parts[] = Html::tag('h4', $this->title, ['class' => 'mb-2']);
            }
            
            if ($this->description) {
                $parts[] = Html::tag('p', $this->description, ['class' => 'text-muted']);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = $content;
        
        if ($this->submitButton || $this->resetButton || $this->cancelButton) {
            $parts[] = Html::beginTag('div', ['class' => 'mt-4 d-flex gap-2']);
            
            if ($this->submitButton) {
                $parts[] = Html::submitButton($this->submitLabel, [
                    'class' => 'btn btn-primary'
                ]);
            }
            
            if ($this->resetButton) {
                $parts[] = Html::resetButton($this->resetLabel, [
                    'class' => 'btn btn-outline-secondary'
                ]);
            }
            
            if ($this->cancelButton) {
                $parts[] = Html::a($this->cancelLabel, $this->cancelUrl ?? '#', [
                    'class' => 'btn btn-outline-secondary'
                ]);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = Html::endTag('form');
        
        return implode("\n", $parts);
    }
}
