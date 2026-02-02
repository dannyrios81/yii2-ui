<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

class StatCard extends BaseWidget
{
    public $icon;
    
    public $iconBg = 'primary';
    
    public $title;
    
    public $value;
    
    public $description = null;
    
    public $trend = null;
    
    public $trendValue = null;
    
    public $trendType = 'success';
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['card', 'stat-card', 'shadow-sm', 'rounded-3', 'h-100']);
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', ['class' => 'card-body p-4']);
        
        $parts[] = Html::beginTag('div', ['class' => 'd-flex justify-content-between align-items-start']);
        
        $parts[] = Html::beginTag('div');
        $parts[] = Html::tag('p', $this->title, ['class' => 'text-muted mb-2 small']);
        $parts[] = Html::tag('h3', $this->value, ['class' => 'mb-0 fw-bold']);
        
        if ($this->description !== null) {
            $parts[] = Html::tag('p', $this->description, ['class' => 'text-muted small mt-2 mb-0']);
        }
        
        if ($this->trend !== null && $this->trendValue !== null) {
            $trendClass = $this->trendType === 'success' ? 'text-success' : 'text-danger';
            $icon = $this->trendType === 'success' ? '↗' : '↘';
            $parts[] = Html::tag('div',
                Html::tag('span', $icon . ' ' . $this->trendValue, ['class' => $trendClass . ' small fw-bold']),
                ['class' => 'mt-2']
            );
        }
        
        $parts[] = Html::endTag('div');
        
        if ($this->icon !== null) {
            $iconHtml = Html::tag('div', $this->icon, [
                'class' => 'stat-icon bg-' . $this->iconBg . ' bg-opacity-10 text-' . $this->iconBg . ' rounded-3 p-3'
            ]);
            $parts[] = $iconHtml;
        }
        
        $parts[] = Html::endTag('div');
        
        $parts[] = Html::endTag('div');
        
        return Html::tag('div', implode("\n", $parts), $this->options);
    }
}
