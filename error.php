<?php
require_once 'includes/config.php';

$error_code = $_GET['code'] ?? '404';
$error_messages = [
    '400' => ['title' => 'Bad Request', 'message' => 'The request could not be understood by the server.'],
    '401' => ['title' => 'Unauthorized', 'message' => 'Authentication is required to access this resource.'],
    '403' => ['title' => 'Forbidden', 'message' => 'You do not have permission to access this resource.'],
    '404' => ['title' => 'Page Not Found', 'message' => 'The page you are looking for could not be found.'],
    '500' => ['title' => 'Internal Server Error', 'message' => 'An internal server error occurred.']
];

$error = $error_messages[$error_code] ?? $error_messages['404'];
$page_title = $error['title'] . ' - Free Online File Converter';

include 'includes/header.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="error-container">
                <h1 class="display-1 text-primary fw-bold"><?php echo $error_code; ?></h1>
                <h2 class="h3 text-dark mb-3"><?php echo $error['title']; ?></h2>
                <p class="text-muted mb-4"><?php echo $error['message']; ?></p>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="index.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-home me-2"></i>Go Home
                    </a>
                    <button onclick="history.back()" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Go Back
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
