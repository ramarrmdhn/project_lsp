<!-- Admin Users Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Manage Users</h1>
                    <p class="text-muted mb-0">View and manage all registered users</p>
                </div>
                <div>
                    <a href="<?php echo base_url('admin/users/add'); ?>" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Add New User
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
                    <form method="GET" action="<?php echo base_url('admin/users'); ?>">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Search users, emails, names..." 
                                           value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="role">
                                    <option value="">All Roles</option>
                                    <option value="user" <?php echo (isset($_GET['role']) && $_GET['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                                    <option value="admin" <?php echo (isset($_GET['role']) && $_GET['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="status">
                                    <option value="">All Status</option>
                                    <option value="active" <?php echo (isset($_GET['status']) && $_GET['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo (isset($_GET['status']) && $_GET['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                    <option value="suspended" <?php echo (isset($_GET['status']) && $_GET['status'] == 'suspended') ? 'selected' : ''; ?>>Suspended</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Search
                                </button>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times me-2"></i>Clear
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Users List</h5>
                </div>
                <div class="card-body">
                    <?php if(isset($users) && !empty($users)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAll" onclick="selectAll()">
                                        </th>
                                        <th>User</th>
                                        <th>Contact</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Orders</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $user): ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="selected_users[]" value="<?php echo $user->id; ?>" 
                                                       onchange="updateBulkActions()">
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <strong><?php echo $user->full_name; ?></strong>
                                                        <br>
                                                        <small class="text-muted">@<?php echo $user->username; ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-envelope me-1"></i><?php echo $user->email; ?>
                                                    </small>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-phone me-1"></i><?php echo $user->phone; ?>
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php echo $user->role == 'admin' ? 'danger' : 'primary'; ?>">
                                                    <?php echo ucfirst($user->role); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php 
                                                    echo $user->status == 'active' ? 'success' : 
                                                        ($user->status == 'inactive' ? 'secondary' : 'warning'); 
                                                ?>">
                                                    <?php echo ucfirst($user->status); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <small class="text-muted">Total: <?php echo $user->total_orders ?? 0; ?></small>
                                                    <small class="text-muted">Completed: <?php echo $user->completed_orders ?? 0; ?></small>
                                                    <small class="text-muted">Spent: Rp <?php echo number_format($user->total_spent ?? 0, 0, ',', '.'); ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo date('d M Y', strtotime($user->created_at)); ?>
                                                <br>
                                                <small class="text-muted"><?php echo date('H:i', strtotime($user->created_at)); ?></small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo base_url('admin/users/view/' . $user->id); ?>" 
                                                       class="btn btn-sm btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('admin/users/edit/' . $user->id); ?>" 
                                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <?php if($user->status == 'active'): ?>
                                                        <button type="button" class="btn btn-sm btn-outline-warning" 
                                                                onclick="suspendUser(<?php echo $user->id; ?>)" title="Suspend">
                                                            <i class="fas fa-pause"></i>
                                                        </button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-sm btn-outline-success" 
                                                                onclick="activateUser(<?php echo $user->id; ?>)" title="Activate">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                            onclick="deleteUser(<?php echo $user->id; ?>)" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Bulk Actions -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="bulkActions" class="d-none">
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="bulkSuspend()">
                                            <i class="fas fa-pause me-2"></i>Suspend Selected
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" onclick="bulkActivate()">
                                            <i class="fas fa-play me-2"></i>Activate Selected
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="bulkDelete()">
                                            <i class="fas fa-trash me-2"></i>Delete Selected
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <?php if(isset($pagination)): ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <nav aria-label="Users pagination">
                                        <?php echo $pagination; ?>
                                    </nav>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">No users found</h4>
                            <p class="text-muted">
                                <?php if(isset($_GET['search']) || isset($_GET['role']) || isset($_GET['status'])): ?>
                                    Try adjusting your search criteria.
                                <?php else: ?>
                                    No users have registered yet.
                                <?php endif; ?>
                            </p>
                            <?php if(!isset($_GET['search']) && !isset($_GET['role']) && !isset($_GET['status'])): ?>
                                <a href="<?php echo base_url('admin/users/add'); ?>" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-2"></i>Add User
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. All user data, orders, and tickets will be permanently deleted.
                </div>
                <p>Are you sure you want to delete this user?</p>
                <p class="mb-0"><strong>User:</strong> <span id="userName"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash me-2"></i>Delete User
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Suspend Confirmation Modal -->
<div class="modal fade" id="suspendModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Suspend User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will prevent the user from logging in and accessing their account.
                </div>
                <p>Are you sure you want to suspend this user?</p>
                <p class="mb-0"><strong>User:</strong> <span id="suspendUserName"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="confirmSuspend()">
                    <i class="fas fa-pause me-2"></i>Suspend User
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let userToDelete = null;
let userToSuspend = null;

// Delete user
function deleteUser(userId) {
    // Get user details via AJAX
    fetch('<?php echo base_url("admin/users/get/"); ?>' + userId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                userToDelete = userId;
                document.getElementById('userName').textContent = data.user.full_name + ' (@' + data.user.username + ')';
                const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                modal.show();
            } else {
                alert('Error loading user details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading user details');
        });
}

function confirmDelete() {
    if (!userToDelete) return;
    
    fetch('<?php echo base_url("admin/users/delete/"); ?>' + userToDelete, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('User deleted successfully!');
            location.reload();
        } else {
            alert('Error deleting user: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error deleting user');
    });
}

// Suspend user
function suspendUser(userId) {
    // Get user details via AJAX
    fetch('<?php echo base_url("admin/users/get/"); ?>' + userId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                userToSuspend = userId;
                document.getElementById('suspendUserName').textContent = data.user.full_name + ' (@' + data.user.username + ')';
                const modal = new bootstrap.Modal(document.getElementById('suspendModal'));
                modal.show();
            } else {
                alert('Error loading user details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading user details');
        });
}

function confirmSuspend() {
    if (!userToSuspend) return;
    
    fetch('<?php echo base_url("admin/users/suspend/"); ?>' + userToSuspend, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('User suspended successfully!');
            location.reload();
        } else {
            alert('Error suspending user: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error suspending user');
    });
}

// Activate user
function activateUser(userId) {
    if (confirm('Are you sure you want to activate this user?')) {
        fetch('<?php echo base_url("admin/users/activate/"); ?>' + userId, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('User activated successfully!');
                location.reload();
            } else {
                alert('Error activating user: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error activating user');
        });
    }
}

// Bulk actions
function selectAll() {
    const checkboxes = document.querySelectorAll('input[name="selected_users[]"]');
    const selectAllCheckbox = document.getElementById('selectAll');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
    
    updateBulkActions();
}

function updateBulkActions() {
    const checkboxes = document.querySelectorAll('input[name="selected_users[]"]:checked');
    const bulkActions = document.getElementById('bulkActions');
    
    if (checkboxes.length > 0) {
        bulkActions.classList.remove('d-none');
    } else {
        bulkActions.classList.add('d-none');
    }
}

function bulkSuspend() {
    const checkboxes = document.querySelectorAll('input[name="selected_users[]"]:checked');
    const selectedIds = Array.from(checkboxes).map(cb => cb.value);
    
    if (selectedIds.length === 0) {
        alert('Please select users to suspend');
        return;
    }
    
    if (confirm(`Are you sure you want to suspend ${selectedIds.length} user(s)?`)) {
        fetch('<?php echo base_url("admin/users/bulk_suspend"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                user_ids: selectedIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Users suspended successfully!');
                location.reload();
            } else {
                alert('Error suspending users: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error suspending users');
        });
    }
}

function bulkActivate() {
    const checkboxes = document.querySelectorAll('input[name="selected_users[]"]:checked');
    const selectedIds = Array.from(checkboxes).map(cb => cb.value);
    
    if (selectedIds.length === 0) {
        alert('Please select users to activate');
        return;
    }
    
    if (confirm(`Are you sure you want to activate ${selectedIds.length} user(s)?`)) {
        fetch('<?php echo base_url("admin/users/bulk_activate"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                user_ids: selectedIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Users activated successfully!');
                location.reload();
            } else {
                alert('Error activating users: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error activating users');
        });
    }
}

function bulkDelete() {
    const checkboxes = document.querySelectorAll('input[name="selected_users[]"]:checked');
    const selectedIds = Array.from(checkboxes).map(cb => cb.value);
    
    if (selectedIds.length === 0) {
        alert('Please select users to delete');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${selectedIds.length} user(s)? This action cannot be undone.`)) {
        fetch('<?php echo base_url("admin/users/bulk_delete"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                user_ids: selectedIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Users deleted successfully!');
                location.reload();
            } else {
                alert('Error deleting users: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting users');
        });
    }
}
</script> 