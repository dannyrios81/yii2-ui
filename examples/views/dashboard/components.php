<?php

/**
 * @var yii\web\View $this
 */

use iguazoft\ui\DashboardAsset;
use iguazoft\ui\widgets\Alert;
use iguazoft\ui\widgets\Badge;
use iguazoft\ui\widgets\Card;
use iguazoft\ui\widgets\DashboardLayout;
use iguazoft\ui\widgets\Sidebar;
use iguazoft\ui\widgets\advanced\Accordion;
use iguazoft\ui\widgets\advanced\Timeline;
use iguazoft\ui\widgets\feedback\Progress;
use iguazoft\ui\widgets\forms\Checkbox;
use iguazoft\ui\widgets\forms\Form;
use iguazoft\ui\widgets\forms\Input;
use iguazoft\ui\widgets\forms\Select;
use iguazoft\ui\widgets\forms\Textarea;
use iguazoft\ui\widgets\navigation\Breadcrumb;
use iguazoft\ui\widgets\navigation\Pagination;
use iguazoft\ui\widgets\navigation\Tabs;

DashboardAsset::register($this);

$this->title = 'Components';
?>

<?php DashboardLayout::begin([
    'sidebar' => Sidebar::widget([
        'user' => ['name' => 'Laura Gómez', 'role' => 'Store manager'],
        'mainMenu' => [
            ['label' => 'Dashboard', 'icon' => '<i class="bi bi-grid-1x2"></i>', 'url' => ['/dashboard']],
            ['label' => 'Components', 'icon' => '<i class="bi bi-ui-checks-grid"></i>', 'url' => ['/dashboard/components'], 'active' => true],
        ],
    ]),
    'header' => '<div>'
        . Breadcrumb::widget(['items' => [['label' => 'Products', 'url' => ['/products']], 'New product']])
        . '<h2 class="mb-0">New product</h2></div>',
]); ?>

<div class="row g-4">
    <div class="col-lg-7">
        <?php Form::begin(['action' => ['/products/create'], 'title' => 'Product details', 'cancelButton' => true, 'cancelUrl' => ['/products'], 'submitLabel' => 'Save product']); ?>
            <div class="row">
                <div class="col-md-8">
                    <?= Input::widget(['name' => 'title', 'label' => 'Name', 'value' => 'Smartwatch Active 2', 'required' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= Input::widget(['name' => 'price', 'label' => 'Price', 'value' => '399', 'prepend' => '$', 'type' => 'number']) ?>
                </div>
            </div>
            <?= Select::widget([
                'name' => 'category',
                'label' => 'Category',
                'value' => 'wearables',
                'items' => ['laptops' => 'Laptops', 'phones' => 'Phones', 'wearables' => 'Wearables'],
            ]) ?>
            <?= Textarea::widget([
                'name' => 'description',
                'label' => 'Description',
                'rows' => 3,
                'maxlength' => 280,
                'showCounter' => true,
                'value' => 'GPS, heart-rate sensor and 7-day battery.',
            ]) ?>
            <?= Checkbox::widget(['name' => 'published', 'label' => 'Published', 'checked' => true, 'switch' => true]) ?>
        <?php Form::end(); ?>
    </div>

    <div class="col-lg-5 d-flex flex-column gap-4">
        <?= Alert::widget([
            'type' => 'success',
            'title' => 'Stock synced',
            'message' => '1,090 units imported from the warehouse.',
            'icon' => '<i class="bi bi-check-circle-fill"></i>',
        ]) ?>

        <?= Card::widget([
            'title' => 'Launch checklist',
            'content' => Progress::widget(['value' => 72, 'showLabel' => true, 'type' => 'success', 'height' => '10px'])
                . '<div class="d-flex flex-wrap gap-2 mt-3">'
                . Badge::widget(['label' => 'Photos', 'type' => 'success', 'pill' => true])
                . Badge::widget(['label' => 'Pricing', 'type' => 'success', 'pill' => true])
                . Badge::widget(['label' => 'SEO', 'type' => 'warning', 'pill' => true])
                . Badge::widget(['label' => 'Translations', 'type' => 'secondary', 'pill' => true, 'outline' => true])
                . '</div>',
        ]) ?>

        <?= Card::widget([
            'title' => 'Activity',
            'content' => Timeline::widget([
                'items' => [
                    ['time' => '10:42', 'title' => 'Price updated', 'content' => '$429 → $399', 'icon' => '<i class="bi bi-tag"></i>', 'color' => 'primary'],
                    ['time' => '09:15', 'title' => 'Photos approved', 'content' => '6 images', 'icon' => '<i class="bi bi-image"></i>', 'color' => 'success'],
                    ['time' => 'Yesterday', 'title' => 'Draft created', 'icon' => '<i class="bi bi-pencil"></i>', 'color' => 'secondary'],
                ],
            ]),
        ]) ?>
    </div>

    <div class="col-lg-7">
        <?= Card::widget([
            'title' => 'Variants',
            'content' => Tabs::widget([
                'pills' => true,
                'items' => [
                    ['label' => 'Colors', 'content' => '<p class="mt-3 mb-0 text-muted">Graphite, Silver, Ocean blue.</p>'],
                    ['label' => 'Sizes', 'content' => '<p class="mt-3 mb-0 text-muted">40 mm, 44 mm.</p>'],
                    ['label' => 'Bundles', 'content' => '<p class="mt-3 mb-0 text-muted">Extra strap, charger.</p>'],
                ],
            ]) . '<div class="mt-3">' . Pagination::widget(['totalPages' => 5, 'currentPage' => 2, 'size' => 'sm']) . '</div>',
        ]) ?>
    </div>

    <div class="col-lg-5">
        <?= Accordion::widget([
            'items' => [
                ['title' => 'Shipping', 'content' => 'Ships in 24 hours from the Bogotá warehouse.'],
                ['title' => 'Warranty', 'content' => '12 months.'],
                ['title' => 'Returns', 'content' => '30 days.'],
            ],
            'activeItems' => [0],
        ]) ?>
    </div>
</div>

<?php DashboardLayout::end(); ?>
