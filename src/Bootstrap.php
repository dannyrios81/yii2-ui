<?php

namespace iguazoft\ui;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            $app->getAssetManager()->bundles[DashboardAsset::class] = [
                'class' => DashboardAsset::class,
            ];
        }
    }
}
