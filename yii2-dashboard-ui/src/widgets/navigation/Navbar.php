<?php

namespace iguazoft\ui\widgets\navigation;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Navbar extends BaseWidget
{
    public $brand;
    
    public $brandUrl = '/';
    
    public $brandImage;
    
    public $items = [];
    
    public $rightItems = [];
    
    public $theme = 'light';
    
    public $expand = 'lg';
    
    public $fixed = null;
    
    public $sticky = false;
    
    public $containerFluid = true;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, ['navbar', 'navbar-expand-' . $this->expand]);
        
        if ($this->theme === 'dark') {
            Html::addCssClass($this->options, 'navbar-dark bg-dark');
        } else {
            Html::addCssClass($this->options, 'navbar-light bg-light');
        }
        
        if ($this->fixed === 'top') {
            Html::addCssClass($this->options, 'fixed-top');
        } elseif ($this->fixed === 'bottom') {
            Html::addCssClass($this->options, 'fixed-bottom');
        }
        
        if ($this->sticky) {
            Html::addCssClass($this->options, 'sticky-top');
        }
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('nav', $this->options);
        
        $containerClass = $this->containerFluid ? 'container-fluid' : 'container';
        $parts[] = Html::beginTag('div', ['class' => $containerClass]);
        
        if ($this->brand || $this->brandImage) {
            $brandContent = '';
            if ($this->brandImage) {
                $brandContent .= Html::img($this->brandImage, ['height' => 30, 'class' => 'me-2']);
            }
            if ($this->brand) {
                $brandContent .= $this->brand;
            }
            $parts[] = Html::a($brandContent, $this->brandUrl, ['class' => 'navbar-brand']);
        }
        
        $parts[] = Html::button(
            '<span class="navbar-toggler-icon"></span>',
            [
                'class' => 'navbar-toggler',
                'type' => 'button',
                'data-bs-toggle' => 'collapse',
                'data-bs-target' => '#navbarNav',
                'aria-controls' => 'navbarNav',
                'aria-expanded' => 'false',
                'aria-label' => 'Toggle navigation'
            ]
        );
        
        $parts[] = Html::beginTag('div', ['class' => 'collapse navbar-collapse', 'id' => 'navbarNav']);
        
        $parts[] = $this->renderNavItems($this->items, 'me-auto');
        
        if (!empty($this->rightItems)) {
            $parts[] = $this->renderNavItems($this->rightItems, 'ms-auto');
        }
        
        $parts[] = Html::endTag('div');
        
        $parts[] = Html::endTag('div');
        $parts[] = Html::endTag('nav');
        
        return implode("\n", $parts);
    }
    
    protected function renderNavItems($items, $class = '')
    {
        $navItems = [];
        
        foreach ($items as $item) {
            $active = isset($item['active']) && $item['active'];
            $linkClass = 'nav-link' . ($active ? ' active' : '');
            
            if (isset($item['items'])) {
                $navItems[] = $this->renderDropdown($item);
            } else {
                $navItems[] = Html::tag('li',
                    Html::a($item['label'], $item['url'] ?? '#', ['class' => $linkClass]),
                    ['class' => 'nav-item']
                );
            }
        }
        
        return Html::tag('ul', implode("\n", $navItems), ['class' => 'navbar-nav ' . $class]);
    }
    
    protected function renderDropdown($item)
    {
        $dropdownItems = [];
        
        foreach ($item['items'] as $subItem) {
            if ($subItem === '-') {
                $dropdownItems[] = '<li><hr class="dropdown-divider"></li>';
            } else {
                $dropdownItems[] = Html::tag('li',
                    Html::a($subItem['label'], $subItem['url'] ?? '#', ['class' => 'dropdown-item'])
                );
            }
        }
        
        $toggle = Html::a(
            $item['label'] . ' <span class="caret"></span>',
            '#',
            [
                'class' => 'nav-link dropdown-toggle',
                'data-bs-toggle' => 'dropdown',
                'role' => 'button',
                'aria-expanded' => 'false'
            ]
        );
        
        $menu = Html::tag('ul', implode("\n", $dropdownItems), ['class' => 'dropdown-menu']);
        
        return Html::tag('li', $toggle . $menu, ['class' => 'nav-item dropdown']);
    }
}
