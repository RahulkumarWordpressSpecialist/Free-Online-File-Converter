<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = "Free Online File Converter - Convert PDF, Images, Audio & Video Files";
$meta_description = "Free online file converter tool. Convert PDF to DOCX, JPG to PNG, MP3 to WAV and more. Fast, secure, and easy to use with drag & drop interface.";
$meta_keywords = "free file converter, online converter, PDF converter, image converter, audio converter, video converter";

include 'includes/header.php';
?>

<main class="container my-5">
    <!-- Hero Section -->
    <section class="hero-section text-center mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold text-primary mb-3">Free Online File Converter</h1>
                <p class="lead text-muted mb-4">Convert your files between multiple formats quickly and securely. Support for documents, images, audio, and video files.</p>
            </div>
        </div>
    </section>

    <!-- File Upload Section -->
    <section class="upload-section">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <form id="convertForm" enctype="multipart/form-data">
                            <div class="row">
                                <!-- File Upload Area -->
                                <div class="col-md-6 mb-4">
                                    <div id="dropZone" class="drop-zone border-dashed border-3 border-primary rounded p-5 text-center position-relative">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                        <h4 class="text-primary">Drop files here</h4>
                                        <p class="text-muted mb-3">or click to browse</p>
                                        <input type="file" id="fileInput" name="file" class="d-none" accept="*/*">
                                        <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('fileInput').click()">
                                            <i class="fas fa-folder-open me-2"></i>Browse Files
                                        </button>
                                    </div>
                                    <div id="fileInfo" class="mt-3 d-none">
                                        <div class="alert alert-info">
                                            <i class="fas fa-file me-2"></i>
                                            <span id="fileName"></span>
                                            <small class="text-muted d-block">Size: <span id="fileSize"></span></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Conversion Options -->
                                <div class="col-md-6 mb-4">
                                    <h5 class="text-dark mb-3">Conversion Settings</h5>
                                    
                                    <div class="mb-3">
                                        <label for="fromFormat" class="form-label">From Format</label>
                                        <select id="fromFormat" class="form-select" disabled>
                                            <option value="">Select a file first</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="toFormat" class="form-label">To Format</label>
                                        <select id="toFormat" class="form-select" disabled>
                                            <option value="">Select from format first</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="quality" class="form-label">Quality</label>
                                        <select id="quality" class="form-select">
                                            <option value="high">High Quality</option>
                                            <option value="medium" selected>Medium Quality</option>
                                            <option value="low">Low Quality (Smaller Size)</option>
                                        </select>
                                    </div>

                                    <button type="submit" id="convertBtn" class="btn btn-primary btn-lg w-100" disabled>
                                        <i class="fas fa-exchange-alt me-2"></i>Convert File
                                    </button>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div id="progressSection" class="mt-4 d-none">
                                <div class="progress mb-3" style="height: 20px;">
                                    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                                </div>
                                <p id="progressText" class="text-center text-muted">Preparing conversion...</p>
                            </div>

                            <!-- Result Section -->
                            <div id="resultSection" class="mt-4 d-none">
                                <div class="alert alert-success">
                                    <h5><i class="fas fa-check-circle me-2"></i>Conversion Complete!</h5>
                                    <p class="mb-0">Your file has been successfully converted.</p>
                                </div>
                                <div class="text-center">
                                    <a id="downloadBtn" href="#" class="btn btn-success btn-lg me-3">
                                        <i class="fas fa-download me-2"></i>Download File
                                    </a>
                                    <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                        Convert Another File
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Supported Formats Section -->
    <section class="formats-section mt-5">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="text-dark">Supported File Formats</h2>
                <p class="text-muted">We support conversion between various file formats</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                        <h5>Documents</h5>
                        <p class="text-muted small">PDF, DOCX, PPT, Excel, CSV, HTML</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-image fa-3x text-success mb-3"></i>
                        <h5>Images</h5>
                        <p class="text-muted small">JPG, PNG, SVG, WebP, GIF, BMP</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-music fa-3x text-warning mb-3"></i>
                        <h5>Audio</h5>
                        <p class="text-muted small">MP3, WAV, AAC, OGG, FLAC</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-video fa-3x text-info mb-3"></i>
                        <h5>Video</h5>
                        <p class="text-muted small">MP4, WebM, AVI, MOV, MKV</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section mt-5">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="text-dark">Why Choose Our Converter?</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h5>Secure & Private</h5>
                    <p class="text-muted">Your files are automatically deleted after conversion for maximum privacy.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <i class="fas fa-bolt fa-3x text-primary mb-3"></i>
                    <h5>Fast Processing</h5>
                    <p class="text-muted">Cloud-based processing ensures quick and efficient file conversions.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <i class="fas fa-mobile-alt fa-3x text-primary mb-3"></i>
                    <h5>Mobile Friendly</h5>
                    <p class="text-muted">Works perfectly on all devices - desktop, tablet, and mobile.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
