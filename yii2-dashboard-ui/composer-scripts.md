# Composer Scripts

Scripts útiles para desarrollo y testing del paquete.

## Configuración en composer.json

Agrega estos scripts a tu `composer.json`:

```json
{
    "scripts": {
        "test": "phpunit",
        "test-coverage": "phpunit --coverage-html coverage",
        "cs-check": "phpcs --standard=PSR12 src/",
        "cs-fix": "phpcbf --standard=PSR12 src/",
        "analyze": "phpstan analyse src/ --level=5",
        "validate": [
            "@cs-check",
            "@test"
        ]
    },
    "scripts-descriptions": {
        "test": "Run unit tests",
        "test-coverage": "Run tests with coverage report",
        "cs-check": "Check coding standards",
        "cs-fix": "Fix coding standards automatically",
        "analyze": "Run static analysis",
        "validate": "Run all validation checks"
    }
}
```

## Uso de Scripts

### Testing

```bash
# Ejecutar tests
composer test

# Tests con coverage
composer test-coverage

# Ver coverage en navegador
open coverage/index.html
```

### Coding Standards

```bash
# Verificar estándares
composer cs-check

# Corregir automáticamente
composer cs-fix
```

### Static Analysis

```bash
# Analizar código
composer analyze
```

### Validación Completa

```bash
# Ejecutar todas las validaciones
composer validate
```

## Dependencias de Desarrollo

Para usar estos scripts, instala las dependencias de desarrollo:

```bash
composer require --dev phpunit/phpunit
composer require --dev squizlabs/php_codesniffer
composer require --dev phpstan/phpstan
```

## CI/CD Integration

Estos scripts se pueden usar en pipelines CI/CD:

```yaml
# .gitlab-ci.yml
test:
  script:
    - composer install
    - composer validate

# GitHub Actions
- name: Run tests
  run: composer test
```
