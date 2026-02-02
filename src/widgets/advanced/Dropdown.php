<?php

namespace iguazoft\ui\widgets\advanced;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Dropdown extends BaseWidget
{
    public $label = 'Dropdown';
    
    public $items = [];
    
    public $buttonType = 'primary';
    
    public $buttonSize = 'md';
    
    public $split = false;
    
    public $direction = 'down';
    
    public $align = 'start';
    
    public $buttonOptions = [];
    
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
            
            $parts[] = Html::button(
                '<span class="visually-hidden">Toggle Dropdown</span>',
                array_merge($this->buttonOptions, [
                    'type' => 'button',
                    'class' => implode(' ', $this->buttonOptions['class']) . ' dropdown-toggle dropdown-toggle-split',
                    'data-bs-toggle' => 'dropdown',
                    'aria-expanded' => 'false'
                ])
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
