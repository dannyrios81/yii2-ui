import { createMetricCard } from '../../src/components/organisms/MetricCard';

export default {
  title: 'Organisms/MetricCard',
  tags: ['autodocs'],
  argTypes: {
    title: {
      control: 'text',
      description: 'Card title',
    },
    value: {
      control: 'text',
      description: 'Main metric value',
    },
    prefix: {
      control: 'text',
      description: 'Value prefix (e.g., $)',
    },
    suffix: {
      control: 'text',
      description: 'Value suffix (e.g., %)',
    },
    tags: {
      control: 'object',
      description: 'Array of tags',
    },
    trend: {
      control: 'object',
      description: 'Trend information',
    },
    chart: {
      control: 'object',
      description: 'Chart configuration',
    },
    icon: {
      control: 'text',
      description: 'Icon (emoji)',
    },
  },
  parameters: {
    docs: {
      description: {
        component: 'Metric card with trend indicators, tags, and optional chart visualization.',
      },
    },
  },
};

export const DecemberIncome = {
  args: {
    title: 'December income',
    value: '287,000',
    prefix: '$',
    tags: ['Macbook m2', 'iPhone 15'],
    trend: {
      value: '18.24%',
      type: 'success',
    },
    chart: {
      type: 'line',
      data: [12, 19, 15, 25, 22, 30, 28],
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    },
    icon: '💰',
  },
};

export const DecemberSales = {
  args: {
    title: 'December sales',
    value: '4.5k',
    trend: {
      value: '9.18%',
      type: 'danger',
    },
    chart: {
      type: 'bar',
      data: [1272, 675],
      labels: ['iPhone 15', 'Macbook'],
    },
    icon: '📊',
  },
};

export const TotalUsers = {
  args: {
    title: 'Total Users',
    value: '12,543',
    trend: {
      value: '5.2%',
      type: 'success',
    },
    icon: '👥',
  },
};

export const ConversionRate = {
  args: {
    title: 'Conversion Rate',
    value: '3.24',
    suffix: '%',
    trend: {
      value: '0.5%',
      type: 'success',
    },
    chart: {
      type: 'line',
      data: [2.1, 2.5, 2.8, 3.0, 3.1, 3.2, 3.24],
    },
    icon: '📈',
  },
};

export const WithoutChart = {
  args: {
    title: 'Active Sessions',
    value: '1,234',
    tags: ['Desktop', 'Mobile'],
    icon: '🖥️',
  },
};

export const AllMetrics = () => {
  const container = document.createElement('div');
  container.className = 'row g-4';
  
  const metrics = [
    {
      title: 'Revenue',
      value: '287,000',
      prefix: '$',
      trend: { value: '18.24%', type: 'success' },
      icon: '💰',
    },
    {
      title: 'Orders',
      value: '4,521',
      trend: { value: '12.5%', type: 'success' },
      icon: '🛒',
    },
    {
      title: 'Customers',
      value: '1,234',
      trend: { value: '3.2%', type: 'danger' },
      icon: '👥',
    },
    {
      title: 'Growth',
      value: '23.5',
      suffix: '%',
      trend: { value: '5.1%', type: 'success' },
      icon: '📈',
    },
  ];
  
  metrics.forEach(metric => {
    const col = document.createElement('div');
    col.className = 'col-md-6 col-lg-3';
    col.appendChild(createMetricCard(metric));
    container.appendChild(col);
  });
  
  return container;
};
