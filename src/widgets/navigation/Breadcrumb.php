<?php

namespace iguazoft\ui\widgets\navigation;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Breadcrumb extends BaseWidget
{
    public $items = [];
    
    public $homeLink = [
        'label' => 'Home',
        'url' => '/'
    ];
    
    public $showHome = true;
    
    public $separator = '/';
    
    public $activeItemTemplate = '<li class="breadcrumb-item active" aria-current="page">{label}</li>';
    
    public $itemTemplate = '<li class="breadcrumb-item">{link}</li>';
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'breadcrumb');
    }
    
    public function run()
    {
        $items = [];
        
        if ($this->showHome && $this->homeLink) {
            $items[] = str_replace(
                '{link}',
                Html::a($this->homeLink['label'], $this->homeLink['url']),
                $this->itemTemplate
            );
        }
        
        foreach ($this->items as $item) {
            if (isset($item['url'])) {
                $items[] = str_replace(
                    '{link}',
                    Html::a($item['label'], $item['url']),
                    $this->itemTemplate
                );
            } else {
                $items[] = str_replace(
                    '{label}',
                    $item['label'],
                    $this->activeItemTemplate
                );
            }
        }
        
        $breadcrumb = Html::tag('ol', implode("\n", $items), $this->options);
        
        return Html::tag('nav', $breadcrumb, ['aria-label' => 'breadcrumb']);
    }
}
