<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * ProductTable renders a styled product data table with checkboxes, actions, and pagination.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class ProductTable extends BaseWidget
{
    /**
     * @var array|\yii\data\BaseDataProvider the data to be displayed as rows.
     * Can be a simple array of items or a Yii2 DataProvider.
     */
    public $dataProvider;

    /** @var array column configuration. Each element is an array with keys: label, attribute, format, value, headerOptions, contentOptions */
    public $columns = [];

    /** @var bool whether to show a checkbox column */
    public $checkboxColumn = true;

    /** @var bool whether to show an action column with edit/delete buttons */
    public $actionColumn = true;

    /** @var array HTML attributes for the <table> tag */
    public $tableOptions = [];

    /** @var array HTML attributes for the header <tr> tag */
    public $headerRowOptions = [];

    /** @var array|callable HTML attributes for body <tr> tags. Can be a callable receiving ($model, $index) */
    public $rowOptions = [];

    /** @var string text displayed when dataProvider is empty */
    public $emptyText = 'No data available';

    /** @var bool whether to show pagination */
    public $showPagination = true;

    /** @var array HTML attributes for the pagination container */
    public $paginationOptions = [];

    /** @var int total number of items across all pages. If null, count of dataProvider is used. */
    public $totalCount;

    /** @var int number of items per page */
    public $pageSize = 10;

    /** @var int current page number (1-indexed) */
    public $currentPage = 1;

    /** @var \yii\data\Pagination|null Yii2 Pagination object. Overrides totalCount/pageSize/currentPage when set. */
    public $pagination;

    /** @var string URL template for pagination links. {page} is replaced with the page number. */
    public $paginationUrlTemplate = '?page={page}';

    /** @var int maximum number of page buttons to display */
    public $maxPageButtons = 7;
    
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
        $totalCount = $this->totalCount;
        $pageSize = $this->pageSize;
        $currentPage = $this->currentPage;

        if ($this->pagination !== null && $this->pagination instanceof \yii\data\Pagination) {
            $totalCount = $this->pagination->totalCount;
            $pageSize = $this->pagination->pageSize;
            $currentPage = $this->pagination->getPage() + 1;
        }

        if ($totalCount === null) {
            $totalCount = is_array($this->dataProvider) ? count($this->dataProvider) : 0;
        }

        $totalPages = $pageSize > 0 ? (int)ceil($totalCount / $pageSize) : 1;

        if ($totalPages <= 1) {
            $showing = $totalCount;
            $html = Html::beginTag('div', ['class' => 'card-footer d-flex justify-content-between align-items-center py-3']);
            $html .= Html::tag('div', "Showing {$showing} of {$totalCount} entries", ['class' => 'text-muted small']);
            $html .= Html::endTag('div');
            return $html;
        }

        $start = ($currentPage - 1) * $pageSize + 1;
        $end = min($currentPage * $pageSize, $totalCount);

        $html = Html::beginTag('div', ['class' => 'card-footer d-flex justify-content-between align-items-center py-3']);
        $html .= Html::tag('div', "Showing {$start}-{$end} of {$totalCount} entries", ['class' => 'text-muted small']);

        $html .= Html::beginTag('nav');
        $html .= Html::beginTag('ul', ['class' => 'pagination pagination-sm mb-0']);

        $prevDisabled = $currentPage <= 1 ? ' disabled' : '';
        $prevUrl = str_replace('{page}', max(1, $currentPage - 1), $this->paginationUrlTemplate);
        $html .= Html::tag('li', Html::a('Prev', $prevUrl, ['class' => 'page-link']), ['class' => 'page-item' . $prevDisabled]);

        $range = $this->calculatePageRange($currentPage, $totalPages, $this->maxPageButtons);
        foreach ($range as $page) {
            if ($page === '...') {
                $html .= Html::tag('li', Html::tag('span', '...', ['class' => 'page-link']), ['class' => 'page-item disabled']);
            } else {
                $active = $page === $currentPage ? ' active' : '';
                $url = str_replace('{page}', $page, $this->paginationUrlTemplate);
                $html .= Html::tag('li', Html::a($page, $url, ['class' => 'page-link']), ['class' => 'page-item' . $active]);
            }
        }

        $nextDisabled = $currentPage >= $totalPages ? ' disabled' : '';
        $nextUrl = str_replace('{page}', min($totalPages, $currentPage + 1), $this->paginationUrlTemplate);
        $html .= Html::tag('li', Html::a('Next', $nextUrl, ['class' => 'page-link']), ['class' => 'page-item' . $nextDisabled]);

        $html .= Html::endTag('ul');
        $html .= Html::endTag('nav');
        $html .= Html::endTag('div');

        return $html;
    }

    /**
     * Calculates the page number range for pagination buttons.
     * @param int $currentPage
     * @param int $totalPages
     * @param int $maxButtons
     * @return array
     */
    protected function calculatePageRange($currentPage, $totalPages, $maxButtons)
    {
        if ($totalPages <= $maxButtons) {
            return range(1, $totalPages);
        }

        $halfMax = (int)floor($maxButtons / 2);
        $start = max(1, $currentPage - $halfMax);
        $end = min($totalPages, $currentPage + $halfMax);

        if ($start <= 2) {
            $end = min($totalPages, $maxButtons - 1);
            $start = 1;
        }
        if ($end >= $totalPages - 1) {
            $start = max(1, $totalPages - $maxButtons + 2);
            $end = $totalPages;
        }

        $range = [];
        if ($start > 1) {
            $range[] = 1;
            if ($start > 2) {
                $range[] = '...';
            }
        }
        for ($i = $start; $i <= $end; $i++) {
            $range[] = $i;
        }
        if ($end < $totalPages) {
            if ($end < $totalPages - 1) {
                $range[] = '...';
            }
            $range[] = $totalPages;
        }

        return $range;
    }
}
