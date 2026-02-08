# Contributing to Yii2 Dashboard UI

First off, thank you for considering contributing to Yii2 Dashboard UI! It's people like you that make this extension better for everyone.

## Code of Conduct

This project and everyone participating in it is governed by our Code of Conduct. By participating, you are expected to uphold this code.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the issue list as you might find out that you don't need to create one. When you are creating a bug report, please include as many details as possible:

* **Use a clear and descriptive title**
* **Describe the exact steps which reproduce the problem**
* **Provide specific examples to demonstrate the steps**
* **Describe the behavior you observed after following the steps**
* **Explain which behavior you expected to see instead and why**
* **Include screenshots if possible**
* **Include your environment details** (PHP version, Yii2 version, OS, etc.)

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:

* **Use a clear and descriptive title**
* **Provide a step-by-step description of the suggested enhancement**
* **Provide specific examples to demonstrate the steps**
* **Describe the current behavior and explain which behavior you expected to see instead**
* **Explain why this enhancement would be useful**

### Pull Requests

* Fill in the required template
* Do not include issue numbers in the PR title
* Follow the PHP coding standards (PSR-12)
* Include thoughtfully-worded, well-structured tests
* Document new code
* End all files with a newline

## Development Process

### Setting Up Development Environment

```bash
# Clone the repository
git clone https://github.com/dannyrios81/yii2-ui.git
cd yii2-ui

# Install dependencies
composer install

# Run tests
composer test
```

### Coding Standards

This project follows PSR-12 coding standards. Please ensure your code adheres to these standards.

```bash
# Check coding standards
composer cs-check

# Fix coding standards automatically
composer cs-fix
```

### Testing

All new features and bug fixes must include tests.

```bash
# Run all tests
composer test

# Run specific test
./vendor/bin/phpunit tests/widgets/ButtonTest.php

# Run tests with coverage
composer test-coverage
```

### Creating a New Widget

1. Create the widget class in `src/widgets/`
2. Create tests in `tests/widgets/`
3. Add documentation in the widget class docblock
4. Add usage example in README.md
5. Update CHANGELOG.md

Example widget structure:

```php
<?php

namespace iguazoft\ui\widgets;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * MyWidget displays something awesome
 * 
 * Usage:
 * ```php
 * <?= MyWidget::widget([
 *     'option1' => 'value1',
 *     'option2' => 'value2',
 * ]) ?>
 * ```
 * 
 * @author Your Name <your.email@example.com>
 */
class MyWidget extends BaseWidget
{
    public $option1;
    public $option2;
    
    public function init()
    {
        parent::init();
        // Initialization code
    }
    
    public function run()
    {
        // Widget rendering code
        return Html::tag('div', 'Content', $this->options);
    }
}
```

### Documentation

* Use clear and concise language
* Include code examples
* Update README.md if adding new features
* Add inline comments for complex logic
* Use PHPDoc for all public methods and properties

### Commit Messages

* Use the present tense ("Add feature" not "Added feature")
* Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
* Limit the first line to 72 characters or less
* Reference issues and pull requests liberally after the first line

Examples:
```
Add MetricCard widget with trend support

- Implement basic MetricCard structure
- Add trend indicator with up/down arrows
- Include Chart.js integration
- Add comprehensive tests

Fixes #123
```

### Branch Naming

* `feature/feature-name` - For new features
* `bugfix/bug-description` - For bug fixes
* `hotfix/critical-fix` - For critical fixes
* `docs/documentation-update` - For documentation updates

## Release Process

1. Update version in `composer.json`
2. Update CHANGELOG.md with all changes
3. Create a git tag: `git tag -a v1.0.0 -m "Release v1.0.0"`
4. Push tag: `git push origin v1.0.0`
5. Create GitHub release with changelog

## Composer Scripts

Add these scripts to your `composer.json` for development:

```json
{
    "scripts": {
        "test": "phpunit",
        "test-coverage": "phpunit --coverage-html coverage",
        "cs-check": "phpcs --standard=PSR12 src/",
        "cs-fix": "phpcbf --standard=PSR12 src/",
        "analyze": "phpstan analyse src/ --level=5",
        "validate": ["@cs-check", "@test"]
    }
}
```

Install dev tools:

```bash
composer require --dev squizlabs/php_codesniffer
composer require --dev phpstan/phpstan
```

## Questions?

Feel free to open an issue with your question or contact the maintainers directly.

## License

By contributing, you agree that your contributions will be licensed under the MIT License.
