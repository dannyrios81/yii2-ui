<?php

namespace iguazoft\ui\widgets\advanced;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Accordion extends BaseWidget
{
    public $items = [];
    
    public $flush = false;
    
    public $alwaysOpen = false;
    
    public $activeItems = [];
    
    public function init()
    {
        parent::init();
        
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'accordion-' . uniqid();
        }
        
        Html::addCssClass($this->options, 'accordion');
        
        if ($this->flush) {
            Html::addCssClass($this->options, 'accordion-flush');
        }
    }
    
    public function run()
    {
        $items = [];
        
        foreach ($this->items as $index => $item) {
            $items[] = $this->renderItem($item, $index);
        }
        
        return Html::tag('div', implode("\n", $items), $this->options);
    }
    
    protected function renderItem($item, $index)
    {
        $itemId = $this->options['id'] . '-item-' . $index;
        $headerId = $itemId . '-header';
        $collapseId = $itemId . '-collapse';
        
        $isActive = in_array($index, $this->activeItems);
        
        $parts = [];
        
        $parts[] = Html::beginTag('div', ['class' => 'accordion-item']);
        
        $parts[] = Html::tag('h2',
            Html::button(
                $item['title'],
                [
                    'class' => 'accordion-button' . ($isActive ? '' : ' collapsed'),
                    'type' => 'button',
                    'data-bs-toggle' => 'collapse',
                    'data-bs-target' => '#' . $collapseId,
                    'aria-expanded' => $isActive ? 'true' : 'false',
                    'aria-controls' => $collapseId
                ]
            ),
            ['class' => 'accordion-header', 'id' => $headerId]
        );
        
        $collapseClass = 'accordion-collapse collapse' . ($isActive ? ' show' : '');
        $collapseOptions = [
            'id' => $collapseId,
            'class' => $collapseClass,
            'aria-labelledby' => $headerId
        ];
        
        if (!$this->alwaysOpen) {
            $collapseOptions['data-bs-parent'] = '#' . $this->options['id'];
        }
        
        $parts[] = Html::beginTag('div', $collapseOptions);
        $parts[] = Html::tag('div', $item['content'], ['class' => 'accordion-body']);
        $parts[] = Html::endTag('div');
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
