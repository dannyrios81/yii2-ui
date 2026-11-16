# Changelog

All notable changes to this project will be documented in this file.

## [1.1.0] - 2026-11-16

First release installable with `composer require iguazoft/yii2-ui`: the `v1.0.0` tag pointed to a commit without `composer.json` at the repository root, so Packagist only offered `dev-main`.

### Security
- `ProductTable`, `DataTable` and `DetailView` now HTML-encode cell values by default. Before, a value such as a product name coming from the database was printed as raw HTML (stored XSS). Use `'format' => 'raw'` or `'format' => 'html'` on a column to output trusted HTML.

### Fixed
- Bootstrap color utilities (`bg-success`, `bg-danger`...) overridden by the theme ignored `.bg-opacity-*`, so `StatCard` icons rendered as solid squares.
- Long header content overflowed the fixed 70px `DashboardLayout` header; it is now a minimum height.
- `Breadcrumb` crashed with plain string items (`'items' => ['Home', 'Page']`), which `yii\widgets\Breadcrumbs` accepts.
- `ProductTable` icons (`bi bi-*`) were not loaded.
- Undefined `--dashboard-gray-300` CSS variable.
- Dynamic pagination in ProductTable (replaces hardcoded values)
- Dropdown split mode class handling bug
- Duplicate CSS media query in dashboard.css
- Test bootstrap now creates Yii2 Application instance
- URLs in composer.json corrected to dannyrios81/yii2-ui

### Added
- `ProductTable` and `DataTable` accept any Yii data provider (`ActiveDataProvider`, `ArrayDataProvider`...) and take its pagination and total count.
- `BootstrapIconsAsset`, registered by `DashboardAsset`: every `icon` option accepts `<i class="bi bi-...">` out of the box.
- `bg-primary` / `text-primary` follow the theme color.
- Screenshots and a second example page (`examples/views/dashboard/components.php`).
- GitHub Actions CI on PHP 7.4 to 8.4, `.gitattributes` to keep the Composer package small.
- English README, README.es.md.
- ChartAsset for automatic Chart.js CDN registration
- Pagination support in DataTable widget
- PHPDoc documentation for all widget classes
- Tests for MetricCard, Card, Alert, DataTable, Badge, Sidebar, Pagination, Modal, Progress and HTML encoding

### Changed
- `ChartAsset` no longer depends on jQuery.
- Examples use Bootstrap Icons instead of emoji.
- Removed unused `yii2-debug` and `yii2-gii` dev dependencies.
- BaseWidget::init() now adds `dashboard-widget` class automatically
- README.md rewritten and streamlined
- Removed 9 redundant documentation files

## [1.0.0] - 2026-02-01

### Added
- Initial release
- DashboardLayout widget for complete dashboard structure
- Sidebar widget with user profile, menu sections and search
- MetricCard widget for displaying metrics with trends
- ReportCard widget for reports with action buttons
- ProductTable widget with checkboxes, pagination and actions
- Card widget for general purpose cards
- StatCard widget for statistics display
- Button widget with icon support
- Badge widget for labels and tags
- Alert widget for notifications
- Chart widget with Chart.js integration
- Complete CSS styling based on modern dashboard design
- JavaScript utilities for interactivity
- Bootstrap 5 integration
- Responsive design support
- Accessibility features (WCAG AA)
- Complete documentation and examples
- Example controller and view

### Features
- Easy integration with any Yii2 project
- Customizable color scheme
- Multiple widget variants
- Table formatting options (currency, rating, stock, etc.)
- Trend indicators (up/down with percentages)
- Checkbox selection in tables
- Action buttons (edit/delete)
- Pagination support
- Tab navigation
- Icon support
- Dismissible alerts
- Responsive sidebar
- Print-friendly styles

### Documentation
- Complete README with installation instructions
- Usage examples for all widgets
- Configuration guide
- Customization options
- Integration examples
- API reference
