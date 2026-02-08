<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

/**
 * MetricCard renders a dashboard metric card with value, trend indicator, tags, and optional chart.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class MetricCard extends BaseWidget
{
    /** @var string the metric title/label */
    public $title;

    /** @var string|int the main metric value */
    public $value;

    /** @var string prefix displayed before the value (e.g. '$') */
    public $prefix = '';

    /** @var string suffix displayed after the value (e.g. 'K') */
    public $suffix = '';

    /** @var array list of tag strings displayed as badges */
    public $tags = [];

    /** @var string|null HTML content for an inline chart area */
    public $chart = null;

    /** @var string|null trend direction indicator (up, down) */
    public $trend = null;

    /** @var string|null trend percentage or value text */
    public $trendValue = null;

    /** @var string trend type affecting color (success, danger) */
    public $trendType = 'success';

    /** @var string|null icon content (HTML or emoji) */
    public $icon = null;

    /** @var array HTML attributes for the icon container */
    public $iconOptions = [];
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['card', 'metric-card', 'shadow-sm', 'rounded-3', 'h-100']);
        Html::addCssClass($this->iconOptions, 'metric-icon');
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', ['class' => 'card-body p-4']);
        
        $header = Html::beginTag('div', ['class' => 'd-flex justify-content-between align-items-start mb-3']);
        $header .= Html::tag('div', Html::tag('p', $this->title, ['class' => 'text-muted small mb-2']), ['class' => 'flex-grow-1']);
        
        if ($this->icon !== null) {
            $header .= Html::tag('div', $this->icon, $this->iconOptions);
        }
        
        $header .= Html::endTag('div');
        $parts[] = $header;
        
        $valueHtml = Html::tag('h2', $this->prefix . $this->value . $this->suffix, ['class' => 'metric-value mb-3']);
        $parts[] = $valueHtml;
        
        if (!empty($this->tags)) {
            $tagsHtml = Html::beginTag('div', ['class' => 'metric-tags mb-3']);
            foreach ($this->tags as $tag) {
                $tagsHtml .= Html::tag('span', '# ' . $tag, ['class' => 'badge bg-light text-dark me-2']);
            }
            $tagsHtml .= Html::endTag('div');
            $parts[] = $tagsHtml;
        }
        
        if ($this->chart !== null) {
            $parts[] = Html::tag('div', $this->chart, ['class' => 'metric-chart mb-3']);
        }
        
        if ($this->trend !== null && $this->trendValue !== null) {
            $trendClass = 'metric-trend ';
            $trendClass .= $this->trendType === 'success' ? 'text-success' : 'text-danger';
            $icon = $this->trendType === 'success' ? '↗' : '↘';
            
            $trendHtml = Html::tag('div', 
                Html::tag('span', $icon . ' ' . $this->trendValue, ['class' => $trendClass . ' small fw-bold']),
                ['class' => 'mt-2']
            );
            $parts[] = $trendHtml;
        }
        
        $parts[] = Html::endTag('div');
        
        return Html::tag('div', implode("\n", $parts), $this->options);
    }
}
