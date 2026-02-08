<?php

namespace iguazoft\ui\widgets\layout;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Col renders a Bootstrap 5 grid column with responsive breakpoint support.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Col extends BaseWidget
{
    /** @var string|null column content. If null, captured output buffer is used. */
    public $content;

    /** @var int|string|null column width at xs breakpoint */
    public $xs;

    /** @var int|string|null column width at sm breakpoint */
    public $sm;

    /** @var int|string|null column width at md breakpoint */
    public $md;

    /** @var int|string|null column width at lg breakpoint */
    public $lg;

    /** @var int|string|null column width at xl breakpoint */
    public $xl;

    /** @var int|string|null column width at xxl breakpoint */
    public $xxl;

    /** @var int|string|null column offset */
    public $offset;

    /** @var int|string|null column order */
    public $order;
    
    public function init()
    {
        parent::init();
        
        $classes = [];
        
        if ($this->xs) $classes[] = 'col-' . $this->xs;
        if ($this->sm) $classes[] = 'col-sm-' . $this->sm;
        if ($this->md) $classes[] = 'col-md-' . $this->md;
        if ($this->lg) $classes[] = 'col-lg-' . $this->lg;
        if ($this->xl) $classes[] = 'col-xl-' . $this->xl;
        if ($this->xxl) $classes[] = 'col-xxl-' . $this->xxl;
        
        if (empty($classes)) {
            $classes[] = 'col';
        }
        
        if ($this->offset) {
            $classes[] = 'offset-' . $this->offset;
        }
        
        if ($this->order) {
            $classes[] = 'order-' . $this->order;
        }
        
        Html::addCssClass($this->options, $classes);
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        if ($this->content !== null) {
            $content = $this->content;
        }
        
        return Html::tag('div', $content, $this->options);
    }
}
