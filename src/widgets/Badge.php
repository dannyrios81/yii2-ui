<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

/**
 * Badge renders a Bootstrap 5 badge/label element.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Badge extends BaseWidget
{
    /** @var string the badge label text */
    public $label;

    /** @var string badge type (primary, secondary, success, danger, warning, info, light, dark) */
    public $type = 'primary';

    /** @var bool whether to render as a pill (rounded) badge */
    public $pill = false;

    /** @var bool whether to use outline style instead of filled */
    public $outline = false;
    
    public function init()
    {
        parent::init();
        
        $badgeClass = 'badge';
        
        if ($this->outline) {
            $badgeClass .= ' border border-' . $this->type . ' text-' . $this->type;
        } else {
            $badgeClass .= ' bg-' . $this->type;
        }
        
        if ($this->pill) {
            $badgeClass .= ' rounded-pill';
        }
        
        Html::addCssClass($this->options, $badgeClass);
    }
    
    public function run()
    {
        return Html::tag('span', $this->label, $this->options);
    }
}
