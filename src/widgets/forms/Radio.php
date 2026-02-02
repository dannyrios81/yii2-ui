<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Radio extends BaseWidget
{
    public $model;
    
    public $attribute;
    
    public $name;
    
    public $value;
    
    public $items = [];
    
    public $label;
    
    public $hint;
    
    public $error;
    
    public $disabled = false;
    
    public $inline = false;
    
    public $labelOptions = [];
    
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
        Html::addCssClass($this->labelOptions, 'form-label d-block');
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->containerOptions);
        
        if ($this->label !== null) {
            $parts[] = Html::tag('label', $this->label, $this->labelOptions);
        }
        
        foreach ($this->items as $itemValue => $itemLabel) {
            $radioClass = 'form-check';
            if ($this->inline) {
                $radioClass .= ' form-check-inline';
            }
            
            $parts[] = Html::beginTag('div', ['class' => $radioClass]);
            
            $inputOptions = ['class' => 'form-check-input'];
            if ($this->disabled) {
                $inputOptions['disabled'] = true;
            }
            if ($this->error) {
                Html::addCssClass($inputOptions, 'is-invalid');
            }
            
            $parts[] = Html::radio(
                $this->name,
                $this->value == $itemValue,
                array_merge($inputOptions, [
                    'value' => $itemValue,
                    'label' => $itemLabel,
                    'labelOptions' => ['class' => 'form-check-label']
                ])
            );
            
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
