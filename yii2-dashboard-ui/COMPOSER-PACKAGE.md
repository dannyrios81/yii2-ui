# Yii2 Dashboard UI - Composer Package

## 📦 Instalación

### Requisitos

- PHP >= 7.4
- Yii2 >= 2.0.0
- Composer

### Instalar vía Composer

```bash
composer require iguazoft/yii2-ui
```

### Instalar Versión Específica

```bash
# Última versión estable
composer require iguazoft/yii2-ui:^1.0

# Versión exacta
composer require iguazoft/yii2-ui:1.0.0

# Versión de desarrollo
composer require iguazoft/yii2-ui:dev-main
```

## 🚀 Inicio Rápido

### 1. Instalar el Paquete

```bash
composer require iguazoft/yii2-ui
```

### 2. Registrar Assets en tu Layout

En `views/layouts/main.php`:

```php
<?php
use dannyrios\dashboardui\DashboardAsset;

DashboardAsset::register($this);
?>
```

### 3. Usar Componentes

```php
use dannyrios\dashboardui\widgets\MetricCard;
use dannyrios\dashboardui\widgets\Button;

<?= MetricCard::widget([
    'title' => 'Total Sales',
    'value' => '287,000',
    'prefix' => '$',
]) ?>

<?= Button::widget([
    'label' => 'Export',
    'type' => 'primary',
]) ?>
```

## 📚 Componentes Disponibles

### Componentes Base (4)
```php
use dannyrios\dashboardui\widgets\{Card, Button, Badge, Alert};
```

### Dashboard (7)
```php
use dannyrios\dashboardui\widgets\{
    DashboardLayout,
    Sidebar,
    MetricCard,
    ReportCard,
    ProductTable,
    StatCard,
    Chart
};
```

### Formularios (7)
```php
use dannyrios\dashboardui\widgets\forms\{
    Form,
    Input,
    Select,
    Checkbox,
    Radio,
    Textarea,
    FileUpload
};
```

### Navegación (4)
```php
use dannyrios\dashboardui\widgets\navigation\{
    Navbar,
    Breadcrumb,
    Tabs,
    Pagination
};
```

### Datos (3)
```php
use dannyrios\dashboardui\widgets\data\{
    DataTable,
    ListView,
    DetailView
};
```

### Feedback (4)
```php
use dannyrios\dashboardui\widgets\feedback\{
    Modal,
    Toast,
    Progress,
    Spinner
};
```

### Layout (5)
```php
use dannyrios\dashboardui\widgets\layout\{
    Container,
    Row,
    Col,
    Grid,
    Divider
};
```

### Avanzados (5)
```php
use dannyrios\dashboardui\widgets\advanced\{
    Dropdown,
    Accordion,
    Carousel,
    Timeline,
    Offcanvas
};
```

## 🔧 Configuración

### Configuración Básica

No requiere configuración adicional. Los assets se registran automáticamente.

### Configuración Avanzada

Si necesitas personalizar los assets, puedes hacerlo en `config/web.php`:

```php
'components' => [
    'assetManager' => [
        'bundles' => [
            'dannyrios\dashboardui\DashboardAsset' => [
                'css' => [
                    'css/dashboard.css',
                    'css/custom.css', // Tu CSS personalizado
                ],
            ],
        ],
    ],
],
```

### Personalizar Colores

Crea un archivo CSS personalizado:

```css
/* web/css/custom-dashboard.css */
:root {
    --dashboard-primary: #your-color;
    --dashboard-success: #your-color;
}
```

Y regístralo en tu layout:

```php
$this->registerCssFile('@web/css/custom-dashboard.css', [
    'depends' => [dannyrios\dashboardui\DashboardAsset::class]
]);
```

## 📖 Ejemplos de Uso

### Dashboard Completo

```php
use dannyrios\dashboardui\widgets\DashboardLayout;
use dannyrios\dashboardui\widgets\Sidebar;
use dannyrios\dashboardui\widgets\MetricCard;

<?php DashboardLayout::begin([
    'sidebar' => Sidebar::widget([
        'user' => [
            'name' => 'Admin',
            'role' => 'Administrator',
        ],
        'mainMenu' => [
            ['label' => 'Dashboard', 'icon' => '🏠', 'url' => ['/'], 'active' => true],
            ['label' => 'Products', 'icon' => '📦', 'url' => ['/products']],
        ],
    ]),
]); ?>

<div class="row g-4">
    <div class="col-md-4">
        <?= MetricCard::widget([
            'title' => 'Total Sales',
            'value' => '287,000',
            'prefix' => '$',
            'trendValue' => '+18.24%',
            'trendType' => 'success',
        ]) ?>
    </div>
</div>

<?php DashboardLayout::end(); ?>
```

### Formulario

```php
use dannyrios\dashboardui\widgets\forms\{Form, Input, Select};

<?php Form::begin(['title' => 'Create Product']) ?>
    
    <?= Input::widget([
        'model' => $model,
        'attribute' => 'name',
        'required' => true,
    ]) ?>
    
    <?= Select::widget([
        'model' => $model,
        'attribute' => 'category_id',
        'items' => $categories,
        'prompt' => 'Select category',
    ]) ?>
    
<?php Form::end() ?>
```

### Tabla de Datos

```php
use dannyrios\dashboardui\widgets\ProductTable;

<?= ProductTable::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'Name', 'attribute' => 'name'],
        ['label' => 'Price', 'attribute' => 'price', 'format' => 'currency'],
        ['label' => 'Rating', 'attribute' => 'rating', 'format' => 'rating'],
    ],
    'selectable' => true,
]) ?>
```

## 🔄 Actualización

### Actualizar a Última Versión

```bash
composer update iguazoft/yii2-ui
```

### Ver Versión Instalada

```bash
composer show iguazoft/yii2-ui
```

### Ver Todas las Versiones Disponibles

```bash
composer show iguazoft/yii2-ui --all
```

## 🐛 Solución de Problemas

### El paquete no se encuentra

```bash
# Limpiar cache de Composer
composer clear-cache

# Intentar de nuevo
composer require iguazoft/yii2-ui
```

### Error de autoload

```bash
# Regenerar autoload
composer dump-autoload
```

### Conflictos de versión

```bash
# Ver árbol de dependencias
composer show --tree

# Actualizar todas las dependencias
composer update
```

### Assets no se cargan

1. Verifica que DashboardAsset esté registrado en tu layout
2. Limpia el cache de assets: `rm -rf web/assets/*`
3. Recarga la página

## 📦 Dependencias

Este paquete requiere:

- `yiisoft/yii2`: ~2.0.0
- `yiisoft/yii2-bootstrap5`: ~2.0.0

Se instalarán automáticamente con Composer.

## 🔗 Enlaces Útiles

- [Packagist](https://packagist.org/packages/iguazoft/yii2-ui)
- [GitHub Repository](https://github.com/iguazoft/yii2-ui)
- [Documentación Completa](https://github.com/iguazoft/yii2-ui/blob/main/README.md)
- [Changelog](https://github.com/iguazoft/yii2-ui/blob/main/CHANGELOG.md)
- [Issues](https://github.com/iguazoft/yii2-ui/issues)

## 📄 Licencia

MIT License - ver [LICENSE](LICENSE) para más detalles.

## 🤝 Contribuir

Ver [CONTRIBUTING.md](CONTRIBUTING.md) para guía de contribución.

## 📞 Soporte

- GitHub Issues: https://github.com/iguazoft/yii2-ui/issues
- Email: danny@example.com
