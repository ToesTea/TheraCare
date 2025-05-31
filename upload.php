<?php
require_once 'includes/gallery_functions.php';

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if a gallery was specified
if (!isset($_POST['gallery'])) {
    header('Location: gallery.php?error=no_gallery');
    exit;
}

$galleryName = $_POST['gallery'];
$targetDir = "Site/gallery-images/" . sanitizeFolderName($galleryName) . "/";

// Create directory if it doesn't exist
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Check if files were uploaded
if (isset($_FILES['images'])) {
    $files = $_FILES['images'];
    $uploadCount = 0;
    $errorCount = 0;
    
    // Allow certain file formats
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    
    // Loop through each uploaded file
    for ($i = 0; $i < count($files['name']); $i++) {
        $fileName = basename($files['name'][$i]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        
        if (in_array($fileType, $allowTypes)) {
            // Upload file to the server
            if (move_uploaded_file($files['tmp_name'][$i], $targetFilePath)) {
                $uploadCount++;
            } else {
                $errorCount++;
            }
        } else {
            $errorCount++;
        }
    }
    
    if ($uploadCount > 0) {
        if ($errorCount > 0) {
            header("Location: gallery.php?success=partial&uploaded={$uploadCount}&failed={$errorCount}");
        } else {
            header("Location: gallery.php?success=full&uploaded={$uploadCount}");
        }
    } else {
        header('Location: gallery.php?error=upload_failed');
    }
} else {
    header('Location: gallery.php?error=no_files');
}
exit;
?> 