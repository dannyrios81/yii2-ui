<?php

namespace iguazoft\ui\widgets\feedback;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Progress renders a Bootstrap 5 progress bar with optional label, striped, and animated styles.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Progress extends BaseWidget
{
    /** @var int|float current progress value */
    public $value = 0;

    /** @var int maximum progress value */
    public $max = 100;

    /** @var string|null custom label text (defaults to percentage if showLabel is true) */
    public $label;

    /** @var bool whether to display the label inside the progress bar */
    public $showLabel = false;

    /** @var string Bootstrap color type (primary, success, danger, warning, info) */
    public $type = 'primary';

    /** @var bool whether to apply striped style */
    public $striped = false;

    /** @var bool whether to animate the stripes */
    public $animated = false;

    /** @var string|null custom CSS height (e.g. '20px') */
    public $height;

    /** @var array HTML attributes for the inner progress bar div */
    public $barOptions = [];
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'progress');
        
        if ($this->height) {
            $this->options['style'] = 'height: ' . $this->height;
        }
        
        Html::addCssClass($this->barOptions, 'progress-bar');
        
        if ($this->type) {
            Html::addCssClass($this->barOptions, 'bg-' . $this->type);
        }
        
        if ($this->striped) {
            Html::addCssClass($this->barOptions, 'progress-bar-striped');
        }
        
        if ($this->animated) {
            Html::addCssClass($this->barOptions, 'progress-bar-animated');
        }
        
        $this->barOptions['role'] = 'progressbar';
        $this->barOptions['aria-valuenow'] = $this->value;
        $this->barOptions['aria-valuemin'] = '0';
        $this->barOptions['aria-valuemax'] = $this->max;
        $this->barOptions['style'] = 'width: ' . ($this->value / $this->max * 100) . '%';
    }
    
    public function run()
    {
        $label = '';
        
        if ($this->showLabel) {
            $label = $this->label ?? ($this->value . '%');
        }
        
        $bar = Html::tag('div', $label, $this->barOptions);
        
        return Html::tag('div', $bar, $this->options);
    }
}
