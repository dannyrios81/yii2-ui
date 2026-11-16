<?php

namespace iguazoft\ui;

use yii\web\AssetBundle;

/**
 * Bootstrap Icons (https://icons.getbootstrap.com), loaded from jsDelivr.
 *
 * Several widgets render `<i class="bi bi-...">` icons, and every `icon` option accepts
 * HTML, so `'icon' => '<i class="bi bi-graph-up"></i>'` works out of the box.
 *
 * To serve the icons yourself, override the bundle in your asset manager config:
 *
 * ```php
 * 'assetManager' => [
 *     'bundles' => [
 *         \iguazoft\ui\BootstrapIconsAsset::class => [
 *             'sourcePath' => '@npm/bootstrap-icons/font',
 *             'css' => ['bootstrap-icons.min.css'],
 *         ],
 *     ],
 * ],
 * ```
 */
class BootstrapIconsAsset extends AssetBundle
{
    public $css = [
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.2/font/bootstrap-icons.min.css',
    ];
}
