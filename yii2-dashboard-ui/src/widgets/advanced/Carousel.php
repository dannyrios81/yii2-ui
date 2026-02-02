<?php

namespace iguazoft\ui\widgets\advanced;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Carousel extends BaseWidget
{
    public $items = [];
    
    public $controls = true;
    
    public $indicators = true;
    
    public $fade = false;
    
    public $autoplay = true;
    
    public $interval = 5000;
    
    public $pause = 'hover';
    
    public function init()
    {
        parent::init();
        
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'carousel-' . uniqid();
        }
        
        Html::addCssClass($this->options, 'carousel slide');
        
        if ($this->fade) {
            Html::addCssClass($this->options, 'carousel-fade');
        }
        
        $this->options['data-bs-ride'] = $this->autoplay ? 'carousel' : 'false';
        
        if ($this->interval) {
            $this->options['data-bs-interval'] = $this->interval;
        }
        
        if ($this->pause) {
            $this->options['data-bs-pause'] = $this->pause;
        }
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->options);
        
        if ($this->indicators) {
            $parts[] = $this->renderIndicators();
        }
        
        $parts[] = $this->renderSlides();
        
        if ($this->controls) {
            $parts[] = $this->renderControls();
        }
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
    
    protected function renderIndicators()
    {
        $indicators = [];
        
        foreach ($this->items as $index => $item) {
            $class = $index === 0 ? 'active' : '';
            $indicators[] = Html::button('', [
                'type' => 'button',
                'data-bs-target' => '#' . $this->options['id'],
                'data-bs-slide-to' => $index,
                'class' => $class,
                'aria-current' => $index === 0 ? 'true' : 'false',
                'aria-label' => 'Slide ' . ($index + 1)
            ]);
        }
        
        return Html::tag('div', implode("\n", $indicators), ['class' => 'carousel-indicators']);
    }
    
    protected function renderSlides()
    {
        $slides = [];
        
        foreach ($this->items as $index => $item) {
            $class = 'carousel-item' . ($index === 0 ? ' active' : '');
            
            $content = '';
            
            if (isset($item['image'])) {
                $content .= Html::img($item['image'], ['class' => 'd-block w-100', 'alt' => $item['alt'] ?? '']);
            }
            
            if (isset($item['caption']) || isset($item['title'])) {
                $caption = Html::beginTag('div', ['class' => 'carousel-caption d-none d-md-block']);
                
                if (isset($item['title'])) {
                    $caption .= Html::tag('h5', $item['title']);
                }
                
                if (isset($item['caption'])) {
                    $caption .= Html::tag('p', $item['caption']);
                }
                
                $caption .= Html::endTag('div');
                $content .= $caption;
            }
            
            $slides[] = Html::tag('div', $content, ['class' => $class]);
        }
        
        return Html::tag('div', implode("\n", $slides), ['class' => 'carousel-inner']);
    }
    
    protected function renderControls()
    {
        $prev = Html::button(
            '<span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span>',
            [
                'class' => 'carousel-control-prev',
                'type' => 'button',
                'data-bs-target' => '#' . $this->options['id'],
                'data-bs-slide' => 'prev'
            ]
        );
        
        $next = Html::button(
            '<span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span>',
            [
                'class' => 'carousel-control-next',
                'type' => 'button',
                'data-bs-target' => '#' . $this->options['id'],
                'data-bs-slide' => 'next'
            ]
        );
        
        return $prev . $next;
    }
}
