<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Error | Ticket Concert</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-container {
            text-align: center;
            color: white;
            max-width: 600px;
            padding: 40px;
        }
        .error-code {
            font-size: 6rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .error-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.9;
        }
        .error-icon {
            font-size: 6rem;
            margin-bottom: 30px;
            opacity: 0.8;
        }
        .btn-home {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 10px;
        }
        .btn-home:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
        }
        .error-details {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            text-align: left;
        }
        .error-details h6 {
            margin-bottom: 15px;
            font-weight: bold;
        }
        .error-details pre {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            padding: 15px;
            color: #f8f9fa;
            font-size: 0.9rem;
            overflow-x: auto;
        }
        .status-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #28a745;
            margin-right: 8px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
            }
        }
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }
        .floating-element {
            position: absolute;
            color: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }
        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        .floating-element:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }
        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
    </style>
</head>
<body>
    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="floating-element">
            <i class="fas fa-database fa-2x"></i>
        </div>
        <div class="floating-element">
            <i class="fas fa-exclamation-triangle fa-2x"></i>
        </div>
        <div class="floating-element">
            <i class="fas fa-tools fa-2x"></i>
        </div>
    </div>

    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-database"></i>
        </div>
        
        <div class="error-code">DB Error</div>
        
        <h1 class="error-title">Database Connection Error</h1>
        
        <p class="error-message">
            We're experiencing technical difficulties with our database. Our team has been notified and is working to resolve this issue.
        </p>
        
        <!-- Status Information -->
        <div class="mb-4">
            <p>
                <span class="status-indicator"></span>
                <strong>Status:</strong> Our technical team is investigating
            </p>
            <p>
                <i class="fas fa-clock me-2"></i>
                <strong>Estimated Resolution:</strong> Within 30 minutes
            </p>
        </div>
        
        <!-- Action Buttons -->
        <div class="mb-4">
            <a href="<?php echo base_url(); ?>" class="btn-home">
                <i class="fas fa-home me-2"></i>Go Home
            </a>
            <a href="javascript:location.reload()" class="btn-home">
                <i class="fas fa-redo me-2"></i>Try Again
            </a>
            <a href="<?php echo base_url('contact'); ?>" class="btn-home">
                <i class="fas fa-headset me-2"></i>Contact Support
            </a>
        </div>
        
        <!-- Error Details (for development) -->
        <?php if(ENVIRONMENT === 'development'): ?>
            <div class="error-details">
                <h6><i class="fas fa-bug me-2"></i>Debug Information:</h6>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Error Type:</strong> Database Connection Error<br>
                        <strong>Error Code:</strong> <?php echo isset($error_code) ? $error_code : 'Unknown'; ?><br>
                        <strong>Error Message:</strong> <?php echo isset($error_message) ? $error_message : 'Database connection failed'; ?><br>
                        <strong>File:</strong> <?php echo isset($file) ? $file : 'Unknown'; ?><br>
                        <strong>Line:</strong> <?php echo isset($line) ? $line : 'Unknown'; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Server Time:</strong> <?php echo date('Y-m-d H:i:s'); ?><br>
                        <strong>Request URI:</strong> <?php echo $_SERVER['REQUEST_URI']; ?><br>
                        <strong>User Agent:</strong> <?php echo $_SERVER['HTTP_USER_AGENT']; ?><br>
                        <strong>IP Address:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?>
                    </div>
                </div>
                
                <?php if(isset($sql_query)): ?>
                    <div class="mt-3">
                        <strong>SQL Query:</strong>
                        <pre><?php echo htmlspecialchars($sql_query); ?></pre>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($backtrace)): ?>
                    <div class="mt-3">
                        <strong>Backtrace:</strong>
                        <pre><?php echo htmlspecialchars($backtrace); ?></pre>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <!-- Alternative Actions -->
        <div class="mt-4">
            <h6>What you can do:</h6>
            <ul class="list-unstyled">
                <li><i class="fas fa-check me-2"></i>Wait a few minutes and try again</li>
                <li><i class="fas fa-check me-2"></i>Check our status page for updates</li>
                <li><i class="fas fa-check me-2"></i>Contact our support team if the issue persists</li>
                <li><i class="fas fa-check me-2"></i>Follow us on social media for updates</li>
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Auto-refresh after 5 minutes
        setTimeout(function() {
            if (confirm('Would you like to try refreshing the page?')) {
                location.reload();
            }
        }, 300000); // 5 minutes

        // Add some interactivity to floating elements
        document.querySelectorAll('.floating-element').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.opacity = '0.3';
                this.style.transform = 'scale(1.2)';
            });
            
            element.addEventListener('mouseleave', function() {
                this.style.opacity = '0.1';
                this.style.transform = 'scale(1)';
            });
        });

        // Track database errors (if analytics is available)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'exception', {
                'description': 'Database Connection Error',
                'fatal': true
            });
        }

        // Check if database is back online
        function checkDatabaseStatus() {
            fetch('<?php echo base_url("api/health"); ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'online') {
                        showSuccess('Database is back online! Refreshing page...');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.log('Database still offline');
                });
        }

        // Check database status every 30 seconds
        setInterval(checkDatabaseStatus, 30000);

        // Show success message function
        function showSuccess(message) {
            const alert = document.createElement('div');
            alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
            alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
            alert.innerHTML = `
                <i class="fas fa-check-circle me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alert);
            
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }
    </script>
</body>
</html>