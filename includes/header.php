<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Free Online File Converter'; ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'Free online file converter tool. Convert PDF, images, audio and video files quickly and securely.'; ?>">
    <meta name="keywords" content="<?php echo isset($meta_keywords) ? htmlspecialchars($meta_keywords) : 'free file converter, online converter, PDF converter, image converter, file conversion'; ?>">
    <meta name="author" content="Rahul Kumar">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Free Online File Converter'; ?>">
    <meta property="og:description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'Free online file converter tool. Convert PDF, images, audio and video files quickly and securely.'; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:site_name" content="Free Online File Converter">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Free Online File Converter'; ?>">
    <meta name="twitter:description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'Free online file converter tool. Convert PDF, images, audio and video files quickly and securely.'; ?>">
    
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🔄</text></svg>">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "Free Online File Converter",
        "description": "Free online tool to convert files between multiple formats including PDF, images, audio, and video files.",
        "url": "<?php echo SITE_URL; ?>",
        "applicationCategory": "UtilityApplication",
        "operatingSystem": "Any",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
        },
        "author": {
            "@type": "Person",
            "name": "Rahul Kumar",
            "email": "help@wp-fixhub.com",
            "url": "https://rahulkumar.wp-fixhub.com"
        }
    }
    </script>
</head>
<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-exchange-alt me-2"></i>FileConverter
            </a>
            
            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" href="about.php">
                            <i class="fas fa-info-circle me-1"></i>About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>" href="contact.php">
                            <i class="fas fa-envelope me-1"></i>Contact
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cog me-1"></i>More
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="privacy.php"><i class="fas fa-shield-alt me-2"></i>Privacy Policy</a></li>
                            <li><a class="dropdown-item" href="terms.php"><i class="fas fa-file-contract me-2"></i>Terms of Service</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="https://rahulkumar.wp-fixhub.com" target="_blank"><i class="fas fa-external-link-alt me-2"></i>Developer</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
