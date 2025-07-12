<!-- Profile Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">My Profile</h1>
                    <p class="text-muted mb-0">Manage your account information and settings</p>
                </div>
                <div>
                    <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Profile Information -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Profile Information</h5>
                </div>
                <div class="card-body">
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

                    <form action="<?php echo base_url('profile/update'); ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           value="<?php echo $user->username; ?>" required>
                                    <?php echo form_error('username', '<div class="text-danger small">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo $user->email; ?>" required>
                                    <?php echo form_error('email', '<div class="text-danger small">', '</div>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" 
                                           value="<?php echo $user->full_name; ?>" required>
                                    <?php echo form_error('full_name', '<div class="text-danger small">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?php echo $user->phone; ?>" required>
                                    <?php echo form_error('phone', '<div class="text-danger small">', '</div>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3"><?php echo $user->address; ?></textarea>
                            <?php echo form_error('address', '<div class="text-danger small">', '</div>'); ?>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Change Password</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('profile/change_password'); ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <?php echo form_error('current_password', '<div class="text-danger small">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <?php echo form_error('new_password', '<div class="text-danger small">', '</div>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <?php echo form_error('confirm_password', '<div class="text-danger small">', '</div>'); ?>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-key me-2"></i>Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Profile Summary -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Profile Summary</h5>
                </div>
                <div class="card-body text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                        <i class="fas fa-user fa-3x text-primary"></i>
                    </div>
                    <h5 class="mb-1"><?php echo $user->full_name; ?></h5>
                    <p class="text-muted mb-3"><?php echo $user->email; ?></p>
                    
                    <div class="row text-center">
                        <div class="col-6">
                            <h6 class="text-primary"><?php echo isset($total_orders) ? $total_orders : 0; ?></h6>
                            <small class="text-muted">Total Orders</small>
                        </div>
                        <div class="col-6">
                            <h6 class="text-success"><?php echo isset($completed_orders) ? $completed_orders : 0; ?></h6>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="text-start">
                        <p class="mb-2"><strong>Username:</strong> <?php echo $user->username; ?></p>
                        <p class="mb-2"><strong>Phone:</strong> <?php echo $user->phone; ?></p>
                        <p class="mb-2"><strong>Member Since:</strong> <?php echo date('d M Y', strtotime($user->created_at)); ?></p>
                        <?php if($user->address): ?>
                            <p class="mb-0"><strong>Address:</strong> <?php echo $user->address; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Account Settings -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Account Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Email Notifications</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="email_orders" checked>
                            <label class="form-check-label" for="email_orders">
                                Order confirmations
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="email_promotions" checked>
                            <label class="form-check-label" for="email_promotions">
                                Promotional offers
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="email_newsletter">
                            <label class="form-check-label" for="email_newsletter">
                                Newsletter
                            </label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">SMS Notifications</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sms_orders" checked>
                            <label class="form-check-label" for="sms_orders">
                                Order updates
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sms_reminders">
                            <label class="form-check-label" for="sms_reminders">
                                Concert reminders
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="button" class="btn btn-outline-primary" onclick="saveSettings()">
                            <i class="fas fa-save me-2"></i>Save Settings
                        </button>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card shadow border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">These actions cannot be undone.</p>
                    
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-danger" onclick="deactivateAccount()">
                            <i class="fas fa-user-slash me-2"></i>Deactivate Account
                        </button>
                        <button type="button" class="btn btn-danger" onclick="deleteAccount()">
                            <i class="fas fa-trash me-2"></i>Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deactivate Account Modal -->
<div class="modal fade" id="deactivateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deactivate Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will temporarily deactivate your account. You can reactivate it later by logging in.
                </div>
                <p>Are you sure you want to deactivate your account?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="confirmDeactivate()">
                    <i class="fas fa-user-slash me-2"></i>Deactivate Account
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. All your data will be permanently deleted.
                </div>
                <p>Are you absolutely sure you want to delete your account?</p>
                <div class="mb-3">
                    <label class="form-label">Type "DELETE" to confirm</label>
                    <input type="text" class="form-control" id="deleteConfirm" placeholder="DELETE">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()" disabled>
                    <i class="fas fa-trash me-2"></i>Delete Account
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Save settings
function saveSettings() {
    const settings = {
        email_orders: document.getElementById('email_orders').checked,
        email_promotions: document.getElementById('email_promotions').checked,
        email_newsletter: document.getElementById('email_newsletter').checked,
        sms_orders: document.getElementById('sms_orders').checked,
        sms_reminders: document.getElementById('sms_reminders').checked
    };
    
    fetch('<?php echo base_url("profile/save_settings"); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(settings)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Settings saved successfully!');
        } else {
            alert('Error saving settings: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving settings');
    });
}

// Deactivate account
function deactivateAccount() {
    const modal = new bootstrap.Modal(document.getElementById('deactivateModal'));
    modal.show();
}

function confirmDeactivate() {
    fetch('<?php echo base_url("profile/deactivate"); ?>', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Account deactivated successfully!');
            window.location.href = '<?php echo base_url("logout"); ?>';
        } else {
            alert('Error deactivating account: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error deactivating account');
    });
}

// Delete account
function deleteAccount() {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Enable delete button when confirmation is typed
document.getElementById('deleteConfirm').addEventListener('input', function() {
    const deleteBtn = document.querySelector('#deleteModal .btn-danger');
    deleteBtn.disabled = this.value !== 'DELETE';
});

function confirmDelete() {
    const confirmInput = document.getElementById('deleteConfirm');
    if (confirmInput.value !== 'DELETE') {
        alert('Please type "DELETE" to confirm');
        return;
    }
    
    fetch('<?php echo base_url("profile/delete"); ?>', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Account deleted successfully!');
            window.location.href = '<?php echo base_url("logout"); ?>';
        } else {
            alert('Error deleting account: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error deleting account');
    });
}
</script> 