# Guía de Instalación Detallada

## Requisitos Previos

- PHP >= 7.4
- Yii2 >= 2.0.0
- Composer
- Bootstrap 5 (se instalará automáticamente)

## Instalación Paso a Paso

### 1. Instalar vía Composer (Recomendado)

```bash
composer require iguazoft/yii2-ui
```

### 2. Instalación Manual

Si prefieres instalar manualmente:

1. Descarga o clona el repositorio:
```bash
cd vendor
mkdir -p dannyrios
cd dannyrios
git clone https://github.com/iguazoft/yii2-ui.git
```

2. Actualiza tu `composer.json`:
```json
{
    "autoload": {
        "psr-4": {
            "iguazoft\\ui\\": "vendor/iguazoft/yii2-ui/src/"
        }
    }
}
```

3. Ejecuta:
```bash
composer dump-autoload
```

### 3. Configuración en tu Aplicación Yii2

#### 3.1 Registrar el Asset Bundle

En tu layout principal (por ejemplo `views/layouts/main.php`):

```php
<?php
use dannyrios\dashboardui\DashboardAsset;

DashboardAsset::register($this);
?>
```

#### 3.2 Configurar Bootstrap 5

Si aún no tienes Bootstrap 5, instálalo:

```bash
composer require yiisoft/yii2-bootstrap5
```

En tu `config/web.php`, asegúrate de tener:

```php
'components' => [
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap5\BootstrapAsset' => [
                'css' => [],
            ],
            'yii\bootstrap5\BootstrapPluginAsset' => [
                'js' => []
            ],
        ],
    ],
],
```

### 4. Crear tu Primer Dashboard

#### 4.1 Crear el Controlador

Crea `controllers/DashboardController.php`:

```php
<?php

namespace app\controllers;

use yii\web\Controller;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
```

#### 4.2 Crear la Vista

Crea `views/dashboard/index.php`:

```php
<?php

use dannyrios\dashboardui\widgets\DashboardLayout;
use dannyrios\dashboardui\widgets\Sidebar;
use dannyrios\dashboardui\widgets\MetricCard;
use dannyrios\dashboardui\DashboardAsset;

DashboardAsset::register($this);

$this->title = 'Mi Dashboard';
?>

<?php DashboardLayout::begin([
    'sidebar' => Sidebar::widget([
        'user' => [
            'name' => 'Usuario',
            'role' => 'Administrador',
        ],
        'mainMenu' => [
            ['label' => 'Dashboard', 'icon' => '🏠', 'url' => ['/dashboard'], 'active' => true],
        ],
    ]),
]); ?>

<div class="row">
    <div class="col-md-4">
        <?= MetricCard::widget([
            'title' => 'Ventas Totales',
            'value' => '150,000',
            'prefix' => '$',
        ]) ?>
    </div>
</div>

<?php DashboardLayout::end(); ?>
```

#### 4.3 Configurar la Ruta

En `config/web.php`, agrega:

```php
'components' => [
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            'dashboard' => 'dashboard/index',
        ],
    ],
],
```

### 5. Dependencias Opcionales

#### 5.1 Chart.js (Para Gráficos)

En tu layout, agrega:

```php
<?php
use yii\web\View;

$this->registerJsFile(
    'https://cdn.jsdelivr.net/npm/chart.js',
    ['position' => View::POS_HEAD]
);
?>
```

#### 5.2 Bootstrap Icons

En tu layout, agrega:

```php
<?php
$this->registerCssFile(
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css'
);
?>
```

### 6. Personalización de Estilos

#### 6.1 Crear tu CSS Personalizado

Crea `web/css/custom-dashboard.css`:

```css
:root {
    --dashboard-primary: #your-brand-color;
}

.sidebar {
    background: #your-sidebar-color;
}
```

#### 6.2 Registrar tu CSS

En tu layout:

```php
<?php
$this->registerCssFile('@web/css/custom-dashboard.css', [
    'depends' => [dannyrios\dashboardui\DashboardAsset::class]
]);
?>
```

### 7. Verificación de la Instalación

1. Accede a `http://tu-sitio.com/dashboard`
2. Deberías ver tu dashboard con el sidebar y los componentes

### 8. Solución de Problemas Comunes

#### Error: "Class not found"

Ejecuta:
```bash
composer dump-autoload
```

#### Los estilos no se cargan

Verifica que el asset bundle esté registrado:
```php
DashboardAsset::register($this);
```

Limpia el cache de assets:
```bash
rm -rf web/assets/*
```

#### Bootstrap 5 no funciona

Asegúrate de tener la versión correcta:
```bash
composer show yiisoft/yii2-bootstrap5
```

Si no está instalado:
```bash
composer require yiisoft/yii2-bootstrap5
```

### 9. Actualización

Para actualizar a la última versión:

```bash
composer update iguazoft/yii2-ui
```

### 10. Desinstalación

Si necesitas desinstalar:

```bash
composer remove iguazoft/yii2-ui
```

## Próximos Pasos

- Lee el [README.md](README.md) para ver todos los widgets disponibles
- Revisa los [ejemplos](examples/) para casos de uso completos
- Consulta el [CHANGELOG.md](CHANGELOG.md) para ver las últimas actualizaciones

## Soporte

Si tienes problemas con la instalación:

1. Revisa esta guía completamente
2. Verifica los requisitos previos
3. Consulta los issues en GitHub
4. Crea un nuevo issue con detalles del error
