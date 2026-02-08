<?php

namespace iguazoft\ui\widgets\feedback;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Modal renders a Bootstrap 5 modal dialog with header, body, and footer.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Modal extends BaseWidget
{
    /** @var string|null modal title */
    public $title;

    /** @var string|null modal body content. If null, captured output buffer is used. */
    public $content;

    /** @var string|null modal footer content */
    public $footer;

    /** @var string modal size (sm, md, lg, xl) */
    public $size = 'md';

    /** @var bool whether to vertically center the modal */
    public $centered = false;

    /** @var bool whether to make the modal body scrollable */
    public $scrollable = false;

    /** @var bool whether to make the modal fullscreen */
    public $fullscreen = false;

    /** @var bool whether to show a close button in the header */
    public $closeButton = true;

    /** @var bool whether clicking the backdrop closes the modal */
    public $backdrop = true;

    /** @var bool whether pressing Escape closes the modal */
    public $keyboard = true;

    /** @var array HTML attributes for the modal header */
    public $headerOptions = [];

    /** @var array HTML attributes for the modal body */
    public $bodyOptions = [];

    /** @var array HTML attributes for the modal footer */
    public $footerOptions = [];

    /** @var array HTML attributes for the modal dialog div */
    public $dialogOptions = [];
    
    public function init()
    {
        parent::init();
        
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'modal-' . uniqid();
        }
        
        Html::addCssClass($this->options, 'modal fade');
        $this->options['tabindex'] = '-1';
        $this->options['aria-hidden'] = 'true';
        
        if (!$this->backdrop) {
            $this->options['data-bs-backdrop'] = 'static';
        }
        
        if (!$this->keyboard) {
            $this->options['data-bs-keyboard'] = 'false';
        }
        
        Html::addCssClass($this->dialogOptions, 'modal-dialog');
        
        if ($this->size !== 'md') {
            Html::addCssClass($this->dialogOptions, 'modal-' . $this->size);
        }
        
        if ($this->centered) {
            Html::addCssClass($this->dialogOptions, 'modal-dialog-centered');
        }
        
        if ($this->scrollable) {
            Html::addCssClass($this->dialogOptions, 'modal-dialog-scrollable');
        }
        
        if ($this->fullscreen) {
            Html::addCssClass($this->dialogOptions, 'modal-fullscreen');
        }
        
        Html::addCssClass($this->headerOptions, 'modal-header');
        Html::addCssClass($this->bodyOptions, 'modal-body');
        Html::addCssClass($this->footerOptions, 'modal-footer');
        
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
        $parts[] = Html::beginTag('div', $this->dialogOptions);
        $parts[] = Html::beginTag('div', ['class' => 'modal-content']);
        
        if ($this->title !== null) {
            $parts[] = Html::beginTag('div', $this->headerOptions);
            $parts[] = Html::tag('h5', $this->title, ['class' => 'modal-title']);
            
            if ($this->closeButton) {
                $parts[] = Html::button('&times;', [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'modal',
                    'aria-label' => 'Close'
                ]);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = Html::tag('div', $content, $this->bodyOptions);
        
        if ($this->footer !== null) {
            $parts[] = Html::tag('div', $this->footer, $this->footerOptions);
        }
        
        $parts[] = Html::endTag('div');
        $parts[] = Html::endTag('div');
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
