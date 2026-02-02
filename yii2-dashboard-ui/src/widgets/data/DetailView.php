<?php

namespace iguazoft\ui\widgets\data;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class DetailView extends BaseWidget
{
    public $model;
    
    public $attributes = [];
    
    public $striped = true;
    
    public $bordered = true;
    
    public $hover = false;
    
    public $labelWidth = '30%';
    
    public $tableOptions = [];
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->tableOptions, 'table detail-view');
        
        if ($this->striped) {
            Html::addCssClass($this->tableOptions, 'table-striped');
        }
        
        if ($this->bordered) {
            Html::addCssClass($this->tableOptions, 'table-bordered');
        }
        
        if ($this->hover) {
            Html::addCssClass($this->tableOptions, 'table-hover');
        }
    }
    
    public function run()
    {
        $rows = [];
        
        foreach ($this->attributes as $attribute) {
            $rows[] = $this->renderRow($attribute);
        }
        
        return Html::tag('table', implode("\n", $rows), $this->tableOptions);
    }
    
    protected function renderRow($attribute)
    {
        if (is_string($attribute)) {
            $attribute = ['attribute' => $attribute];
        }
        
        $label = $attribute['label'] ?? $this->model->getAttributeLabel($attribute['attribute']);
        $value = '';
        
        if (isset($attribute['value'])) {
            if (is_callable($attribute['value'])) {
                $value = call_user_func($attribute['value'], $this->model);
            } else {
                $value = $attribute['value'];
            }
        } else {
            $value = ArrayHelper::getValue($this->model, $attribute['attribute']);
        }
        
        if (isset($attribute['format'])) {
            $value = $this->formatValue($value, $attribute['format']);
        }
        
        $labelOptions = $attribute['labelOptions'] ?? [];
        Html::addCssClass($labelOptions, 'fw-bold');
        $labelOptions['style'] = 'width: ' . $this->labelWidth;
        
        $valueOptions = $attribute['valueOptions'] ?? [];
        
        $labelCell = Html::tag('th', $label, $labelOptions);
        $valueCell = Html::tag('td', $value, $valueOptions);
        
        return Html::tag('tr', $labelCell . $valueCell);
    }
    
    protected function formatValue($value, $format)
    {
        switch ($format) {
            case 'text':
                return Html::encode($value);
            case 'html':
                return $value;
            case 'date':
                return date('Y-m-d', strtotime($value));
            case 'datetime':
                return date('Y-m-d H:i:s', strtotime($value));
            case 'boolean':
                return $value ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>';
            case 'number':
                return number_format($value);
            case 'currency':
                return '$' . number_format($value, 2);
            default:
                return $value;
        }
    }
}
