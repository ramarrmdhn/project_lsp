<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Admin Panel - Ticket Concert'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-sidebar {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            width: 250px;
            transition: all 0.3s;
        }
        .admin-sidebar.collapsed {
            width: 60px;
        }
        .admin-sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            border-radius: 0;
            transition: all 0.3s;
        }
        .admin-sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .admin-sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border-left: 4px solid #3498db;
        }
        .admin-sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .admin-sidebar.collapsed .nav-link span {
            display: none;
        }
        .admin-sidebar.collapsed .nav-link i {
            margin-right: 0;
            text-align: center;
            width: 100%;
        }
        .admin-main {
            margin-left: 250px;
            transition: all 0.3s;
        }
        .admin-main.expanded {
            margin-left: 60px;
        }
        .admin-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .admin-content {
            padding: 30px;
        }
        .sidebar-toggle {
            background: none;
            border: none;
            color: #2c3e50;
            font-size: 1.2rem;
            cursor: pointer;
        }
        .admin-brand {
            color: #ecf0f1;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .admin-brand.collapsed {
            padding: 15px 5px;
            font-size: 1rem;
        }
        .user-dropdown {
            background: none;
            border: none;
            color: #2c3e50;
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidebar-section {
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar-section.collapsed {
            padding: 10px 0;
        }
        .sidebar-section-title {
            color: #bdc3c7;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
            padding: 0 20px 10px;
            margin-bottom: 0;
        }
        .sidebar-section-title.collapsed {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Admin Sidebar -->
    <div class="admin-sidebar" id="adminSidebar">
        <div class="admin-brand" id="adminBrand">
            <i class="fas fa-shield-alt me-2"></i>
            <span>Admin Panel</span>
        </div>
        
        <nav class="nav flex-column">
            <div class="sidebar-section">
                <h6 class="sidebar-section-title">Dashboard</h6>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>" href="<?php echo base_url('admin/dashboard'); ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            
            <div class="sidebar-section">
                <h6 class="sidebar-section-title">Content Management</h6>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'concerts' ? 'active' : ''; ?>" href="<?php echo base_url('admin/concerts'); ?>">
                    <i class="fas fa-music"></i>
                    <span>Concerts</span>
                </a>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'tickets' ? 'active' : ''; ?>" href="<?php echo base_url('admin/tickets'); ?>">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Tickets</span>
                </a>
            </div>
            
            <div class="sidebar-section">
                <h6 class="sidebar-section-title">User Management</h6>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'users' ? 'active' : ''; ?>" href="<?php echo base_url('admin/users'); ?>">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'admins' ? 'active' : ''; ?>" href="<?php echo base_url('admin/admins'); ?>">
                    <i class="fas fa-user-shield"></i>
                    <span>Administrators</span>
                </a>
            </div>
            
            <div class="sidebar-section">
                <h6 class="sidebar-section-title">Sales & Orders</h6>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'orders' ? 'active' : ''; ?>" href="<?php echo base_url('admin/orders'); ?>">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Orders</span>
                </a>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'payments' ? 'active' : ''; ?>" href="<?php echo base_url('admin/payments'); ?>">
                    <i class="fas fa-credit-card"></i>
                    <span>Payments</span>
                </a>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'reports' ? 'active' : ''; ?>" href="<?php echo base_url('admin/reports'); ?>">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </a>
            </div>
            
            <div class="sidebar-section">
                <h6 class="sidebar-section-title">System</h6>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'settings' ? 'active' : ''; ?>" href="<?php echo base_url('admin/settings'); ?>">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'logs' ? 'active' : ''; ?>" href="<?php echo base_url('admin/logs'); ?>">
                    <i class="fas fa-file-alt"></i>
                    <span>System Logs</span>
                </a>
                <a class="nav-link <?php echo $this->uri->segment(2) == 'backup' ? 'active' : ''; ?>" href="<?php echo base_url('admin/backup'); ?>">
                    <i class="fas fa-database"></i>
                    <span>Backup</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Admin Main Content -->
    <div class="admin-main" id="adminMain">
        <!-- Admin Header -->
        <div class="admin-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <button class="sidebar-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="ms-3"><?php echo isset($page_title) ? $page_title : 'Dashboard'; ?></span>
                </div>
                <div class="col-md-6 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <!-- Notifications -->
                        <div class="position-relative me-3">
                            <button class="btn btn-link text-decoration-none" onclick="showNotifications()">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge">3</span>
                            </button>
                        </div>
                        
                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn user-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-2"></i>
                                <?php echo $this->session->userdata('admin_name') ?? 'Admin'; ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo base_url('admin/profile'); ?>">
                                    <i class="fas fa-user me-2"></i>Profile
                                </a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('admin/settings'); ?>">
                                    <i class="fas fa-cog me-2"></i>Settings
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('admin/logout'); ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Content -->
        <div class="admin-content">
            <!-- Flash Messages -->
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('warning')): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $this->session->flashdata('warning'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('info')): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i><?php echo $this->session->flashdata('info'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?> 