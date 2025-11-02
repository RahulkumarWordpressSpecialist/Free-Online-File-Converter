<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = "Contact Us - Free Online File Converter";
$meta_description = "Get in touch with us for support, feedback, or inquiries about our free online file converter service.";

$success_message = '';
$error_message = '';

// Handle form submission
if ($_POST) {
    $name = sanitize_input($_POST['name'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $subject = sanitize_input($_POST['subject'] ?? '');
    $message = sanitize_input($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        // Here you would typically send an email or save to database
        // For now, we'll just show a success message
        $success_message = 'Thank you for your message! We will get back to you soon.';
        
        // Clear form data after successful submission
        $name = $email = $subject = $message = '';
    }
}

include 'includes/header.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Page Header -->
            <div class="text-center mb-5">
                <h1 class="display-4 text-primary mb-3">Contact Us</h1>
                <p class="lead text-muted">Have questions or need support? We're here to help!</p>
            </div>

            <!-- Success/Error Messages -->
            <?php if ($success_message): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Contact Form -->
                <div class="col-md-8 mb-5">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="text-primary mb-4">Send us a Message</h3>
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Choose a subject...</option>
                                        <option value="General Inquiry" <?php echo (isset($subject) && $subject == 'General Inquiry') ? 'selected' : ''; ?>>General Inquiry</option>
                                        <option value="Technical Support" <?php echo (isset($subject) && $subject == 'Technical Support') ? 'selected' : ''; ?>>Technical Support</option>
                                        <option value="Feature Request" <?php echo (isset($subject) && $subject == 'Feature Request') ? 'selected' : ''; ?>>Feature Request</option>
                                        <option value="Bug Report" <?php echo (isset($subject) && $subject == 'Bug Report') ? 'selected' : ''; ?>>Bug Report</option>
                                        <option value="Business Inquiry" <?php echo (isset($subject) && $subject == 'Business Inquiry') ? 'selected' : ''; ?>>Business Inquiry</option>
                                        <option value="Other" <?php echo (isset($subject) && $subject == 'Other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="6" 
                                              placeholder="Please describe your inquiry in detail..." required><?php echo htmlspecialchars($message ?? ''); ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h4 class="text-primary mb-3">Get in Touch</h4>
                            <div class="contact-info">
                                <div class="mb-3">
                                    <i class="fas fa-user text-primary me-2"></i>
                                    <strong>Rahul Kumar</strong><br>
                                    <small class="text-muted">CEO & Developer</small>
                                </div>
                                <div class="mb-3">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    <a href="mailto:help@wp-fixhub.com" class="text-decoration-none">help@wp-fixhub.com</a>
                                </div>
                                <div class="mb-3">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <a href="tel:+919113451527" class="text-decoration-none">+91 9113451527</a>
                                </div>
                                <div class="mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    At-Khedarpur, PO-Bahadurpur<br>
                                    Samastipur, Bihar 848114
                                </div>
                                <div class="mb-3">
                                    <i class="fas fa-globe text-primary me-2"></i>
                                    <a href="https://rahulkumar.wp-fixhub.com" target="_blank" class="text-decoration-none">rahulkumar.wp-fixhub.com</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="text-primary mb-3">Follow Us</h5>
                            <div class="social-links">
                                <a href="#" class="btn btn-outline-primary me-2 mb-2">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-info me-2 mb-2">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary me-2 mb-2">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger me-2 mb-2">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="card shadow-sm border-0 mt-5">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-4">Frequently Asked Questions</h3>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Is your file converter really free?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! Our basic file conversion service is completely free with no hidden charges or registration required.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    How secure are my files?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We take security seriously. All files are automatically deleted from our servers after conversion to ensure your privacy.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    What file formats do you support?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We support a wide range of formats including documents (PDF, DOCX), images (JPG, PNG), audio (MP3, WAV), and video files.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
