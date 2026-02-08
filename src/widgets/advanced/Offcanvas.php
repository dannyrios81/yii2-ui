<?php

namespace iguazoft\ui\widgets\advanced;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Offcanvas renders a Bootstrap 5 offcanvas panel that slides in from the side.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Offcanvas extends BaseWidget
{
    /** @var string|null offcanvas title */
    public $title;

    /** @var string|null offcanvas body content */
    public $content;

    /** @var string slide-in direction (start, end, top, bottom) */
    public $placement = 'start';

    /** @var bool whether to show a backdrop overlay */
    public $backdrop = true;

    /** @var bool whether body scrolling is allowed while offcanvas is open */
    public $scroll = false;

    /** @var bool whether to show a close button */
    public $closeButton = true;

    /** @var array HTML attributes for the offcanvas header */
    public $headerOptions = [];

    /** @var array HTML attributes for the offcanvas body */
    public $bodyOptions = [];
    
    public function init()
    {
        parent::init();
        
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'offcanvas-' . uniqid();
        }
        
        Html::addCssClass($this->options, ['offcanvas', 'offcanvas-' . $this->placement]);
        
        $this->options['tabindex'] = '-1';
        
        if (!$this->backdrop) {
            $this->options['data-bs-backdrop'] = 'false';
        }
        
        if ($this->scroll) {
            $this->options['data-bs-scroll'] = 'true';
        }
        
        Html::addCssClass($this->headerOptions, 'offcanvas-header');
        Html::addCssClass($this->bodyOptions, 'offcanvas-body');
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        if ($this->content !== null) {
            $content = $this->content;
        }
        
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->options);
        
        if ($this->title !== null) {
            $parts[] = Html::beginTag('div', $this->headerOptions);
            $parts[] = Html::tag('h5', $this->title, ['class' => 'offcanvas-title']);
            
            if ($this->closeButton) {
                $parts[] = Html::button('&times;', [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'offcanvas',
                    'aria-label' => 'Close'
                ]);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = Html::tag('div', $content, $this->bodyOptions);
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
