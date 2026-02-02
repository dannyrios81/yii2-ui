<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class ProductTable extends BaseWidget
{
    public $dataProvider;
    
    public $columns = [];
    
    public $checkboxColumn = true;
    
    public $actionColumn = true;
    
    public $tableOptions = [];
    
    public $headerRowOptions = [];
    
    public $rowOptions = [];
    
    public $emptyText = 'No data available';
    
    public $showPagination = true;
    
    public $paginationOptions = [];
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['product-table-wrapper', 'card', 'shadow-sm', 'rounded-3']);
        Html::addCssClass($this->tableOptions, ['table', 'table-hover', 'align-middle', 'mb-0']);
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->options);
        $parts[] = Html::beginTag('div', ['class' => 'table-responsive']);
        $parts[] = Html::beginTag('table', $this->tableOptions);
        
        $parts[] = $this->renderTableHeader();
        $parts[] = $this->renderTableBody();
        
        $parts[] = Html::endTag('table');
        $parts[] = Html::endTag('div');
        
        if ($this->showPagination && $this->dataProvider !== null) {
            $parts[] = $this->renderPagination();
        }
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
    
    protected function renderTableHeader()
    {
        $cells = [];
        
        if ($this->checkboxColumn) {
            $cells[] = Html::tag('th', 
                Html::checkbox('select-all', false, ['class' => 'form-check-input']),
                ['class' => 'text-center', 'style' => 'width: 50px;']
            );
        }
        
        foreach ($this->columns as $column) {
            $label = $column['label'] ?? '';
            $headerOptions = $column['headerOptions'] ?? [];
            Html::addCssClass($headerOptions, 'text-muted small text-uppercase');
            $cells[] = Html::tag('th', $label, $headerOptions);
        }
        
        if ($this->actionColumn) {
            $cells[] = Html::tag('th', 'ACTION', [
                'class' => 'text-muted small text-uppercase text-center',
                'style' => 'width: 120px;'
            ]);
        }
        
        $row = Html::tag('tr', implode("\n", $cells), $this->headerRowOptions);
        return Html::tag('thead', $row, ['class' => 'table-light']);
    }
    
    protected function renderTableBody()
    {
        $rows = [];
        
        if ($this->dataProvider === null || empty($this->dataProvider)) {
            $colspan = count($this->columns);
            if ($this->checkboxColumn) $colspan++;
            if ($this->actionColumn) $colspan++;
            
            $cell = Html::tag('td', $this->emptyText, [
                'colspan' => $colspan,
                'class' => 'text-center text-muted py-5'
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
        
        if ($this->checkboxColumn) {
            $cells[] = Html::tag('td',
                Html::checkbox('selection[]', false, [
                    'value' => $model['id'] ?? $index,
                    'class' => 'form-check-input'
                ]),
                ['class' => 'text-center']
            );
        }
        
        foreach ($this->columns as $column) {
            $cells[] = $this->renderDataCell($column, $model, $index);
        }
        
        if ($this->actionColumn) {
            $cells[] = $this->renderActionCell($model, $index);
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
    
    protected function renderActionCell($model, $index)
    {
        $buttons = [];
        
        $editUrl = isset($model['id']) ? ['update', 'id' => $model['id']] : '#';
        $deleteUrl = isset($model['id']) ? ['delete', 'id' => $model['id']] : '#';
        
        $buttons[] = Html::a(
            '<i class="bi bi-pencil"></i>',
            $editUrl,
            ['class' => 'btn btn-sm btn-link text-secondary', 'title' => 'Edit']
        );
        
        $buttons[] = Html::a(
            '<i class="bi bi-trash"></i>',
            $deleteUrl,
            [
                'class' => 'btn btn-sm btn-link text-danger',
                'title' => 'Delete',
                'data-confirm' => 'Are you sure you want to delete this item?',
                'data-method' => 'post'
            ]
        );
        
        return Html::tag('td', implode(' ', $buttons), ['class' => 'text-center']);
    }
    
    protected function formatValue($value, $format)
    {
        switch ($format) {
            case 'currency':
                return '$' . number_format($value, 0);
            case 'number':
                return number_format($value);
            case 'rating':
                return Html::tag('span', '⭐ ' . $value, ['class' => 'text-warning']);
            case 'badge':
                return Html::tag('span', $value, ['class' => 'badge bg-light text-dark']);
            case 'stock':
                return Html::tag('span', 
                    '<i class="bi bi-box"></i> ' . number_format($value),
                    ['class' => 'text-muted']
                );
            case 'sold':
                return Html::tag('span',
                    '<i class="bi bi-check-circle"></i> ' . number_format($value),
                    ['class' => 'text-success']
                );
            default:
                return $value;
        }
    }
    
    protected function renderPagination()
    {
        $html = Html::beginTag('div', ['class' => 'card-footer d-flex justify-content-between align-items-center py-3']);
        
        $html .= Html::tag('div', 'Showing 7 of 120 entries', ['class' => 'text-muted small']);
        
        $html .= Html::beginTag('nav');
        $html .= Html::beginTag('ul', ['class' => 'pagination pagination-sm mb-0']);
        
        $html .= Html::tag('li', Html::a('Prev', '#', ['class' => 'page-link']), ['class' => 'page-item']);
        $html .= Html::tag('li', Html::a('1', '#', ['class' => 'page-link']), ['class' => 'page-item active']);
        $html .= Html::tag('li', Html::a('2', '#', ['class' => 'page-link']), ['class' => 'page-item']);
        $html .= Html::tag('li', Html::tag('span', '...', ['class' => 'page-link']), ['class' => 'page-item disabled']);
        $html .= Html::tag('li', Html::a('8', '#', ['class' => 'page-link']), ['class' => 'page-item']);
        $html .= Html::tag('li', Html::a('9', '#', ['class' => 'page-link']), ['class' => 'page-item']);
        $html .= Html::tag('li', Html::a('Next', '#', ['class' => 'page-link']), ['class' => 'page-item']);
        
        $html .= Html::endTag('ul');
        $html .= Html::endTag('nav');
        
        $html .= Html::endTag('div');
        
        return $html;
    }
}
