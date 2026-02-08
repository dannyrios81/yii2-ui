# Yii2 Dashboard UI

[![Latest Stable Version](https://poser.pugx.org/iguazoft/yii2-ui/v/stable)](https://packagist.org/packages/iguazoft/yii2-ui)
[![Total Downloads](https://poser.pugx.org/iguazoft/yii2-ui/downloads)](https://packagist.org/packages/iguazoft/yii2-ui)
[![License](https://poser.pugx.org/iguazoft/yii2-ui/license)](https://packagist.org/packages/iguazoft/yii2-ui)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue.svg)](https://php.net/)
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)

Extensión Yii2 con **40+ widgets** para crear interfaces de dashboard con Bootstrap 5, generadas completamente desde PHP.

## Requisitos

- PHP >= 7.4
- Yii2 >= 2.0.0
- yiisoft/yii2-bootstrap5

## Instalación

```bash
composer require iguazoft/yii2-ui
```

Registra los assets en tu layout:

```php
use iguazoft\ui\DashboardAsset;
DashboardAsset::register($this);
```

## Componentes

| Categoría | Widgets |
|-----------|---------|
| **Base** | Card, Button, Badge, Alert |
| **Dashboard** | DashboardLayout, Sidebar, MetricCard, ReportCard, ProductTable, StatCard, Chart |
| **Formularios** | Form, Input, Select, Checkbox, Radio, Textarea, FileUpload |
| **Navegación** | Navbar, Breadcrumb, Tabs, Pagination |
| **Datos** | DataTable, ListView, DetailView |
| **Feedback** | Modal, Toast, Progress, Spinner |
| **Layout** | Container, Row, Col, Grid, Divider |
| **Avanzados** | Dropdown, Accordion, Carousel, Timeline, Offcanvas |

## Uso

### MetricCard

```php
use iguazoft\ui\widgets\MetricCard;

<?= MetricCard::widget([
    'title' => 'December income',
    'value' => '287,000',
    'prefix' => '$',
    'trend' => 'up',
    'trendValue' => '18.24%',
    'trendType' => 'success',
    'icon' => '💰',
]) ?>
```

### DashboardLayout + Sidebar

```php
use iguazoft\ui\widgets\DashboardLayout;
use iguazoft\ui\widgets\Sidebar;

<?php DashboardLayout::begin([
    'sidebar' => Sidebar::widget([
        'user' => ['name' => 'Admin', 'role' => 'Manager'],
        'mainMenu' => [
            ['label' => 'Dashboard', 'icon' => '🏠', 'url' => ['/'], 'active' => true],
            ['label' => 'Analytics', 'icon' => '📊', 'url' => ['/analytics']],
        ],
    ]),
]); ?>
    <!-- content -->
<?php DashboardLayout::end(); ?>
```

### ProductTable

```php
use iguazoft\ui\widgets\ProductTable;

<?= ProductTable::widget([
    'dataProvider' => $products,
    'totalCount' => 120,
    'pageSize' => 10,
    'currentPage' => 1,
    'columns' => [
        ['label' => 'Name', 'attribute' => 'name'],
        ['label' => 'Price', 'attribute' => 'price', 'format' => 'currency'],
        ['label' => 'Rating', 'attribute' => 'rating', 'format' => 'rating'],
    ],
]) ?>
```

### Chart (Chart.js)

```php
use iguazoft\ui\widgets\Chart;

<?= Chart::widget([
    'type' => 'line',
    'data' => [
        'labels' => ['Jan', 'Feb', 'Mar'],
        'datasets' => [[
            'label' => 'Sales',
            'data' => [12, 19, 3],
            'borderColor' => 'rgb(99, 102, 241)',
        ]],
    ],
    'height' => '300px',
]) ?>
```

### Formularios

```php
use iguazoft\ui\widgets\forms\Form;
use iguazoft\ui\widgets\forms\Input;
use iguazoft\ui\widgets\forms\Select;

<?php Form::begin(['action' => ['/save'], 'title' => 'Create Product']); ?>
    <?= Input::widget(['name' => 'title', 'label' => 'Product Name', 'required' => true]) ?>
    <?= Select::widget(['name' => 'category', 'label' => 'Category', 'items' => $categories]) ?>
<?php Form::end(); ?>
```

### Más ejemplos

Ver la carpeta [`examples/`](examples/) para un dashboard completo funcional.

## Personalización

```css
:root {
    --dashboard-primary: #6366f1;
    --dashboard-success: #22c55e;
    --dashboard-danger: #ef4444;
}
```

Todos los widgets aceptan `options` para clases CSS personalizadas:

```php
<?= Card::widget(['title' => 'Custom', 'options' => ['class' => 'my-class']]) ?>
```

Para extender un widget:

```php
class MyCard extends \iguazoft\ui\widgets\Card
{
    public function init()
    {
        parent::init();
        // custom logic
    }
}
```

## Testing

```bash
composer install
vendor/bin/phpunit
```

## Contribuir

Ver [CONTRIBUTING.md](CONTRIBUTING.md).

## Soporte

- [GitHub Issues](https://github.com/dannyrios81/yii2-ui/issues)
- [CHANGELOG.md](CHANGELOG.md)

## Licencia

MIT
