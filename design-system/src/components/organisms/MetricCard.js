import Chart from 'chart.js/auto';

/**
 * MetricCard Component
 * @organism
 * 
 * Displays a metric with optional trend, tags, and chart visualization.
 * 
 * @param {Object} props - Component props
 * @param {string} props.title - Card title
 * @param {string|number} props.value - Main metric value
 * @param {string} [props.prefix] - Value prefix (e.g., $)
 * @param {string} [props.suffix] - Value suffix (e.g., %)
 * @param {string[]} [props.tags] - Array of tags
 * @param {Object} [props.trend] - Trend information
 * @param {string} props.trend.value - Trend percentage
 * @param {string} props.trend.type - Trend type ('success' or 'danger')
 * @param {Object} [props.chart] - Chart configuration
 * @param {string} props.chart.type - Chart type ('line' or 'bar')
 * @param {number[]} props.chart.data - Chart data
 * @param {string[]} [props.chart.labels] - Chart labels
 * @param {string} [props.icon] - Icon (emoji)
 * @returns {HTMLElement}
 */
export const createMetricCard = ({
  title,
  value,
  prefix = '',
  suffix = '',
  tags = [],
  trend = null,
  chart = null,
  icon = null,
}) => {
  const card = document.createElement('div');
  card.className = 'card metric-card shadow-sm rounded-3 h-100';
  
  const cardBody = document.createElement('div');
  cardBody.className = 'card-body p-4';
  
  // Header with title and icon
  const header = document.createElement('div');
  header.className = 'd-flex justify-content-between align-items-start mb-3';
  
  const titleDiv = document.createElement('div');
  titleDiv.className = 'flex-grow-1';
  
  const titleEl = document.createElement('p');
  titleEl.className = 'text-muted small mb-2';
  titleEl.textContent = title;
  titleDiv.appendChild(titleEl);
  
  header.appendChild(titleDiv);
  
  if (icon) {
    const iconDiv = document.createElement('div');
    iconDiv.className = 'metric-icon bg-primary bg-opacity-10 text-primary rounded-3 p-3';
    iconDiv.textContent = icon;
    header.appendChild(iconDiv);
  }
  
  cardBody.appendChild(header);
  
  // Value
  const valueEl = document.createElement('h2');
  valueEl.className = 'metric-value mb-3';
  valueEl.textContent = `${prefix}${value}${suffix}`;
  cardBody.appendChild(valueEl);
  
  // Tags
  if (tags.length > 0) {
    const tagsDiv = document.createElement('div');
    tagsDiv.className = 'metric-tags mb-3';
    
    tags.forEach(tag => {
      const badge = document.createElement('span');
      badge.className = 'badge bg-light text-dark me-2';
      badge.textContent = `# ${tag}`;
      tagsDiv.appendChild(badge);
    });
    
    cardBody.appendChild(tagsDiv);
  }
  
  // Chart
  if (chart) {
    const chartContainer = document.createElement('div');
    chartContainer.className = 'metric-chart mb-3';
    chartContainer.style.height = '80px';
    
    const canvas = document.createElement('canvas');
    const chartId = `chart-${Math.random().toString(36).substr(2, 9)}`;
    canvas.id = chartId;
    chartContainer.appendChild(canvas);
    
    cardBody.appendChild(chartContainer);
    
    // Initialize chart after DOM insertion
    setTimeout(() => {
      const ctx = canvas.getContext('2d');
      new Chart(ctx, {
        type: chart.type,
        data: {
          labels: chart.labels || chart.data.map((_, i) => i + 1),
          datasets: [{
            data: chart.data,
            borderColor: '#6366F1',
            backgroundColor: chart.type === 'bar' ? '#6366F1' : 'rgba(99, 102, 241, 0.1)',
            borderWidth: 2,
            tension: 0.4,
            fill: chart.type === 'line',
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            },
          },
          scales: {
            x: {
              display: false,
            },
            y: {
              display: false,
            },
          },
        },
      });
    }, 100);
  }
  
  // Trend
  if (trend) {
    const trendDiv = document.createElement('div');
    trendDiv.className = 'mt-2';
    
    const trendSpan = document.createElement('span');
    trendSpan.className = `metric-trend small fw-bold ${trend.type === 'success' ? 'text-success' : 'text-danger'}`;
    trendSpan.textContent = `${trend.type === 'success' ? '↗' : '↘'} ${trend.value}`;
    
    trendDiv.appendChild(trendSpan);
    cardBody.appendChild(trendDiv);
  }
  
  card.appendChild(cardBody);
  
  return card;
};

export default createMetricCard;
