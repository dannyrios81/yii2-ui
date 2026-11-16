<?php

/**
 * @var yii\web\View $this
 * @var array $products
 */

use iguazoft\ui\DashboardAsset;
use iguazoft\ui\widgets\Button;
use iguazoft\ui\widgets\Chart;
use iguazoft\ui\widgets\DashboardLayout;
use iguazoft\ui\widgets\MetricCard;
use iguazoft\ui\widgets\ProductTable;
use iguazoft\ui\widgets\ReportCard;
use iguazoft\ui\widgets\Sidebar;
use iguazoft\ui\widgets\StatCard;

DashboardAsset::register($this);

$this->title = 'Dashboard';
?>

<?php DashboardLayout::begin([
    'sidebar' => Sidebar::widget([
        'user' => ['name' => 'Laura Gómez', 'role' => 'Store manager'],
        'mainMenu' => [
            ['label' => 'Dashboard', 'icon' => '<i class="bi bi-grid-1x2"></i>', 'url' => ['/dashboard'], 'active' => true],
            ['label' => 'Analytics', 'icon' => '<i class="bi bi-bar-chart-line"></i>', 'url' => ['/analytics']],
        ],
        'accountMenu' => [
            ['label' => 'Products', 'icon' => '<i class="bi bi-box-seam"></i>', 'url' => ['/products']],
            ['label' => 'Orders', 'icon' => '<i class="bi bi-receipt"></i>', 'url' => ['/orders']],
            ['label' => 'Customers', 'icon' => '<i class="bi bi-people"></i>', 'url' => ['/customers']],
        ],
        'otherMenu' => [
            ['label' => 'Settings', 'icon' => '<i class="bi bi-gear"></i>', 'url' => ['/settings']],
            ['label' => 'Help', 'icon' => '<i class="bi bi-question-circle"></i>', 'url' => ['/help']],
        ],
    ]),
    'header' => '<div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        <h2 class="mb-1">Dashboard</h2>
                        <p class="text-muted small mb-0">Sales overview for December</p>
                    </div>
                    ' . Button::widget([
                        'label' => 'Export',
                        'icon' => '<i class="bi bi-download"></i>',
                        'url' => ['/export'],
                        'type' => 'primary',
                    ]) . '
                 </div>',
]); ?>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <?= MetricCard::widget([
            'title' => 'December income',
            'value' => '287,000',
            'prefix' => '$',
            'tags' => ['Laptops', 'Phones'],
            'trend' => 'up',
            'trendValue' => '18.24%',
            'trendType' => 'success',
            'icon' => '<i class="bi bi-cash-stack fs-4"></i>',
        ]) ?>
    </div>

    <div class="col-md-4">
        <?= MetricCard::widget([
            'title' => 'December sales',
            'value' => '4.5k',
            'trend' => 'down',
            'trendValue' => '9.18%',
            'trendType' => 'danger',
            'icon' => '<i class="bi bi-bag-check fs-4"></i>',
        ]) ?>
    </div>

    <div class="col-md-4">
        <?= ReportCard::widget([
            'title' => 'December report',
            'description' => 'Review the key figures of the month before the planning meeting.',
            'primaryButton' => [
                'label' => 'Analyze',
                'url' => ['/reports/analyze'],
                'icon' => '<i class="bi bi-graph-up-arrow"></i>',
            ],
            'secondaryButton' => [
                'label' => 'Download',
                'url' => ['/reports/download'],
            ],
            'tabs' => ['Published', 'Draft'],
            'activeTab' => 0,
        ]) ?>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card dashboard-widget h-100">
            <div class="card-body p-4">
                <h5 class="mb-3">Revenue vs. last year</h5>
                <?= Chart::widget([
                    'type' => 'line',
                    'height' => '260px',
                    'data' => [
                        'labels' => ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        'datasets' => [
                            [
                                'label' => '2026',
                                'data' => [182, 196, 210, 238, 251, 287],
                                'borderColor' => 'rgb(99, 102, 241)',
                                'backgroundColor' => 'rgba(99, 102, 241, 0.12)',
                                'fill' => true,
                                'tension' => 0.35,
                            ],
                            [
                                'label' => '2025',
                                'data' => [160, 171, 168, 190, 205, 231],
                                'borderColor' => 'rgb(148, 163, 184)',
                                'borderDash' => [6, 4],
                                'tension' => 0.35,
                            ],
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-4 d-flex flex-column gap-4">
        <?= StatCard::widget([
            'title' => 'New customers',
            'value' => '1,284',
            'icon' => '<i class="bi bi-person-plus fs-4"></i>',
            'iconBg' => 'success',
            'trend' => 'up',
            'trendValue' => '6.4%',
        ]) ?>
        <?= StatCard::widget([
            'title' => 'Refunds',
            'value' => '32',
            'icon' => '<i class="bi bi-arrow-counterclockwise fs-4"></i>',
            'iconBg' => 'danger',
            'trend' => 'down',
            'trendValue' => '2.1%',
            'trendType' => 'danger',
        ]) ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?= ProductTable::widget([
            'dataProvider' => $products,
            'columns' => [
                ['label' => 'PRODUCT NAME', 'attribute' => 'name', 'contentOptions' => ['class' => 'fw-bold']],
                ['label' => 'FIRST STOCK', 'attribute' => 'first_stock', 'format' => 'stock', 'headerOptions' => ['style' => 'width: 150px;']],
                ['label' => 'SOLD', 'attribute' => 'sold', 'format' => 'sold', 'headerOptions' => ['style' => 'width: 120px;']],
                ['label' => 'DATE ADDED', 'attribute' => 'date', 'headerOptions' => ['style' => 'width: 150px;']],
                ['label' => 'PRICING', 'attribute' => 'price', 'format' => 'currency', 'headerOptions' => ['style' => 'width: 120px;']],
                ['label' => 'RATING', 'attribute' => 'rating', 'format' => 'rating', 'headerOptions' => ['style' => 'width: 100px;']],
            ],
        ]) ?>
    </div>
</div>

<?php DashboardLayout::end(); ?>
