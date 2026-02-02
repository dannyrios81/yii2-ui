<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Select extends BaseWidget
{
    public $model;
    
    public $attribute;
    
    public $name;
    
    public $value;
    
    public $items = [];
    
    public $label;
    
    public $prompt;
    
    public $hint;
    
    public $error;
    
    public $required = false;
    
    public $disabled = false;
    
    public $multiple = false;
    
    public $size = 'md';
    
    public $labelOptions = [];
    
    public $selectOptions = [];
    
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
        Html::addCssClass($this->selectOptions, 'form-select');
        
        if ($this->size !== 'md') {
            Html::addCssClass($this->selectOptions, 'form-select-' . $this->size);
        }
        
        if ($this->error) {
            Html::addCssClass($this->selectOptions, 'is-invalid');
        }
        
        if ($this->required) {
            $this->selectOptions['required'] = true;
        }
        
        if ($this->disabled) {
            $this->selectOptions['disabled'] = true;
        }
        
        if ($this->multiple) {
            $this->selectOptions['multiple'] = true;
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
            $parts[] = Html::tag('label', $labelText, $this->labelOptions);
        }
        
        $parts[] = Html::dropDownList(
            $this->name,
            $this->value,
            $this->items,
            array_merge($this->selectOptions, [
                'prompt' => $this->prompt
            ])
        );
        
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
