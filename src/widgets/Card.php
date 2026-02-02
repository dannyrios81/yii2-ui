<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

class Card extends BaseWidget
{
    public $title;
    
    public $subtitle;
    
    public $content;
    
    public $footer;
    
    public $headerOptions = [];
    
    public $bodyOptions = [];
    
    public $footerOptions = [];
    
    public $shadow = true;
    
    public $rounded = true;
    
    public function init()
    {
        parent::init();
        $this->initDefaultOptions();
        
        Html::addCssClass($this->options, 'card');
        
        if ($this->shadow) {
            Html::addCssClass($this->options, 'shadow-sm');
        }
        
        if ($this->rounded) {
            Html::addCssClass($this->options, 'rounded-3');
        }
        
        Html::addCssClass($this->headerOptions, 'card-header');
        Html::addCssClass($this->bodyOptions, 'card-body');
        Html::addCssClass($this->footerOptions, 'card-footer');
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        if ($this->content !== null) {
            $content = $this->content;
        }
        
        $parts = [];
        
        if ($this->title !== null || $this->subtitle !== null) {
            $header = '';
            if ($this->title !== null) {
                $header .= Html::tag('h5', $this->title, ['class' => 'card-title mb-1']);
            }
            if ($this->subtitle !== null) {
                $header .= Html::tag('p', $this->subtitle, ['class' => 'card-subtitle text-muted small']);
            }
            $parts[] = Html::tag('div', $header, $this->headerOptions);
        }
        
        if ($content !== null && $content !== '') {
            $parts[] = Html::tag('div', $content, $this->bodyOptions);
        }
        
        if ($this->footer !== null) {
            $parts[] = Html::tag('div', $this->footer, $this->footerOptions);
        }
        
        return Html::tag('div', implode("\n", $parts), $this->options);
    }
}
