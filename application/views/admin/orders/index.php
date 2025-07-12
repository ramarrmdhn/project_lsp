<!-- Admin Orders Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Manage Orders</h1>
                    <p class="text-muted mb-0">View and manage all customer orders</p>
                </div>
                <div>
                    <a href="<?php echo base_url('admin/orders/export'); ?>" class="btn btn-success">
                        <i class="fas fa-download me-2"></i>Export Orders
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="<?php echo base_url('admin/orders'); ?>">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Search orders, customers..." 
                                           value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="status">
                                    <option value="">All Status</option>
                                    <option value="pending" <?php echo (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="paid" <?php echo (isset($_GET['status']) && $_GET['status'] == 'paid') ? 'selected' : ''; ?>>Paid</option>
                                    <option value="completed" <?php echo (isset($_GET['status']) && $_GET['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                    <option value="cancelled" <?php echo (isset($_GET['status']) && $_GET['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="payment_status">
                                    <option value="">All Payment</option>
                                    <option value="pending" <?php echo (isset($_GET['payment_status']) && $_GET['payment_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="paid" <?php echo (isset($_GET['payment_status']) && $_GET['payment_status'] == 'paid') ? 'selected' : ''; ?>>Paid</option>
                                    <option value="failed" <?php echo (isset($_GET['payment_status']) && $_GET['payment_status'] == 'failed') ? 'selected' : ''; ?>>Failed</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" name="date_from" 
                                       placeholder="From Date" 
                                       value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : ''; ?>">
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" name="date_to" 
                                       placeholder="To Date" 
                                       value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : ''; ?>">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-shopping-bag me-2"></i>Orders List</h5>
                </div>
                <div class="card-body">
                    <?php if(isset($orders) && !empty($orders)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Concert</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orders as $order): ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo $order->order_number; ?></strong>
                                                <br>
                                                <small class="text-muted"><?php echo $order->ticket_count; ?> ticket(s)</small>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong><?php echo $order->customer_name; ?></strong>
                                                    <br>
                                                    <small class="text-muted"><?php echo $order->customer_email; ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong><?php echo $order->concert_title; ?></strong>
                                                    <br>
                                                    <small class="text-muted"><?php echo $order->artist; ?></small>
                                                    <br>
                                                    <small class="text-muted"><?php echo date('d M Y', strtotime($order->concert_date)); ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Rp <?php echo number_format($order->total_amount, 0, ',', '.'); ?></strong>
                                                <br>
                                                <small class="text-muted">
                                                    Subtotal: Rp <?php echo number_format($order->subtotal, 0, ',', '.'); ?>
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php 
                                                    echo $order->status == 'paid' ? 'success' : 
                                                        ($order->status == 'pending' ? 'warning' : 
                                                        ($order->status == 'completed' ? 'info' : 
                                                        ($order->status == 'cancelled' ? 'danger' : 'secondary'))); 
                                                ?>">
                                                    <?php echo ucfirst($order->status); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php 
                                                    echo $order->payment_status == 'paid' ? 'success' : 
                                                        ($order->payment_status == 'pending' ? 'warning' : 'danger'); 
                                                ?>">
                                                    <?php echo ucfirst($order->payment_status); ?>
                                                </span>
                                                <br>
                                                <small class="text-muted"><?php echo ucfirst($order->payment_method); ?></small>
                                            </td>
                                            <td>
                                                <?php echo date('d M Y', strtotime($order->order_date)); ?>
                                                <br>
                                                <small class="text-muted"><?php echo date('H:i', strtotime($order->order_date)); ?></small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo base_url('admin/orders/view/' . $order->id); ?>" 
                                                       class="btn btn-sm btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/orders/edit/' . $order->id); ?>" 
                                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <?php if($order->status == 'pending'): ?>
                                                        <button type="button" class="btn btn-sm btn-outline-success" 
                                                                onclick="markAsPaid(<?php echo $order->id; ?>)" title="Mark as Paid">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                onclick="cancelOrder(<?php echo $order->id; ?>)" title="Cancel">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <?php if($order->status == 'paid'): ?>
                                                        <button type="button" class="btn btn-sm btn-outline-info" 
                                                                onclick="markAsCompleted(<?php echo $order->id; ?>)" title="Mark as Completed">
                                                            <i class="fas fa-check-double"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                            onclick="resendEmail(<?php echo $order->id; ?>)" title="Resend Email">
                                                        <i class="fas fa-envelope"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?php if(isset($pagination)): ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <nav aria-label="Orders pagination">
                                        <?php echo $pagination; ?>
                                    </nav>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-bag fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">No orders found</h4>
                            <p class="text-muted">
                                <?php if(isset($_GET['search']) || isset($_GET['status']) || isset($_GET['payment_status'])): ?>
                                    Try adjusting your search criteria.
                                <?php else: ?>
                                    No orders have been placed yet.
                                <?php endif; ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="orderModalBody">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Cancel Confirmation Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will cancel the order and refund the customer if payment was made.
                </div>
                <p>Are you sure you want to cancel this order?</p>
                <p class="mb-0"><strong>Order:</strong> <span id="cancelOrderNumber"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmCancel()">
                    <i class="fas fa-times me-2"></i>Cancel Order
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let orderToCancel = null;

// View order details
function viewOrder(orderId) {
    fetch('<?php echo base_url("admin/orders/detail/"); ?>' + orderId)
        .then(response => response.text())
        .then(html => {
            document.getElementById('orderModalBody').innerHTML = html;
            const modal = new bootstrap.Modal(document.getElementById('orderModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading order details');
        });
}

// Mark as paid
function markAsPaid(orderId) {
    if (confirm('Are you sure you want to mark this order as paid?')) {
        fetch('<?php echo base_url("admin/orders/mark_paid/"); ?>' + orderId, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order marked as paid successfully!');
                location.reload();
            } else {
                alert('Error marking order as paid: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error marking order as paid');
        });
    }
}

// Mark as completed
function markAsCompleted(orderId) {
    if (confirm('Are you sure you want to mark this order as completed?')) {
        fetch('<?php echo base_url("admin/orders/mark_completed/"); ?>' + orderId, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order marked as completed successfully!');
                location.reload();
            } else {
                alert('Error marking order as completed: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error marking order as completed');
        });
    }
}

// Cancel order
function cancelOrder(orderId) {
    // Get order details via AJAX
    fetch('<?php echo base_url("admin/orders/get/"); ?>' + orderId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                orderToCancel = orderId;
                document.getElementById('cancelOrderNumber').textContent = data.order.order_number;
                const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
                modal.show();
            } else {
                alert('Error loading order details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading order details');
        });
}

function confirmCancel() {
    if (!orderToCancel) return;
    
    fetch('<?php echo base_url("admin/orders/cancel/"); ?>' + orderToCancel, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Order cancelled successfully!');
            location.reload();
        } else {
            alert('Error cancelling order: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error cancelling order');
    });
}

// Resend email
function resendEmail(orderId) {
    if (confirm('Are you sure you want to resend the order confirmation email?')) {
        fetch('<?php echo base_url("admin/orders/resend_email/"); ?>' + orderId, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Email sent successfully!');
            } else {
                alert('Error sending email: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error sending email');
        });
    }
}

// Export orders
function exportOrders() {
    const params = new URLSearchParams(window.location.search);
    window.open('<?php echo base_url("admin/orders/export"); ?>?' + params.toString(), '_blank');
}
</script> 