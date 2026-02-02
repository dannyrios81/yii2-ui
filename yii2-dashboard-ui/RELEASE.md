# Release Process

Guía para crear y publicar nuevas versiones del paquete.

## Pre-Release Checklist

Antes de crear una nueva versión:

- [ ] Todos los tests pasan (`composer test`)
- [ ] Código cumple estándares (`composer cs-check`)
- [ ] Documentación actualizada
- [ ] CHANGELOG.md actualizado
- [ ] README.md actualizado si hay nuevas features
- [ ] Ejemplos funcionan correctamente
- [ ] No hay TODOs críticos pendientes

## Versionado Semántico

Seguimos [Semantic Versioning 2.0.0](https://semver.org/):

- **MAJOR** (X.0.0): Cambios incompatibles con versiones anteriores
- **MINOR** (0.X.0): Nueva funcionalidad compatible
- **PATCH** (0.0.X): Correcciones de bugs compatibles

### Ejemplos

```
1.0.0 → 1.0.1  # Bug fix
1.0.1 → 1.1.0  # Nuevo widget
1.1.0 → 2.0.0  # Cambio incompatible (renombrar props)
```

## Proceso de Release

### 1. Actualizar CHANGELOG.md

```markdown
## [1.1.0] - 2024-02-01

### Added
- New Timeline widget
- Chart.js integration in MetricCard
- Support for custom themes

### Changed
- Improved Button component performance
- Updated Bootstrap 5 to latest version

### Fixed
- Icon alignment in MetricCard
- Pagination display on mobile

### Deprecated
- `Button::$rounded` prop (use CSS classes instead)
```

### 2. Commit Cambios

```bash
git add .
git commit -m "Release v1.1.0

- Add Timeline widget
- Integrate Chart.js in MetricCard
- Fix icon alignment issues
"
```

### 3. Crear Tag

```bash
# Crear tag anotado
git tag -a v1.1.0 -m "Release v1.1.0"

# Verificar tag
git tag -l

# Ver detalles del tag
git show v1.1.0
```

### 4. Push a GitHub

```bash
# Push commits
git push origin main

# Push tags
git push origin v1.1.0

# O push todos los tags
git push origin --tags
```

### 5. Crear GitHub Release

1. Ve a https://github.com/iguazoft/yii2-ui/releases
2. Click en "Draft a new release"
3. Selecciona el tag `v1.1.0`
4. Título: `v1.1.0 - Timeline Widget & Chart.js Integration`
5. Descripción: Copia el contenido del CHANGELOG para esta versión
6. Adjunta archivos si es necesario (opcional)
7. Click en "Publish release"

### 6. Verificar en Packagist

Packagist se actualizará automáticamente si configuraste el webhook.

Verifica en: https://packagist.org/packages/iguazoft/yii2-ui

Si no se actualiza automáticamente:
1. Ve a tu paquete en Packagist
2. Click en "Update"

### 7. Anunciar Release

- Twitter/X
- Yii2 Forum
- GitHub Discussions
- Newsletter (si aplica)

## Tipos de Releases

### Patch Release (1.0.0 → 1.0.1)

Para bug fixes menores:

```bash
# Fix el bug
git commit -m "Fix: Correct icon alignment in MetricCard"

# Crear tag
git tag -a v1.0.1 -m "Fix icon alignment"

# Push
git push origin main --tags
```

### Minor Release (1.0.0 → 1.1.0)

Para nuevas features compatibles:

```bash
# Agregar feature
git commit -m "Add: Timeline widget component"

# Actualizar CHANGELOG
# Crear tag
git tag -a v1.1.0 -m "Add Timeline widget"

# Push
git push origin main --tags
```

### Major Release (1.0.0 → 2.0.0)

Para cambios incompatibles:

```bash
# Hacer cambios incompatibles
git commit -m "Breaking: Rename Button props for consistency"

# Actualizar CHANGELOG con sección BREAKING CHANGES
# Actualizar UPGRADE.md con guía de migración
# Crear tag
git tag -a v2.0.0 -m "Major release with breaking changes"

# Push
git push origin main --tags
```

## Pre-Release Versions

Para versiones beta o RC:

```bash
# Beta
git tag -a v1.1.0-beta.1 -m "Beta release"

# Release Candidate
git tag -a v1.1.0-rc.1 -m "Release candidate"

# Push
git push origin --tags
```

Instalar pre-release:

```bash
composer require iguazoft/yii2-ui:1.1.0-beta.1
```

## Hotfix Release

Para fixes críticos en producción:

```bash
# Crear rama hotfix desde tag de producción
git checkout -b hotfix/critical-fix v1.0.0

# Fix el issue
git commit -m "Hotfix: Critical security issue"

# Merge a main
git checkout main
git merge hotfix/critical-fix

# Tag
git tag -a v1.0.1 -m "Hotfix: Critical security issue"

# Push
git push origin main --tags

# Eliminar rama hotfix
git branch -d hotfix/critical-fix
```

## Rollback

Si necesitas revertir un release:

```bash
# Eliminar tag local
git tag -d v1.1.0

# Eliminar tag remoto
git push origin :refs/tags/v1.1.0

# Revertir commits si es necesario
git revert <commit-hash>
```

## Automatización

### GitHub Actions

Crear `.github/workflows/release.yml`:

```yaml
name: Release

on:
  push:
    tags:
      - 'v*'

jobs:
  release:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      
      - name: Create Release
        uses: actions/create-release@v1
        env:
          GITHUB_TOKEN: ${{ secrets.GITHUB_TOKEN }}
        with:
          tag_name: ${{ github.ref }}
          release_name: Release ${{ github.ref }}
          draft: false
          prerelease: false
```

## Post-Release

Después de publicar:

1. Verificar que Packagist se actualizó
2. Probar instalación en proyecto limpio
3. Monitorear issues por 24-48 horas
4. Responder preguntas en GitHub Discussions

## Comandos Útiles

```bash
# Ver último tag
git describe --tags --abbrev=0

# Ver todos los tags
git tag -l

# Ver commits desde último tag
git log $(git describe --tags --abbrev=0)..HEAD --oneline

# Generar CHANGELOG automático
git log --pretty=format:"- %s" v1.0.0..HEAD

# Ver diferencias entre tags
git diff v1.0.0..v1.1.0
```

## Recursos

- [Semantic Versioning](https://semver.org/)
- [Keep a Changelog](https://keepachangelog.com/)
- [GitHub Releases](https://docs.github.com/en/repositories/releasing-projects-on-github)
- [Packagist](https://packagist.org/)
