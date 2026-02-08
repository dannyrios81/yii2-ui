<?php

namespace iguazoft\ui\widgets\layout;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Grid renders a CSS Grid layout container with configurable columns and gaps.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Grid extends BaseWidget
{
    /** @var int number of grid columns */
    public $columns = 12;

    /** @var int|string gap between grid items */
    public $gap = 3;

    /** @var string|null CSS row-gap value */
    public $rowGap;

    /** @var string|null CSS column-gap value */
    public $columnGap;

    /** @var string|null grid content. If null, captured output buffer is used. */
    public $content;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'd-grid');
        
        $style = [];
        $style[] = 'grid-template-columns: repeat(' . $this->columns . ', 1fr)';
        
        if ($this->rowGap !== null) {
            $style[] = 'row-gap: ' . $this->rowGap;
        } elseif ($this->gap !== null) {
            $style[] = 'gap: ' . $this->gap . 'rem';
        }
        
        if ($this->columnGap !== null) {
            $style[] = 'column-gap: ' . $this->columnGap;
        }
        
        $this->options['style'] = implode('; ', $style);
        
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
