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
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; padding: 20px; height: 200px; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 20px; left: 20px; right: 20px; bottom: 20px;">
                <div style="color: white; opacity: 0.9; font-size: 14px; margin-bottom: 8px;">December income</div>
                <div style="color: white; font-size: 36px; font-weight: bold; margin-bottom: 12px;">$287,000</div>
                <div style="display: flex; gap: 8px; margin-bottom: 16px;">
                    <span style="background: rgba(255,255,255,0.2); color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px;"># Macbook m2</span>
                    <span style="background: rgba(255,255,255,0.2); color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px;"># iPhone 15</span>
                </div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 60px; background: rgba(255,255,255,0.1); border-radius: 8px;"></div>
                <div style="position: absolute; bottom: 10px; left: 10px; color: white; font-size: 12px; font-weight: bold;">↗ 18.24%</div>
            </div>
        </div>
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
