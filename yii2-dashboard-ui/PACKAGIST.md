# Publicación en Packagist

Guía paso a paso para publicar el paquete `iguazoft/yii2-ui` en Packagist.

## Requisitos Previos

- [x] Cuenta en GitHub
- [x] Cuenta en Packagist.org
- [x] Repositorio público en GitHub
- [x] composer.json configurado correctamente
- [x] README.md completo
- [x] LICENSE file
- [x] CHANGELOG.md

## Pasos para Publicación

### 1. Preparar el Repositorio

#### 1.1 Crear Repositorio en GitHub

```bash
# Inicializar git (si no está inicializado)
cd yii2-dashboard-ui
git init

# Agregar archivos
git add .
git commit -m "Initial commit: Yii2 Dashboard UI Extension"

# Crear repositorio en GitHub y conectar
git remote add origin https://github.com/iguazoft/yii2-ui.git
git branch -M main
git push -u origin main
```

#### 1.2 Verificar composer.json

Asegúrate de que `composer.json` tenga:

```json
{
    "name": "iguazoft/yii2-ui",
    "type": "yii2-extension",
    "license": "MIT",
    "minimum-stability": "stable"
}
```

#### 1.3 Crear Tag de Versión

```bash
# Crear tag para la primera versión
git tag -a v1.0.0 -m "Release v1.0.0: Initial stable release"
git push origin v1.0.0
```

### 2. Registrar en Packagist

#### 2.1 Crear Cuenta en Packagist

1. Ve a https://packagist.org/
2. Haz clic en "Sign in with GitHub"
3. Autoriza Packagist a acceder a tu cuenta de GitHub

#### 2.2 Enviar Paquete

1. Ve a https://packagist.org/packages/submit
2. Pega la URL de tu repositorio:
   ```
   https://github.com/iguazoft/yii2-ui
   ```
3. Haz clic en "Check"
4. Si todo está correcto, haz clic en "Submit"

#### 2.3 Configurar Auto-Update

Para que Packagist se actualice automáticamente cuando hagas push:

1. Ve a tu paquete en Packagist
2. Haz clic en "Settings"
3. Copia el webhook URL
4. Ve a tu repositorio en GitHub → Settings → Webhooks → Add webhook
5. Pega la URL del webhook
6. Content type: `application/json`
7. Selecciona "Just the push event"
8. Haz clic en "Add webhook"

### 3. Verificar Instalación

Prueba que el paquete se puede instalar:

```bash
# En un proyecto nuevo
composer require iguazoft/yii2-ui

# Debería instalar correctamente
```

### 4. Publicar Nuevas Versiones

#### 4.1 Actualizar CHANGELOG.md

```markdown
## [1.1.0] - 2024-02-01

### Added
- New Timeline widget
- Chart.js integration in MetricCard

### Fixed
- Button icon alignment issue
```

#### 4.2 Actualizar Versión y Crear Tag

```bash
# Commit cambios
git add .
git commit -m "Release v1.1.0: Add Timeline widget and Chart.js"

# Crear nuevo tag
git tag -a v1.1.0 -m "Release v1.1.0"
git push origin main
git push origin v1.1.0
```

Packagist se actualizará automáticamente si configuraste el webhook.

### 5. Badges para README

Agrega badges a tu README.md:

```markdown
[![Latest Stable Version](https://poser.pugx.org/iguazoft/yii2-ui/v/stable)](https://packagist.org/packages/iguazoft/yii2-ui)
[![Total Downloads](https://poser.pugx.org/iguazoft/yii2-ui/downloads)](https://packagist.org/packages/iguazoft/yii2-ui)
[![License](https://poser.pugx.org/iguazoft/yii2-ui/license)](https://packagist.org/packages/iguazoft/yii2-ui)
```

## Versionado Semántico

Sigue [Semantic Versioning](https://semver.org/):

- **MAJOR** (1.0.0): Cambios incompatibles con versiones anteriores
- **MINOR** (0.1.0): Nueva funcionalidad compatible con versiones anteriores
- **PATCH** (0.0.1): Correcciones de bugs compatibles

Ejemplos:
- `v1.0.0` - Primera versión estable
- `v1.1.0` - Agregar nuevo widget
- `v1.1.1` - Fix de bug en widget existente
- `v2.0.0` - Cambio incompatible (ej: cambiar nombre de props)

## Checklist de Publicación

Antes de publicar una nueva versión:

- [ ] Todos los tests pasan
- [ ] Documentación actualizada
- [ ] CHANGELOG.md actualizado
- [ ] Versión actualizada en composer.json (opcional)
- [ ] README.md actualizado si hay nuevas features
- [ ] Código revisado y limpio
- [ ] No hay TODOs pendientes críticos
- [ ] Tag creado con mensaje descriptivo

## Comandos Útiles

```bash
# Verificar que composer.json es válido
composer validate

# Ver información del paquete
composer show iguazoft/yii2-ui

# Actualizar a última versión
composer update iguazoft/yii2-ui

# Instalar versión específica
composer require iguazoft/yii2-ui:^1.0

# Ver todas las versiones disponibles
composer show iguazoft/yii2-ui --all
```

## Solución de Problemas

### El paquete no aparece en Packagist

1. Verifica que el repositorio es público
2. Verifica que composer.json es válido
3. Verifica que existe al menos un tag
4. Espera unos minutos y recarga la página

### Error "Could not find package"

1. Verifica el nombre exacto del paquete
2. Asegúrate de que está publicado en Packagist
3. Ejecuta `composer clear-cache`
4. Intenta de nuevo

### Webhook no funciona

1. Ve a GitHub → Settings → Webhooks
2. Verifica que el webhook está activo
3. Revisa "Recent Deliveries" para ver errores
4. Vuelve a crear el webhook si es necesario

## Recursos

- [Packagist](https://packagist.org/)
- [Composer Documentation](https://getcomposer.org/doc/)
- [Semantic Versioning](https://semver.org/)
- [GitHub Releases](https://docs.github.com/en/repositories/releasing-projects-on-github)

## Soporte

Si tienes problemas publicando el paquete:

1. Revisa la [documentación de Packagist](https://packagist.org/about)
2. Busca en [Stack Overflow](https://stackoverflow.com/questions/tagged/packagist)
3. Abre un issue en el repositorio
