<?php

namespace iguazoft\ui\widgets\advanced;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Dropdown renders a Bootstrap 5 dropdown button with menu items.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Dropdown extends BaseWidget
{
    /** @var string the dropdown button label */
    public $label = 'Dropdown';

    /** @var array dropdown menu items. Each item is an array with keys: label, url, active, disabled. Use '-' for a divider, or ['header' => 'text'] for headers. */
    public $items = [];

    /** @var string Bootstrap button type (primary, secondary, success, danger, etc.) */
    public $buttonType = 'primary';

    /** @var string button size (sm, md, lg) */
    public $buttonSize = 'md';

    /** @var bool whether to render a split dropdown button */
    public $split = false;

    /** @var string dropdown direction (down, up, start, end) */
    public $direction = 'down';

    /** @var string menu alignment (start, end) */
    public $align = 'start';

    /** @var array HTML attributes for the button element */
    public $buttonOptions = [];

    /** @var array HTML attributes for the dropdown menu <ul> */
    public $menuOptions = [];
    
    public function init()
    {
        parent::init();
        
        $dropClass = 'drop' . $this->direction;
        Html::addCssClass($this->options, $dropClass);
        
        Html::addCssClass($this->buttonOptions, ['btn', 'btn-' . $this->buttonType]);
        
        if ($this->buttonSize !== 'md') {
            Html::addCssClass($this->buttonOptions, 'btn-' . $this->buttonSize);
        }
        
        Html::addCssClass($this->menuOptions, 'dropdown-menu');
        
        if ($this->align !== 'start') {
            Html::addCssClass($this->menuOptions, 'dropdown-menu-' . $this->align);
        }
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->options);
        
        if ($this->split) {
            $parts[] = Html::button($this->label, array_merge($this->buttonOptions, [
                'type' => 'button'
            ]));

            $splitOptions = $this->buttonOptions;
            Html::addCssClass($splitOptions, ['dropdown-toggle', 'dropdown-toggle-split']);
            $splitOptions['type'] = 'button';
            $splitOptions['data-bs-toggle'] = 'dropdown';
            $splitOptions['aria-expanded'] = 'false';

            $parts[] = Html::button(
                '<span class="visually-hidden">Toggle Dropdown</span>',
                $splitOptions
            );
        } else {
            Html::addCssClass($this->buttonOptions, 'dropdown-toggle');
            $this->buttonOptions['data-bs-toggle'] = 'dropdown';
            $this->buttonOptions['aria-expanded'] = 'false';
            
            $parts[] = Html::button($this->label, array_merge($this->buttonOptions, [
                'type' => 'button'
            ]));
        }
        
        $parts[] = $this->renderMenu();
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
    
    protected function renderMenu()
    {
        $items = [];
        
        foreach ($this->items as $item) {
            if ($item === '-') {
                $items[] = '<li><hr class="dropdown-divider"></li>';
            } elseif (isset($item['header'])) {
                $items[] = Html::tag('li', 
                    Html::tag('h6', $item['header'], ['class' => 'dropdown-header'])
                );
            } else {
                $itemClass = 'dropdown-item';
                if (isset($item['active']) && $item['active']) {
                    $itemClass .= ' active';
                }
                if (isset($item['disabled']) && $item['disabled']) {
                    $itemClass .= ' disabled';
                }
                
                $items[] = Html::tag('li',
                    Html::a($item['label'], $item['url'] ?? '#', ['class' => $itemClass])
                );
            }
        }
        
        return Html::tag('ul', implode("\n", $items), $this->menuOptions);
    }
}
