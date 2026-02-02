# Dashboard Design System

[![Storybook](https://img.shields.io/badge/Storybook-FF4785?style=for-the-badge&logo=storybook&logoColor=white)](https://storybook.js.org/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white)](https://www.chartjs.org/)

Design System completo para interfaces de dashboard basado en **Bootstrap 5**, **Atomic Design** y **Storybook**.

## 🌟 Características

- ✅ **50+ Componentes** organizados en Atomic Design
- 📚 **Storybook** con documentación interactiva
- 🎨 **Bootstrap 5** como base
- 📊 **Chart.js** integrado para visualizaciones
- 🔧 **Contratos UX-Frontend** bien definidos
- 🚀 **Pipeline CI/CD** en GitLab
- ♿ **Accesible** (WCAG AA)
- 📱 **Responsive** y mobile-first
- 🧪 **Testeado** con Jest
- 📖 **Documentación completa**

## 📦 Estructura del Proyecto

```
design-system/
├── .storybook/              # Configuración de Storybook
│   ├── main.js
│   └── preview.js
├── src/
│   ├── components/
│   │   ├── atoms/           # Componentes atómicos
│   │   ├── molecules/       # Componentes moleculares
│   │   └── organisms/       # Componentes organismos
│   └── styles/
│       └── design-system.css
├── stories/                 # Stories de Storybook
│   ├── Introduction.mdx
│   ├── atoms/
│   ├── molecules/
│   └── organisms/
├── public/                  # Assets estáticos
├── .gitlab-ci.yml          # Pipeline CI/CD
├── ATOMIC-DESIGN.md        # Documentación Atomic Design
├── UX-FRONTEND-CONTRACT.md # Contratos de componentes
├── package.json
└── README.md
```

## 🚀 Inicio Rápido

### Instalación

```bash
# Clonar el repositorio
git clone https://gitlab.com/dannyrios/dashboard-design-system.git
cd dashboard-design-system

# Instalar dependencias
npm install

# Iniciar Storybook
npm run storybook
```

Storybook estará disponible en `http://localhost:6006`

### Build

```bash
# Build de Storybook para producción
npm run build-storybook

# Los archivos estarán en ./storybook-static
```

## 📚 Documentación

### Atomic Design

El sistema está organizado en 5 niveles:

#### ⚛️ Atoms (10 componentes)
- Button, Input, Badge, Icon, Checkbox, Radio, Spinner, Label, Avatar, Divider

#### 🧬 Molecules (10 componentes)
- FormField, SearchBar, MetricDisplay, Tag, Breadcrumb, Pagination, ProgressBar, Alert, UserProfile, ChartLegend

#### 🏗️ Organisms (10 componentes)
- Navbar, Sidebar, MetricCard, DataTable, Form, Modal, Accordion, Carousel, Timeline, ChartWidget

Ver [ATOMIC-DESIGN.md](./ATOMIC-DESIGN.md) para documentación completa.

### Contratos UX-Frontend

Cada componente tiene un contrato bien definido con:
- Props requeridas y opcionales
- Tipos de datos
- Valores por defecto
- Callbacks y eventos
- Ejemplos de uso

Ver [UX-FRONTEND-CONTRACT.md](./UX-FRONTEND-CONTRACT.md) para detalles.

## 🎨 Componentes Principales

### Button

```javascript
import { createButton } from './src/components/atoms/Button';

const button = createButton({
  label: 'Click me',
  variant: 'primary',
  size: 'md',
  icon: '🚀',
  onClick: () => console.log('Clicked!')
});
```

### MetricCard

```javascript
import { createMetricCard } from './src/components/organisms/MetricCard';

const card = createMetricCard({
  title: 'December income',
  value: '287,000',
  prefix: '$',
  tags: ['Macbook m2', 'iPhone 15'],
  trend: {
    value: '18.24%',
    type: 'success'
  },
  chart: {
    type: 'line',
    data: [12, 19, 15, 25, 22, 30, 28]
  }
});
```

### DataTable

```javascript
import { createDataTable } from './src/components/organisms/DataTable';

const table = createDataTable({
  columns: [
    { key: 'name', label: 'Product Name', sortable: true },
    { key: 'price', label: 'Price', format: 'currency' },
    { key: 'rating', label: 'Rating', format: 'rating' }
  ],
  data: products,
  selectable: true,
  pagination: {
    currentPage: 1,
    totalPages: 10
  },
  actions: [
    { label: 'Edit', icon: '✏️', onClick: (row) => edit(row) },
    { label: 'Delete', icon: '🗑️', onClick: (row) => delete(row) }
  ]
});
```

## 🧪 Testing

```bash
# Ejecutar tests
npm test

# Tests con coverage
npm run test:coverage

# Lint
npm run lint

# Validación completa
npm run validate
```

## 🚀 CI/CD Pipeline

El proyecto incluye un pipeline completo de GitLab CI/CD que:

1. **Install** - Instala dependencias
2. **Lint** - Valida código con ESLint
3. **Test** - Ejecuta tests unitarios
4. **Build** - Construye Storybook
5. **Validate** - Valida estructura del Design System
6. **Deploy** - Despliega a GitLab Pages

### Stages del Pipeline

```yaml
stages:
  - install
  - lint
  - test
  - build
  - deploy
```

### Validaciones Automáticas

- ✅ Linting de código
- ✅ Tests unitarios con coverage
- ✅ Validación de estructura Atomic Design
- ✅ Verificación de stories para cada componente
- ✅ Security scanning con npm audit
- ✅ Performance checks del bundle

Ver [.gitlab-ci.yml](./.gitlab-ci.yml) para configuración completa.

## 📊 Chart.js Integration

Los componentes incluyen integración completa con Chart.js:

```javascript
const chartConfig = {
  type: 'line',
  data: {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
    datasets: [{
      label: 'Sales',
      data: [12, 19, 15, 25, 22],
      borderColor: '#6366F1',
      tension: 0.4
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
};
```

Tipos de gráficos soportados:
- Line Charts
- Bar Charts
- Pie Charts
- Doughnut Charts
- Radar Charts
- Polar Area Charts

## 🎯 Uso en Proyectos

### Como Paquete NPM

```bash
npm install @dannyrios/dashboard-design-system
```

```javascript
import { createButton, createMetricCard } from '@dannyrios/dashboard-design-system';
import '@dannyrios/dashboard-design-system/dist/styles.css';
```

### Como Módulo Local

```javascript
import { createButton } from './design-system/src/components/atoms/Button';
```

### Con Yii2 (Backend Integration)

```php
use dannyrios\dashboardui\widgets\MetricCard;

<?= MetricCard::widget([
    'title' => 'December income',
    'value' => '287,000',
    'prefix' => '$'
]) ?>
```

## 🎨 Personalización

### Variables CSS

```css
:root {
  --ds-primary: #6366F1;
  --ds-success: #10B981;
  --ds-danger: #EF4444;
  --ds-font-family: 'Inter', sans-serif;
}
```

### Temas

```javascript
// Tema oscuro
document.documentElement.setAttribute('data-theme', 'dark');

// Tema claro
document.documentElement.setAttribute('data-theme', 'light');
```

## 📖 Scripts Disponibles

```bash
npm run storybook          # Iniciar Storybook en desarrollo
npm run build-storybook    # Build de Storybook para producción
npm run test               # Ejecutar tests
npm run lint               # Lint del código
npm run lint:fix           # Fix automático de lint
npm run validate           # Validación completa (lint + test)
npm run build              # Build del paquete
```

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama de feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Merge Request

### Guía de Contribución

1. Seguir la estructura de Atomic Design
2. Crear story de Storybook para cada componente
3. Escribir tests unitarios
4. Documentar props en el contrato UX-Frontend
5. Asegurar accesibilidad (WCAG AA)
6. Pasar todas las validaciones del CI/CD

## 📄 Licencia

MIT License - ver [LICENSE](LICENSE) para más detalles.

## 🙏 Agradecimientos

- [Bootstrap Team](https://getbootstrap.com/)
- [Storybook Team](https://storybook.js.org/)
- [Chart.js Team](https://www.chartjs.org/)
- [Brad Frost](https://bradfrost.com/) por Atomic Design

## 📞 Soporte

- 📧 Email: danny@example.com
- 🐛 Issues: [GitLab Issues](https://gitlab.com/dannyrios/dashboard-design-system/issues)
- 💬 Discussions: [GitLab Discussions](https://gitlab.com/dannyrios/dashboard-design-system/-/issues)

## 🔗 Enlaces

- [Storybook Demo](https://dannyrios.gitlab.io/dashboard-design-system/)
- [Documentación](https://gitlab.com/dannyrios/dashboard-design-system/-/wikis/home)
- [Changelog](CHANGELOG.md)

---

**Hecho con ❤️ por Danny Rios**
