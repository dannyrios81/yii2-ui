<?php

namespace iguazoft\ui\widgets\data;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * DetailView renders a two-column detail table for displaying a single model's attributes.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class DetailView extends BaseWidget
{
    /** @var array|object the data model whose attributes are displayed */
    public $model;

    /** @var array attribute definitions. Each element: [attribute, label, format, value] */
    public $attributes = [];

    /** @var bool whether to apply striped row styling */
    public $striped = true;

    /** @var bool whether to apply table borders */
    public $bordered = true;

    /** @var bool whether to apply hover effect on rows */
    public $hover = false;

    /** @var string CSS width of the label column */
    public $labelWidth = '30%';

    /** @var array HTML attributes for the <table> tag */
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
