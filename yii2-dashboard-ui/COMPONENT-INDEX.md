# Índice Rápido de Componentes

## 🎯 Búsqueda Rápida por Necesidad

### "Necesito crear un formulario"
→ `Form`, `Input`, `Select`, `Checkbox`, `Radio`, `Textarea`, `FileUpload`

### "Necesito mostrar datos en tabla"
→ `DataTable`, `ProductTable`, `DetailView`, `ListView`

### "Necesito navegación"
→ `Navbar`, `Sidebar`, `Breadcrumb`, `Tabs`, `Pagination`

### "Necesito mostrar métricas/estadísticas"
→ `MetricCard`, `StatCard`, `Chart`, `Progress`

### "Necesito notificaciones/alertas"
→ `Alert`, `Toast`, `Modal`, `Spinner`

### "Necesito organizar el layout"
→ `Container`, `Row`, `Col`, `Grid`, `DashboardLayout`

### "Necesito componentes interactivos"
→ `Dropdown`, `Accordion`, `Carousel`, `Modal`, `Offcanvas`

---

## 📁 Componentes por Categoría

### Base (4 componentes)
| Componente | Namespace | Uso |
|------------|-----------|-----|
| Card | `dannyrios\dashboardui\widgets\Card` | Tarjetas genéricas |
| Button | `dannyrios\dashboardui\widgets\Button` | Botones con iconos |
| Badge | `dannyrios\dashboardui\widgets\Badge` | Etiquetas |
| Alert | `dannyrios\dashboardui\widgets\Alert` | Alertas |

### Dashboard (7 componentes)
| Componente | Namespace | Uso |
|------------|-----------|-----|
| DashboardLayout | `dannyrios\dashboardui\widgets\DashboardLayout` | Layout completo |
| Sidebar | `dannyrios\dashboardui\widgets\Sidebar` | Navegación lateral |
| MetricCard | `dannyrios\dashboardui\widgets\MetricCard` | Métricas con tendencias |
| ReportCard | `dannyrios\dashboardui\widgets\ReportCard` | Reportes |
| ProductTable | `dannyrios\dashboardui\widgets\ProductTable` | Tabla productos |
| StatCard | `dannyrios\dashboardui\widgets\StatCard` | Estadísticas |
| Chart | `dannyrios\dashboardui\widgets\Chart` | Gráficos |

### Formularios (7 componentes)
| Componente | Namespace | Uso |
|------------|-----------|-----|
| Form | `dannyrios\dashboardui\widgets\forms\Form` | Formulario completo |
| Input | `dannyrios\dashboardui\widgets\forms\Input` | Campos de texto |
| Select | `dannyrios\dashboardui\widgets\forms\Select` | Listas desplegables |
| Checkbox | `dannyrios\dashboardui\widgets\forms\Checkbox` | Casillas |
| Radio | `dannyrios\dashboardui\widgets\forms\Radio` | Botones radio |
| Textarea | `dannyrios\dashboardui\widgets\forms\Textarea` | Área de texto |
| FileUpload | `dannyrios\dashboardui\widgets\forms\FileUpload` | Subir archivos |

### Navegación (4 componentes)
| Componente | Namespace | Uso |
|------------|-----------|-----|
| Navbar | `dannyrios\dashboardui\widgets\navigation\Navbar` | Barra navegación |
| Breadcrumb | `dannyrios\dashboardui\widgets\navigation\Breadcrumb` | Migas de pan |
| Tabs | `dannyrios\dashboardui\widgets\navigation\Tabs` | Pestañas |
| Pagination | `dannyrios\dashboardui\widgets\navigation\Pagination` | Paginación |

### Datos (3 componentes)
| Componente | Namespace | Uso |
|------------|-----------|-----|
| DataTable | `dannyrios\dashboardui\widgets\data\DataTable` | Tabla de datos |
| ListView | `dannyrios\dashboardui\widgets\data\ListView` | Lista de items |
| DetailView | `dannyrios\dashboardui\widgets\data\DetailView` | Vista detalle |

### Feedback (4 componentes)
| Componente | Namespace | Uso |
|------------|-----------|-----|
| Modal | `dannyrios\dashboardui\widgets\feedback\Modal` | Ventanas modales |
| Toast | `dannyrios\dashboardui\widgets\feedback\Toast` | Notificaciones |
| Progress | `dannyrios\dashboardui\widgets\feedback\Progress` | Barras progreso |
| Spinner | `dannyrios\dashboardui\widgets\feedback\Spinner` | Cargando |

### Layout (5 componentes)
| Componente | Namespace | Uso |
|------------|-----------|-----|
| Container | `dannyrios\dashboardui\widgets\layout\Container` | Contenedor |
| Row | `dannyrios\dashboardui\widgets\layout\Row` | Fila |
| Col | `dannyrios\dashboardui\widgets\layout\Col` | Columna |
| Grid | `dannyrios\dashboardui\widgets\layout\Grid` | Grid CSS |
| Divider | `dannyrios\dashboardui\widgets\layout\Divider` | Divisor |

### Avanzados (5 componentes)
| Componente | Namespace | Uso |
|------------|-----------|-----|
| Dropdown | `dannyrios\dashboardui\widgets\advanced\Dropdown` | Menú desplegable |
| Accordion | `dannyrios\dashboardui\widgets\advanced\Accordion` | Acordeón |
| Carousel | `dannyrios\dashboardui\widgets\advanced\Carousel` | Carrusel |
| Timeline | `dannyrios\dashboardui\widgets\advanced\Timeline` | Línea tiempo |
| Offcanvas | `dannyrios\dashboardui\widgets\advanced\Offcanvas` | Panel lateral |

---

## 🔍 Búsqueda por Tipo de Input

| Tipo | Componente | Ejemplo |
|------|------------|---------|
| Texto simple | Input | `Input::widget(['type' => 'text'])` |
| Email | Input | `Input::widget(['type' => 'email'])` |
| Password | Input | `Input::widget(['type' => 'password'])` |
| Número | Input | `Input::widget(['type' => 'number'])` |
| Teléfono | Input | `Input::widget(['type' => 'tel'])` |
| URL | Input | `Input::widget(['type' => 'url'])` |
| Lista | Select | `Select::widget(['items' => [...]])` |
| Checkbox | Checkbox | `Checkbox::widget(['switch' => true])` |
| Radio | Radio | `Radio::widget(['items' => [...]])` |
| Texto largo | Textarea | `Textarea::widget(['rows' => 5])` |
| Archivo | FileUpload | `FileUpload::widget(['accept' => 'image/*'])` |

---

## 📊 Componentes por Complejidad

### Básicos (Fácil de usar)
- Badge, Button, Alert, Divider, Spinner, Progress

### Intermedios
- Card, Input, Select, Checkbox, Radio, Textarea, Breadcrumb, Tabs

### Avanzados
- Form, DataTable, Modal, Navbar, Dropdown, Accordion, Carousel

### Complejos (Requieren configuración)
- DashboardLayout, ProductTable, Chart, Timeline, Offcanvas

---

## 🎨 Componentes por Caso de Uso

### Dashboard Administrativo
```
DashboardLayout + Sidebar + MetricCard + StatCard + ProductTable + Chart
```

### Formulario de Registro
```
Form + Input + Select + Checkbox + FileUpload + Button
```

### Página de Perfil
```
Container + Row + Col + DetailView + Card + Button
```

### Lista de Productos
```
DataTable + Pagination + Modal + Button + Badge
```

### Navegación Principal
```
Navbar + Dropdown + Breadcrumb
```

### Galería de Imágenes
```
Grid + Card + Modal + Carousel
```

### Línea de Tiempo de Eventos
```
Timeline + Card + Badge
```

### Panel de Notificaciones
```
Offcanvas + ListView + Toast + Badge
```

---

## 🚀 Snippets Rápidos

### Dashboard Completo
```php
use dannyrios\dashboardui\widgets\DashboardLayout;
use dannyrios\dashboardui\widgets\Sidebar;

<?php DashboardLayout::begin([
    'sidebar' => Sidebar::widget([...])
]); ?>
    <!-- Contenido -->
<?php DashboardLayout::end(); ?>
```

### Formulario Rápido
```php
use dannyrios\dashboardui\widgets\forms\{Form, Input, Select};

<?php Form::begin() ?>
    <?= Input::widget(['model' => $model, 'attribute' => 'name']) ?>
    <?= Select::widget(['model' => $model, 'attribute' => 'type', 'items' => [...]]) ?>
<?php Form::end() ?>
```

### Tabla de Datos
```php
use dannyrios\dashboardui\widgets\data\DataTable;

<?= DataTable::widget([
    'dataProvider' => $data,
    'columns' => [...]
]) ?>
```

### Grid Responsive
```php
use dannyrios\dashboardui\widgets\layout\{Container, Row, Col};

<?php Container::begin() ?>
    <?php Row::begin() ?>
        <?php Col::begin(['md' => 6]) ?>Content<?php Col::end() ?>
        <?php Col::begin(['md' => 6]) ?>Content<?php Col::end() ?>
    <?php Row::end() ?>
<?php Container::end() ?>
```

---

## 📖 Documentación Relacionada

- **[README.md](README.md)** - Introducción y características
- **[COMPONENTS.md](COMPONENTS.md)** - Documentación detallada de cada componente
- **[INSTALLATION.md](INSTALLATION.md)** - Guía de instalación
- **[examples/](examples/)** - Ejemplos de código completos

---

**Total: 39 componentes principales + variantes = 50+ componentes**
