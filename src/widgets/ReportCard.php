<?php

namespace iguazoft\ui\widgets;

use yii\helpers\Html;

/**
 * ReportCard renders a report-style card with title, description, action buttons, and tab navigation.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
class ReportCard extends BaseWidget
{
    /** @var string the report card title */
    public $title;

    /** @var string|null description text below the title */
    public $description;

    /** @var array|null primary action button config with keys: label, url, icon, options */
    public $primaryButton = null;

    /** @var array|null secondary action button config with keys: label, url, options */
    public $secondaryButton = null;

    /** @var array list of tab label strings */
    public $tabs = [];

    /** @var int zero-indexed active tab */
    public $activeTab = 0;
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['card', 'report-card', 'shadow-sm', 'rounded-3']);
    }
    
    public function run()
    {
        $parts = [];
        
        $parts[] = Html::beginTag('div', ['class' => 'card-body p-4']);
        
        $parts[] = Html::tag('h4', $this->title, ['class' => 'card-title mb-2']);
        
        if ($this->description !== null) {
            $parts[] = Html::tag('p', $this->description, ['class' => 'text-muted mb-4']);
        }
        
        if ($this->primaryButton !== null || $this->secondaryButton !== null) {
            $buttonsHtml = Html::beginTag('div', ['class' => 'd-flex gap-2 mb-3']);
            
            if ($this->primaryButton !== null) {
                $btnOptions = $this->primaryButton['options'] ?? [];
                Html::addCssClass($btnOptions, 'btn btn-primary');
                $icon = isset($this->primaryButton['icon']) ? $this->primaryButton['icon'] . ' ' : '';
                $buttonsHtml .= Html::a(
                    $icon . $this->primaryButton['label'],
                    $this->primaryButton['url'] ?? '#',
                    $btnOptions
                );
            }
            
            if ($this->secondaryButton !== null) {
                $btnOptions = $this->secondaryButton['options'] ?? [];
                Html::addCssClass($btnOptions, 'btn btn-outline-secondary');
                $buttonsHtml .= Html::a(
                    $this->secondaryButton['label'],
                    $this->secondaryButton['url'] ?? '#',
                    $btnOptions
                );
            }
            
            $buttonsHtml .= Html::endTag('div');
            $parts[] = $buttonsHtml;
        }
        
        if (!empty($this->tabs)) {
            $tabsHtml = Html::beginTag('div', ['class' => 'report-tabs']);
            foreach ($this->tabs as $index => $tab) {
                $tabClass = 'tab-item';
                if ($index === $this->activeTab) {
                    $tabClass .= ' active';
                }
                $tabsHtml .= Html::tag('span', $tab, ['class' => $tabClass]);
            }
            $tabsHtml .= Html::endTag('div');
            $parts[] = $tabsHtml;
        }
        
        $parts[] = Html::endTag('div');
        
        return Html::tag('div', implode("\n", $parts), $this->options);
    }
}
