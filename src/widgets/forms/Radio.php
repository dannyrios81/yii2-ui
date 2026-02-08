<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Radio renders a group of Bootstrap 5 styled radio buttons.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Radio extends BaseWidget
{
    /** @var \yii\base\Model|null Yii2 model instance */
    public $model;

    /** @var string|null model attribute name */
    public $attribute;

    /** @var string|null input name attribute */
    public $name;

    /** @var mixed currently selected value */
    public $value;

    /** @var array key-value pairs for the radio options */
    public $items = [];

    /** @var string|null group label text */
    public $label;

    /** @var string|null hint text */
    public $hint;

    /** @var string|null error message */
    public $error;

    /** @var bool whether the radios are disabled */
    public $disabled = false;

    /** @var bool whether to display radios inline */
    public $inline = false;

    /** @var array HTML attributes for the label */
    public $labelOptions = [];

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
