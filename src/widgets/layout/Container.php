<?php

namespace iguazoft\ui\widgets\layout;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Container renders a Bootstrap 5 container or container-fluid wrapper.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Container extends BaseWidget
{
    /** @var bool whether to use container-fluid (true) or container (false) */
    public $fluid = false;

    /** @var string|null content. If null, captured output buffer is used. */
    public $content;
    
    public function init()
    {
        parent::init();
        
        $class = $this->fluid ? 'container-fluid' : 'container';
        Html::addCssClass($this->options, $class);
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        if ($this->content !== null) {
            $content = $this->content;
        }
        
        return Html::tag('div', $content, $this->options);
    }
}
