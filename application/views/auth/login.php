<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Login - Ticket Concert'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .login-body {
            padding: 40px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }
        .form-control:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
        }
        .social-login {
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
            margin-top: 20px;
        }
        .btn-social {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-card">
                        <div class="login-header">
                            <h2 class="mb-0">
                                <i class="fas fa-ticket-alt me-2"></i>Ticket Concert
                            </h2>
                            <p class="mb-0 mt-2">Selamat datang kembali! Silakan masuk ke akun Anda.</p>
                        </div>
                        
                        <div class="login-body">
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

                            <!-- Login Form -->
                            <?php echo form_open('auth/login', ['class' => 'needs-validation', 'novalidate' => '']); ?>
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Alamat Email
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo set_value('email'); ?>" required>
                                    <?php echo form_error('email', '<div class="text-danger small">', '</div>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Kata Sandi
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <?php echo form_error('password', '<div class="text-danger small">', '</div>'); ?>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">
                                        Ingat saya
                                    </label>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                    </button>
                                </div>
                            <?php echo form_close(); ?>

                            <!-- Social Login -->
                            <div class="social-login">
                                <p class="text-center text-muted mb-3">Atau masuk dengan</p>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button class="btn btn-outline-primary btn-social w-100">
                                            <i class="fab fa-google me-2"></i>Google
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-dark btn-social w-100">
                                            <i class="fab fa-facebook me-2"></i>Facebook
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Links -->
                            <div class="text-center mt-4">
                                <p class="mb-2">
                                    Belum punya akun? 
                                    <a href="<?php echo base_url('register'); ?>" class="text-decoration-none">
                                        Daftar di sini
                                    </a>
                                </p>
                                <p class="mb-0">
                                    <a href="<?php echo base_url('forgot-password'); ?>" class="text-decoration-none">
                                        <i class="fas fa-key me-1"></i>Lupa kata sandi?
                                    </a>
                                </p>
                            </div>

                            <!-- Back to Home -->
                            <div class="text-center mt-4">
                                <a href="<?php echo base_url(); ?>" class="text-decoration-none">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html> 