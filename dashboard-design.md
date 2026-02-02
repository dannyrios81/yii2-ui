# Dashboard - Design Documentation

## Overview

Dashboard principal que muestra información general del sistema con métricas clave, reportes y gestión de productos.

**URL**: `10amstudio.statly/overview/instagram`

---

## Layout Structure

### Sidebar Navigation

**User Profile**
- Avatar: Wildan
- Role: Creative Director

**Main Menu**
- 🏠 Dashboard (active)
- 📊 Analytics

**Account Section**
- 👤 Account
- 📄 My Publishing
- 📦 Products
- ▶️ Orders
- ⋯ More

**Other Menu**
- ⚙️ Setting
- ❓ Help
- 🔔 Subscriptions

---

## Main Content Area

### Header
```
Dashboard
All general information appears in this field
```

### Metrics Cards

#### Card 1: December Income
```
December income
$287,000

Tags:
# Macbook m2    # iPhone 15

Chart: Line chart showing upward trend
Performance: ↗ 18.24%
```

#### Card 2: December Sales
```
December sales
4.5k

Details:
1,272 iPhone 15    675 Macbook

Chart: Bar chart showing comparison
Performance: ↘ 9.18%
```

### December Report Card
```
December Report
Retrieve December report, analyze key data for informed strategic decisions.

Actions:
[Analyze This 🔗] [Download]
```

**Tabs**: Published | Draft

---

## Product Table

### Table Structure

| Column | Type | Description |
|--------|------|-------------|
| ☑️ | Checkbox | Row selection |
| PRODUCT NAME | Text | Nombre del producto |
| FIRST STOCK | Number | Stock inicial con icono 📦 |
| SOLD | Number | Unidades vendidas con icono 🎯 |
| DATE ADDED | Date | Fecha de agregado |
| PRICING | Currency | Precio en $ |
| RATING | Stars | Calificación ⭐ |
| ACTION | Icons | Editar ✏️ y Eliminar 🗑️ |

### Sample Data

#### Row 1 (Selected)
- ☑️ **MacBook Pro with M2 Chip**
- First Stock: 📦 4,159 → Sold: 🎯 878
- Date: Jul 14, 2023
- Price: $1,200
- Rating: ⭐ 4.8

#### Row 2 (Selected)
- ☑️ **iPhone 15 128 / 256 / 512 IBOX**
- First Stock: 📦 1,690 → Sold: 🎯 981
- Date: Aug 09, 2023
- Price: $1,660
- Rating: ⭐ 5.0

#### Row 3 (Selected)
- ☑️ **Apple Watch Ultra 2 Alpine**
- First Stock: 📦 1,090 → Sold: 🎯 184
- Date: Aug 12, 2023
- Price: $999
- Rating: ⭐ 4.7

#### Row 4
- ☐ **iPhone 15 Pro Max 256**
- First Stock: 📦 2,690 → Sold: 🎯 905
- Date: Aug 24, 2023
- Price: $1,600
- Rating: ⭐ 4.2

#### Row 5
- ☐ **MacBook Pro with M2 Chip**
- First Stock: 📦 4,100 → Sold: 🎯 645
- Date: Nov 30, 2023
- Price: $1,200
- Rating: ⭐ 5.0

#### Row 6
- ☐ **Apple Watch Series 9 45MM**
- First Stock: 📦 3,140 → Sold: 🎯 981
- Date: Dec 04, 2023
- Price: $980
- Rating: ⭐ 4.6

#### Row 7
- ☐ **Apple Watch Ultra 2 Alpine**
- First Stock: 📦 2,150 → Sold: 🎯 167
- Date: Dec 05, 2023
- Price: $799
- Rating: ⭐ 4.8

### Pagination
```
[Prev] [1] [2] ... [8] [9] [Next]

Showing 7 of 120 entries
```

### Actions
- **Export Now** (Purple button, top right)

---

## Design Specifications

### Color Palette

**Primary Colors**
- Purple/Indigo: `#6366F1` (Primary buttons, active states)
- White: `#FFFFFF` (Background)
- Light Gray: `#F9FAFB` (Card backgrounds)

**Text Colors**
- Dark: `#111827` (Headings)
- Medium Gray: `#6B7280` (Body text)
- Light Gray: `#9CA3AF` (Secondary text)

**Status Colors**
- Success Green: `#10B981` (Positive metrics)
- Error Red: `#EF4444` (Negative metrics)
- Warning: `#F59E0B`

### Typography

**Font Family**: Inter / SF Pro Display

**Sizes**:
- H1 (Dashboard): 32px, Bold
- H2 (Card titles): 14px, Medium
- H3 (Metrics): 36px, Bold
- Body: 14px, Regular
- Small: 12px, Regular

### Spacing

- Card padding: 24px
- Card gap: 16px
- Table row height: 56px
- Sidebar width: 240px

### Components

#### Button Styles
```css
Primary Button (Analyze This):
- Background: #6366F1
- Color: White
- Padding: 12px 24px
- Border-radius: 8px
- Icon: 🔗

Secondary Button (Download):
- Background: White
- Color: #6B7280
- Border: 1px solid #E5E7EB
- Padding: 12px 24px
- Border-radius: 8px
```

#### Card Style
```css
Card:
- Background: White
- Border-radius: 12px
- Box-shadow: 0 1px 3px rgba(0,0,0,0.1)
- Padding: 24px
```

#### Table Style
```css
Table:
- Background: White
- Border-radius: 12px
- Row hover: #F9FAFB
- Border: 1px solid #E5E7EB
```

---

## Interactive States

### Hover States
- Sidebar items: Background `#F3F4F6`
- Table rows: Background `#F9FAFB`
- Buttons: Opacity 90%

### Active States
- Sidebar active item: Purple left border + Purple icon
- Selected table rows: Purple checkbox + Light purple background

### Focus States
- Input fields: Blue border `#3B82F6`
- Buttons: Blue ring outline

---

## Responsive Behavior

### Desktop (1024px+)
- Full sidebar visible
- 3-column card layout for metrics
- Full table with all columns

### Tablet (768px - 1023px)
- Collapsible sidebar
- 2-column card layout
- Scrollable table

### Mobile (< 768px)
- Hamburger menu
- Single column cards
- Card-based table view

---

## Accessibility

- **ARIA Labels**: All interactive elements
- **Keyboard Navigation**: Full support
- **Screen Reader**: Semantic HTML structure
- **Color Contrast**: WCAG AA compliant
- **Focus Indicators**: Visible on all interactive elements

---

## Usage Examples

### Use Case 1: Monthly Review
User accesses dashboard to review December performance, clicks "Analyze This" to get detailed insights.

### Use Case 2: Product Management
User selects multiple products from table and performs bulk actions (edit/delete).

### Use Case 3: Quick Metrics
User glances at income and sales cards to get instant overview of business performance.

---

## Technical Notes

### Data Sources
- Income data: Real-time from sales API
- Product inventory: Updated every 5 minutes
- Charts: Generated using Chart.js or Recharts

### Performance
- Initial load: < 2s
- Table pagination: Client-side for better UX
- Charts: Lazy loaded

### Dependencies
- React/Next.js
- TailwindCSS
- Chart library (Chart.js/Recharts)
- Icon library (Lucide/Heroicons)

---

## Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | 2024 | Initial design |

---

## Related Components

- `<Sidebar />` - Navigation sidebar
- `<MetricCard />` - Income/Sales cards
- `<ReportCard />` - December report card
- `<ProductTable />` - Product listing table
- `<Pagination />` - Table pagination
- `<Button />` - Primary/Secondary buttons
- `<Chart />` - Line/Bar charts

---

## Design Files

**Figma**: [Link to design file]  
**Assets**: `/assets/dashboard/`  
**Icons**: Lucide Icons / Heroicons
