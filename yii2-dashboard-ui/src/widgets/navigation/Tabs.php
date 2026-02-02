<?php

namespace iguazoft\ui\widgets\navigation;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Tabs extends BaseWidget
{
    public $items = [];
    
    public $activeTab = 0;
    
    public $pills = false;
    
    public $vertical = false;
    
    public $justified = false;
    
    public $fill = false;
    
    public $navOptions = [];
    
    public $contentOptions = [];
    
    public function init()
    {
        parent::init();
        
        $navClass = $this->pills ? 'nav-pills' : 'nav-tabs';
        Html::addCssClass($this->navOptions, ['nav', $navClass]);
        
        if ($this->vertical) {
            Html::addCssClass($this->navOptions, 'flex-column');
        }
        
        if ($this->justified) {
            Html::addCssClass($this->navOptions, 'nav-justified');
        }
        
        if ($this->fill) {
            Html::addCssClass($this->navOptions, 'nav-fill');
        }
        
        Html::addCssClass($this->contentOptions, 'tab-content');
    }
    
    public function run()
    {
        $navItems = [];
        $contentPanes = [];
        
        foreach ($this->items as $index => $item) {
            $id = 'tab-' . uniqid() . '-' . $index;
            $active = $index === $this->activeTab;
            
            $navItemClass = 'nav-link';
            if ($active) {
                $navItemClass .= ' active';
            }
            if (isset($item['disabled']) && $item['disabled']) {
                $navItemClass .= ' disabled';
            }
            
            $navItems[] = Html::tag('li',
                Html::a(
                    $item['label'],
                    '#' . $id,
                    [
                        'class' => $navItemClass,
                        'data-bs-toggle' => 'tab',
                        'role' => 'tab',
                        'aria-controls' => $id,
                        'aria-selected' => $active ? 'true' : 'false'
                    ]
                ),
                ['class' => 'nav-item', 'role' => 'presentation']
            );
            
            $paneClass = 'tab-pane fade';
            if ($active) {
                $paneClass .= ' show active';
            }
            
            $contentPanes[] = Html::tag('div',
                $item['content'] ?? '',
                [
                    'class' => $paneClass,
                    'id' => $id,
                    'role' => 'tabpanel'
                ]
            );
        }
        
        $nav = Html::tag('ul', implode("\n", $navItems), array_merge($this->navOptions, ['role' => 'tablist']));
        $content = Html::tag('div', implode("\n", $contentPanes), $this->contentOptions);
        
        $wrapper = $this->vertical ? 'd-flex' : '';
        
        return Html::tag('div', $nav . "\n" . $content, ['class' => $wrapper]);
    }
}
