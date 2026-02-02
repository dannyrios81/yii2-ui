<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

class DashboardLayout extends BaseWidget
{
    public $sidebar = null;
    
    public $header = null;
    
    public $content = null;
    
    public $footer = null;
    
    public $sidebarWidth = '280px';
    
    public $headerHeight = '70px';
    
    public $containerFluid = true;
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'dashboard-layout');
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        if ($this->content !== null) {
            $content = $this->content;
        }
        
        $parts = [];
        
        $parts[] = Html::beginTag('div', $this->options);
        
        if ($this->sidebar !== null) {
            $parts[] = Html::tag('div', $this->sidebar, [
                'class' => 'dashboard-sidebar',
                'style' => 'width: ' . $this->sidebarWidth
            ]);
        }
        
        $mainStyle = $this->sidebar !== null ? 'margin-left: ' . $this->sidebarWidth : '';
        $parts[] = Html::beginTag('div', ['class' => 'dashboard-main', 'style' => $mainStyle]);
        
        if ($this->header !== null) {
            $parts[] = Html::tag('div', $this->header, [
                'class' => 'dashboard-header bg-white border-bottom',
                'style' => 'height: ' . $this->headerHeight
            ]);
        }
        
        $containerClass = $this->containerFluid ? 'container-fluid' : 'container';
        $parts[] = Html::beginTag('div', ['class' => 'dashboard-content ' . $containerClass . ' py-4']);
        $parts[] = $content;
        $parts[] = Html::endTag('div');
        
        if ($this->footer !== null) {
            $parts[] = Html::tag('div', $this->footer, ['class' => 'dashboard-footer bg-white border-top py-3']);
        }
        
        $parts[] = Html::endTag('div');
        
        $parts[] = Html::endTag('div');
        
        return implode("\n", $parts);
    }
}
