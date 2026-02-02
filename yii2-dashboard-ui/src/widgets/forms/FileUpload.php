<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class FileUpload extends BaseWidget
{
    public $model;
    
    public $attribute;
    
    public $name;
    
    public $label;
    
    public $hint;
    
    public $error;
    
    public $required = false;
    
    public $disabled = false;
    
    public $multiple = false;
    
    public $accept;
    
    public $maxSize;
    
    public $preview = false;
    
    public $previewUrl;
    
    public $labelOptions = [];
    
    public $inputOptions = [];
    
    public $containerOptions = [];
    
    public function init()
    {
        parent::init();
        
        if ($this->model !== null && $this->attribute !== null) {
            $this->name = Html::getInputName($this->model, $this->attribute);
            
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
        
        if ($this->error) {
            Html::addCssClass($this->inputOptions, 'is-invalid');
        }
        
        if ($this->required) {
            $this->inputOptions['required'] = true;
        }
        
        if ($this->disabled) {
            $this->inputOptions['disabled'] = true;
        }
        
        if ($this->multiple) {
            $this->inputOptions['multiple'] = true;
        }
        
        if ($this->accept) {
            $this->inputOptions['accept'] = $this->accept;
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
        
        if ($this->preview && $this->previewUrl) {
            $parts[] = Html::beginTag('div', ['class' => 'mb-2']);
            $parts[] = Html::img($this->previewUrl, [
                'class' => 'img-thumbnail',
                'style' => 'max-width: 200px; max-height: 200px;'
            ]);
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = Html::fileInput($this->name, null, $this->inputOptions);
        
        if ($this->hint) {
            $parts[] = Html::tag('div', $this->hint, ['class' => 'form-text']);
        }
        
        if ($this->maxSize) {
            $maxSizeMB = $this->maxSize / 1024 / 1024;
            $parts[] = Html::tag('div', 
                'Max file size: ' . $maxSizeMB . 'MB',
                ['class' => 'form-text']
            );
        }
        
        if ($this->error) {
            $parts[] = Html::tag('div', $this->error, ['class' => 'invalid-feedback d-block']);
        }
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
