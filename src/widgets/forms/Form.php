<?php

namespace iguazoft\ui\widgets\forms;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Form renders a styled HTML form with optional title, description, and action buttons.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Form extends BaseWidget
{
    /** @var string|null form action URL */
    public $action;

    /** @var string HTTP method (post, get) */
    public $method = 'post';

    /** @var string|null form encoding type (e.g. multipart/form-data) */
    public $enctype;

    /** @var string|null form title displayed above fields */
    public $title;

    /** @var string|null description text below the title */
    public $description;

    /** @var bool whether to show a submit button */
    public $submitButton = true;

    /** @var string submit button label */
    public $submitLabel = 'Submit';

    /** @var bool whether to show a reset button */
    public $resetButton = false;

    /** @var string reset button label */
    public $resetLabel = 'Reset';

    /** @var bool whether to show a cancel button */
    public $cancelButton = false;

    /** @var string cancel button label */
    public $cancelLabel = 'Cancel';

    /** @var string|null URL for the cancel button link */
    public $cancelUrl;

    /** @var bool whether to render the form inline */
    public $inline = false;

    /** @var bool whether to enable HTML5 validation (adds needs-validation class) */
    public $validated = false;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'dashboard-form');
        
        if ($this->validated) {
            Html::addCssClass($this->options, 'needs-validation');
            $this->options['novalidate'] = true;
        }
        
        if ($this->action) {
            $this->options['action'] = $this->action;
        }
        
        $this->options['method'] = $this->method;
        
        if ($this->enctype) {
            $this->options['enctype'] = $this->enctype;
        }
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        $parts = [];
        
        $parts[] = Html::beginTag('form', $this->options);
        
        if ($this->title || $this->description) {
            $parts[] = Html::beginTag('div', ['class' => 'mb-4']);
            
            if ($this->title) {
                $parts[] = Html::tag('h4', $this->title, ['class' => 'mb-2']);
            }
            
            if ($this->description) {
                $parts[] = Html::tag('p', $this->description, ['class' => 'text-muted']);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = $content;
        
        if ($this->submitButton || $this->resetButton || $this->cancelButton) {
            $parts[] = Html::beginTag('div', ['class' => 'mt-4 d-flex gap-2']);
            
            if ($this->submitButton) {
                $parts[] = Html::submitButton($this->submitLabel, [
                    'class' => 'btn btn-primary'
                ]);
            }
            
            if ($this->resetButton) {
                $parts[] = Html::resetButton($this->resetLabel, [
                    'class' => 'btn btn-outline-secondary'
                ]);
            }
            
            if ($this->cancelButton) {
                $parts[] = Html::a($this->cancelLabel, $this->cancelUrl ?? '#', [
                    'class' => 'btn btn-outline-secondary'
                ]);
            }
            
            $parts[] = Html::endTag('div');
        }
        
        $parts[] = Html::endTag('form');
        
        return implode("\n", $parts);
    }
}
