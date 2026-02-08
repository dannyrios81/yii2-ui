<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

/**
 * Button renders a Bootstrap 5 styled button/link element.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Button extends BaseWidget
{
    /** @var string the button label text */
    public $label;

    /** @var string|array the button URL */
    public $url = '#';

    /** @var string Bootstrap button type (primary, secondary, success, danger, warning, info, light, dark) */
    public $type = 'primary';

    /** @var string button size (sm, md, lg) */
    public $size = 'md';

    /** @var string|null icon content (HTML or emoji) */
    public $icon = null;

    /** @var string icon position relative to label (left, right) */
    public $iconPosition = 'left';

    /** @var bool whether to use outline style */
    public $outline = false;

    /** @var bool whether to apply rounded corners */
    public $rounded = true;

    /** @var bool whether to render as full-width block button */
    public $block = false;
    
    public function init()
    {
        parent::init();
        
        $btnClass = 'btn';
        
        if ($this->outline) {
            $btnClass .= ' btn-outline-' . $this->type;
        } else {
            $btnClass .= ' btn-' . $this->type;
        }
        
        if ($this->size !== 'md') {
            $btnClass .= ' btn-' . $this->size;
        }
        
        if ($this->rounded) {
            $btnClass .= ' rounded-2';
        }
        
        if ($this->block) {
            $btnClass .= ' w-100';
        }
        
        Html::addCssClass($this->options, $btnClass);
    }
    
    public function run()
    {
        $content = '';
        
        if ($this->icon !== null && $this->iconPosition === 'left') {
            $content .= Html::tag('span', $this->icon, ['class' => 'me-2']);
        }
        
        $content .= $this->label;
        
        if ($this->icon !== null && $this->iconPosition === 'right') {
            $content .= Html::tag('span', $this->icon, ['class' => 'ms-2']);
        }
        
        return Html::a($content, $this->url, $this->options);
    }
}
