# Atomic Design Structure

Este Design System sigue la metodología **Atomic Design** de Brad Frost, organizando los componentes en 5 niveles jerárquicos.

## 📐 Jerarquía de Componentes

```
Atoms (Átomos)
  ↓
Molecules (Moléculas)
  ↓
Organisms (Organismos)
  ↓
Templates (Plantillas)
  ↓
Pages (Páginas)
```

---

## ⚛️ Atoms (Átomos)

**Definición**: Los bloques de construcción más básicos. No se pueden dividir más sin perder su función.

### Componentes

#### 1. **Button**
- **Ubicación**: `atoms/Button`
- **Props**:
  ```typescript
  {
    label: string;
    variant: 'primary' | 'secondary' | 'success' | 'danger' | 'warning' | 'info';
    size: 'sm' | 'md' | 'lg';
    icon?: string;
    iconPosition?: 'left' | 'right';
    outline?: boolean;
    disabled?: boolean;
    onClick?: () => void;
  }
  ```

#### 2. **Badge**
- **Ubicación**: `atoms/Badge`
- **Props**:
  ```typescript
  {
    label: string;
    variant: 'primary' | 'secondary' | 'success' | 'danger' | 'warning' | 'info';
    pill?: boolean;
    outline?: boolean;
  }
  ```

#### 3. **Icon**
- **Ubicación**: `atoms/Icon`
- **Props**:
  ```typescript
  {
    name: string;
    size: 'sm' | 'md' | 'lg';
    color?: string;
  }
  ```

#### 4. **Input**
- **Ubicación**: `atoms/Input`
- **Props**:
  ```typescript
  {
    type: 'text' | 'email' | 'password' | 'number' | 'tel' | 'url';
    value: string;
    placeholder?: string;
    disabled?: boolean;
    required?: boolean;
    error?: string;
    onChange?: (value: string) => void;
  }
  ```

#### 5. **Label**
- **Ubicación**: `atoms/Label`
- **Props**:
  ```typescript
  {
    text: string;
    required?: boolean;
    htmlFor?: string;
  }
  ```

#### 6. **Checkbox**
- **Ubicación**: `atoms/Checkbox`
- **Props**:
  ```typescript
  {
    checked: boolean;
    label?: string;
    disabled?: boolean;
    onChange?: (checked: boolean) => void;
  }
  ```

#### 7. **Radio**
- **Ubicación**: `atoms/Radio`
- **Props**:
  ```typescript
  {
    checked: boolean;
    label: string;
    name: string;
    value: string;
    disabled?: boolean;
    onChange?: (value: string) => void;
  }
  ```

#### 8. **Spinner**
- **Ubicación**: `atoms/Spinner`
- **Props**:
  ```typescript
  {
    size: 'sm' | 'md' | 'lg';
    variant: 'border' | 'grow';
    color?: string;
  }
  ```

#### 9. **Divider**
- **Ubicación**: `atoms/Divider`
- **Props**:
  ```typescript
  {
    orientation: 'horizontal' | 'vertical';
    margin?: number;
  }
  ```

#### 10. **Avatar**
- **Ubicación**: `atoms/Avatar`
- **Props**:
  ```typescript
  {
    src?: string;
    alt: string;
    size: 'sm' | 'md' | 'lg';
    fallback?: string;
  }
  ```

---

## 🧬 Molecules (Moléculas)

**Definición**: Grupos de átomos que funcionan juntos como una unidad.

### Componentes

#### 1. **FormField**
- **Ubicación**: `molecules/FormField`
- **Composición**: Label + Input + ErrorMessage
- **Props**:
  ```typescript
  {
    label: string;
    type: 'text' | 'email' | 'password' | 'number';
    value: string;
    placeholder?: string;
    required?: boolean;
    error?: string;
    hint?: string;
    onChange?: (value: string) => void;
  }
  ```

#### 2. **SearchBar**
- **Ubicación**: `molecules/SearchBar`
- **Composición**: Input + Icon + Button
- **Props**:
  ```typescript
  {
    placeholder?: string;
    value: string;
    onSearch: (query: string) => void;
  }
  ```

#### 3. **MetricDisplay**
- **Ubicación**: `molecules/MetricDisplay`
- **Composición**: Label + Value + Trend + Icon
- **Props**:
  ```typescript
  {
    label: string;
    value: string | number;
    trend?: {
      value: string;
      direction: 'up' | 'down';
      type: 'positive' | 'negative';
    };
    icon?: string;
  }
  ```

#### 4. **Tag**
- **Ubicación**: `molecules/Tag`
- **Composición**: Badge + CloseButton
- **Props**:
  ```typescript
  {
    label: string;
    variant: 'primary' | 'secondary' | 'success' | 'danger';
    removable?: boolean;
    onRemove?: () => void;
  }
  ```

#### 5. **Breadcrumb**
- **Ubicación**: `molecules/Breadcrumb`
- **Composición**: Link[] + Separator
- **Props**:
  ```typescript
  {
    items: Array<{
      label: string;
      href?: string;
      active?: boolean;
    }>;
  }
  ```

#### 6. **Pagination**
- **Ubicación**: `molecules/Pagination`
- **Composición**: Button[] + PageNumbers
- **Props**:
  ```typescript
  {
    currentPage: number;
    totalPages: number;
    onPageChange: (page: number) => void;
    maxButtons?: number;
  }
  ```

#### 7. **ProgressBar**
- **Ubicación**: `molecules/ProgressBar`
- **Composición**: Label + Bar + Percentage
- **Props**:
  ```typescript
  {
    value: number;
    max: number;
    label?: string;
    variant: 'primary' | 'success' | 'warning' | 'danger';
    striped?: boolean;
    animated?: boolean;
  }
  ```

#### 8. **Alert**
- **Ubicación**: `molecules/Alert`
- **Composición**: Icon + Message + CloseButton
- **Props**:
  ```typescript
  {
    type: 'success' | 'danger' | 'warning' | 'info';
    title?: string;
    message: string;
    dismissible?: boolean;
    onDismiss?: () => void;
  }
  ```

#### 9. **UserProfile**
- **Ubicación**: `molecules/UserProfile`
- **Composición**: Avatar + Name + Role
- **Props**:
  ```typescript
  {
    avatar?: string;
    name: string;
    role?: string;
    size: 'sm' | 'md' | 'lg';
  }
  ```

#### 10. **ChartLegend**
- **Ubicación**: `molecules/ChartLegend`
- **Composición**: Icon[] + Label[]
- **Props**:
  ```typescript
  {
    items: Array<{
      label: string;
      color: string;
      value?: string;
    }>;
  }
  ```

---

## 🏗️ Organisms (Organismos)

**Definición**: Grupos de moléculas y/o átomos que forman secciones complejas de la interfaz.

### Componentes

#### 1. **Navbar**
- **Ubicación**: `organisms/Navbar`
- **Composición**: Logo + Navigation + UserProfile + SearchBar
- **Props**:
  ```typescript
  {
    brand: {
      logo?: string;
      name: string;
      href: string;
    };
    navigation: Array<{
      label: string;
      href: string;
      active?: boolean;
      items?: Array<{
        label: string;
        href: string;
      }>;
    }>;
    user?: {
      name: string;
      avatar?: string;
      role?: string;
    };
    searchEnabled?: boolean;
  }
  ```

#### 2. **Sidebar**
- **Ubicación**: `organisms/Sidebar`
- **Composición**: UserProfile + Navigation + MenuSections
- **Props**:
  ```typescript
  {
    user: {
      name: string;
      role: string;
      avatar?: string;
    };
    mainMenu: Array<{
      label: string;
      icon: string;
      href: string;
      active?: boolean;
    }>;
    sections?: Array<{
      title: string;
      items: Array<{
        label: string;
        icon: string;
        href: string;
      }>;
    }>;
    searchEnabled?: boolean;
  }
  ```

#### 3. **MetricCard**
- **Ubicación**: `organisms/MetricCard`
- **Composición**: Card + MetricDisplay + Chart + Tags
- **Props**:
  ```typescript
  {
    title: string;
    value: string | number;
    prefix?: string;
    suffix?: string;
    trend?: {
      value: string;
      type: 'success' | 'danger';
    };
    tags?: string[];
    chart?: {
      type: 'line' | 'bar';
      data: number[];
      labels?: string[];
    };
    icon?: string;
  }
  ```

#### 4. **DataTable**
- **Ubicación**: `organisms/DataTable`
- **Composición**: Table + Pagination + SearchBar + Actions
- **Props**:
  ```typescript
  {
    columns: Array<{
      key: string;
      label: string;
      sortable?: boolean;
      format?: 'text' | 'number' | 'date' | 'currency' | 'badge';
    }>;
    data: Array<Record<string, any>>;
    selectable?: boolean;
    pagination?: {
      currentPage: number;
      totalPages: number;
      onPageChange: (page: number) => void;
    };
    actions?: Array<{
      label: string;
      icon?: string;
      onClick: (row: any) => void;
    }>;
  }
  ```

#### 5. **Form**
- **Ubicación**: `organisms/Form`
- **Composición**: FormFields + Buttons
- **Props**:
  ```typescript
  {
    title?: string;
    description?: string;
    fields: Array<{
      name: string;
      label: string;
      type: 'text' | 'email' | 'password' | 'select' | 'checkbox' | 'radio' | 'textarea';
      required?: boolean;
      options?: Array<{ label: string; value: string }>;
    }>;
    onSubmit: (data: Record<string, any>) => void;
    submitLabel?: string;
    cancelLabel?: string;
    onCancel?: () => void;
  }
  ```

#### 6. **Modal**
- **Ubicación**: `organisms/Modal`
- **Composición**: Header + Body + Footer
- **Props**:
  ```typescript
  {
    title: string;
    content: string | HTMLElement;
    footer?: string | HTMLElement;
    size: 'sm' | 'md' | 'lg' | 'xl';
    centered?: boolean;
    onClose?: () => void;
  }
  ```

#### 7. **Accordion**
- **Ubicación**: `organisms/Accordion`
- **Composición**: AccordionItems[]
- **Props**:
  ```typescript
  {
    items: Array<{
      title: string;
      content: string | HTMLElement;
    }>;
    activeItems?: number[];
    alwaysOpen?: boolean;
  }
  ```

#### 8. **Carousel**
- **Ubicación**: `organisms/Carousel`
- **Composición**: Slides + Controls + Indicators
- **Props**:
  ```typescript
  {
    items: Array<{
      image: string;
      alt: string;
      title?: string;
      caption?: string;
    }>;
    autoplay?: boolean;
    interval?: number;
    controls?: boolean;
    indicators?: boolean;
  }
  ```

#### 9. **Timeline**
- **Ubicación**: `organisms/Timeline`
- **Composición**: TimelineItems[]
- **Props**:
  ```typescript
  {
    items: Array<{
      time: string;
      title: string;
      content: string;
      icon?: string;
      color?: 'primary' | 'success' | 'danger' | 'warning';
    }>;
    align?: 'left' | 'center';
  }
  ```

#### 10. **ChartWidget**
- **Ubicación**: `organisms/ChartWidget`
- **Composición**: Card + Chart + Legend + Filters
- **Props**:
  ```typescript
  {
    title: string;
    type: 'line' | 'bar' | 'pie' | 'doughnut';
    data: {
      labels: string[];
      datasets: Array<{
        label: string;
        data: number[];
        backgroundColor?: string | string[];
        borderColor?: string;
      }>;
    };
    options?: Record<string, any>;
    filters?: Array<{
      label: string;
      value: string;
    }>;
  }
  ```

---

## 📄 Templates (Plantillas)

**Definición**: Composiciones de organismos que definen la estructura de una página.

### Plantillas

#### 1. **DashboardTemplate**
- **Composición**: Sidebar + Navbar + MainContent + Footer
- **Uso**: Layout base para dashboards

#### 2. **FormTemplate**
- **Composición**: Navbar + Form + Sidebar (opcional)
- **Uso**: Páginas de formularios

#### 3. **ListTemplate**
- **Composición**: Navbar + Filters + DataTable
- **Uso**: Páginas de listados

---

## 📱 Pages (Páginas)

**Definición**: Instancias específicas de templates con contenido real.

### Páginas

#### 1. **Dashboard Page**
- **Template**: DashboardTemplate
- **Contenido**: MetricCards + Charts + DataTable

#### 2. **Product List Page**
- **Template**: ListTemplate
- **Contenido**: ProductTable + Filters

#### 3. **User Profile Page**
- **Template**: FormTemplate
- **Contenido**: UserForm + Avatar

---

## 🎯 Contrato UX → Frontend

### Estructura de Props

Cada componente debe definir:

1. **Props requeridas** - Marcadas sin `?`
2. **Props opcionales** - Marcadas con `?`
3. **Tipos estrictos** - Usar TypeScript o PropTypes
4. **Valores por defecto** - Documentados en Storybook
5. **Callbacks** - Eventos que el componente emite

### Ejemplo de Contrato

```typescript
// atoms/Button/Button.types.ts
export interface ButtonProps {
  // Required
  label: string;
  
  // Optional with defaults
  variant?: 'primary' | 'secondary' | 'success' | 'danger';
  size?: 'sm' | 'md' | 'lg';
  
  // Optional
  icon?: string;
  disabled?: boolean;
  
  // Callbacks
  onClick?: () => void;
}

export const defaultProps: Partial<ButtonProps> = {
  variant: 'primary',
  size: 'md',
  disabled: false,
};
```

---

## 📊 Matriz de Componentes

| Nivel | Cantidad | Ejemplos |
|-------|----------|----------|
| Atoms | 10 | Button, Badge, Input, Icon |
| Molecules | 10 | FormField, SearchBar, MetricDisplay |
| Organisms | 10 | Navbar, Sidebar, DataTable, Form |
| Templates | 3 | DashboardTemplate, FormTemplate, ListTemplate |
| Pages | 3+ | Dashboard, ProductList, UserProfile |

**Total: 30+ componentes base**

---

## 🔄 Flujo de Trabajo

1. **Diseño** → Definir componente en Figma/Sketch
2. **Contrato** → Crear tipos TypeScript con props
3. **Implementación** → Desarrollar componente
4. **Story** → Crear story en Storybook
5. **Testing** → Escribir tests unitarios
6. **Documentación** → Completar docs en Storybook
7. **Review** → Code review y UX review
8. **Publish** → Merge y publicación

---

## 📚 Referencias

- [Atomic Design by Brad Frost](https://atomicdesign.bradfrost.com/)
- [Storybook Documentation](https://storybook.js.org/)
- [Bootstrap 5 Components](https://getbootstrap.com/docs/5.3/components/)
