/**
 * DataTable Component
 * @organism
 * 
 * Advanced data table with sorting, pagination, selection, and row actions.
 * 
 * @param {Object} props - Component props
 * @param {Array} props.columns - Column definitions
 * @param {Array} props.data - Table data
 * @param {boolean} [props.selectable=false] - Enable row selection
 * @param {Object} [props.pagination] - Pagination config
 * @param {Array} [props.actions] - Row actions
 * @param {string} [props.emptyText] - Empty state text
 * @returns {HTMLElement}
 */
export const createDataTable = ({
  columns,
  data,
  selectable = false,
  pagination = null,
  actions = [],
  emptyText = 'No data available',
}) => {
  const wrapper = document.createElement('div');
  wrapper.className = 'card shadow-sm rounded-3';
  
  const tableResponsive = document.createElement('div');
  tableResponsive.className = 'table-responsive';
  
  const table = document.createElement('table');
  table.className = 'table table-hover align-middle mb-0';
  
  // Header
  const thead = document.createElement('thead');
  thead.className = 'table-light';
  const headerRow = document.createElement('tr');
  
  if (selectable) {
    const th = document.createElement('th');
    th.className = 'text-center';
    th.style.width = '50px';
    
    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.className = 'form-check-input';
    checkbox.addEventListener('change', (e) => {
      const checkboxes = table.querySelectorAll('tbody input[type="checkbox"]');
      checkboxes.forEach(cb => cb.checked = e.target.checked);
    });
    
    th.appendChild(checkbox);
    headerRow.appendChild(th);
  }
  
  columns.forEach(column => {
    const th = document.createElement('th');
    th.className = 'text-muted small text-uppercase';
    th.textContent = column.label;
    
    if (column.sortable) {
      th.style.cursor = 'pointer';
      th.addEventListener('click', () => {
        console.log('Sort by', column.key);
      });
    }
    
    headerRow.appendChild(th);
  });
  
  if (actions.length > 0) {
    const th = document.createElement('th');
    th.className = 'text-muted small text-uppercase text-center';
    th.style.width = '120px';
    th.textContent = 'ACTION';
    headerRow.appendChild(th);
  }
  
  thead.appendChild(headerRow);
  table.appendChild(thead);
  
  // Body
  const tbody = document.createElement('tbody');
  
  if (data.length === 0) {
    const tr = document.createElement('tr');
    const td = document.createElement('td');
    td.colSpan = columns.length + (selectable ? 1 : 0) + (actions.length > 0 ? 1 : 0);
    td.className = 'text-center text-muted py-5';
    td.textContent = emptyText;
    tr.appendChild(td);
    tbody.appendChild(tr);
  } else {
    data.forEach(row => {
      const tr = document.createElement('tr');
      
      if (selectable) {
        const td = document.createElement('td');
        td.className = 'text-center';
        
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.className = 'form-check-input';
        checkbox.value = row.id;
        
        td.appendChild(checkbox);
        tr.appendChild(td);
      }
      
      columns.forEach(column => {
        const td = document.createElement('td');
        let value = row[column.key];
        
        if (column.format) {
          value = formatValue(value, column.format);
        }
        
        if (column.key === 'name') {
          td.className = 'fw-bold';
        }
        
        if (typeof value === 'string' && value.includes('<')) {
          td.innerHTML = value;
        } else {
          td.textContent = value;
        }
        
        tr.appendChild(td);
      });
      
      if (actions.length > 0) {
        const td = document.createElement('td');
        td.className = 'text-center';
        
        actions.forEach(action => {
          const btn = document.createElement('button');
          btn.className = `btn btn-sm btn-link ${action.variant === 'danger' ? 'text-danger' : 'text-secondary'}`;
          btn.title = action.label;
          btn.innerHTML = action.icon || action.label;
          btn.addEventListener('click', () => action.onClick(row));
          
          td.appendChild(btn);
        });
        
        tr.appendChild(td);
      }
      
      tbody.appendChild(tr);
    });
  }
  
  table.appendChild(tbody);
  tableResponsive.appendChild(table);
  wrapper.appendChild(tableResponsive);
  
  // Pagination
  if (pagination) {
    const footer = document.createElement('div');
    footer.className = 'card-footer d-flex justify-content-between align-items-center py-3';
    
    const info = document.createElement('div');
    info.className = 'text-muted small';
    info.textContent = `Showing ${pagination.itemsPerPage} of ${pagination.totalItems} entries`;
    footer.appendChild(info);
    
    const nav = document.createElement('nav');
    const ul = document.createElement('ul');
    ul.className = 'pagination pagination-sm mb-0';
    
    // Prev
    const prevLi = document.createElement('li');
    prevLi.className = `page-item ${pagination.currentPage === 1 ? 'disabled' : ''}`;
    const prevA = document.createElement('a');
    prevA.className = 'page-link';
    prevA.href = '#';
    prevA.textContent = 'Prev';
    prevLi.appendChild(prevA);
    ul.appendChild(prevLi);
    
    // Pages
    for (let i = 1; i <= Math.min(pagination.totalPages, 5); i++) {
      const li = document.createElement('li');
      li.className = `page-item ${i === pagination.currentPage ? 'active' : ''}`;
      const a = document.createElement('a');
      a.className = 'page-link';
      a.href = '#';
      a.textContent = i;
      li.appendChild(a);
      ul.appendChild(li);
    }
    
    if (pagination.totalPages > 5) {
      const li = document.createElement('li');
      li.className = 'page-item disabled';
      const span = document.createElement('span');
      span.className = 'page-link';
      span.textContent = '...';
      li.appendChild(span);
      ul.appendChild(li);
      
      const lastLi = document.createElement('li');
      lastLi.className = 'page-item';
      const lastA = document.createElement('a');
      lastA.className = 'page-link';
      lastA.href = '#';
      lastA.textContent = pagination.totalPages;
      lastLi.appendChild(lastA);
      ul.appendChild(lastLi);
    }
    
    // Next
    const nextLi = document.createElement('li');
    nextLi.className = `page-item ${pagination.currentPage === pagination.totalPages ? 'disabled' : ''}`;
    const nextA = document.createElement('a');
    nextA.className = 'page-link';
    nextA.href = '#';
    nextA.textContent = 'Next';
    nextLi.appendChild(nextA);
    ul.appendChild(nextLi);
    
    nav.appendChild(ul);
    footer.appendChild(nav);
    wrapper.appendChild(footer);
  }
  
  return wrapper;
};

function formatValue(value, format) {
  switch (format) {
    case 'currency':
      return `$${Number(value).toLocaleString()}`;
    case 'stock':
      return `<i class="bi bi-box"></i> ${Number(value).toLocaleString()}`;
    case 'sold':
      return `<i class="bi bi-check-circle"></i> ${Number(value).toLocaleString()}`;
    case 'rating':
      return `⭐ ${value}`;
    default:
      return value;
  }
}

export default createDataTable;
