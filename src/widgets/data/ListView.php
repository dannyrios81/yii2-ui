<?php

namespace iguazoft\ui\widgets\data;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

/**
 * ListView renders a list of items using a custom item view callback or template.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class ListView extends BaseWidget
{
    /** @var array the data items to display */
    public $dataProvider;

    /** @var callable|string item rendering callback receiving ($model, $index, $widget) */
    public $itemView;

    /** @var array HTML attributes for each item wrapper */
    public $itemOptions = [];

    /** @var string text displayed when dataProvider is empty */
    public $emptyText = 'No items found';

    /** @var string HTML separator between items */
    public $separator = '';

    /** @var string layout template. {items} is replaced with rendered items. */
    public $layout = '{items}';

    /** @var array additional parameters passed to the item view */
    public $viewParams = [];
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'list-view');
    }
    
    public function run()
    {
        if (empty($this->dataProvider)) {
            return Html::tag('div', $this->emptyText, ['class' => 'empty text-center text-muted py-5']);
        }
        
        $items = [];
        
        foreach ($this->dataProvider as $index => $model) {
            $items[] = $this->renderItem($model, $index);
        }
        
        $content = implode($this->separator, $items);
        
        return Html::tag('div', $content, $this->options);
    }
    
    protected function renderItem($model, $index)
    {
        if (is_callable($this->itemView)) {
            $content = call_user_func($this->itemView, $model, $index, $this);
        } else {
            $content = $this->itemView;
        }
        
        $itemOptions = is_callable($this->itemOptions)
            ? call_user_func($this->itemOptions, $model, $index)
            : $this->itemOptions;
        
        return Html::tag('div', $content, $itemOptions);
    }
}
