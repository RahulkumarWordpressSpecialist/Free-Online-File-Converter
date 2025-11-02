<?php
require_once 'includes/config.php';

// Get the requested file
$filename = $_GET['file'] ?? '';

if (empty($filename)) {
    http_response_code(400);
    die('No file specified');
}

// Sanitize filename to prevent directory traversal
$filename = basename($filename);
$filePath = CONVERTED_DIR . $filename;

// Check if file exists
if (!file_exists($filePath)) {
    http_response_code(404);
    die('File not found or has expired');
}

// Get file information
$fileSize = filesize($filePath);
$fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

// Set appropriate content type
$contentTypes = [
    'pdf' => 'application/pdf',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'xls' => 'application/vnd.ms-excel',
    'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'ppt' => 'application/vnd.ms-powerpoint',
    'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    'txt' => 'text/plain',
    'csv' => 'text/csv',
    'html' => 'text/html',
    'htm' => 'text/html',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
    'bmp' => 'image/bmp',
    'webp' => 'image/webp',
    'svg' => 'image/svg+xml',
    'mp3' => 'audio/mpeg',
    'wav' => 'audio/wav',
    'ogg' => 'audio/ogg',
    'aac' => 'audio/aac',
    'mp4' => 'video/mp4',
    'avi' => 'video/x-msvideo',
    'webm' => 'video/webm',
    'mov' => 'video/quicktime',
    'mkv' => 'video/x-matroska',
    'zip' => 'application/zip',
    'rar' => 'application/x-rar-compressed'
];

$contentType = $contentTypes[$fileExtension] ?? 'application/octet-stream';

// Generate download filename
$downloadName = 'converted_' . date('Y-m-d_H-i-s') . '.' . $fileExtension;

// Set headers for file download
header('Content-Type: ' . $contentType);
header('Content-Disposition: attachment; filename="' . $downloadName . '"');
header('Content-Length: ' . $fileSize);
header('Cache-Control: no-cache, must-revalidate');
header('Expires: 0');
header('Pragma: public');

// Prevent execution timeout for large files
set_time_limit(0);

// Output file in chunks to handle large files
$chunkSize = 8192; // 8KB chunks
$handle = fopen($filePath, 'rb');

if ($handle === false) {
    http_response_code(500);
    die('Error reading file');
}

while (!feof($handle)) {
    echo fread($handle, $chunkSize);
    flush();
}

fclose($handle);

// Schedule file for deletion after download
// Add a small delay to ensure download completes
ignore_user_abort(true);
sleep(1);

// Delete the file
if (file_exists($filePath)) {
    unlink($filePath);
}

exit;
?>
