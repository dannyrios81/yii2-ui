<?php

namespace iguazoft\ui\widgets\data;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class DataTable extends BaseWidget
{
    public $dataProvider;
    
    public $columns = [];
    
    public $striped = false;
    
    public $bordered = true;
    
    public $hover = true;
    
    public $responsive = true;
    
    public $small = false;
    
    public $emptyText = 'No data available';
    
    public $showHeader = true;
    
    public $showFooter = false;
    
    public $footerContent;
    
    public $tableOptions = [];
    
    public $headerRowOptions = [];
    
    public $rowOptions = [];
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->tableOptions, 'table');
        
        if ($this->striped) {
            Html::addCssClass($this->tableOptions, 'table-striped');
        }
        
        if ($this->bordered) {
            Html::addCssClass($this->tableOptions, 'table-bordered');
        }
        
        if ($this->hover) {
            Html::addCssClass($this->tableOptions, 'table-hover');
        }
        
        if ($this->small) {
            Html::addCssClass($this->tableOptions, 'table-sm');
        }
    }
    
    public function run()
    {
        $parts = [];
        
        if ($this->responsive) {
            $parts[] = Html::beginTag('div', ['class' => 'table-responsive']);
        }
        
        $parts[] = Html::beginTag('table', $this->tableOptions);
        
        if ($this->showHeader) {
            $parts[] = $this->renderTableHeader();
        }
        
        $parts[] = $this->renderTableBody();
        
        if ($this->showFooter && $this->footerContent) {
            $parts[] = $this->renderTableFooter();
        }
        
        $parts[] = Html::endTag('table');
        
        if ($this->responsive) {
            $parts[] = Html::endTag('div');
        }
        
        return implode("\n", $parts);
    }
    
    protected function renderTableHeader()
    {
        $cells = [];
        
        foreach ($this->columns as $column) {
            $label = $column['label'] ?? '';
            $headerOptions = $column['headerOptions'] ?? [];
            $cells[] = Html::tag('th', $label, $headerOptions);
        }
        
        $row = Html::tag('tr', implode("\n", $cells), $this->headerRowOptions);
        return Html::tag('thead', $row);
    }
    
    protected function renderTableBody()
    {
        $rows = [];
        
        if (empty($this->dataProvider)) {
            $colspan = count($this->columns);
            $cell = Html::tag('td', $this->emptyText, [
                'colspan' => $colspan,
                'class' => 'text-center text-muted py-4'
            ]);
            $rows[] = Html::tag('tr', $cell);
        } else {
            foreach ($this->dataProvider as $index => $model) {
                $rows[] = $this->renderTableRow($model, $index);
            }
        }
        
        return Html::tag('tbody', implode("\n", $rows));
    }
    
    protected function renderTableRow($model, $index)
    {
        $cells = [];
        
        foreach ($this->columns as $column) {
            $cells[] = $this->renderDataCell($column, $model, $index);
        }
        
        $rowOptions = is_callable($this->rowOptions)
            ? call_user_func($this->rowOptions, $model, $index)
            : $this->rowOptions;
        
        return Html::tag('tr', implode("\n", $cells), $rowOptions);
    }
    
    protected function renderDataCell($column, $model, $index)
    {
        $value = '';
        
        if (isset($column['attribute'])) {
            $value = ArrayHelper::getValue($model, $column['attribute']);
        }
        
        if (isset($column['value']) && is_callable($column['value'])) {
            $value = call_user_func($column['value'], $model, $index);
        }
        
        if (isset($column['format'])) {
            $value = $this->formatValue($value, $column['format']);
        }
        
        $contentOptions = $column['contentOptions'] ?? [];
        
        return Html::tag('td', $value, $contentOptions);
    }
    
    protected function renderTableFooter()
    {
        return Html::tag('tfoot', $this->footerContent);
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
                return $value ? 'Yes' : 'No';
            case 'number':
                return number_format($value);
            default:
                return $value;
        }
    }
}
