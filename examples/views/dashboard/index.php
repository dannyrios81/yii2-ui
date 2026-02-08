<?php

use iguazoft\ui\widgets\DashboardLayout;
use iguazoft\ui\widgets\Sidebar;
use iguazoft\ui\widgets\MetricCard;
use iguazoft\ui\widgets\ReportCard;
use iguazoft\ui\widgets\ProductTable;
use iguazoft\ui\widgets\Button;
use iguazoft\ui\DashboardAsset;

DashboardAsset::register($this);

$this->title = 'Dashboard';
?>

<?php DashboardLayout::begin([
    'sidebar' => Sidebar::widget([
        'user' => [
            'name' => 'Wildan',
            'role' => 'Creative Director',
            'avatar' => '/images/avatar.jpg'
        ],
        'mainMenu' => [
            ['label' => 'Dashboard', 'icon' => '🏠', 'url' => ['/dashboard'], 'active' => true],
            ['label' => 'Analytics', 'icon' => '📊', 'url' => ['/analytics']],
        ],
        'accountMenu' => [
            ['label' => 'Account', 'icon' => '👤', 'url' => ['/account']],
            ['label' => 'My Publishing', 'icon' => '📄', 'url' => ['/publishing']],
            ['label' => 'Products', 'icon' => '📦', 'url' => ['/products']],
            ['label' => 'Orders', 'icon' => '▶️', 'url' => ['/orders']],
            ['label' => 'More', 'icon' => '⋯', 'url' => ['/more']],
        ],
        'otherMenu' => [
            ['label' => 'Setting', 'icon' => '⚙️', 'url' => ['/settings']],
            ['label' => 'Help', 'icon' => '❓', 'url' => ['/help']],
            ['label' => 'Subscriptions', 'icon' => '🔔', 'url' => ['/subscriptions']],
        ]
    ]),
    'header' => '<div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        <h2 class="mb-1">Dashboard</h2>
                        <p class="text-muted small mb-0">All general information appears in this field</p>
                    </div>
                    ' . Button::widget([
                        'label' => 'Export Now',
                        'url' => ['/export'],
                        'type' => 'primary'
                    ]) . '
                 </div>'
]); ?>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <?= MetricCard::widget([
            'title' => 'December income',
            'value' => '287,000',
            'prefix' => '$',
            'tags' => ['Macbook m2', 'iPhone 15'],
            'trend' => 'up',
            'trendValue' => '18.24%',
            'trendType' => 'success',
            'icon' => '💰',
            'options' => [
                'style' => 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;',
                'class' => 'border-0',
            ],
        ]) ?>
    </div>
    
    <div class="col-md-4">
        <?= MetricCard::widget([
            'title' => 'December sales',
            'value' => '4.5k',
            'trend' => 'down',
            'trendValue' => '9.18%',
            'trendType' => 'danger',
            'icon' => '📊'
        ]) ?>
    </div>
    
    <div class="col-md-4">
        <?= ReportCard::widget([
            'title' => 'December Report',
            'description' => 'Retrieve December report, analyze key data for informed strategic decisions.',
            'primaryButton' => [
                'label' => 'Analyze This',
                'url' => ['/reports/analyze'],
                'icon' => '🔗'
            ],
            'secondaryButton' => [
                'label' => 'Download',
                'url' => ['/reports/download']
            ],
            'tabs' => ['Published', 'Draft'],
            'activeTab' => 0
        ]) ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?= ProductTable::widget([
            'dataProvider' => $products,
            'columns' => [
                [
                    'label' => 'PRODUCT NAME',
                    'attribute' => 'name',
                    'contentOptions' => ['class' => 'fw-bold']
                ],
                [
                    'label' => 'FIRST STOCK',
                    'attribute' => 'first_stock',
                    'format' => 'stock',
                    'headerOptions' => ['style' => 'width: 150px;']
                ],
                [
                    'label' => 'SOLD',
                    'attribute' => 'sold',
                    'format' => 'sold',
                    'headerOptions' => ['style' => 'width: 120px;']
                ],
                [
                    'label' => 'DATE ADDED',
                    'attribute' => 'date',
                    'headerOptions' => ['style' => 'width: 150px;']
                ],
                [
                    'label' => 'PRICING',
                    'attribute' => 'price',
                    'format' => 'currency',
                    'headerOptions' => ['style' => 'width: 120px;']
                ],
                [
                    'label' => 'RATING',
                    'attribute' => 'rating',
                    'format' => 'rating',
                    'headerOptions' => ['style' => 'width: 100px;']
                ]
            ]
        ]) ?>
    </div>
</div>

<?php DashboardLayout::end(); ?>
