# Free Online File Converter Web Application

A complete PHP-based web application for converting files between multiple formats with drag & drop functionality.

## Features

- **Multi-format Support**: Convert between PDF, images (JPG, PNG, WebP, etc.), audio (MP3, WAV, AAC), video (MP4, WebM, AVI), and documents
- **Drag & Drop Interface**: Easy file upload with visual feedback
- **Secure Processing**: Files automatically deleted after conversion for privacy
- **Mobile Responsive**: Works on all devices
- **High Quality Conversion**: Optimized settings to maintain file quality
- **Complete Website**: Includes About, Contact, Privacy Policy, and Terms pages

## Installation

1. Upload all files to your web server
2. Ensure PHP 7.4+ is installed with GD extension enabled
3. Set write permissions for `uploads/` and `converted/` directories:
   ```bash
   chmod 755 uploads/
   chmod 755 converted/
   ```
4. For advanced conversions, install optional dependencies:
   - ImageMagick (for PDF to image conversion)
   - FFmpeg (for audio/video conversion)

## Server Requirements

- PHP 7.4 or higher
- GD extension (for image processing)
- Apache/Nginx web server
- 256MB+ RAM
- Write permissions for upload directories

## Optional Dependencies

- **ImageMagick**: For PDF to image conversion
- **FFmpeg**: For audio and video conversion
- **wkhtmltopdf**: For HTML to PDF conversion

## Configuration

Edit `includes/config.php` to customize:
- Site URL and name
- File size limits
- Supported formats
- Email settings

## Security Features

- File type validation
- Size limit enforcement
- Automatic file deletion
- Directory access protection
- CSRF protection
- Rate limiting

## Developer Information

**Developed by**: Rahul Kumar
**Email**: help@wp-fixhub.com
**Website**: https://rahulkumar.wp-fixhub.com
**Phone**: +91 9113451527
**Address**: At-Khedarpur, PO-Bahadurpur, Samastipur, Bihar 848114

## License

Free to use for personal and commercial projects.

## Support

For support and customization requests, contact: help@wp-fixhub.com
