<?php

namespace iguazoft\ui\widgets\feedback;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Toast renders a Bootstrap 5 toast notification with header, body, and auto-hide support.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Toast extends BaseWidget
{
    /** @var string|null toast title */
    public $title;

    /** @var string toast body message */
    public $message;

    /** @var string toast type affecting header color (info, success, warning, danger) */
    public $type = 'info';

    /** @var string|null icon content */
    public $icon;

    /** @var string|null timestamp text displayed in the header */
    public $time;

    /** @var bool whether the toast auto-hides after delay */
    public $autohide = true;

    /** @var int auto-hide delay in milliseconds */
    public $delay = 5000;

    /** @var bool whether to show a close button */
    public $closeButton = true;

    /** @var array HTML attributes for the toast header */
    public $headerOptions = [];

    /** @var array HTML attributes for the toast body */
    public $bodyOptions = [];
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'toast');
        $this->options['role'] = 'alert';
        $this->options['aria-live'] = 'assertive';
        $this->options['aria-atomic'] = 'true';
        
        if ($this->autohide) {
            $this->options['data-bs-autohide'] = 'true';
            $this->options['data-bs-delay'] = $this->delay;
        } else {
            $this->options['data-bs-autohide'] = 'false';
        }
        
        Html::addCssClass($this->headerOptions, 'toast-header');
        
        if ($this->type !== 'info') {
            Html::addCssClass($this->headerOptions, 'bg-' . $this->type . ' text-white');
        }
        
        Html::addCssClass($this->bodyOptions, 'toast-body');
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->options);
        
        if ($this->title !== null) {
            $parts[] = Html::beginTag('div', $this->headerOptions);
            
            if ($this->icon) {
                $parts[] = Html::tag('span', $this->icon, ['class' => 'me-2']);
            }
            
            $parts[] = Html::tag('strong', $this->title, ['class' => 'me-auto']);
            
            if ($this->time) {
                $parts[] = Html::tag('small', $this->time);
            }
            
            if ($this->closeButton) {
                $parts[] = Html::button('&times;', [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'toast',
                    'aria-label' => 'Close'
                ]);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = Html::tag('div', $this->message, $this->bodyOptions);
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
