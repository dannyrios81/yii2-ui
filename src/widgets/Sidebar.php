<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;
use yii\helpers\Url;

class Sidebar extends BaseWidget
{
    public $user = [];
    
    public $mainMenu = [];
    
    public $accountMenu = [];
    
    public $otherMenu = [];
    
    public $searchEnabled = true;
    
    public $searchPlaceholder = 'Search';
    
    public $brandLogo = null;
    
    public $brandUrl = '/';
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['sidebar', 'bg-white', 'border-end', 'vh-100', 'position-fixed']);
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', ['class' => 'sidebar-content p-3']);
        
        if ($this->brandLogo !== null) {
            $parts[] = Html::a(
                Html::img($this->brandLogo, ['class' => 'brand-logo mb-4', 'alt' => 'Logo']),
                $this->brandUrl,
                ['class' => 'd-block']
            );
        }
        
        if (!empty($this->user)) {
            $parts[] = $this->renderUser();
        }
        
        if ($this->searchEnabled) {
            $parts[] = $this->renderSearch();
        }
        
        if (!empty($this->mainMenu)) {
            $parts[] = $this->renderMenu($this->mainMenu, 'main-menu');
        }
        
        if (!empty($this->accountMenu)) {
            $parts[] = Html::tag('div', 'ACCOUNT', ['class' => 'menu-section-title text-muted small mt-4 mb-2']);
            $parts[] = $this->renderMenu($this->accountMenu, 'account-menu');
        }
        
        if (!empty($this->otherMenu)) {
            $parts[] = Html::tag('div', 'OTHER MENU', ['class' => 'menu-section-title text-muted small mt-4 mb-2']);
            $parts[] = $this->renderMenu($this->otherMenu, 'other-menu');
        }
        
        $parts[] = Html::endTag('div');
        
        return Html::tag('div', implode("\n", $parts), $this->options);
    }
    
    protected function renderUser()
    {
        $html = Html::beginTag('div', ['class' => 'user-profile d-flex align-items-center mb-4 p-2']);
        
        if (isset($this->user['avatar'])) {
            $html .= Html::img($this->user['avatar'], ['class' => 'rounded-circle me-2', 'width' => 40, 'height' => 40]);
        }
        
        $html .= Html::beginTag('div');
        $html .= Html::tag('div', $this->user['name'] ?? 'User', ['class' => 'fw-bold']);
        if (isset($this->user['role'])) {
            $html .= Html::tag('div', $this->user['role'], ['class' => 'text-muted small']);
        }
        $html .= Html::endTag('div');
        
        $html .= Html::endTag('div');
        
        return $html;
    }
    
    protected function renderSearch()
    {
        $html = Html::beginTag('div', ['class' => 'sidebar-search mb-3']);
        $html .= Html::input('text', 'search', '', [
            'class' => 'form-control',
            'placeholder' => $this->searchPlaceholder
        ]);
        $html .= Html::endTag('div');
        
        return $html;
    }
    
    protected function renderMenu($items, $menuClass)
    {
        $html = Html::beginTag('ul', ['class' => 'nav flex-column ' . $menuClass]);
        
        foreach ($items as $item) {
            $html .= $this->renderMenuItem($item);
        }
        
        $html .= Html::endTag('ul');
        
        return $html;
    }
    
    protected function renderMenuItem($item)
    {
        $active = isset($item['active']) && $item['active'];
        $url = $item['url'] ?? '#';
        $label = $item['label'] ?? '';
        $icon = $item['icon'] ?? '';
        
        $linkClass = 'nav-link d-flex align-items-center';
        if ($active) {
            $linkClass .= ' active';
        }
        
        $content = '';
        if ($icon) {
            $content .= Html::tag('span', $icon, ['class' => 'nav-icon me-2']);
        }
        $content .= Html::tag('span', $label);
        
        $html = Html::beginTag('li', ['class' => 'nav-item']);
        $html .= Html::a($content, $url, ['class' => $linkClass]);
        $html .= Html::endTag('li');
        
        return $html;
    }
}
