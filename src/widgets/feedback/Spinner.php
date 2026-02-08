<?php

namespace iguazoft\ui\widgets\feedback;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Spinner renders a Bootstrap 5 loading spinner indicator.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Spinner extends BaseWidget
{
    /** @var string spinner type (border, grow) */
    public $type = 'border';

    /** @var string spinner size (sm, md) */
    public $size = 'md';

    /** @var string Bootstrap color (primary, secondary, success, danger, etc.) */
    public $color = 'primary';

    /** @var string accessible label text */
    public $label = 'Loading...';

    /** @var bool whether to show the label text visibly next to the spinner */
    public $showLabel = false;
    
    public function init()
    {
        parent::init();
        
        $spinnerClass = 'spinner-' . $this->type;
        Html::addCssClass($this->options, $spinnerClass);
        
        if ($this->color) {
            Html::addCssClass($this->options, 'text-' . $this->color);
        }
        
        if ($this->size === 'sm') {
            Html::addCssClass($this->options, $spinnerClass . '-sm');
        }
        
        $this->options['role'] = 'status';
    }
    
    public function run()
    {
        $label = Html::tag('span', $this->label, ['class' => 'visually-hidden']);
        
        if ($this->showLabel) {
            return Html::tag('div', 
                Html::tag('div', $label, $this->options) . ' ' . $this->label,
                ['class' => 'd-flex align-items-center']
            );
        }
        
        return Html::tag('div', $label, $this->options);
    }
}
