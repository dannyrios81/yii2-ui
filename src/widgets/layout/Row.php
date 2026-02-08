<?php

namespace iguazoft\ui\widgets\layout;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Row renders a Bootstrap 5 grid row with gutter, alignment, and justification options.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Row extends BaseWidget
{
    /** @var string|null row content. If null, captured output buffer is used. */
    public $content;

    /** @var bool whether to enable gutters between columns */
    public $gutters = true;

    /** @var string|null vertical alignment (start, center, end) */
    public $align = null;

    /** @var string|null horizontal justification (start, center, end, between, around, evenly) */
    public $justify = null;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'row');
        
        if (!$this->gutters) {
            Html::addCssClass($this->options, 'g-0');
        }
        
        if ($this->align) {
            Html::addCssClass($this->options, 'align-items-' . $this->align);
        }
        
        if ($this->justify) {
            Html::addCssClass($this->options, 'justify-content-' . $this->justify);
        }
        
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
