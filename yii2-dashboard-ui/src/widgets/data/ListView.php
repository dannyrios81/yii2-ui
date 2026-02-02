<?php

namespace iguazoft\ui\widgets\data;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class ListView extends BaseWidget
{
    public $dataProvider;
    
    public $itemView;
    
    public $itemOptions = [];
    
    public $emptyText = 'No items found';
    
    public $separator = '';
    
    public $layout = '{items}';
    
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
