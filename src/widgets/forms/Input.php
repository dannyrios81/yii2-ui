<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Input extends BaseWidget
{
    public $model;
    
    public $attribute;
    
    public $name;
    
    public $value;
    
    public $type = 'text';
    
    public $label;
    
    public $placeholder;
    
    public $hint;
    
    public $error;
    
    public $required = false;
    
    public $disabled = false;
    
    public $readonly = false;
    
    public $size = 'md';
    
    public $prepend = null;
    
    public $append = null;
    
    public $labelOptions = [];
    
    public $inputOptions = [];
    
    public $containerOptions = [];
    
    public function init()
    {
        parent::init();
        
        if ($this->model !== null && $this->attribute !== null) {
            $this->name = Html::getInputName($this->model, $this->attribute);
            $this->value = Html::getAttributeValue($this->model, $this->attribute);
            
            if ($this->label === null) {
                $this->label = $this->model->getAttributeLabel($this->attribute);
            }
            
            if ($this->model->hasErrors($this->attribute)) {
                $this->error = $this->model->getFirstError($this->attribute);
            }
        }
        
        Html::addCssClass($this->containerOptions, 'mb-3');
        Html::addCssClass($this->labelOptions, 'form-label');
        Html::addCssClass($this->inputOptions, 'form-control');
        
        if ($this->size !== 'md') {
            Html::addCssClass($this->inputOptions, 'form-control-' . $this->size);
        }
        
        if ($this->error) {
            Html::addCssClass($this->inputOptions, 'is-invalid');
        }
        
        if ($this->required) {
            $this->inputOptions['required'] = true;
        }
        
        if ($this->disabled) {
            $this->inputOptions['disabled'] = true;
        }
        
        if ($this->readonly) {
            $this->inputOptions['readonly'] = true;
        }
        
        if ($this->placeholder) {
            $this->inputOptions['placeholder'] = $this->placeholder;
        }
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->containerOptions);
        
        if ($this->label !== null) {
            $labelText = $this->label;
            if ($this->required) {
                $labelText .= ' <span class="text-danger">*</span>';
            }
            $parts[] = Html::tag('label', $labelText, array_merge($this->labelOptions, [
                'for' => $this->inputOptions['id'] ?? null
            ]));
        }
        
        if ($this->prepend !== null || $this->append !== null) {
            $parts[] = Html::beginTag('div', ['class' => 'input-group']);
            
            if ($this->prepend !== null) {
                $parts[] = Html::tag('span', $this->prepend, ['class' => 'input-group-text']);
            }
        }
        
        $parts[] = Html::input($this->type, $this->name, $this->value, $this->inputOptions);
        
        if ($this->prepend !== null || $this->append !== null) {
            if ($this->append !== null) {
                $parts[] = Html::tag('span', $this->append, ['class' => 'input-group-text']);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        if ($this->hint) {
            $parts[] = Html::tag('div', $this->hint, ['class' => 'form-text']);
        }
        
        if ($this->error) {
            $parts[] = Html::tag('div', $this->error, ['class' => 'invalid-feedback d-block']);
        }
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
