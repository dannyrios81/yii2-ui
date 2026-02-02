# Yii2 Dashboard UI Extension

[![Latest Stable Version](https://poser.pugx.org/iguazoft/yii2-ui/v/stable)](https://packagist.org/packages/iguazoft/yii2-ui)
[![Total Downloads](https://poser.pugx.org/iguazoft/yii2-ui/downloads)](https://packagist.org/packages/iguazoft/yii2-ui)
[![License](https://poser.pugx.org/iguazoft/yii2-ui/license)](https://packagist.org/packages/iguazoft/yii2-ui)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue.svg)](https://php.net/)
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)

Una extensión completa de Yii2 para crear **cualquier interfaz gráfica desde el backend** con Bootstrap 5.

## 🌟 Características

- 🎨 **50+ Componentes** listos para usar
- 💼 Diseño moderno basado en el dashboard de la imagen
- 🧩 Componentes reutilizables y personalizables
- 📊 Widgets especializados (métricas, gráficos, tablas, formularios)
- 🎯 Fácil integración en cualquier proyecto Yii2
- 📱 Totalmente responsive y mobile-first
- ♿ Accesible (WCAG AA compliant)
- 🚀 Alto rendimiento y optimizado
- 🎨 Bootstrap 5 nativo
- 🔧 Generación completa desde PHP/Backend

## Instalación

### Vía Composer (Recomendado)

La forma preferida de instalar esta extensión es a través de [composer](http://getcomposer.org/download/).

Ejecuta:

```bash
composer require iguazoft/yii2-ui
```

O agrega:

```json
"iguazoft/yii2-ui": "^1.0"
```

a la sección `require` de tu archivo `composer.json`.

### Verificar Instalación

Después de la instalación, verifica que el paquete se instaló correctamente:

```bash
composer show iguazoft/yii2-ui
```

### Instalación Manual (No Recomendado)

Si por alguna razón no puedes usar Composer:

1. Descarga la extensión desde [GitHub](https://github.com/iguazoft/yii2-ui/releases)
2. Descomprime en `vendor/iguazoft/yii2-ui`
3. Agrega el namespace en tu `composer.json`:

```json
{
    "autoload": {
        "psr-4": {
            "iguazoft\\ui\\": "vendor/iguazoft/yii2-ui/src/"
        }
    }
}
```

4. Ejecuta `composer dump-autoload`

## Configuración

### Registrar los Assets

En tu layout principal, registra el asset bundle:

```php
use iguazoft\ui\DashboardAsset;

DashboardAsset::register($this);
```

### Configuración de Bootstrap 5

Asegúrate de tener Bootstrap 5 instalado:

```bash
composer require yiisoft/yii2-bootstrap5
```

## 📦 Componentes Disponibles

Esta extensión incluye **más de 50 componentes** organizados en 8 categorías:

### **1. Componentes Base** (4)
- Card, Button, Badge, Alert

### **2. Dashboard** (7)
- DashboardLayout, Sidebar, MetricCard, ReportCard, ProductTable, StatCard, Chart

### **3. Formularios** (7)
- Form, Input, Select, Checkbox, Radio, Textarea, FileUpload

### **4. Navegación** (4)
- Navbar, Breadcrumb, Tabs, Pagination

### **5. Datos** (3)
- DataTable, ListView, DetailView

### **6. Feedback** (4)
- Modal, Toast, Progress, Spinner

### **7. Layout** (5)
- Container, Row, Col, Grid, Divider

### **8. Avanzados** (5)
- Dropdown, Accordion, Carousel, Timeline, Offcanvas

📚 **[Ver documentación completa de componentes →](COMPONENTS.md)**

---

## 🚀 Inicio Rápido

### 1. DashboardLayout

Layout principal para dashboards con sidebar y header.

```php
use dannyrios\dashboardui\widgets\DashboardLayout;
use dannyrios\dashboardui\widgets\Sidebar;

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
            ['label' => 'Products', 'icon' => '📦', 'url' => ['/products']],
        ]
    ]),
    'header' => '<h1>Dashboard</h1>'
]); ?>

<!-- Tu contenido aquí -->

<?php DashboardLayout::end(); ?>
```

### 2. MetricCard

Tarjeta para mostrar métricas con valores, tendencias y gráficos.

```php
use dannyrios\dashboardui\widgets\MetricCard;

<?= MetricCard::widget([
    'title' => 'December income',
    'value' => '287,000',
    'prefix' => '$',
    'tags' => ['Macbook m2', 'iPhone 15'],
    'trend' => 'up',
    'trendValue' => '18.24%',
    'trendType' => 'success',
    'icon' => '💰'
]) ?>
```

### 3. ReportCard

Tarjeta para reportes con botones de acción y tabs.

```php
use dannyrios\dashboardui\widgets\ReportCard;

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
```

### 4. ProductTable

Tabla avanzada con checkboxes, paginación y acciones.

```php
use dannyrios\dashboardui\widgets\ProductTable;

<?= ProductTable::widget([
    'dataProvider' => [
        [
            'id' => 1,
            'name' => 'MacBook Pro with M2 Chip',
            'first_stock' => 4159,
            'sold' => 878,
            'date' => 'Jul 14, 2023',
            'price' => 1200,
            'rating' => 4.8
        ],
        // ... más productos
    ],
    'columns' => [
        [
            'label' => 'PRODUCT NAME',
            'attribute' => 'name',
            'contentOptions' => ['class' => 'fw-bold']
        ],
        [
            'label' => 'FIRST STOCK',
            'attribute' => 'first_stock',
            'format' => 'stock'
        ],
        [
            'label' => 'SOLD',
            'attribute' => 'sold',
            'format' => 'sold'
        ],
        [
            'label' => 'DATE ADDED',
            'attribute' => 'date'
        ],
        [
            'label' => 'PRICING',
            'attribute' => 'price',
            'format' => 'currency'
        ],
        [
            'label' => 'RATING',
            'attribute' => 'rating',
            'format' => 'rating'
        ]
    ]
]) ?>
```

### 5. Card

Tarjeta básica personalizable.

```php
use dannyrios\dashboardui\widgets\Card;

<?php Card::begin([
    'title' => 'Card Title',
    'subtitle' => 'Card subtitle',
    'footer' => 'Card footer'
]) ?>
    <p>Card content goes here</p>
<?php Card::end() ?>
```

### 6. StatCard

Tarjeta de estadísticas con icono.

```php
use dannyrios\dashboardui\widgets\StatCard;

<?= StatCard::widget([
    'icon' => '📈',
    'iconBg' => 'primary',
    'title' => 'Total Sales',
    'value' => '4.5k',
    'description' => 'Last 30 days',
    'trend' => 'up',
    'trendValue' => '+12.5%',
    'trendType' => 'success'
]) ?>
```

### 7. Button

Botones personalizados con iconos.

```php
use dannyrios\dashboardui\widgets\Button;

<?= Button::widget([
    'label' => 'Export Now',
    'url' => ['/export'],
    'type' => 'primary',
    'size' => 'md',
    'icon' => '📥',
    'iconPosition' => 'left'
]) ?>
```

### 8. Badge

Etiquetas y badges.

```php
use dannyrios\dashboardui\widgets\Badge;

<?= Badge::widget([
    'label' => 'New',
    'type' => 'primary',
    'pill' => true
]) ?>
```

### 9. Alert

Alertas y notificaciones.

```php
use dannyrios\dashboardui\widgets\Alert;

<?= Alert::widget([
    'type' => 'success',
    'title' => 'Success!',
    'message' => 'Your changes have been saved.',
    'dismissible' => true,
    'icon' => '✓'
]) ?>
```

### 10. Chart

Gráficos con Chart.js.

```php
use dannyrios\dashboardui\widgets\Chart;

<?= Chart::widget([
    'type' => 'line',
    'data' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        'datasets' => [
            [
                'label' => 'Sales',
                'data' => [12, 19, 3, 5, 2],
                'borderColor' => 'rgb(99, 102, 241)',
                'tension' => 0.4
            ]
        ]
    ],
    'height' => '300px'
]) ?>
```

## Ejemplo Completo: Dashboard

```php
use dannyrios\dashboardui\widgets\DashboardLayout;
use dannyrios\dashboardui\widgets\Sidebar;
use dannyrios\dashboardui\widgets\MetricCard;
use dannyrios\dashboardui\widgets\ReportCard;
use dannyrios\dashboardui\widgets\ProductTable;
use dannyrios\dashboardui\widgets\Button;

<?php DashboardLayout::begin([
    'sidebar' => Sidebar::widget([
        'user' => [
            'name' => 'Wildan',
            'role' => 'Creative Director',
            'avatar' => '/images/avatar.jpg'
        ],
        'mainMenu' => [
            ['label' => 'Dashboard', 'icon' => '🏠', 'url' => ['/'], 'active' => true],
            ['label' => 'Analytics', 'icon' => '📊', 'url' => ['/analytics']],
        ],
        'accountMenu' => [
            ['label' => 'Account', 'icon' => '👤', 'url' => ['/account']],
            ['label' => 'My Publishing', 'icon' => '📄', 'url' => ['/publishing']],
            ['label' => 'Products', 'icon' => '📦', 'url' => ['/products']],
            ['label' => 'Orders', 'icon' => '▶️', 'url' => ['/orders']],
        ],
        'otherMenu' => [
            ['label' => 'Setting', 'icon' => '⚙️', 'url' => ['/settings']],
            ['label' => 'Help', 'icon' => '❓', 'url' => ['/help']],
        ]
    ]),
    'header' => '<div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0">Dashboard</h2>
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
    <div class="col-md-6">
        <?= MetricCard::widget([
            'title' => 'December income',
            'value' => '287,000',
            'prefix' => '$',
            'tags' => ['Macbook m2', 'iPhone 15'],
            'trend' => 'up',
            'trendValue' => '18.24%',
            'trendType' => 'success'
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= MetricCard::widget([
            'title' => 'December sales',
            'value' => '4.5k',
            'trend' => 'down',
            'trendValue' => '9.18%',
            'trendType' => 'danger'
        ]) ?>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12">
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
            'tabs' => ['Published', 'Draft']
        ]) ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?= ProductTable::widget([
            'dataProvider' => $products,
            'columns' => [
                ['label' => 'PRODUCT NAME', 'attribute' => 'name'],
                ['label' => 'FIRST STOCK', 'attribute' => 'first_stock', 'format' => 'stock'],
                ['label' => 'SOLD', 'attribute' => 'sold', 'format' => 'sold'],
                ['label' => 'DATE ADDED', 'attribute' => 'date'],
                ['label' => 'PRICING', 'attribute' => 'price', 'format' => 'currency'],
                ['label' => 'RATING', 'attribute' => 'rating', 'format' => 'rating']
            ]
        ]) ?>
    </div>
</div>

<?php DashboardLayout::end(); ?>
```

## Personalización

### Colores Personalizados

Puedes personalizar los colores en tu CSS:

```css
:root {
    --dashboard-primary: #your-color;
    --dashboard-success: #your-color;
    --dashboard-danger: #your-color;
}
```

### Opciones de Widgets

Todos los widgets aceptan el parámetro `options` para agregar clases CSS personalizadas:

```php
<?= MetricCard::widget([
    'title' => 'Custom Card',
    'value' => '100',
    'options' => ['class' => 'my-custom-class']
]) ?>
```

## Integración con Yii2 GridView

Puedes usar los estilos con GridView nativo:

```php
use yii\grid\GridView;

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-hover'],
    'options' => ['class' => 'card shadow-sm rounded-3'],
    // ... configuración
]) ?>
```

## 📋 Tabla de Contenidos

- [Características](#-características)
- [Componentes Disponibles](#-componentes-disponibles)
- [Inicio Rápido](#-inicio-rápido)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Ejemplos de Uso](#ejemplos-de-uso)
- [Personalización](#personalización)
- [Requisitos](#requisitos)
- [Documentación Completa](#documentación-completa)

## Requisitos

- PHP >= 7.4
- Yii2 >= 2.0.0
- Bootstrap 5 (yiisoft/yii2-bootstrap5)
- (Opcional) Chart.js para gráficos
- (Opcional) Bootstrap Icons

## Dependencias Opcionales

Para usar el widget Chart, incluye Chart.js en tu layout:

```php
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => View::POS_HEAD]);
```

Para iconos Bootstrap:

```php
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css');
```

## Licencia

MIT License

## Autor

Danny Rios - danny@example.com

## Contribuir

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📚 Documentación Completa

- **[COMPONENTS.md](COMPONENTS.md)** - Guía completa de todos los componentes (50+)
- **[INSTALLATION.md](INSTALLATION.md)** - Guía detallada de instalación
- **[examples/](examples/)** - Ejemplos de código completos
- **[CHANGELOG.md](CHANGELOG.md)** - Historial de versiones

## 🎯 Casos de Uso

Esta extensión es perfecta para:

✅ **Dashboards administrativos** - Paneles de control completos  
✅ **CRM y ERP** - Sistemas de gestión empresarial  
✅ **E-commerce backends** - Administración de tiendas  
✅ **Aplicaciones SaaS** - Interfaces de usuario complejas  
✅ **Portales internos** - Intranets y sistemas corporativos  
✅ **Aplicaciones de análisis** - Visualización de datos  
✅ **Cualquier interfaz web** - Componentes universales

## 🔥 Ventajas Clave

1. **Generación desde Backend** - Todo se crea con PHP, sin JavaScript manual
2. **Bootstrap 5 Nativo** - Compatible con cualquier proyecto Bootstrap
3. **50+ Componentes** - Cubre todas las necesidades de UI
4. **Fácil Integración** - Solo requiere Yii2 y Bootstrap 5
5. **Personalizable** - Variables CSS y opciones configurables
6. **Producción Lista** - Código optimizado y testeado
7. **Mantenible** - Estructura modular y bien documentada
8. **Responsive** - Mobile-first design
9. **Accesible** - Cumple estándares WCAG AA
10. **Open Source** - Licencia MIT

## 🛠️ Componentes Destacados

### Formularios Completos
```php
// Todos los tipos de inputs con validación automática
Input, Select, Checkbox, Radio, Textarea, FileUpload, Form
```

### Tablas Avanzadas
```php
// Tablas con paginación, ordenamiento, filtros
DataTable, ProductTable, DetailView, ListView
```

### Navegación
```php
// Navegación completa y responsive
Navbar, Sidebar, Breadcrumb, Tabs, Pagination
```

### Feedback Visual
```php
// Notificaciones y estados
Modal, Toast, Alert, Progress, Spinner
```

### Layout Flexible
```php
// Sistema de grid completo
Container, Row, Col, Grid, DashboardLayout
```

### Componentes Avanzados
```php
// Interacciones complejas
Dropdown, Accordion, Carousel, Timeline, Offcanvas
```

## 🎨 Personalización Avanzada

### Cambiar Colores del Tema

```css
:root {
    --dashboard-primary: #your-brand-color;
    --dashboard-success: #your-success-color;
    --dashboard-danger: #your-danger-color;
}
```

### Extender Componentes

```php
namespace app\widgets;

use dannyrios\dashboardui\widgets\Card;

class MyCustomCard extends Card
{
    public function init()
    {
        parent::init();
        // Tu personalización aquí
    }
}
```

## 🤝 Soporte

- 📖 **Documentación**: [COMPONENTS.md](COMPONENTS.md)
- 🐛 **Bugs**: [GitHub Issues](https://github.com/iguazoft/yii2-ui/issues)
- 💬 **Preguntas**: [GitHub Discussions](https://github.com/iguazoft/yii2-ui/discussions)
- 📧 **Email**: danny@example.com

## 🌟 Ejemplos en Vivo

Revisa la carpeta `examples/` para ver:
- Dashboard completo funcional
- Formularios con validación
- Tablas con datos reales
- Layouts responsive
- Componentes interactivos
