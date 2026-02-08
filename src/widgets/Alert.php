<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

/**
 * Alert renders a Bootstrap 5 alert component with optional title, icon, and dismiss button.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Alert extends BaseWidget
{
    /** @var string alert type (info, success, warning, danger, primary, secondary, light, dark) */
    public $type = 'info';

    /** @var string|null bold title text displayed before the message */
    public $title = null;

    /** @var string the alert message content */
    public $message;

    /** @var bool whether the alert can be dismissed with a close button */
    public $dismissible = true;

    /** @var string|null icon content (HTML or emoji) displayed before the message */
    public $icon = null;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, ['alert', 'alert-' . $this->type]);
        
        if ($this->dismissible) {
            Html::addCssClass($this->options, 'alert-dismissible fade show');
        }
    }
    
    public function run()
    {
        $parts = [];
        
        if ($this->icon !== null) {
            $parts[] = Html::tag('span', $this->icon, ['class' => 'me-2']);
        }
        
        if ($this->title !== null) {
            $parts[] = Html::tag('strong', $this->title . ' ');
        }
        
        $parts[] = $this->message;
        
        if ($this->dismissible) {
            $parts[] = Html::button('&times;', [
                'type' => 'button',
                'class' => 'btn-close',
                'data-bs-dismiss' => 'alert',
                'aria-label' => 'Close'
            ]);
        }
        
        return Html::tag('div', implode('', $parts), $this->options);
    }
}
