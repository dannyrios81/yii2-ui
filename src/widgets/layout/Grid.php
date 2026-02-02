<?php

namespace iguazoft\ui\widgets\layout;

use iguazoft\ui\widgets\BaseWidget;
use yii\helpers\Html;

class Grid extends BaseWidget
{
    public $columns = 12;
    
    public $gap = 3;
    
    public $rowGap;
    
    public $columnGap;
    
    public $content;
    
    public function init()
    {
        parent::init();
        
        Html::addCssClass($this->options, 'd-grid');
        
        $style = [];
        $style[] = 'grid-template-columns: repeat(' . $this->columns . ', 1fr)';
        
        if ($this->rowGap !== null) {
            $style[] = 'row-gap: ' . $this->rowGap;
        } elseif ($this->gap !== null) {
            $style[] = 'gap: ' . $this->gap . 'rem';
        }
        
        if ($this->columnGap !== null) {
            $style[] = 'column-gap: ' . $this->columnGap;
        }
        
        $this->options['style'] = implode('; ', $style);
        
        ob_start();
    }
    
    public function run()
    {
        $content = ob_get_clean();
        
        if ($this->content !== null) {
            $content = $this->content;
        }
        
        return Html::tag('div', $content, $this->options);
    }
}
