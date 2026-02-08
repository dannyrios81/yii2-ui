<?php

namespace iguazoft\ui\widgets\data;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * DataTable renders a configurable data table with formatting, responsive wrapper, and optional pagination.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class DataTable extends BaseWidget
{
    /** @var array|\yii\data\BaseDataProvider the data rows to display */
    public $dataProvider;

    /** @var array column configuration. Each element: [label, attribute, format, value, headerOptions, contentOptions] */
    public $columns = [];

    /** @var bool whether to apply striped rows */
    public $striped = false;

    /** @var bool whether to apply table borders */
    public $bordered = true;

    /** @var bool whether to apply hover effect on rows */
    public $hover = true;

    /** @var bool whether to wrap the table in a responsive container */
    public $responsive = true;

    /** @var bool whether to use compact table styling */
    public $small = false;

    /** @var string text shown when dataProvider is empty */
    public $emptyText = 'No data available';

    /** @var bool whether to render the table header */
    public $showHeader = true;

    /** @var bool whether to render the table footer */
    public $showFooter = false;

    /** @var string|null HTML content for the table footer */
    public $footerContent;

    /** @var array HTML attributes for the <table> tag */
    public $tableOptions = [];

    /** @var array HTML attributes for the header <tr> tag */
    public $headerRowOptions = [];

    /** @var array|callable HTML attributes for body <tr> tags. Can be a callable receiving ($model, $index) */
    public $rowOptions = [];

    /** @var bool whether to show pagination below the table */
    public $showPagination = false;

    /** @var \yii\data\Pagination|null Yii2 Pagination object for dynamic pagination */
    public $pagination;

    /** @var int total number of items (used if pagination object is not set) */
    public $totalCount;

    /** @var int items per page */
    public $pageSize = 10;

    /** @var int current page (1-indexed) */
    public $currentPage = 1;

    /** @var string URL template for pagination links. {page} is replaced with page number. */
    public $paginationUrlTemplate = '?page={page}';
    
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

        if ($this->showPagination) {
            $parts[] = $this->renderPagination();
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
            case 'currency':
                return '$' . number_format($value, 2);
            default:
                return $value;
        }
    }

    /**
     * Renders the pagination footer.
     * @return string
     */
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
            return '';
        }

        $start = ($currentPage - 1) * $pageSize + 1;
        $end = min($currentPage * $pageSize, $totalCount);

        $html = Html::beginTag('div', ['class' => 'd-flex justify-content-between align-items-center py-3 px-3']);
        $html .= Html::tag('div', "Showing {$start}-{$end} of {$totalCount} entries", ['class' => 'text-muted small']);

        $html .= Html::beginTag('nav');
        $html .= Html::beginTag('ul', ['class' => 'pagination pagination-sm mb-0']);

        $prevDisabled = $currentPage <= 1 ? ' disabled' : '';
        $prevUrl = str_replace('{page}', max(1, $currentPage - 1), $this->paginationUrlTemplate);
        $html .= Html::tag('li', Html::a('Prev', $prevUrl, ['class' => 'page-link']), ['class' => 'page-item' . $prevDisabled]);

        $range = $this->calculatePageRange($currentPage, $totalPages);
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
     * @return array
     */
    protected function calculatePageRange($currentPage, $totalPages)
    {
        $maxButtons = 7;

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
