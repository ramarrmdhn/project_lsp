<!-- Admin Reports Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Reports & Analytics</h1>
                    <p class="text-muted mb-0">View detailed reports and analytics</p>
                </div>
                <div>
                    <button type="button" class="btn btn-success" onclick="exportReport()">
                        <i class="fas fa-download me-2"></i>Export Report
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Range Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="<?php echo base_url('admin/reports'); ?>">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Date Range</label>
                                <select class="form-select" name="date_range" onchange="updateDateInputs(this.value)">
                                    <option value="today" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'today') ? 'selected' : ''; ?>>Today</option>
                                    <option value="yesterday" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'yesterday') ? 'selected' : ''; ?>>Yesterday</option>
                                    <option value="last_7_days" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'last_7_days') ? 'selected' : ''; ?>>Last 7 Days</option>
                                    <option value="last_30_days" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'last_30_days') ? 'selected' : ''; ?>>Last 30 Days</option>
                                    <option value="this_month" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'this_month') ? 'selected' : ''; ?>>This Month</option>
                                    <option value="last_month" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'last_month') ? 'selected' : ''; ?>>Last Month</option>
                                    <option value="custom" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'custom') ? 'selected' : ''; ?>>Custom Range</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" 
                                       value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('-30 days')); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" 
                                       value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Generate Report
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Revenue
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp <?php echo number_format($total_revenue ?? 0, 0, ',', '.'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                Total Orders
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format($total_orders ?? 0, 0, ',', '.'); ?>
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
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Tickets Sold
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo number_format($total_tickets ?? 0, 0, ',', '.'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
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
                                Average Order Value
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp <?php echo number_format($avg_order_value ?? 0, 0, ',', '.'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Trend</h6>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Order Status Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="orderStatusChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Concerts and Customers -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Top Performing Concerts</h6>
                </div>
                <div class="card-body">
                    <?php if(isset($top_concerts) && !empty($top_concerts)): ?>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Concert</th>
                                        <th>Tickets Sold</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($top_concerts as $concert): ?>
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong><?php echo $concert->title; ?></strong>
                                                    <br>
                                                    <small class="text-muted"><?php echo $concert->artist; ?></small>
                                                </div>
                                            </td>
                                            <td><?php echo number_format($concert->tickets_sold, 0, ',', '.'); ?></td>
                                            <td>Rp <?php echo number_format($concert->revenue, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-3">
                            <i class="fas fa-music fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No concert data available</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Top Customers</h6>
                </div>
                <div class="card-body">
                    <?php if(isset($top_customers) && !empty($top_customers)): ?>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Orders</th>
                                        <th>Total Spent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($top_customers as $customer): ?>
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong><?php echo $customer->full_name; ?></strong>
                                                    <br>
                                                    <small class="text-muted"><?php echo $customer->email; ?></small>
                                                </div>
                                            </td>
                                            <td><?php echo $customer->order_count; ?></td>
                                            <td>Rp <?php echo number_format($customer->total_spent, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-3">
                            <i class="fas fa-users fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No customer data available</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Reports -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Daily Sales Report</h6>
                </div>
                <div class="card-body">
                    <?php if(isset($daily_sales) && !empty($daily_sales)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Orders</th>
                                        <th>Tickets Sold</th>
                                        <th>Revenue</th>
                                        <th>Average Order Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($daily_sales as $sale): ?>
                                        <tr>
                                            <td><?php echo date('d M Y', strtotime($sale->date)); ?></td>
                                            <td><?php echo $sale->orders; ?></td>
                                            <td><?php echo $sale->tickets_sold; ?></td>
                                            <td>Rp <?php echo number_format($sale->revenue, 0, ',', '.'); ?></td>
                                            <td>Rp <?php echo number_format($sale->avg_order_value, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-3">
                            <i class="fas fa-chart-bar fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No sales data available for the selected period</p>
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
// Update date inputs based on date range selection
function updateDateInputs(range) {
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    const today = new Date();
    
    switch(range) {
        case 'today':
            startDate.value = today.toISOString().split('T')[0];
            endDate.value = today.toISOString().split('T')[0];
            break;
        case 'yesterday':
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            startDate.value = yesterday.toISOString().split('T')[0];
            endDate.value = yesterday.toISOString().split('T')[0];
            break;
        case 'last_7_days':
            const last7Days = new Date(today);
            last7Days.setDate(last7Days.getDate() - 7);
            startDate.value = last7Days.toISOString().split('T')[0];
            endDate.value = today.toISOString().split('T')[0];
            break;
        case 'last_30_days':
            const last30Days = new Date(today);
            last30Days.setDate(last30Days.getDate() - 30);
            startDate.value = last30Days.toISOString().split('T')[0];
            endDate.value = today.toISOString().split('T')[0];
            break;
        case 'this_month':
            startDate.value = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split('T')[0];
            endDate.value = today.toISOString().split('T')[0];
            break;
        case 'last_month':
            const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
            const lastMonthEnd = new Date(today.getFullYear(), today.getMonth(), 0);
            startDate.value = lastMonth.toISOString().split('T')[0];
            endDate.value = lastMonthEnd.toISOString().split('T')[0];
            break;
        case 'custom':
            // Don't change the values, let user input manually
            break;
    }
}

// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($chart_labels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']); ?>,
        datasets: [{
            label: 'Revenue',
            data: <?php echo json_encode($chart_data ?? [12000000, 19000000, 15000000, 25000000, 22000000, 30000000]); ?>,
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
const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
const orderStatusChart = new Chart(orderStatusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Paid', 'Completed', 'Cancelled'],
        datasets: [{
            data: <?php echo json_encode($order_status_data ?? [12, 19, 8, 3]); ?>,
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

// Export report
function exportReport() {
    const params = new URLSearchParams(window.location.search);
    window.open('<?php echo base_url("admin/reports/export"); ?>?' + params.toString(), '_blank');
}

// Initialize date inputs on page load
document.addEventListener('DOMContentLoaded', function() {
    const dateRange = document.querySelector('select[name="date_range"]');
    if (dateRange.value !== 'custom') {
        updateDateInputs(dateRange.value);
    }
});
</script> 