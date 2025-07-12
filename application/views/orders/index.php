<!-- Orders Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">My Orders</h1>
                    <p class="text-muted mb-0">View your order history and track your tickets</p>
                </div>
                <div>
                    <a href="<?php echo base_url('concerts'); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Book More Tickets
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="<?php echo base_url('orders'); ?>">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select class="form-select" name="status">
                                    <option value="">All Status</option>
                                    <option value="pending" <?php echo (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="paid" <?php echo (isset($_GET['status']) && $_GET['status'] == 'paid') ? 'selected' : ''; ?>>Paid</option>
                                    <option value="completed" <?php echo (isset($_GET['status']) && $_GET['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                    <option value="cancelled" <?php echo (isset($_GET['status']) && $_GET['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="date_from" 
                                       placeholder="From Date" 
                                       value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : ''; ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="date_to" 
                                       placeholder="To Date" 
                                       value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : ''; ?>">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders List -->
    <div class="row">
        <div class="col-12">
            <?php if(isset($orders) && !empty($orders)): ?>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Concert</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orders as $order): ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo $order->order_number; ?></strong>
                                                <br>
                                                <small class="text-muted"><?php echo date('d M Y', strtotime($order->order_date)); ?></small>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <?php if($order->concert_image): ?>
                                                        <img src="<?php echo base_url('uploads/concerts/' . $order->concert_image); ?>" 
                                                             class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                    <?php else: ?>
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                                             style="width: 50px; height: 50px;">
                                                            <i class="fas fa-music text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <h6 class="mb-1"><?php echo $order->concert_title; ?></h6>
                                                        <small class="text-muted"><?php echo $order->artist; ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo date('d M Y', strtotime($order->concert_date)); ?>
                                                <br>
                                                <small class="text-muted"><?php echo date('H:i', strtotime($order->concert_date)); ?> WIB</small>
                                            </td>
                                            <td>
                                                <strong>Rp <?php echo number_format($order->total_amount, 0, ',', '.'); ?></strong>
                                                <br>
                                                <small class="text-muted"><?php echo $order->ticket_count; ?> ticket(s)</small>
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
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo base_url('order/' . $order->id); ?>" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php if($order->status == 'pending'): ?>
                                                        <button type="button" class="btn btn-sm btn-outline-success" 
                                                                onclick="payOrder(<?php echo $order->id; ?>)">
                                                            <i class="fas fa-credit-card"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                onclick="cancelOrder(<?php echo $order->id; ?>)">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <?php if($order->status == 'completed'): ?>
                                                        <button type="button" class="btn btn-sm btn-outline-info" 
                                                                onclick="downloadTicket(<?php echo $order->id; ?>)">
                                                            <i class="fas fa-download"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                <!-- Empty Orders -->
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-bag fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No orders found</h4>
                        <p class="text-muted mb-4">
                            <?php if(isset($_GET['status']) || isset($_GET['date_from']) || isset($_GET['date_to'])): ?>
                                Try adjusting your filters or check back later for new orders.
                            <?php else: ?>
                                You haven't placed any orders yet. Start by browsing our concerts!
                            <?php endif; ?>
                        </p>
                        <?php if(!isset($_GET['status']) && !isset($_GET['date_from']) && !isset($_GET['date_to'])): ?>
                            <a href="<?php echo base_url('concerts'); ?>" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Browse Concerts
                            </a>
                        <?php else: ?>
                            <a href="<?php echo base_url('orders'); ?>" class="btn btn-outline-primary">
                                <i class="fas fa-times me-2"></i>Clear Filters
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
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

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Please complete your payment to confirm your order.
                </div>
                
                <div class="mb-3">
                    <h6>Payment Methods Available:</h6>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" checked>
                                <label class="form-check-label" for="bank_transfer">
                                    <i class="fas fa-university me-2"></i>Bank Transfer
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card">
                                <label class="form-check-label" for="credit_card">
                                    <i class="fas fa-credit-card me-2"></i>Credit Card
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <h6>Payment Instructions:</h6>
                    <ol>
                        <li>Choose your preferred payment method</li>
                        <li>Complete the payment process</li>
                        <li>Upload payment proof if required</li>
                        <li>Wait for payment confirmation</li>
                    </ol>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="processPayment()">
                    <i class="fas fa-credit-card me-2"></i>Proceed to Payment
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentOrderId = null;

// View order details
function viewOrder(orderId) {
    fetch('<?php echo base_url("orders/detail/"); ?>' + orderId)
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

// Pay order
function payOrder(orderId) {
    currentOrderId = orderId;
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();
}

// Process payment
function processPayment() {
    if (!currentOrderId) return;
    
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    
    fetch('<?php echo base_url("orders/pay/"); ?>' + currentOrderId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            payment_method: paymentMethod
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Payment processed successfully!');
            location.reload();
        } else {
            alert('Error processing payment: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error processing payment');
    });
}

// Cancel order
function cancelOrder(orderId) {
    if (confirm('Are you sure you want to cancel this order?')) {
        fetch('<?php echo base_url("orders/cancel/"); ?>' + orderId, {
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
}

// Download ticket
function downloadTicket(orderId) {
    window.open('<?php echo base_url("orders/download/"); ?>' + orderId, '_blank');
}
</script> 