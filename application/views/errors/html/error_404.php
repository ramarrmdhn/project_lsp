<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Ticket Concert</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            font-size: 8rem;
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
        .search-box {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 15px 25px;
            color: white;
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
        }
        .search-box::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .search-box:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
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
        .suggested-links {
            margin-top: 40px;
        }
        .suggested-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            margin: 0 15px;
            transition: all 0.3s ease;
        }
        .suggested-links a:hover {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="floating-element">
            <i class="fas fa-music fa-2x"></i>
        </div>
        <div class="floating-element">
            <i class="fas fa-ticket-alt fa-2x"></i>
        </div>
        <div class="floating-element">
            <i class="fas fa-star fa-2x"></i>
        </div>
    </div>

    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-search"></i>
        </div>
        
        <div class="error-code">404</div>
        
        <h1 class="error-title">Oops! Page Not Found</h1>
        
        <p class="error-message">
            The page you're looking for doesn't exist. It might have been moved, deleted, or you entered the wrong URL.
        </p>
        
        <!-- Search Box -->
        <form action="<?php echo base_url('search'); ?>" method="GET" class="mb-4">
            <input type="text" name="q" class="search-box" placeholder="Search for concerts, artists, or venues..." 
                   value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
        </form>
        
        <!-- Action Buttons -->
        <div class="mb-4">
            <a href="<?php echo base_url(); ?>" class="btn-home">
                <i class="fas fa-home me-2"></i>Go Home
            </a>
            <a href="<?php echo base_url('concerts'); ?>" class="btn-home">
                <i class="fas fa-music me-2"></i>Browse Concerts
            </a>
            <a href="javascript:history.back()" class="btn-home">
                <i class="fas fa-arrow-left me-2"></i>Go Back
            </a>
        </div>
        
        <!-- Suggested Links -->
        <div class="suggested-links">
            <h6 class="mb-3">Popular Pages:</h6>
            <a href="<?php echo base_url('concerts'); ?>">Concerts</a>
            <a href="<?php echo base_url('about'); ?>">About Us</a>
            <a href="<?php echo base_url('contact'); ?>">Contact</a>
            <a href="<?php echo base_url('help'); ?>">Help Center</a>
        </div>
        
        <!-- Error Details (for debugging) -->
        <?php if(ENVIRONMENT === 'development'): ?>
            <div class="mt-5 p-3" style="background: rgba(255, 255, 255, 0.1); border-radius: 10px;">
                <h6>Debug Information:</h6>
                <small>
                    <strong>Requested URL:</strong> <?php echo $_SERVER['REQUEST_URI']; ?><br>
                    <strong>Referrer:</strong> <?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'None'; ?><br>
                    <strong>User Agent:</strong> <?php echo $_SERVER['HTTP_USER_AGENT']; ?>
                </small>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Auto-focus search box
        document.addEventListener('DOMContentLoaded', function() {
            const searchBox = document.querySelector('.search-box');
            if (searchBox) {
                searchBox.focus();
            }
        });

        // Handle search form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const searchValue = document.querySelector('.search-box').value.trim();
            if (!searchValue) {
                e.preventDefault();
                alert('Please enter a search term');
            }
        });

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

        // Track 404 errors (if analytics is available)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'page_view', {
                'page_title': '404 Error',
                'page_location': window.location.href
            });
        }
    </script>
</body>
</html>