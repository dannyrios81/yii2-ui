<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

/**
 * Card renders a Bootstrap 5 card component with header, body, and footer sections.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Card extends BaseWidget
{
    /** @var string|null card title displayed in the header */
    public $title;

    /** @var string|null card subtitle displayed below the title */
    public $subtitle;

    /** @var string|null card body content. If null, captured output buffer is used. */
    public $content;

    /** @var string|null card footer content */
    public $footer;

    /** @var array HTML attributes for the card header */
    public $headerOptions = [];

    /** @var array HTML attributes for the card body */
    public $bodyOptions = [];

    /** @var array HTML attributes for the card footer */
    public $footerOptions = [];

    /** @var bool whether to apply shadow styling */
    public $shadow = true;

    /** @var bool whether to apply rounded corners */
    public $rounded = true;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'card');
        
        if ($this->shadow) {
            Html::addCssClass($this->options, 'shadow-sm');
        }
        
        if ($this->rounded) {
            Html::addCssClass($this->options, 'rounded-3');
        }
        
        Html::addCssClass($this->headerOptions, 'card-header');
        Html::addCssClass($this->bodyOptions, 'card-body');
        Html::addCssClass($this->footerOptions, 'card-footer');
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        if ($this->content !== null) {
            $content = $this->content;
        }
        
        $parts = [];
        
        if ($this->title !== null || $this->subtitle !== null) {
            $header = '';
            if ($this->title !== null) {
                $header .= Html::tag('h5', $this->title, ['class' => 'card-title mb-1']);
            }
            if ($this->subtitle !== null) {
                $header .= Html::tag('p', $this->subtitle, ['class' => 'card-subtitle text-muted small']);
            }
            $parts[] = Html::tag('div', $header, $this->headerOptions);
        }
        
        if ($content !== null && $content !== '') {
            $parts[] = Html::tag('div', $content, $this->bodyOptions);
        }
        
        if ($this->footer !== null) {
            $parts[] = Html::tag('div', $this->footer, $this->footerOptions);
        }
        
        return Html::tag('div', implode("\n", $parts), $this->options);
    }
}
