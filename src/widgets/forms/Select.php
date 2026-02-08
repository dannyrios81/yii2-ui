<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Select renders a styled dropdown select field with label, hint, and error support.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Select extends BaseWidget
{
    /** @var \yii\base\Model|null Yii2 model instance */
    public $model;

    /** @var string|null model attribute name */
    public $attribute;

    /** @var string|null select name attribute */
    public $name;

    /** @var mixed selected value */
    public $value;

    /** @var array key-value pairs for the select options */
    public $items = [];

    /** @var string|null label text */
    public $label;

    /** @var string|null prompt/placeholder option text */
    public $prompt;

    /** @var string|null hint text displayed below the select */
    public $hint;

    /** @var string|null error message */
    public $error;

    /** @var bool whether the field is required */
    public $required = false;

    /** @var bool whether the field is disabled */
    public $disabled = false;

    /** @var bool whether multiple selection is allowed */
    public $multiple = false;

    /** @var string select size (sm, md, lg) */
    public $size = 'md';

    /** @var array HTML attributes for the label tag */
    public $labelOptions = [];

    /** @var array HTML attributes for the select tag */
    public $selectOptions = [];

    /** @var array HTML attributes for the container div */
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
