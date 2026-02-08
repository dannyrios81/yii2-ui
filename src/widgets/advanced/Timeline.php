<?php

namespace iguazoft\ui\widgets\advanced;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * Timeline renders a vertical timeline with icons, titles, content, and timestamps.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class Timeline extends BaseWidget
{
    /** @var array timeline items. Each item: [title, content, time, icon, color] */
    public $items = [];

    /** @var string timeline alignment (left, center) */
    public $align = 'left';

    /** @var string icon shape type (circle) */
    public $iconType = 'circle';
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'timeline timeline-' . $this->align);
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
        $parts = [];
        
        $parts[] = Html::beginTag('div', ['class' => 'timeline-item']);
        
        $iconClass = 'timeline-icon bg-' . ($item['color'] ?? 'primary');
        $icon = $item['icon'] ?? '';
        $parts[] = Html::tag('div', $icon, ['class' => $iconClass]);
        
        $parts[] = Html::beginTag('div', ['class' => 'timeline-content']);
        
        if (isset($item['time'])) {
            $parts[] = Html::tag('div', $item['time'], ['class' => 'timeline-time text-muted small']);
        }
        
        if (isset($item['title'])) {
            $parts[] = Html::tag('h5', $item['title'], ['class' => 'timeline-title']);
        }
        
        if (isset($item['content'])) {
            $parts[] = Html::tag('div', $item['content'], ['class' => 'timeline-body']);
        }
        
        $parts[] = Html::endTag('div');
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
