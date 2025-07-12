<!-- Dashboard Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Welcome back, <?php echo $user->full_name; ?>!</h1>
                    <p class="text-muted mb-0">Here's what's happening with your account</p>
                </div>
                <div>
                    <a href="<?php echo base_url('concerts'); ?>" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>Browse Concerts
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Orders
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo isset($total_orders) ? $total_orders : 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed Orders
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo isset($completed_orders) ? $completed_orders : 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Orders
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo isset($pending_orders) ? $pending_orders : 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Spent
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp <?php echo isset($total_spent) ? number_format($total_spent, 0, ',', '.') : '0'; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Orders</h6>
                    <a href="<?php echo base_url('orders'); ?>" class="btn btn-sm btn-primary">
                        View All Orders
                    </a>
                </div>
                <div class="card-body">
                    <?php if(isset($recent_orders) && !empty($recent_orders)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Concert</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($recent_orders as $order): ?>
                                        <tr>
                                            <td><?php echo $order->order_number; ?></td>
                                            <td><?php echo $order->concert_title ?? 'N/A'; ?></td>
                                            <td>Rp <?php echo number_format($order->total_amount, 0, ',', '.'); ?></td>
                                            <td>
                                                <span class="badge bg-<?php 
                                                    echo $order->status == 'paid' ? 'success' : 
                                                        ($order->status == 'pending' ? 'warning' : 
                                                        ($order->status == 'completed' ? 'info' : 'secondary')); 
                                                ?>">
                                                    <?php echo ucfirst($order->status); ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d M Y', strtotime($order->order_date)); ?></td>
                                            <td>
                                                <a href="<?php echo base_url('order/' . $order->id); ?>" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No orders yet</h5>
                            <p class="text-muted">Start by browsing our concerts and making your first purchase!</p>
                            <a href="<?php echo base_url('concerts'); ?>" class="btn btn-primary">
                                Browse Concerts
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- User Profile Card -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-user fa-2x text-primary"></i>
                        </div>
                        <h5 class="mb-1"><?php echo $user->full_name; ?></h5>
                        <p class="text-muted mb-0"><?php echo $user->email; ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <strong><i class="fas fa-user me-2"></i>Username:</strong>
                        <span class="text-muted"><?php echo $user->username; ?></span>
                    </div>
                    
                    <div class="mb-3">
                        <strong><i class="fas fa-phone me-2"></i>Phone:</strong>
                        <span class="text-muted"><?php echo $user->phone; ?></span>
                    </div>
                    
                    <?php if($user->address): ?>
                        <div class="mb-3">
                            <strong><i class="fas fa-map-marker-alt me-2"></i>Address:</strong>
                            <span class="text-muted"><?php echo $user->address; ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <strong><i class="fas fa-calendar me-2"></i>Member Since:</strong>
                        <span class="text-muted"><?php echo date('d M Y', strtotime($user->created_at)); ?></span>
                    </div>
                    
                    <div class="d-grid">
                        <a href="<?php echo base_url('profile'); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo base_url('concerts'); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-search me-2"></i>Browse Concerts
                        </a>
                        <a href="<?php echo base_url('orders'); ?>" class="btn btn-outline-info">
                            <i class="fas fa-list me-2"></i>My Orders
                        </a>
                        <a href="<?php echo base_url('cart'); ?>" class="btn btn-outline-warning">
                            <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
                        </a>
                        <a href="<?php echo base_url('contact'); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-headset me-2"></i>Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Concerts -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upcoming Concerts</h6>
                </div>
                <div class="card-body">
                    <?php if(isset($upcoming_concerts) && !empty($upcoming_concerts)): ?>
                        <div class="row">
                            <?php foreach($upcoming_concerts as $concert): ?>
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card concert-card h-100">
                                        <?php if($concert->image): ?>
                                            <img src="<?php echo base_url('uploads/concerts/' . $concert->image); ?>" class="card-img-top" alt="<?php echo $concert->title; ?>">
                                        <?php else: ?>
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                <i class="fas fa-music fa-3x text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold"><?php echo $concert->title; ?></h5>
                                            <p class="card-text text-muted">
                                                <i class="fas fa-user me-1"></i><?php echo $concert->artist; ?>
                                            </p>
                                            <p class="card-text">
                                                <i class="fas fa-map-marker-alt me-1 text-danger"></i><?php echo $concert->venue; ?>
                                            </p>
                                            <p class="card-text">
                                                <i class="fas fa-calendar me-1 text-primary"></i>
                                                <?php echo date('d M Y H:i', strtotime($concert->date_time)); ?>
                                            </p>
                                            <div class="d-grid">
                                                <a href="<?php echo base_url('concert/' . $concert->id); ?>" class="btn btn-primary btn-sm">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-music fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No upcoming concerts</h5>
                            <p class="text-muted">Check back later for new concerts!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div> 