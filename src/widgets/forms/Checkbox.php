<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Checkbox extends BaseWidget
{
    public $model;
    
    public $attribute;
    
    public $name;
    
    public $value = 1;
    
    public $checked = false;
    
    public $label;
    
    public $hint;
    
    public $error;
    
    public $disabled = false;
    
    public $inline = false;
    
    public $switch = false;
    
    public $labelOptions = [];
    
    public $inputOptions = [];
    
    public $containerOptions = [];
    
    public function init()
    {
        parent::init();
        
        if ($this->model !== null && $this->attribute !== null) {
            $this->name = Html::getInputName($this->model, $this->attribute);
            $this->checked = (bool)Html::getAttributeValue($this->model, $this->attribute);
            
            if ($this->label === null) {
                $this->label = $this->model->getAttributeLabel($this->attribute);
            }
            
            if ($this->model->hasErrors($this->attribute)) {
                $this->error = $this->model->getFirstError($this->attribute);
            }
        }
        
        $containerClass = $this->switch ? 'form-check form-switch' : 'form-check';
        if ($this->inline) {
            $containerClass .= ' form-check-inline';
        }
        Html::addCssClass($this->containerOptions, $containerClass);
        
        Html::addCssClass($this->inputOptions, 'form-check-input');
        Html::addCssClass($this->labelOptions, 'form-check-label');
        
        if ($this->error) {
            Html::addCssClass($this->inputOptions, 'is-invalid');
        }
        
        if ($this->disabled) {
            $this->inputOptions['disabled'] = true;
        }
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->containerOptions);
        
        $parts[] = Html::checkbox($this->name, $this->checked, array_merge($this->inputOptions, [
            'value' => $this->value,
            'label' => null
        ]));
        
        if ($this->label !== null) {
            $parts[] = Html::tag('label', $this->label, $this->labelOptions);
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
