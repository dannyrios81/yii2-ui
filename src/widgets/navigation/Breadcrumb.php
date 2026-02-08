<?php

namespace iguazoft\ui\widgets\navigation;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Breadcrumb renders a Bootstrap 5 breadcrumb navigation component.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Breadcrumb extends BaseWidget
{
    /** @var array breadcrumb items. Each item: [label, url]. Last item without url is treated as active. */
    public $items = [];

    /** @var array home link config with keys: label, url */
    public $homeLink = [
        'label' => 'Home',
        'url' => '/'
    ];

    /** @var bool whether to show the home link */
    public $showHome = true;

    /** @var string separator character between items */
    public $separator = '/';

    /** @var string HTML template for the active (last) breadcrumb item */
    public $activeItemTemplate = '<li class="breadcrumb-item active" aria-current="page">{label}</li>';

    /** @var string HTML template for linked breadcrumb items */
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
