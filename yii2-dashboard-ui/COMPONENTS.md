# Guía Completa de Componentes

Esta extensión incluye **50+ componentes** organizados en categorías para crear cualquier interfaz desde el backend.

## 📋 Índice de Componentes

### 1. Componentes Base
- [Card](#card) - Tarjetas genéricas
- [Button](#button) - Botones con variantes
- [Badge](#badge) - Etiquetas y badges
- [Alert](#alert) - Alertas y notificaciones

### 2. Componentes de Dashboard
- [DashboardLayout](#dashboardlayout) - Layout completo
- [Sidebar](#sidebar) - Navegación lateral
- [MetricCard](#metriccard) - Tarjetas de métricas
- [ReportCard](#reportcard) - Tarjetas de reportes
- [ProductTable](#producttable) - Tabla de productos
- [StatCard](#statcard) - Tarjetas de estadísticas
- [Chart](#chart) - Gráficos

### 3. Formularios
- [Form](#form) - Formulario completo
- [Input](#input) - Campos de texto
- [Select](#select) - Listas desplegables
- [Checkbox](#checkbox) - Casillas de verificación
- [Radio](#radio) - Botones de radio
- [Textarea](#textarea) - Áreas de texto
- [FileUpload](#fileupload) - Carga de archivos

### 4. Navegación
- [Navbar](#navbar) - Barra de navegación
- [Breadcrumb](#breadcrumb) - Migas de pan
- [Tabs](#tabs) - Pestañas
- [Pagination](#pagination) - Paginación

### 5. Datos
- [DataTable](#datatable) - Tabla de datos
- [ListView](#listview) - Vista de lista
- [DetailView](#detailview) - Vista de detalles

### 6. Feedback
- [Modal](#modal) - Ventanas modales
- [Toast](#toast) - Notificaciones toast
- [Progress](#progress) - Barras de progreso
- [Spinner](#spinner) - Indicadores de carga

### 7. Layout
- [Container](#container) - Contenedor
- [Row](#row) - Fila
- [Col](#col) - Columna
- [Grid](#grid) - Grid CSS
- [Divider](#divider) - Divisor

### 8. Avanzados
- [Dropdown](#dropdown) - Menús desplegables
- [Accordion](#accordion) - Acordeón
- [Carousel](#carousel) - Carrusel
- [Timeline](#timeline) - Línea de tiempo
- [Offcanvas](#offcanvas) - Panel lateral

---

## Componentes Base

### Card

Tarjeta genérica personalizable.

```php
use dannyrios\dashboardui\widgets\Card;

<?php Card::begin([
    'title' => 'Card Title',
    'subtitle' => 'Card subtitle',
    'footer' => 'Card footer',
    'shadow' => true,
    'rounded' => true
]) ?>
    <p>Card content goes here</p>
<?php Card::end() ?>
```

**Propiedades:**
- `title` - Título de la tarjeta
- `subtitle` - Subtítulo
- `content` - Contenido (alternativa a usar begin/end)
- `footer` - Pie de tarjeta
- `shadow` - Agregar sombra (default: true)
- `rounded` - Bordes redondeados (default: true)

### Button

Botones con iconos y variantes.

```php
use dannyrios\dashboardui\widgets\Button;

<?= Button::widget([
    'label' => 'Click Me',
    'url' => ['/action'],
    'type' => 'primary', // primary, secondary, success, danger, warning, info
    'size' => 'md', // sm, md, lg
    'icon' => '🚀',
    'iconPosition' => 'left', // left, right
    'outline' => false,
    'rounded' => true,
    'block' => false
]) ?>
```

### Badge

Etiquetas y badges.

```php
use dannyrios\dashboardui\widgets\Badge;

<?= Badge::widget([
    'label' => 'New',
    'type' => 'primary',
    'pill' => true,
    'outline' => false
]) ?>
```

### Alert

Alertas y notificaciones.

```php
use dannyrios\dashboardui\widgets\Alert;

<?= Alert::widget([
    'type' => 'success', // success, danger, warning, info
    'title' => 'Success!',
    'message' => 'Your changes have been saved.',
    'dismissible' => true,
    'icon' => '✓'
]) ?>
```

---

## Formularios

### Form

Formulario completo con validación.

```php
use dannyrios\dashboardui\widgets\forms\Form;

<?php Form::begin([
    'action' => ['/submit'],
    'method' => 'post',
    'title' => 'User Registration',
    'description' => 'Please fill in your details',
    'submitButton' => true,
    'submitLabel' => 'Register',
    'resetButton' => true,
    'cancelButton' => true,
    'cancelUrl' => ['/cancel'],
    'validated' => true
]) ?>

    <!-- Campos del formulario aquí -->

<?php Form::end() ?>
```

### Input

Campos de texto con validación.

```php
use dannyrios\dashboardui\widgets\forms\Input;

<?= Input::widget([
    'model' => $model,
    'attribute' => 'username',
    'type' => 'text', // text, email, password, number, tel, url
    'label' => 'Username',
    'placeholder' => 'Enter username',
    'hint' => 'Min 3 characters',
    'required' => true,
    'size' => 'md', // sm, md, lg
    'prepend' => '@', // Texto antes del input
    'append' => '.com' // Texto después del input
]) ?>
```

### Select

Listas desplegables.

```php
use dannyrios\dashboardui\widgets\forms\Select;

<?= Select::widget([
    'model' => $model,
    'attribute' => 'country',
    'items' => [
        'us' => 'United States',
        'mx' => 'Mexico',
        'ca' => 'Canada'
    ],
    'prompt' => 'Select a country',
    'multiple' => false,
    'required' => true
]) ?>
```

### Checkbox

Casillas de verificación.

```php
use dannyrios\dashboardui\widgets\forms\Checkbox;

<?= Checkbox::widget([
    'model' => $model,
    'attribute' => 'agree',
    'label' => 'I agree to the terms',
    'switch' => true, // Mostrar como switch
    'inline' => false
]) ?>
```

### Radio

Botones de radio.

```php
use dannyrios\dashboardui\widgets\forms\Radio;

<?= Radio::widget([
    'model' => $model,
    'attribute' => 'gender',
    'items' => [
        'male' => 'Male',
        'female' => 'Female',
        'other' => 'Other'
    ],
    'inline' => true
]) ?>
```

### Textarea

Áreas de texto.

```php
use dannyrios\dashboardui\widgets\forms\Textarea;

<?= Textarea::widget([
    'model' => $model,
    'attribute' => 'description',
    'rows' => 5,
    'maxlength' => 500,
    'showCounter' => true,
    'placeholder' => 'Enter description'
]) ?>
```

### FileUpload

Carga de archivos.

```php
use dannyrios\dashboardui\widgets\forms\FileUpload;

<?= FileUpload::widget([
    'model' => $model,
    'attribute' => 'avatar',
    'accept' => 'image/*',
    'multiple' => false,
    'preview' => true,
    'previewUrl' => '/uploads/avatar.jpg',
    'maxSize' => 5242880 // 5MB en bytes
]) ?>
```

---

## Navegación

### Navbar

Barra de navegación responsive.

```php
use dannyrios\dashboardui\widgets\navigation\Navbar;

<?= Navbar::widget([
    'brand' => 'My App',
    'brandUrl' => ['/'],
    'brandImage' => '/images/logo.png',
    'theme' => 'light', // light, dark
    'expand' => 'lg', // sm, md, lg, xl
    'fixed' => 'top', // top, bottom, null
    'sticky' => false,
    'items' => [
        ['label' => 'Home', 'url' => ['/'], 'active' => true],
        ['label' => 'About', 'url' => ['/about']],
        [
            'label' => 'Services',
            'items' => [
                ['label' => 'Web Design', 'url' => ['/services/web']],
                '-', // Divider
                ['label' => 'SEO', 'url' => ['/services/seo']]
            ]
        ]
    ],
    'rightItems' => [
        ['label' => 'Login', 'url' => ['/login']]
    ]
]) ?>
```

### Breadcrumb

Migas de pan para navegación.

```php
use dannyrios\dashboardui\widgets\navigation\Breadcrumb;

<?= Breadcrumb::widget([
    'items' => [
        ['label' => 'Dashboard', 'url' => ['/dashboard']],
        ['label' => 'Products', 'url' => ['/products']],
        ['label' => 'Edit Product']
    ],
    'showHome' => true,
    'homeLink' => ['label' => 'Home', 'url' => '/']
]) ?>
```

### Tabs

Pestañas con contenido.

```php
use dannyrios\dashboardui\widgets\navigation\Tabs;

<?= Tabs::widget([
    'items' => [
        [
            'label' => 'Profile',
            'content' => '<p>Profile content</p>'
        ],
        [
            'label' => 'Settings',
            'content' => '<p>Settings content</p>'
        ],
        [
            'label' => 'Disabled',
            'content' => '<p>Content</p>',
            'disabled' => true
        ]
    ],
    'activeTab' => 0,
    'pills' => false, // true para estilo pills
    'vertical' => false,
    'justified' => false
]) ?>
```

### Pagination

Paginación personalizable.

```php
use dannyrios\dashboardui\widgets\navigation\Pagination;

<?= Pagination::widget([
    'totalPages' => 10,
    'currentPage' => 3,
    'maxButtons' => 7,
    'size' => 'md', // sm, md, lg
    'alignment' => 'center', // start, center, end
    'showFirstLast' => true,
    'showPrevNext' => true,
    'urlTemplate' => '?page={page}'
]) ?>
```

---

## Datos

### DataTable

Tabla de datos completa.

```php
use dannyrios\dashboardui\widgets\data\DataTable;

<?= DataTable::widget([
    'dataProvider' => $data,
    'columns' => [
        ['label' => 'ID', 'attribute' => 'id'],
        ['label' => 'Name', 'attribute' => 'name'],
        [
            'label' => 'Status',
            'value' => function($model) {
                return $model['active'] ? 'Active' : 'Inactive';
            }
        ],
        ['label' => 'Created', 'attribute' => 'created_at', 'format' => 'date']
    ],
    'striped' => true,
    'bordered' => true,
    'hover' => true,
    'responsive' => true
]) ?>
```

### ListView

Vista de lista personalizable.

```php
use dannyrios\dashboardui\widgets\data\ListView;

<?= ListView::widget([
    'dataProvider' => $items,
    'itemView' => function($model, $index) {
        return '<div class="item">' . $model['name'] . '</div>';
    },
    'emptyText' => 'No items found',
    'separator' => '<hr>'
]) ?>
```

### DetailView

Vista de detalles de un modelo.

```php
use dannyrios\dashboardui\widgets\data\DetailView;

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'email',
        [
            'attribute' => 'status',
            'format' => 'boolean'
        ],
        [
            'attribute' => 'created_at',
            'format' => 'datetime'
        ],
        [
            'label' => 'Custom',
            'value' => function($model) {
                return 'Custom value';
            }
        ]
    ],
    'striped' => true,
    'bordered' => true
]) ?>
```

---

## Feedback

### Modal

Ventanas modales.

```php
use dannyrios\dashboardui\widgets\feedback\Modal;

<?php Modal::begin([
    'title' => 'Confirm Action',
    'size' => 'lg', // sm, md, lg, xl
    'centered' => true,
    'scrollable' => false,
    'fullscreen' => false,
    'footer' => '<button class="btn btn-primary">Confirm</button>'
]) ?>
    <p>Are you sure you want to continue?</p>
<?php Modal::end() ?>
```

### Toast

Notificaciones toast.

```php
use dannyrios\dashboardui\widgets\feedback\Toast;

<?= Toast::widget([
    'title' => 'Notification',
    'message' => 'Your action was successful',
    'type' => 'success',
    'icon' => '✓',
    'time' => '2 mins ago',
    'autohide' => true,
    'delay' => 5000
]) ?>
```

### Progress

Barras de progreso.

```php
use dannyrios\dashboardui\widgets\feedback\Progress;

<?= Progress::widget([
    'value' => 75,
    'max' => 100,
    'type' => 'success',
    'striped' => true,
    'animated' => true,
    'showLabel' => true,
    'height' => '20px'
]) ?>
```

### Spinner

Indicadores de carga.

```php
use dannyrios\dashboardui\widgets\feedback\Spinner;

<?= Spinner::widget([
    'type' => 'border', // border, grow
    'size' => 'md', // sm, md
    'color' => 'primary',
    'label' => 'Loading...',
    'showLabel' => true
]) ?>
```

---

## Layout

### Container, Row, Col

Sistema de grid de Bootstrap 5.

```php
use dannyrios\dashboardui\widgets\layout\Container;
use dannyrios\dashboardui\widgets\layout\Row;
use dannyrios\dashboardui\widgets\layout\Col;

<?php Container::begin(['fluid' => false]) ?>
    <?php Row::begin(['gutters' => true]) ?>
        <?php Col::begin(['md' => 6, 'lg' => 4]) ?>
            Content 1
        <?php Col::end() ?>
        
        <?php Col::begin(['md' => 6, 'lg' => 8]) ?>
            Content 2
        <?php Col::end() ?>
    <?php Row::end() ?>
<?php Container::end() ?>
```

### Grid

Grid CSS moderno.

```php
use dannyrios\dashboardui\widgets\layout\Grid;

<?php Grid::begin([
    'columns' => 3,
    'gap' => 2
]) ?>
    <div>Item 1</div>
    <div>Item 2</div>
    <div>Item 3</div>
<?php Grid::end() ?>
```

### Divider

Divisores horizontales y verticales.

```php
use dannyrios\dashboardui\widgets\layout\Divider;

<?= Divider::widget([
    'type' => 'horizontal', // horizontal, vertical
    'text' => 'OR',
    'margin' => 3
]) ?>
```

---

## Avanzados

### Dropdown

Menús desplegables.

```php
use dannyrios\dashboardui\widgets\advanced\Dropdown;

<?= Dropdown::widget([
    'label' => 'Actions',
    'buttonType' => 'primary',
    'items' => [
        ['label' => 'Edit', 'url' => ['/edit']],
        ['label' => 'Delete', 'url' => ['/delete']],
        '-',
        ['header' => 'More Options'],
        ['label' => 'Archive', 'url' => ['/archive']]
    ],
    'split' => false,
    'direction' => 'down' // down, up, start, end
]) ?>
```

### Accordion

Acordeón expandible.

```php
use dannyrios\dashboardui\widgets\advanced\Accordion;

<?= Accordion::widget([
    'items' => [
        [
            'title' => 'Section 1',
            'content' => '<p>Content 1</p>'
        ],
        [
            'title' => 'Section 2',
            'content' => '<p>Content 2</p>'
        ]
    ],
    'activeItems' => [0],
    'flush' => false,
    'alwaysOpen' => false
]) ?>
```

### Carousel

Carrusel de imágenes.

```php
use dannyrios\dashboardui\widgets\advanced\Carousel;

<?= Carousel::widget([
    'items' => [
        [
            'image' => '/images/slide1.jpg',
            'alt' => 'Slide 1',
            'title' => 'First Slide',
            'caption' => 'Description'
        ],
        [
            'image' => '/images/slide2.jpg',
            'alt' => 'Slide 2'
        ]
    ],
    'controls' => true,
    'indicators' => true,
    'fade' => false,
    'autoplay' => true,
    'interval' => 5000
]) ?>
```

### Timeline

Línea de tiempo.

```php
use dannyrios\dashboardui\widgets\advanced\Timeline;

<?= Timeline::widget([
    'items' => [
        [
            'time' => '2 hours ago',
            'title' => 'Event Title',
            'content' => 'Event description',
            'icon' => '📅',
            'color' => 'primary'
        ],
        [
            'time' => '1 day ago',
            'title' => 'Another Event',
            'content' => 'Description',
            'icon' => '✓',
            'color' => 'success'
        ]
    ],
    'align' => 'left' // left, center
]) ?>
```

### Offcanvas

Panel lateral deslizante.

```php
use dannyrios\dashboardui\widgets\advanced\Offcanvas;

<?php Offcanvas::begin([
    'title' => 'Menu',
    'placement' => 'start', // start, end, top, bottom
    'backdrop' => true,
    'scroll' => false
]) ?>
    <p>Offcanvas content</p>
<?php Offcanvas::end() ?>
```

---

## Ejemplos de Uso Combinado

### Formulario Completo

```php
use dannyrios\dashboardui\widgets\forms\Form;
use dannyrios\dashboardui\widgets\forms\Input;
use dannyrios\dashboardui\widgets\forms\Select;
use dannyrios\dashboardui\widgets\forms\Textarea;
use dannyrios\dashboardui\widgets\forms\Checkbox;

<?php Form::begin([
    'title' => 'Create Product',
    'submitLabel' => 'Save Product'
]) ?>

    <?= Input::widget([
        'model' => $model,
        'attribute' => 'name',
        'required' => true
    ]) ?>

    <?= Select::widget([
        'model' => $model,
        'attribute' => 'category_id',
        'items' => $categories,
        'prompt' => 'Select category'
    ]) ?>

    <?= Textarea::widget([
        'model' => $model,
        'attribute' => 'description',
        'rows' => 5
    ]) ?>

    <?= Checkbox::widget([
        'model' => $model,
        'attribute' => 'active',
        'label' => 'Active',
        'switch' => true
    ]) ?>

<?php Form::end() ?>
```

### Dashboard con Grid

```php
use dannyrios\dashboardui\widgets\layout\Container;
use dannyrios\dashboardui\widgets\layout\Row;
use dannyrios\dashboardui\widgets\layout\Col;
use dannyrios\dashboardui\widgets\StatCard;

<?php Container::begin(['fluid' => true]) ?>
    <?php Row::begin() ?>
        <?php Col::begin(['md' => 3]) ?>
            <?= StatCard::widget([
                'title' => 'Total Sales',
                'value' => '$45,000',
                'icon' => '💰',
                'trendValue' => '+12%'
            ]) ?>
        <?php Col::end() ?>
        
        <?php Col::begin(['md' => 3]) ?>
            <?= StatCard::widget([
                'title' => 'Users',
                'value' => '1,234',
                'icon' => '👥',
                'trendValue' => '+5%'
            ]) ?>
        <?php Col::end() ?>
    <?php Row::end() ?>
<?php Container::end() ?>
```

---

## Notas Importantes

1. **Todos los componentes** soportan la propiedad `options` para agregar clases CSS personalizadas
2. **Integración con modelos Yii2** - Los componentes de formulario funcionan con ActiveRecord
3. **Bootstrap 5** - Todos los componentes usan clases de Bootstrap 5
4. **Responsive** - Diseño responsive por defecto
5. **Accesible** - Atributos ARIA incluidos

## Soporte

Para más información, consulta:
- [README.md](README.md) - Documentación general
- [INSTALLATION.md](INSTALLATION.md) - Guía de instalación
- [examples/](examples/) - Ejemplos completos
