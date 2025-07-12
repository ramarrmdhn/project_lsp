<!-- Admin Settings Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">System Settings</h1>
                    <p class="text-muted mb-0">Configure system preferences and options</p>
                </div>
                <div>
                    <button type="button" class="btn btn-success" onclick="saveAllSettings()">
                        <i class="fas fa-save me-2"></i>Save All Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- General Settings -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cog me-2"></i>General Settings</h5>
                </div>
                <div class="card-body">
                    <form id="generalSettingsForm">
                        <div class="mb-3">
                            <label for="site_name" class="form-label">Site Name</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" 
                                   value="<?php echo $settings->site_name ?? 'Ticket Concert'; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="site_description" class="form-label">Site Description</label>
                            <textarea class="form-control" id="site_description" name="site_description" rows="3"><?php echo $settings->site_description ?? 'Website penjualan tiket konser terpercaya'; ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="admin_email" class="form-label">Admin Email</label>
                            <input type="email" class="form-control" id="admin_email" name="admin_email" 
                                   value="<?php echo $settings->admin_email ?? 'admin@ticketconcert.com'; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Contact Phone</label>
                            <input type="tel" class="form-control" id="contact_phone" name="contact_phone" 
                                   value="<?php echo $settings->contact_phone ?? '+62 812-3456-7890'; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="contact_address" class="form-label">Contact Address</label>
                            <textarea class="form-control" id="contact_address" name="contact_address" rows="3"><?php echo $settings->contact_address ?? 'Jakarta, Indonesia'; ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="timezone" class="form-label">Timezone</label>
                            <select class="form-select" id="timezone" name="timezone">
                                <option value="Asia/Jakarta" <?php echo ($settings->timezone ?? 'Asia/Jakarta') == 'Asia/Jakarta' ? 'selected' : ''; ?>>Asia/Jakarta (WIB)</option>
                                <option value="Asia/Makassar" <?php echo ($settings->timezone ?? 'Asia/Jakarta') == 'Asia/Makassar' ? 'selected' : ''; ?>>Asia/Makassar (WITA)</option>
                                <option value="Asia/Jayapura" <?php echo ($settings->timezone ?? 'Asia/Jakarta') == 'Asia/Jayapura' ? 'selected' : ''; ?>>Asia/Jayapura (WIT)</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Ticket Settings -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Ticket Settings</h5>
                </div>
                <div class="card-body">
                    <form id="ticketSettingsForm">
                        <div class="mb-3">
                            <label for="max_tickets_per_order" class="form-label">Maximum Tickets per Order</label>
                            <input type="number" class="form-control" id="max_tickets_per_order" name="max_tickets_per_order" 
                                   value="<?php echo $settings->max_tickets_per_order ?? 10; ?>" min="1" max="50">
                        </div>
                        
                        <div class="mb-3">
                            <label for="ticket_expiry_hours" class="form-label">Ticket Reservation Expiry (Hours)</label>
                            <input type="number" class="form-control" id="ticket_expiry_hours" name="ticket_expiry_hours" 
                                   value="<?php echo $settings->ticket_expiry_hours ?? 24; ?>" min="1" max="72">
                        </div>
                        
                        <div class="mb-3">
                            <label for="service_fee_percentage" class="form-label">Service Fee Percentage (%)</label>
                            <input type="number" class="form-control" id="service_fee_percentage" name="service_fee_percentage" 
                                   value="<?php echo $settings->service_fee_percentage ?? 5; ?>" min="0" max="20" step="0.1">
                        </div>
                        
                        <div class="mb-3">
                            <label for="tax_percentage" class="form-label">Tax Percentage (%)</label>
                            <input type="number" class="form-control" id="tax_percentage" name="tax_percentage" 
                                   value="<?php echo $settings->tax_percentage ?? 10; ?>" min="0" max="20" step="0.1">
                        </div>
                        
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-select" id="currency" name="currency">
                                <option value="IDR" <?php echo ($settings->currency ?? 'IDR') == 'IDR' ? 'selected' : ''; ?>>Indonesian Rupiah (IDR)</option>
                                <option value="USD" <?php echo ($settings->currency ?? 'IDR') == 'USD' ? 'selected' : ''; ?>>US Dollar (USD)</option>
                                <option value="EUR" <?php echo ($settings->currency ?? 'IDR') == 'EUR' ? 'selected' : ''; ?>>Euro (EUR)</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Email Settings -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Email Settings</h5>
                </div>
                <div class="card-body">
                    <form id="emailSettingsForm">
                        <div class="mb-3">
                            <label for="smtp_host" class="form-label">SMTP Host</label>
                            <input type="text" class="form-control" id="smtp_host" name="smtp_host" 
                                   value="<?php echo $settings->smtp_host ?? 'smtp.gmail.com'; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="smtp_port" class="form-label">SMTP Port</label>
                            <input type="number" class="form-control" id="smtp_port" name="smtp_port" 
                                   value="<?php echo $settings->smtp_port ?? 587; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="smtp_username" class="form-label">SMTP Username</label>
                            <input type="email" class="form-control" id="smtp_username" name="smtp_username" 
                                   value="<?php echo $settings->smtp_username ?? ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="smtp_password" class="form-label">SMTP Password</label>
                            <input type="password" class="form-control" id="smtp_password" name="smtp_password" 
                                   value="<?php echo $settings->smtp_password ?? ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="smtp_encryption" class="form-label">SMTP Encryption</label>
                            <select class="form-select" id="smtp_encryption" name="smtp_encryption">
                                <option value="tls" <?php echo ($settings->smtp_encryption ?? 'tls') == 'tls' ? 'selected' : ''; ?>>TLS</option>
                                <option value="ssl" <?php echo ($settings->smtp_encryption ?? 'tls') == 'ssl' ? 'selected' : ''; ?>>SSL</option>
                                <option value="none" <?php echo ($settings->smtp_encryption ?? 'tls') == 'none' ? 'selected' : ''; ?>>None</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-primary" onclick="testEmail()">
                                <i class="fas fa-paper-plane me-2"></i>Test Email Configuration
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Payment Settings -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Payment Settings</h5>
                </div>
                <div class="card-body">
                    <form id="paymentSettingsForm">
                        <div class="mb-3">
                            <label class="form-label">Payment Methods</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="payment_bank_transfer" name="payment_methods[]" 
                                       value="bank_transfer" <?php echo in_array('bank_transfer', $settings->payment_methods ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="payment_bank_transfer">
                                    Bank Transfer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="payment_credit_card" name="payment_methods[]" 
                                       value="credit_card" <?php echo in_array('credit_card', $settings->payment_methods ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="payment_credit_card">
                                    Credit Card
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="payment_e_wallet" name="payment_methods[]" 
                                       value="e_wallet" <?php echo in_array('e_wallet', $settings->payment_methods ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="payment_e_wallet">
                                    E-Wallet
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="payment_cash" name="payment_methods[]" 
                                       value="cash" <?php echo in_array('cash', $settings->payment_methods ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="payment_cash">
                                    Cash on Delivery
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="midtrans_merchant_id" class="form-label">Midtrans Merchant ID</label>
                            <input type="text" class="form-control" id="midtrans_merchant_id" name="midtrans_merchant_id" 
                                   value="<?php echo $settings->midtrans_merchant_id ?? ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="midtrans_client_key" class="form-label">Midtrans Client Key</label>
                            <input type="text" class="form-control" id="midtrans_client_key" name="midtrans_client_key" 
                                   value="<?php echo $settings->midtrans_client_key ?? ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="midtrans_server_key" class="form-label">Midtrans Server Key</label>
                            <input type="password" class="form-control" id="midtrans_server_key" name="midtrans_server_key" 
                                   value="<?php echo $settings->midtrans_server_key ?? ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="payment_environment" class="form-label">Payment Environment</label>
                            <select class="form-select" id="payment_environment" name="payment_environment">
                                <option value="sandbox" <?php echo ($settings->payment_environment ?? 'sandbox') == 'sandbox' ? 'selected' : ''; ?>>Sandbox (Testing)</option>
                                <option value="production" <?php echo ($settings->payment_environment ?? 'sandbox') == 'production' ? 'selected' : ''; ?>>Production (Live)</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Security Settings -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Security Settings</h5>
                </div>
                <div class="card-body">
                    <form id="securitySettingsForm">
                        <div class="mb-3">
                            <label for="session_timeout" class="form-label">Session Timeout (Minutes)</label>
                            <input type="number" class="form-control" id="session_timeout" name="session_timeout" 
                                   value="<?php echo $settings->session_timeout ?? 30; ?>" min="5" max="1440">
                        </div>
                        
                        <div class="mb-3">
                            <label for="max_login_attempts" class="form-label">Maximum Login Attempts</label>
                            <input type="number" class="form-control" id="max_login_attempts" name="max_login_attempts" 
                                   value="<?php echo $settings->max_login_attempts ?? 5; ?>" min="3" max="10">
                        </div>
                        
                        <div class="mb-3">
                            <label for="lockout_duration" class="form-label">Lockout Duration (Minutes)</label>
                            <input type="number" class="form-control" id="lockout_duration" name="lockout_duration" 
                                   value="<?php echo $settings->lockout_duration ?? 15; ?>" min="5" max="60">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Security Features</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="enable_captcha" name="security_features[]" 
                                       value="captcha" <?php echo in_array('captcha', $settings->security_features ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="enable_captcha">
                                    Enable CAPTCHA on login
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="enable_2fa" name="security_features[]" 
                                       value="2fa" <?php echo in_array('2fa', $settings->security_features ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="enable_2fa">
                                    Enable Two-Factor Authentication
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="enable_ssl" name="security_features[]" 
                                       value="ssl" <?php echo in_array('ssl', $settings->security_features ?? []) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="enable_ssl">
                                    Force SSL/HTTPS
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Maintenance Settings -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-tools me-2"></i>Maintenance Settings</h5>
                </div>
                <div class="card-body">
                    <form id="maintenanceSettingsForm">
                        <div class="mb-3">
                            <label class="form-label">Maintenance Mode</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode" 
                                       value="1" <?php echo ($settings->maintenance_mode ?? 0) == 1 ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="maintenance_mode">
                                    Enable Maintenance Mode
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="maintenance_message" class="form-label">Maintenance Message</label>
                            <textarea class="form-control" id="maintenance_message" name="maintenance_message" rows="3"><?php echo $settings->maintenance_message ?? 'We are currently performing maintenance. Please check back later.'; ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="backup_frequency" class="form-label">Database Backup Frequency</label>
                            <select class="form-select" id="backup_frequency" name="backup_frequency">
                                <option value="daily" <?php echo ($settings->backup_frequency ?? 'daily') == 'daily' ? 'selected' : ''; ?>>Daily</option>
                                <option value="weekly" <?php echo ($settings->backup_frequency ?? 'daily') == 'weekly' ? 'selected' : ''; ?>>Weekly</option>
                                <option value="monthly" <?php echo ($settings->backup_frequency ?? 'daily') == 'monthly' ? 'selected' : ''; ?>>Monthly</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="log_retention_days" class="form-label">Log Retention (Days)</label>
                            <input type="number" class="form-control" id="log_retention_days" name="log_retention_days" 
                                   value="<?php echo $settings->log_retention_days ?? 30; ?>" min="7" max="365">
                        </div>
                        
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-warning" onclick="createBackup()">
                                <i class="fas fa-download me-2"></i>Create Manual Backup
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Test Email Modal -->
<div class="modal fade" id="testEmailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Test Email Configuration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="test_email" class="form-label">Test Email Address</label>
                    <input type="email" class="form-control" id="test_email" placeholder="Enter email address to test">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="sendTestEmail()">
                    <i class="fas fa-paper-plane me-2"></i>Send Test Email
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Save all settings
function saveAllSettings() {
    const forms = ['generalSettingsForm', 'ticketSettingsForm', 'emailSettingsForm', 'paymentSettingsForm', 'securitySettingsForm', 'maintenanceSettingsForm'];
    const formData = new FormData();
    
    forms.forEach(formId => {
        const form = document.getElementById(formId);
        const formElements = form.elements;
        
        for (let i = 0; i < formElements.length; i++) {
            const element = formElements[i];
            if (element.name) {
                if (element.type === 'checkbox') {
                    if (element.checked) {
                        formData.append(element.name, element.value);
                    }
                } else {
                    formData.append(element.name, element.value);
                }
            }
        }
    });
    
    fetch('<?php echo base_url("admin/settings/save"); ?>', {
        method: 'POST',
        body: formData
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

// Test email configuration
function testEmail() {
    const modal = new bootstrap.Modal(document.getElementById('testEmailModal'));
    modal.show();
}

function sendTestEmail() {
    const testEmail = document.getElementById('test_email').value;
    
    if (!testEmail) {
        alert('Please enter a test email address');
        return;
    }
    
    fetch('<?php echo base_url("admin/settings/test_email"); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            test_email: testEmail
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Test email sent successfully!');
            bootstrap.Modal.getInstance(document.getElementById('testEmailModal')).hide();
        } else {
            alert('Error sending test email: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error sending test email');
    });
}

// Create manual backup
function createBackup() {
    if (confirm('Are you sure you want to create a manual backup? This may take a few moments.')) {
        fetch('<?php echo base_url("admin/settings/create_backup"); ?>', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Backup created successfully!');
            } else {
                alert('Error creating backup: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error creating backup');
        });
    }
}

// Auto-save settings on change
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[id$="SettingsForm"]');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('change', function() {
                // Auto-save after 2 seconds of inactivity
                clearTimeout(window.autoSaveTimeout);
                window.autoSaveTimeout = setTimeout(() => {
                    saveAllSettings();
                }, 2000);
            });
        });
    });
});
</script> 