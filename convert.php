<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

header('Content-Type: application/json');

// Optimize PHP settings for faster processing
set_time_limit(120); // 2 minutes max
ini_set('memory_limit', '512M'); // Increased memory for large files
ini_set('max_execution_time', 120);
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');

$response = ['success' => false, 'message' => '', 'downloadUrl' => ''];

try {
    // Check if file was uploaded
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('No file uploaded or upload error occurred');
    }

    // Check required parameters
    if (!isset($_POST['fromFormat']) || !isset($_POST['toFormat'])) {
        throw new Exception('Missing conversion parameters');
    }

    $file = $_FILES['file'];
    $fromFormat = strtolower(trim($_POST['fromFormat']));
    $toFormat = strtolower(trim($_POST['toFormat']));
    $quality = $_POST['quality'] ?? 'medium';

    // Validate file size (100MB limit)
    $maxSize = 100 * 1024 * 1024; // 100MB
    if ($file['size'] > $maxSize) {
        throw new Exception('File size exceeds 100MB limit');
    }

    // Validate file extension
    $originalExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if ($originalExtension !== $fromFormat) {
        throw new Exception('File extension does not match selected format');
    }

    // Generate unique filename
    $uniqueId = uniqid('conv_', true);
    $uploadPath = UPLOAD_DIR . $uniqueId . '.' . $originalExtension;
    $convertedPath = CONVERTED_DIR . $uniqueId . '.' . $toFormat;

    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        throw new Exception('Failed to save uploaded file');
    }

    // Perform conversion based on file types
    $conversionResult = performConversion($uploadPath, $convertedPath, $fromFormat, $toFormat, $quality);
    
    if (!$conversionResult) {
        // Clean up uploaded file
        unlink($uploadPath);
        throw new Exception('File conversion failed');
    }

    // Clean up original uploaded file
    unlink($uploadPath);

    // Schedule file deletion
    scheduleFileDeletion($convertedPath);

    $response['success'] = true;
    $response['message'] = 'File converted successfully';
    $response['downloadUrl'] = 'download.php?file=' . urlencode(basename($convertedPath));

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    
    // Clean up files if they exist
    if (isset($uploadPath) && file_exists($uploadPath)) {
        unlink($uploadPath);
    }
    if (isset($convertedPath) && file_exists($convertedPath)) {
        unlink($convertedPath);
    }
}

echo json_encode($response);

function performConversion($inputPath, $outputPath, $fromFormat, $toFormat, $quality) {
    // Image conversions
    if (in_array($fromFormat, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']) && 
        in_array($toFormat, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
        return convertImage($inputPath, $outputPath, $fromFormat, $toFormat, $quality);
    }
    
    // PDF to image conversion
    if ($fromFormat === 'pdf' && in_array($toFormat, ['jpg', 'jpeg', 'png'])) {
        return convertPdfToImage($inputPath, $outputPath, $toFormat, $quality);
    }
    
    // Document conversions (basic text-based)
    if (in_array($fromFormat, ['txt', 'csv']) && in_array($toFormat, ['txt', 'csv', 'html'])) {
        return convertDocument($inputPath, $outputPath, $fromFormat, $toFormat);
    }
    
    // HTML to PDF (basic)
    if ($fromFormat === 'html' && $toFormat === 'pdf') {
        return convertHtmlToPdf($inputPath, $outputPath);
    }
    
    // Audio conversions (if ffmpeg is available)
    if (in_array($fromFormat, ['mp3', 'wav', 'ogg', 'aac']) && 
        in_array($toFormat, ['mp3', 'wav', 'ogg', 'aac'])) {
        return convertAudio($inputPath, $outputPath, $fromFormat, $toFormat, $quality);
    }
    
    // Video conversions (if ffmpeg is available)
    if (in_array($fromFormat, ['mp4', 'avi', 'webm', 'mov', 'mkv']) && 
        in_array($toFormat, ['mp4', 'avi', 'webm', 'mov'])) {
        return convertVideo($inputPath, $outputPath, $fromFormat, $toFormat, $quality);
    }
    
    return false;
}

function convertImage($inputPath, $outputPath, $fromFormat, $toFormat, $quality) {
    // Create image resource from input
    switch ($fromFormat) {
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($inputPath);
            break;
        case 'png':
            $image = imagecreatefrompng($inputPath);
            break;
        case 'gif':
            $image = imagecreatefromgif($inputPath);
            break;
        case 'bmp':
            $image = imagecreatefrombmp($inputPath);
            break;
        case 'webp':
            $image = imagecreatefromwebp($inputPath);
            break;
        default:
            return false;
    }
    
    if (!$image) {
        return false;
    }
    
    // Set quality level - optimized for no quality loss
    $qualityValue = 95; // default high quality
    switch ($quality) {
        case 'high':
            $qualityValue = 100; // Maximum quality
            break;
        case 'medium':
            $qualityValue = 95; // Very high quality
            break;
        case 'low':
            $qualityValue = 85; // Good quality
            break;
    }
    
    // Save image in target format
    $result = false;
    switch ($toFormat) {
        case 'jpg':
        case 'jpeg':
            $result = imagejpeg($image, $outputPath, $qualityValue);
            break;
        case 'png':
            // PNG quality is 0-9, convert from 0-100
            $pngQuality = (int)((100 - $qualityValue) / 10);
            $result = imagepng($image, $outputPath, $pngQuality);
            break;
        case 'gif':
            $result = imagegif($image, $outputPath);
            break;
        case 'bmp':
            $result = imagebmp($image, $outputPath);
            break;
        case 'webp':
            $result = imagewebp($image, $outputPath, $qualityValue);
            break;
    }
    
    imagedestroy($image);
    return $result;
}

function convertDocument($inputPath, $outputPath, $fromFormat, $toFormat) {
    $content = file_get_contents($inputPath);
    if ($content === false) {
        return false;
    }
    
    switch ($toFormat) {
        case 'txt':
            return file_put_contents($outputPath, strip_tags($content)) !== false;
        case 'html':
            if ($fromFormat === 'csv') {
                return csvToHtml($content, $outputPath);
            } else {
                $htmlContent = "<html><body><pre>" . htmlspecialchars($content) . "</pre></body></html>";
                return file_put_contents($outputPath, $htmlContent) !== false;
            }
        case 'csv':
            if ($fromFormat === 'txt') {
                // Simple conversion: each line becomes a CSV row
                $lines = explode("\n", $content);
                $csvContent = '';
                foreach ($lines as $line) {
                    $csvContent .= '"' . str_replace('"', '""', trim($line)) . '"' . "\n";
                }
                return file_put_contents($outputPath, $csvContent) !== false;
            }
            break;
    }
    
    return false;
}

function csvToHtml($csvContent, $outputPath) {
    $lines = explode("\n", trim($csvContent));
    $html = "<html><head><title>CSV Data</title><style>table{border-collapse:collapse;width:100%;}th,td{border:1px solid #ddd;padding:8px;text-align:left;}th{background-color:#f2f2f2;}</style></head><body><table>";
    
    $isFirstRow = true;
    foreach ($lines as $line) {
        if (empty(trim($line))) continue;
        
        $cells = str_getcsv($line);
        $html .= "<tr>";
        
        foreach ($cells as $cell) {
            $tag = $isFirstRow ? 'th' : 'td';
            $html .= "<{$tag}>" . htmlspecialchars($cell) . "</{$tag}>";
        }
        
        $html .= "</tr>";
        $isFirstRow = false;
    }
    
    $html .= "</table></body></html>";
    return file_put_contents($outputPath, $html) !== false;
}

function convertHtmlToPdf($inputPath, $outputPath) {
    // This is a basic implementation - in production, you'd want to use a proper library like wkhtmltopdf or TCPDF
    $htmlContent = file_get_contents($inputPath);
    if ($htmlContent === false) {
        return false;
    }
    
    // Very basic PDF creation (this is just a placeholder)
    // In a real implementation, you'd use a library like TCPDF, FPDF, or wkhtmltopdf
    $pdfContent = "%PDF-1.4\n1 0 obj\n<<\n/Type /Catalog\n/Pages 2 0 R\n>>\nendobj\n\n";
    $pdfContent .= "2 0 obj\n<<\n/Type /Pages\n/Kids [3 0 R]\n/Count 1\n>>\nendobj\n\n";
    $pdfContent .= "3 0 obj\n<<\n/Type /Page\n/Parent 2 0 R\n/MediaBox [0 0 612 792]\n>>\nendobj\n\n";
    $pdfContent .= "xref\n0 4\n0000000000 65535 f \n0000000009 00000 n \n0000000058 00000 n \n0000000115 00000 n \n";
    $pdfContent .= "trailer\n<<\n/Size 4\n/Root 1 0 R\n>>\nstartxref\n174\n%%EOF";
    
    return file_put_contents($outputPath, $pdfContent) !== false;
}

function convertAudio($inputPath, $outputPath, $fromFormat, $toFormat, $quality) {
    // Check if ffmpeg is available
    $ffmpegPath = exec('which ffmpeg 2>/dev/null');
    if (empty($ffmpegPath)) {
        return false; // ffmpeg not available
    }
    
    // Set quality parameters
    $qualityParams = '';
    switch ($quality) {
        case 'high':
            $qualityParams = '-b:a 320k';
            break;
        case 'medium':
            $qualityParams = '-b:a 192k';
            break;
        case 'low':
            $qualityParams = '-b:a 128k';
            break;
    }
    
    $command = escapeshellcmd("ffmpeg -i " . escapeshellarg($inputPath) . " " . $qualityParams . " " . escapeshellarg($outputPath) . " 2>&1");
    $output = [];
    $returnVar = 0;
    
    exec($command, $output, $returnVar);
    
    return $returnVar === 0 && file_exists($outputPath);
}

function convertVideo($inputPath, $outputPath, $fromFormat, $toFormat, $quality) {
    // Check if ffmpeg is available
    $ffmpegPath = exec('which ffmpeg 2>/dev/null');
    if (empty($ffmpegPath)) {
        return false; // ffmpeg not available
    }
    
    // Set quality parameters
    $qualityParams = '';
    switch ($quality) {
        case 'high':
            $qualityParams = '-crf 18';
            break;
        case 'medium':
            $qualityParams = '-crf 23';
            break;
        case 'low':
            $qualityParams = '-crf 28';
            break;
    }
    
    $command = escapeshellcmd("ffmpeg -i " . escapeshellarg($inputPath) . " " . $qualityParams . " -c:v libx264 -c:a aac " . escapeshellarg($outputPath) . " 2>&1");
    $output = [];
    $returnVar = 0;
    
    exec($command, $output, $returnVar);
    
    return $returnVar === 0 && file_exists($outputPath);
}

function convertPdfToImage($inputPath, $outputPath, $toFormat, $quality) {
    // Check if ImageMagick is available
    $convertPath = exec('which convert 2>/dev/null');
    if (empty($convertPath)) {
        return false; // ImageMagick not available
    }
    
    // Set quality parameters - optimized for no quality loss
    $qualityValue = 95;
    switch ($quality) {
        case 'high':
            $qualityValue = 100;
            break;
        case 'medium':
            $qualityValue = 95;
            break;
        case 'low':
            $qualityValue = 85;
            break;
    }
    
    $command = escapeshellcmd("convert -density 150 " . escapeshellarg($inputPath . "[0]") . " -quality " . $qualityValue . " " . escapeshellarg($outputPath) . " 2>&1");
    $output = [];
    $returnVar = 0;
    
    exec($command, $output, $returnVar);
    
    return $returnVar === 0 && file_exists($outputPath);
}
?>
