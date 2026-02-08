<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Textarea renders a styled multi-line text input with label, hint, error, and character counter support.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Textarea extends BaseWidget
{
    /** @var \yii\base\Model|null Yii2 model instance */
    public $model;

    /** @var string|null model attribute name */
    public $attribute;

    /** @var string|null textarea name attribute */
    public $name;

    /** @var string|null textarea value */
    public $value;

    /** @var string|null label text */
    public $label;

    /** @var string|null placeholder text */
    public $placeholder;

    /** @var string|null hint text */
    public $hint;

    /** @var string|null error message */
    public $error;

    /** @var bool whether the field is required */
    public $required = false;

    /** @var bool whether the field is disabled */
    public $disabled = false;

    /** @var bool whether the field is readonly */
    public $readonly = false;

    /** @var int number of visible text rows */
    public $rows = 3;

    /** @var int|null maximum character length */
    public $maxlength;

    /** @var bool whether to show a character counter (requires maxlength) */
    public $showCounter = false;

    /** @var array HTML attributes for the label */
    public $labelOptions = [];

    /** @var array HTML attributes for the textarea */
    public $textareaOptions = [];

    /** @var array HTML attributes for the container */
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
        Html::addCssClass($this->textareaOptions, 'form-control');
        
        if ($this->error) {
            Html::addCssClass($this->textareaOptions, 'is-invalid');
        }
        
        $this->textareaOptions['rows'] = $this->rows;
        
        if ($this->required) {
            $this->textareaOptions['required'] = true;
        }
        
        if ($this->disabled) {
            $this->textareaOptions['disabled'] = true;
        }
        
        if ($this->readonly) {
            $this->textareaOptions['readonly'] = true;
        }
        
        if ($this->placeholder) {
            $this->textareaOptions['placeholder'] = $this->placeholder;
        }
        
        if ($this->maxlength) {
            $this->textareaOptions['maxlength'] = $this->maxlength;
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
        
        $parts[] = Html::textarea($this->name, $this->value, $this->textareaOptions);
        
        if ($this->showCounter && $this->maxlength) {
            $currentLength = mb_strlen($this->value ?? '');
            $parts[] = Html::tag('div', 
                $currentLength . ' / ' . $this->maxlength,
                ['class' => 'form-text text-end small']
            );
        } elseif ($this->hint) {
            $parts[] = Html::tag('div', $this->hint, ['class' => 'form-text']);
        }
        
        if ($this->error) {
            $parts[] = Html::tag('div', $this->error, ['class' => 'invalid-feedback d-block']);
        }
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
