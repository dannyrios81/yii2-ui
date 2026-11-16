<?php

namespace iguazoft\ui\widgets;

use yii\data\DataProviderInterface;

/**
 * Lets table widgets accept a Yii data provider (ActiveDataProvider, ArrayDataProvider...)
 * as well as a plain array of rows.
 */
trait DataProviderTrait
{
    /**
     * Replaces a data provider by its models and takes its pagination and total count.
     */
    protected function resolveDataProvider()
    {
        if (!$this->dataProvider instanceof DataProviderInterface) {
            return;
        }

        $provider = $this->dataProvider;
        $models = $provider->getModels();
        $keys = $provider->getKeys();
        $this->dataProvider = $keys ? array_combine($keys, $models) : $models;

        if ($this->pagination === null && $provider->getPagination() !== false) {
            $this->pagination = $provider->getPagination();
        }
        if ($this->totalCount === null) {
            $this->totalCount = $provider->getTotalCount();
        }
    }
}
