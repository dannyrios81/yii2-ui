import { createDataTable } from '../../src/components/organisms/DataTable';

export default {
  title: 'Organisms/DataTable',
  tags: ['autodocs'],
  parameters: {
    docs: {
      description: {
        component: 'Advanced data table with sorting, pagination, selection, and actions.',
      },
    },
    layout: 'fullscreen',
  },
};

const sampleData = [
  {
    id: 1,
    name: 'MacBook Pro with M2 Chip',
    first_stock: 4159,
    sold: 878,
    date: 'Jul 14, 2023',
    price: 1200,
    rating: 4.8,
  },
  {
    id: 2,
    name: 'iPhone 15 128 / 256 / 512 IBOX',
    first_stock: 1690,
    sold: 981,
    date: 'Aug 09, 2023',
    price: 1660,
    rating: 5.0,
  },
  {
    id: 3,
    name: 'Apple Watch Ultra 2 Alpine',
    first_stock: 1090,
    sold: 184,
    date: 'Aug 12, 2023',
    price: 999,
    rating: 4.7,
  },
  {
    id: 4,
    name: 'iPhone 15 Pro Max 256',
    first_stock: 2690,
    sold: 905,
    date: 'Aug 24, 2023',
    price: 1600,
    rating: 4.2,
  },
  {
    id: 5,
    name: 'MacBook Pro with M2 Chip',
    first_stock: 4100,
    sold: 645,
    date: 'Nov 30, 2023',
    price: 1200,
    rating: 5.0,
  },
  {
    id: 6,
    name: 'Apple Watch Series 9 45MM',
    first_stock: 3140,
    sold: 981,
    date: 'Dec 04, 2023',
    price: 980,
    rating: 4.6,
  },
  {
    id: 7,
    name: 'Apple Watch Ultra 2 Alpine',
    first_stock: 2150,
    sold: 167,
    date: 'Dec 05, 2023',
    price: 799,
    rating: 4.8,
  },
];

const columns = [
  {
    key: 'name',
    label: 'PRODUCT NAME',
    sortable: true,
  },
  {
    key: 'first_stock',
    label: 'FIRST STOCK',
    format: 'stock',
    sortable: true,
  },
  {
    key: 'sold',
    label: 'SOLD',
    format: 'sold',
    sortable: true,
  },
  {
    key: 'date',
    label: 'DATE ADDED',
    sortable: true,
  },
  {
    key: 'price',
    label: 'PRICING',
    format: 'currency',
    sortable: true,
  },
  {
    key: 'rating',
    label: 'RATING',
    format: 'rating',
    sortable: true,
  },
];

export const ProductTable = {
  args: {
    columns,
    data: sampleData,
    selectable: true,
    pagination: {
      currentPage: 1,
      totalPages: 9,
      totalItems: 120,
      itemsPerPage: 7,
    },
    actions: [
      {
        label: 'Edit',
        icon: '✏️',
        onClick: (row) => console.log('Edit', row),
      },
      {
        label: 'Delete',
        icon: '🗑️',
        variant: 'danger',
        onClick: (row) => console.log('Delete', row),
      },
    ],
  },
};

export const SimpleTable = {
  args: {
    columns: columns.slice(0, 4),
    data: sampleData.slice(0, 5),
    selectable: false,
  },
};

export const WithoutActions = {
  args: {
    columns,
    data: sampleData,
    selectable: true,
    actions: [],
  },
};

export const EmptyState = {
  args: {
    columns,
    data: [],
    emptyText: 'No products found',
  },
};
