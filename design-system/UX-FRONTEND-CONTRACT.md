# Contrato UX → Frontend

Este documento define el contrato entre el equipo de UX/Diseño y el equipo de Frontend para el Design System.

## 📋 Tabla de Contenidos

1. [Principios del Contrato](#principios-del-contrato)
2. [Estructura de Props](#estructura-de-props)
3. [Tipos de Datos](#tipos-de-datos)
4. [Contratos por Componente](#contratos-por-componente)
5. [Validación y Testing](#validación-y-testing)
6. [Versionado](#versionado)

---

## Principios del Contrato

### 1. **Inmutabilidad**
- Las props son inmutables una vez definidas
- Cambios requieren nueva versión del componente
- Deprecación gradual de props antiguas

### 2. **Tipado Fuerte**
- Todas las props deben tener tipo definido
- Uso de TypeScript o PropTypes
- Validación en desarrollo

### 3. **Valores por Defecto**
- Todas las props opcionales tienen valores por defecto
- Documentados en Storybook
- Consistentes en todo el sistema

### 4. **Retrocompatibilidad**
- Mantener compatibilidad por al menos 2 versiones
- Avisos de deprecación claros
- Guías de migración

---

## Estructura de Props

### Nomenclatura

```typescript
interface ComponentProps {
  // Required props (sin ?)
  requiredProp: Type;
  
  // Optional props (con ?)
  optionalProp?: Type;
  
  // Props con valores por defecto
  propWithDefault?: Type; // default: value
  
  // Callbacks
  onEvent?: (param: Type) => void;
  
  // Children/Content
  children?: React.ReactNode | string;
}
```

### Categorías de Props

1. **Data Props** - Datos a mostrar
2. **Style Props** - Variantes visuales
3. **Behavior Props** - Comportamiento del componente
4. **Event Props** - Callbacks y eventos
5. **Accessibility Props** - ARIA y a11y

---

## Tipos de Datos

### Tipos Primitivos

```typescript
type Primitive = string | number | boolean;
```

### Tipos Compuestos

```typescript
// Variant types
type Variant = 'primary' | 'secondary' | 'success' | 'danger' | 'warning' | 'info';

// Size types
type Size = 'sm' | 'md' | 'lg' | 'xl';

// Position types
type Position = 'top' | 'right' | 'bottom' | 'left';

// Alignment types
type Alignment = 'start' | 'center' | 'end';
```

### Tipos de Objetos

```typescript
// User type
interface User {
  id: string | number;
  name: string;
  email?: string;
  avatar?: string;
  role?: string;
}

// Trend type
interface Trend {
  value: string;
  type: 'success' | 'danger';
  direction?: 'up' | 'down';
}

// Chart data type
interface ChartData {
  labels: string[];
  datasets: Array<{
    label: string;
    data: number[];
    backgroundColor?: string | string[];
    borderColor?: string;
  }>;
}
```

---

## Contratos por Componente

### Atoms

#### Button

```typescript
interface ButtonProps {
  // Required
  label: string;
  
  // Optional - Style
  variant?: 'primary' | 'secondary' | 'success' | 'danger' | 'warning' | 'info';
  size?: 'sm' | 'md' | 'lg';
  outline?: boolean;
  rounded?: boolean;
  block?: boolean;
  
  // Optional - Behavior
  disabled?: boolean;
  loading?: boolean;
  
  // Optional - Icon
  icon?: string;
  iconPosition?: 'left' | 'right';
  
  // Optional - Events
  onClick?: () => void;
  
  // Optional - Accessibility
  ariaLabel?: string;
  type?: 'button' | 'submit' | 'reset';
}

const defaultProps: Partial<ButtonProps> = {
  variant: 'primary',
  size: 'md',
  outline: false,
  rounded: true,
  block: false,
  disabled: false,
  loading: false,
  iconPosition: 'left',
  type: 'button',
};
```

#### Input

```typescript
interface InputProps {
  // Required
  value: string;
  onChange: (value: string) => void;
  
  // Optional - Style
  size?: 'sm' | 'md' | 'lg';
  
  // Optional - Behavior
  type?: 'text' | 'email' | 'password' | 'number' | 'tel' | 'url' | 'search';
  placeholder?: string;
  disabled?: boolean;
  readonly?: boolean;
  required?: boolean;
  
  // Optional - Validation
  error?: string;
  valid?: boolean;
  
  // Optional - Addons
  prepend?: string;
  append?: string;
  
  // Optional - Accessibility
  id?: string;
  name?: string;
  ariaLabel?: string;
  ariaDescribedBy?: string;
}

const defaultProps: Partial<InputProps> = {
  type: 'text',
  size: 'md',
  disabled: false,
  readonly: false,
  required: false,
};
```

### Molecules

#### FormField

```typescript
interface FormFieldProps {
  // Required
  label: string;
  value: string;
  onChange: (value: string) => void;
  
  // Optional - Input props
  type?: 'text' | 'email' | 'password' | 'number' | 'tel' | 'url';
  placeholder?: string;
  
  // Optional - Validation
  required?: boolean;
  error?: string;
  hint?: string;
  
  // Optional - Style
  size?: 'sm' | 'md' | 'lg';
  
  // Optional - Accessibility
  id?: string;
  name?: string;
}

const defaultProps: Partial<FormFieldProps> = {
  type: 'text',
  size: 'md',
  required: false,
};
```

#### MetricDisplay

```typescript
interface MetricDisplayProps {
  // Required
  label: string;
  value: string | number;
  
  // Optional - Formatting
  prefix?: string;
  suffix?: string;
  
  // Optional - Trend
  trend?: {
    value: string;
    type: 'success' | 'danger';
    direction?: 'up' | 'down';
  };
  
  // Optional - Visual
  icon?: string;
  color?: Variant;
}

const defaultProps: Partial<MetricDisplayProps> = {
  prefix: '',
  suffix: '',
};
```

### Organisms

#### MetricCard

```typescript
interface MetricCardProps {
  // Required
  title: string;
  value: string | number;
  
  // Optional - Formatting
  prefix?: string;
  suffix?: string;
  
  // Optional - Additional data
  tags?: string[];
  trend?: {
    value: string;
    type: 'success' | 'danger';
  };
  
  // Optional - Chart
  chart?: {
    type: 'line' | 'bar' | 'pie' | 'doughnut';
    data: number[];
    labels?: string[];
    options?: Record<string, any>;
  };
  
  // Optional - Visual
  icon?: string;
  variant?: Variant;
  
  // Optional - Events
  onClick?: () => void;
}

const defaultProps: Partial<MetricCardProps> = {
  prefix: '',
  suffix: '',
  tags: [],
  variant: 'primary',
};
```

#### DataTable

```typescript
interface Column {
  key: string;
  label: string;
  sortable?: boolean;
  format?: 'text' | 'number' | 'date' | 'currency' | 'badge' | 'custom';
  render?: (value: any, row: any) => string | HTMLElement;
  width?: string;
  align?: 'left' | 'center' | 'right';
}

interface Action {
  label: string;
  icon?: string;
  variant?: Variant;
  onClick: (row: any) => void;
  visible?: (row: any) => boolean;
}

interface Pagination {
  currentPage: number;
  totalPages: number;
  totalItems: number;
  itemsPerPage: number;
  onPageChange: (page: number) => void;
}

interface DataTableProps {
  // Required
  columns: Column[];
  data: Array<Record<string, any>>;
  
  // Optional - Features
  selectable?: boolean;
  sortable?: boolean;
  pagination?: Pagination;
  actions?: Action[];
  
  // Optional - Style
  striped?: boolean;
  bordered?: boolean;
  hover?: boolean;
  responsive?: boolean;
  
  // Optional - Empty state
  emptyText?: string;
  emptyIcon?: string;
  
  // Optional - Events
  onRowClick?: (row: any) => void;
  onSelectionChange?: (selectedRows: any[]) => void;
  onSort?: (column: string, direction: 'asc' | 'desc') => void;
}

const defaultProps: Partial<DataTableProps> = {
  selectable: false,
  sortable: true,
  striped: false,
  bordered: true,
  hover: true,
  responsive: true,
  emptyText: 'No data available',
  actions: [],
};
```

#### Sidebar

```typescript
interface MenuItem {
  label: string;
  icon: string;
  href: string;
  active?: boolean;
  badge?: {
    label: string;
    variant: Variant;
  };
}

interface MenuSection {
  title: string;
  items: MenuItem[];
}

interface SidebarProps {
  // Required
  user: {
    name: string;
    role: string;
    avatar?: string;
  };
  mainMenu: MenuItem[];
  
  // Optional - Additional sections
  sections?: MenuSection[];
  
  // Optional - Features
  searchEnabled?: boolean;
  searchPlaceholder?: string;
  collapsible?: boolean;
  collapsed?: boolean;
  
  // Optional - Style
  width?: string;
  variant?: 'light' | 'dark';
  
  // Optional - Events
  onMenuClick?: (item: MenuItem) => void;
  onSearch?: (query: string) => void;
  onToggle?: (collapsed: boolean) => void;
}

const defaultProps: Partial<SidebarProps> = {
  searchEnabled: true,
  searchPlaceholder: 'Search',
  collapsible: true,
  collapsed: false,
  width: '280px',
  variant: 'light',
  sections: [],
};
```

---

## Validación y Testing

### Validación de Props

```javascript
// Ejemplo con PropTypes (JavaScript)
import PropTypes from 'prop-types';

Button.propTypes = {
  label: PropTypes.string.isRequired,
  variant: PropTypes.oneOf(['primary', 'secondary', 'success', 'danger', 'warning', 'info']),
  size: PropTypes.oneOf(['sm', 'md', 'lg']),
  outline: PropTypes.bool,
  disabled: PropTypes.bool,
  icon: PropTypes.string,
  iconPosition: PropTypes.oneOf(['left', 'right']),
  onClick: PropTypes.func,
};

Button.defaultProps = {
  variant: 'primary',
  size: 'md',
  outline: false,
  disabled: false,
  iconPosition: 'left',
};
```

### Testing de Contratos

```javascript
// Ejemplo de test
describe('Button Contract', () => {
  it('should accept all required props', () => {
    const props = { label: 'Click me' };
    expect(() => createButton(props)).not.toThrow();
  });
  
  it('should use default values for optional props', () => {
    const button = createButton({ label: 'Click me' });
    expect(button.className).toContain('btn-primary');
    expect(button.className).toContain('btn-md');
  });
  
  it('should validate variant prop', () => {
    const invalidProps = { label: 'Click me', variant: 'invalid' };
    expect(() => createButton(invalidProps)).toThrow();
  });
});
```

---

## Versionado

### Semantic Versioning

- **MAJOR** (1.0.0): Cambios incompatibles en el contrato
- **MINOR** (0.1.0): Nuevas props opcionales
- **PATCH** (0.0.1): Fixes que no afectan el contrato

### Changelog de Contratos

```markdown
## [2.0.0] - 2024-02-01
### Breaking Changes
- Button: Removed `type` prop, use `variant` instead
- Input: `onChange` now returns value instead of event

### Added
- Button: New `loading` prop
- MetricCard: New `chart` prop for inline charts

### Deprecated
- Button: `rounded` prop (will be removed in 3.0.0)
```

---

## Checklist de Implementación

### Para UX/Diseño

- [ ] Definir props requeridas y opcionales
- [ ] Especificar tipos de datos
- [ ] Documentar valores por defecto
- [ ] Crear ejemplos visuales en Figma
- [ ] Definir estados (hover, active, disabled)
- [ ] Especificar comportamiento responsive
- [ ] Documentar casos de uso

### Para Frontend

- [ ] Implementar validación de props
- [ ] Crear tests unitarios
- [ ] Documentar en Storybook
- [ ] Implementar todos los estados
- [ ] Verificar accesibilidad
- [ ] Optimizar performance
- [ ] Code review

---

## Recursos

- [TypeScript Handbook](https://www.typescriptlang.org/docs/)
- [PropTypes Documentation](https://reactjs.org/docs/typechecking-with-proptypes.html)
- [Storybook Args](https://storybook.js.org/docs/react/writing-stories/args)
- [Atomic Design](https://atomicdesign.bradfrost.com/)
