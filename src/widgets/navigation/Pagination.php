<?php

namespace iguazoft\ui\widgets\navigation;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Pagination renders a Bootstrap 5 pagination component with configurable buttons and navigation.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Pagination extends BaseWidget
{
    /** @var int total number of pages */
    public $totalPages = 1;

    /** @var int current active page (1-indexed) */
    public $currentPage = 1;

    /** @var int maximum number of page buttons to show */
    public $maxButtons = 7;

    /** @var string pagination size (sm, md, lg) */
    public $size = 'md';

    /** @var string alignment (start, center, end) */
    public $alignment = 'start';

    /** @var string previous button label */
    public $prevLabel = 'Previous';

    /** @var string next button label */
    public $nextLabel = 'Next';

    /** @var string first page button label */
    public $firstLabel = 'First';

    /** @var string last page button label */
    public $lastLabel = 'Last';

    /** @var bool whether to show first/last page buttons */
    public $showFirstLast = false;

    /** @var bool whether to show previous/next buttons */
    public $showPrevNext = true;

    /** @var string URL template where {page} is replaced with page number */
    public $urlTemplate = '?page={page}';
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'pagination');
        
        if ($this->size !== 'md') {
            Html::addCssClass($this->options, 'pagination-' . $this->size);
        }
    }
    
    public function run()
    {
        if ($this->totalPages <= 1) {
            return '';
        }
        
        $items = [];
        
        if ($this->showFirstLast) {
            $items[] = $this->renderPageButton(1, $this->firstLabel, $this->currentPage === 1);
        }
        
        if ($this->showPrevNext) {
            $items[] = $this->renderPageButton(
                max(1, $this->currentPage - 1),
                $this->prevLabel,
                $this->currentPage === 1
            );
        }
        
        $range = $this->getPageRange();
        
        foreach ($range as $page) {
            if ($page === '...') {
                $items[] = Html::tag('li',
                    Html::tag('span', '...', ['class' => 'page-link']),
                    ['class' => 'page-item disabled']
                );
            } else {
                $items[] = $this->renderPageButton($page, $page, false, $page === $this->currentPage);
            }
        }
        
        if ($this->showPrevNext) {
            $items[] = $this->renderPageButton(
                min($this->totalPages, $this->currentPage + 1),
                $this->nextLabel,
                $this->currentPage === $this->totalPages
            );
        }
        
        if ($this->showFirstLast) {
            $items[] = $this->renderPageButton(
                $this->totalPages,
                $this->lastLabel,
                $this->currentPage === $this->totalPages
            );
        }
        
        $pagination = Html::tag('ul', implode("\n", $items), $this->options);
        
        $navClass = 'justify-content-' . $this->alignment;
        
        return Html::tag('nav', $pagination, ['class' => $navClass]);
    }
    
    protected function renderPageButton($page, $label, $disabled = false, $active = false)
    {
        $class = 'page-item';
        if ($disabled) {
            $class .= ' disabled';
        }
        if ($active) {
            $class .= ' active';
        }
        
        $url = str_replace('{page}', $page, $this->urlTemplate);
        
        return Html::tag('li',
            Html::a($label, $url, ['class' => 'page-link']),
            ['class' => $class]
        );
    }
    
    protected function getPageRange()
    {
        $range = [];
        $halfMax = floor($this->maxButtons / 2);
        
        if ($this->totalPages <= $this->maxButtons) {
            for ($i = 1; $i <= $this->totalPages; $i++) {
                $range[] = $i;
            }
        } else {
            $start = max(1, $this->currentPage - $halfMax);
            $end = min($this->totalPages, $this->currentPage + $halfMax);
            
            if ($start > 1) {
                $range[] = 1;
                if ($start > 2) {
                    $range[] = '...';
                }
            }
            
            for ($i = $start; $i <= $end; $i++) {
                $range[] = $i;
            }
            
            if ($end < $this->totalPages) {
                if ($end < $this->totalPages - 1) {
                    $range[] = '...';
                }
                $range[] = $this->totalPages;
            }
        }
        
        return $range;
    }
}
