<!-- Cart Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Shopping Cart</h1>
                    <p class="text-muted mb-0">Review your selected tickets</p>
                </div>
                <div>
                    <a href="<?php echo base_url('concerts'); ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($cart_items) && !empty($cart_items)): ?>
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Cart Items</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach($cart_items as $item): ?>
                            <div class="cart-item border-bottom pb-3 mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <?php if($item->concert_image): ?>
                                            <img src="<?php echo base_url('uploads/concerts/' . $item->concert_image); ?>" 
                                                 class="img-fluid rounded" alt="<?php echo $item->concert_title; ?>">
                                        <?php else: ?>
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="height: 100px;">
                                                <i class="fas fa-music fa-2x text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="mb-1"><?php echo $item->concert_title; ?></h6>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-user me-1"></i><?php echo $item->artist; ?>
                                        </p>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-map-marker-alt me-1"></i><?php echo $item->venue; ?>
                                        </p>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-calendar me-1"></i>
                                            <?php echo date('d M Y H:i', strtotime($item->concert_date)); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-end">
                                            <div class="mb-2">
                                                <strong class="text-primary">Rp <?php echo number_format($item->price, 0, ',', '.'); ?></strong>
                                            </div>
                                            <div class="input-group input-group-sm mb-2" style="width: 120px; margin-left: auto;">
                                                <button type="button" class="btn btn-outline-secondary" 
                                                        onclick="updateQuantity(<?php echo $item->id; ?>, -1)">-</button>
                                                <input type="number" class="form-control text-center" 
                                                       id="quantity_<?php echo $item->id; ?>" 
                                                       value="<?php echo $item->quantity; ?>" 
                                                       min="1" max="<?php echo $item->available_tickets; ?>"
                                                       onchange="updateQuantity(<?php echo $item->id; ?>, 0)">
                                                <button type="button" class="btn btn-outline-secondary" 
                                                        onclick="updateQuantity(<?php echo $item->id; ?>, 1)">+</button>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Total: Rp <?php echo number_format($item->price * $item->quantity, 0, ',', '.'); ?></small>
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                        onclick="removeItem(<?php echo $item->id; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow sticky-top" style="top: 20px;">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Service Fee:</span>
                                <span>Rp <?php echo number_format($service_fee, 0, ',', '.'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax:</span>
                                <span>Rp <?php echo number_format($tax, 0, ',', '.'); ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total:</span>
                                <span class="text-primary">Rp <?php echo number_format($total, 0, ',', '.'); ?></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select" id="paymentMethod">
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="e_wallet">E-Wallet</option>
                                <option value="cash">Cash on Delivery</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Delivery Method</label>
                            <select class="form-select" id="deliveryMethod">
                                <option value="email">Email (Free)</option>
                                <option value="sms">SMS (+Rp 5,000)</option>
                                <option value="physical">Physical Ticket (+Rp 10,000)</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-lg" onclick="proceedToCheckout()">
                                <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="clearCart()">
                                <i class="fas fa-trash me-2"></i>Clear Cart
                            </button>
                        </div>

                        <div class="mt-3">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Secure Payment:</strong> Your payment information is encrypted and secure.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Empty Cart -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Your cart is empty</h4>
                        <p class="text-muted mb-4">Looks like you haven't added any tickets to your cart yet.</p>
                        <a href="<?php echo base_url('concerts'); ?>" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Browse Concerts
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="checkoutForm" action="<?php echo base_url('checkout/process'); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Billing Information</h6>
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="billing_name" 
                                       value="<?php echo $user->full_name; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="billing_email" 
                                       value="<?php echo $user->email; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" name="billing_phone" 
                                       value="<?php echo $user->phone; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="billing_address" rows="3" required><?php echo $user->address; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Payment Details</h6>
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <select class="form-select" name="payment_method" required>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="e_wallet">E-Wallet</option>
                                    <option value="cash">Cash on Delivery</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Delivery Method</label>
                                <select class="form-select" name="delivery_method" required>
                                    <option value="email">Email (Free)</option>
                                    <option value="sms">SMS (+Rp 5,000)</option>
                                    <option value="physical">Physical Ticket (+Rp 10,000)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Special Instructions</label>
                                <textarea class="form-control" name="special_instructions" rows="3" 
                                          placeholder="Any special requests or instructions..."></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-3">
                        <h6>Order Summary</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td class="text-end">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Service Fee:</td>
                                        <td class="text-end">Rp <?php echo number_format($service_fee, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tax:</td>
                                        <td class="text-end">Rp <?php echo number_format($tax, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td>Total:</td>
                                        <td class="text-end text-primary">Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="checkoutForm" class="btn btn-primary">
                    <i class="fas fa-credit-card me-2"></i>Place Order
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Update quantity
function updateQuantity(itemId, change) {
    const input = document.getElementById('quantity_' + itemId);
    let newQuantity = parseInt(input.value) || 0;
    
    if (change === 0) {
        // Direct input change
        newQuantity = parseInt(input.value) || 0;
    } else {
        // Button click
        newQuantity += change;
    }
    
    if (newQuantity < 1) newQuantity = 1;
    if (newQuantity > parseInt(input.getAttribute('max'))) newQuantity = parseInt(input.getAttribute('max'));
    
    input.value = newQuantity;
    
    // Update via AJAX
    fetch('<?php echo base_url("cart/update"); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            item_id: itemId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error updating quantity: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating quantity');
    });
}

// Remove item
function removeItem(itemId) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
        fetch('<?php echo base_url("cart/remove"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                item_id: itemId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error removing item: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing item');
        });
    }
}

// Proceed to checkout
function proceedToCheckout() {
    const modal = new bootstrap.Modal(document.getElementById('checkoutModal'));
    modal.show();
}

// Clear cart
function clearCart() {
    if (confirm('Are you sure you want to clear your entire cart?')) {
        fetch('<?php echo base_url("cart/clear"); ?>', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error clearing cart: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error clearing cart');
        });
    }
}
</script> 