<?php
require_once 'includes/gallery_functions.php';

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gallery-name'])) {
    $galleryName = $_POST['gallery-name'];
    
    if (empty($galleryName)) {
        header('Location: gallery.php?error=empty_name');
        exit;
    }
    
    if (createGalleryFolder($galleryName)) {
        header('Location: gallery.php?success=gallery_created');
    } else {
        header('Location: gallery.php?error=creation_failed');
    }
} else {
    header('Location: gallery.php?error=invalid_request');
}
exit; 