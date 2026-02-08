<?php

namespace iguazoft\ui\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * BaseWidget is the base class for all iguazoft/yii2-ui widgets.
 *
 * It provides common options and container rendering shared by all dashboard widgets.
 *
 * @author Iguazoft <info@iguazoft.com>
 */
abstract class BaseWidget extends Widget
{
    /** @var array HTML attributes for the main widget tag */
    public $options = [];

    /** @var array HTML attributes for the optional container wrapper */
    public $containerOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'dashboard-widget');
    }

    /**
     * Renders content inside a container div.
     * @param string $content
     * @return string
     */
    protected function renderContainer($content)
    {
        return Html::tag('div', $content, $this->containerOptions);
    }
}
