(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        initSidebar();
        initTableCheckboxes();
        initTooltips();
        initCharts();
    });

    function initSidebar() {
        const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
        const sidebar = document.querySelector('.sidebar');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }

        const overlay = document.querySelector('.sidebar-overlay');
        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
            });
        }
    }

    function initTableCheckboxes() {
        const selectAllCheckbox = document.querySelector('input[name="select-all"]');
        
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('input[name="selection[]"]');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                    updateRowSelection(checkbox);
                });
            });
        }

        const rowCheckboxes = document.querySelectorAll('input[name="selection[]"]');
        rowCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateRowSelection(checkbox);
                updateSelectAllCheckbox();
            });
        });
    }

    function updateRowSelection(checkbox) {
        const row = checkbox.closest('tr');
        if (row) {
            if (checkbox.checked) {
                row.classList.add('selected');
            } else {
                row.classList.remove('selected');
            }
        }
    }

    function updateSelectAllCheckbox() {
        const selectAllCheckbox = document.querySelector('input[name="select-all"]');
        const rowCheckboxes = document.querySelectorAll('input[name="selection[]"]');
        
        if (selectAllCheckbox && rowCheckboxes.length > 0) {
            const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(rowCheckboxes).some(cb => cb.checked);
            
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = someChecked && !allChecked;
        }
    }

    function initTooltips() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    }

    function initCharts() {
        const chartContainers = document.querySelectorAll('.chart-container');
        
        chartContainers.forEach(function(container) {
            const canvas = container.querySelector('canvas');
            if (canvas && typeof Chart !== 'undefined') {
                console.log('Chart initialized for:', canvas.id);
            }
        });
    }

    window.DashboardUI = {
        refreshChart: function(chartId) {
            console.log('Refreshing chart:', chartId);
        },
        
        showNotification: function(message, type) {
            type = type || 'info';
            console.log('Notification [' + type + ']:', message);
        },
        
        confirmDelete: function(message, callback) {
            if (confirm(message || 'Are you sure you want to delete this item?')) {
                if (typeof callback === 'function') {
                    callback();
                }
                return true;
            }
            return false;
        }
    };

})();
