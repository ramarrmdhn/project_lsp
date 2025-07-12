        </div>
    </div>
</div>

<!-- Notifications Modal -->
<div class="modal fade" id="notificationsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">New Order Received</h6>
                            <small class="text-muted">3 mins ago</small>
                        </div>
                        <p class="mb-1">Order #ORD-2024-001 has been placed by John Doe</p>
                        <small class="text-muted">Total: Rp 500,000</small>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Payment Confirmed</h6>
                            <small class="text-muted">1 hour ago</small>
                        </div>
                        <p class="mb-1">Payment for Order #ORD-2024-002 has been confirmed</p>
                        <small class="text-muted">Amount: Rp 750,000</small>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Low Stock Alert</h6>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                        <p class="mb-1">VIP tickets for "Rock Concert 2024" are running low</p>
                        <small class="text-muted">Only 5 tickets remaining</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="<?php echo base_url('admin/notifications'); ?>" class="btn btn-primary">View All</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Custom JS -->
<script>
// Toggle sidebar
function toggleSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    const main = document.getElementById('adminMain');
    const brand = document.getElementById('adminBrand');
    const sections = document.querySelectorAll('.sidebar-section');
    const titles = document.querySelectorAll('.sidebar-section-title');
    
    sidebar.classList.toggle('collapsed');
    main.classList.toggle('expanded');
    brand.classList.toggle('collapsed');
    
    sections.forEach(section => {
        section.classList.toggle('collapsed');
    });
    
    titles.forEach(title => {
        title.classList.toggle('collapsed');
    });
}

// Show notifications
function showNotifications() {
    const modal = new bootstrap.Modal(document.getElementById('notificationsModal'));
    modal.show();
}

// Auto-hide alerts after 5 seconds
setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 5000);

// Update notification count
function updateNotificationCount() {
    fetch('<?php echo base_url("admin/notifications/count"); ?>')
        .then(response => response.json())
        .then(data => {
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                badge.textContent = data.count;
                if (data.count === 0) {
                    badge.style.display = 'none';
                } else {
                    badge.style.display = 'flex';
                }
            }
        })
        .catch(error => {
            console.error('Error updating notification count:', error);
        });
}

// Update notification count every 30 seconds
setInterval(updateNotificationCount, 30000);

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Confirm delete actions
function confirmDelete(message = 'Are you sure you want to delete this item?') {
    return confirm(message);
}

// Show loading spinner
function showLoading() {
    const spinner = document.createElement('div');
    spinner.className = 'position-fixed top-50 start-50 translate-middle';
    spinner.innerHTML = `
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    `;
    spinner.id = 'loadingSpinner';
    document.body.appendChild(spinner);
}

// Hide loading spinner
function hideLoading() {
    const spinner = document.getElementById('loadingSpinner');
    if (spinner) {
        spinner.remove();
    }
}

// AJAX error handler
function handleAjaxError(xhr, status, error) {
    console.error('AJAX Error:', status, error);
    alert('An error occurred. Please try again.');
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(amount);
}

// Format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

// Format datetime
function formatDateTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Show success message
function showSuccess(message) {
    const alert = `
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    document.querySelector('.admin-content').insertAdjacentHTML('afterbegin', alert);
    
    setTimeout(() => {
        $('.alert').fadeOut('slow');
    }, 5000);
}

// Show error message
function showError(message) {
    const alert = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    document.querySelector('.admin-content').insertAdjacentHTML('afterbegin', alert);
    
    setTimeout(() => {
        $('.alert').fadeOut('slow');
    }, 5000);
}

// Show warning message
function showWarning(message) {
    const alert = `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    document.querySelector('.admin-content').insertAdjacentHTML('afterbegin', alert);
    
    setTimeout(() => {
        $('.alert').fadeOut('slow');
    }, 5000);
}

// Show info message
function showInfo(message) {
    const alert = `
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    document.querySelector('.admin-content').insertAdjacentHTML('afterbegin', alert);
    
    setTimeout(() => {
        $('.alert').fadeOut('slow');
    }, 5000);
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Update notification count on page load
    updateNotificationCount();
    
    // Add active class to current nav item
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.admin-sidebar .nav-link');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
});
</script>
</body>
</html> 