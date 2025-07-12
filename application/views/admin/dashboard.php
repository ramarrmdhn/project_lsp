<!-- Admin Dashboard Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Admin Dashboard</h1>
                    <p class="text-muted mb-0">Welcome back, <?php echo $admin->full_name; ?>!</p>
                </div>
                <div>
                    <a href="<?php echo base_url('admin/concerts/add'); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Concert
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo isset($total_users) ? $total_users : 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                Total Concerts
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo isset($total_concerts) ? $total_concerts : 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-music fa-2x text-gray-300"></i>
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
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Revenue
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp <?php echo isset($total_revenue) ? number_format($total_revenue, 0, ',', '.') : '0'; ?>
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

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Orders</h6>
                    <a href="<?php echo base_url('admin/orders'); ?>" class="btn btn-sm btn-primary">
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
                                        <th>Customer</th>
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
                                            <td><?php echo $order->customer_name; ?></td>
                                            <td><?php echo $order->concert_title; ?></td>
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
                                                <a href="<?php echo base_url('admin/orders/view/' . $order->id); ?>" 
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
                            <p class="text-muted">Orders will appear here when customers make purchases.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo base_url('admin/concerts/add'); ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Concert
                        </a>
                        <a href="<?php echo base_url('admin/concerts'); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-music me-2"></i>Manage Concerts
                        </a>
                        <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-outline-info">
                            <i class="fas fa-users me-2"></i>Manage Users
                        </a>
                        <a href="<?php echo base_url('admin/orders'); ?>" class="btn btn-outline-success">
                            <i class="fas fa-shopping-bag me-2"></i>View Orders
                        </a>
                        <a href="<?php echo base_url('admin/reports'); ?>" class="btn btn-outline-warning">
                            <i class="fas fa-chart-bar me-2"></i>View Reports
                        </a>
                        <a href="<?php echo base_url('admin/settings'); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-cog me-2"></i>System Settings
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">System Status</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Database</span>
                            <span class="badge bg-success">Online</span>
                        </div>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Storage</span>
                            <span class="badge bg-warning">75%</span>
                        </div>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-warning" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Memory</span>
                            <span class="badge bg-info">60%</span>
                        </div>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-info" style="width: 60%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>CPU</span>
                            <span class="badge bg-success">45%</span>
                        </div>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-success" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Overview</h6>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Order Status Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="orderChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Concerts -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Concerts</h6>
                    <a href="<?php echo base_url('admin/concerts'); ?>" class="btn btn-sm btn-primary">
                        View All Concerts
                    </a>
                </div>
                <div class="card-body">
                    <?php if(isset($recent_concerts) && !empty($recent_concerts)): ?>
                        <div class="row">
                            <?php foreach($recent_concerts as $concert): ?>
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
                                            <h6 class="card-title fw-bold"><?php echo $concert->title; ?></h6>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-user me-1"></i><?php echo $concert->artist; ?>
                                            </p>
                                            <p class="card-text small">
                                                <i class="fas fa-calendar me-1 text-primary"></i>
                                                <?php echo date('d M Y', strtotime($concert->date_time)); ?>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-<?php 
                                                    echo $concert->status == 'upcoming' ? 'primary' : 
                                                        ($concert->status == 'active' ? 'success' : 'secondary'); 
                                                ?>">
                                                    <?php echo ucfirst($concert->status); ?>
                                                </span>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="<?php echo base_url('admin/concerts/edit/' . $concert->id); ?>" 
                                                       class="btn btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/concerts/view/' . $concert->id); ?>" 
                                                       class="btn btn-outline-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-music fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No concerts yet</h5>
                            <p class="text-muted">Add your first concert to get started!</p>
                            <a href="<?php echo base_url('admin/concerts/add'); ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Concert
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Revenue',
            data: [12000000, 19000000, 15000000, 25000000, 22000000, 30000000],
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});

// Order Status Chart
const orderCtx = document.getElementById('orderChart').getContext('2d');
const orderChart = new Chart(orderCtx, {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Paid', 'Completed', 'Cancelled'],
        datasets: [{
            data: [12, 19, 8, 3],
            backgroundColor: [
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 99, 132, 0.8)'
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script> 