<?php
require_once 'includes/config.php';

$page_title = "About Us - Free Online File Converter";
$meta_description = "Learn about our free online file converter service and meet our team. Founded by Rahul Kumar, CEO and Developer.";

include 'includes/header.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Page Header -->
            <div class="text-center mb-5">
                <h1 class="display-4 text-primary mb-3">About Us</h1>
                <p class="lead text-muted">Learn more about our mission and the team behind this service</p>
            </div>

            <!-- About Content -->
            <div class="card shadow-lg border-0 mb-5">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-4x text-white"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h2 class="text-primary mb-3">Rahul Kumar</h2>
                            <h5 class="text-muted mb-3">CEO & Developer</h5>
                            <p class="text-dark mb-4">
                                Hello! I'm Rahul Kumar, the founder and developer of this free online file converter service. 
                                With a passion for creating useful web applications, I've developed this platform to help 
                                users easily convert their files between different formats without any hassle.
                            </p>
                            
                            <!-- Contact Information -->
                            <div class="contact-info">
                                <h6 class="text-primary mb-3">Contact Information:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <strong>Address:</strong> At-Khedarpur, PO-Bahadurpur, Samastipur, Bihar 848114
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-phone text-primary me-2"></i>
                                        <strong>Mobile:</strong> <a href="tel:+919113451527" class="text-decoration-none">+91 9113451527</a>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <strong>Email:</strong> <a href="mailto:help@wp-fixhub.com" class="text-decoration-none">help@wp-fixhub.com</a>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-globe text-primary me-2"></i>
                                        <strong>Website:</strong> <a href="https://rahulkumar.wp-fixhub.com" target="_blank" class="text-decoration-none">rahulkumar.wp-fixhub.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mission Section -->
            <div class="card shadow-sm border-0 mb-5">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-3">Our Mission</h3>
                    <p class="text-dark mb-3">
                        Our mission is to provide a fast, secure, and user-friendly file conversion service that's 
                        accessible to everyone. We believe that file conversion should be simple, free, and respect 
                        your privacy.
                    </p>
                    <p class="text-dark">
                        We're committed to continuously improving our service by adding new formats, enhancing 
                        performance, and maintaining the highest standards of security and privacy.
                    </p>
                </div>
            </div>

            <!-- Features Section -->
            <div class="card shadow-sm border-0 mb-5">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-3">What We Offer</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Free file conversion</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Multiple format support</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Drag & drop interface</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Mobile-friendly design</li>
                            </ul>
                        </div>
                        <div class="col-md-6 mb-3">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Secure processing</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Auto-delete for privacy</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fast cloud processing</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>No registration required</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="text-center">
                <h4 class="text-primary mb-3">Connect With Us</h4>
                <div class="social-links">
                    <a href="#" class="btn btn-outline-primary btn-lg me-2 mb-2">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-outline-info btn-lg me-2 mb-2">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline-primary btn-lg me-2 mb-2">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="btn btn-outline-danger btn-lg me-2 mb-2">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://rahulkumar.wp-fixhub.com" target="_blank" class="btn btn-outline-dark btn-lg me-2 mb-2">
                        <i class="fas fa-globe"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
