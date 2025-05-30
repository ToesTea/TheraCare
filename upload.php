<?php
// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Directory where images will be stored
$targetDir = "gallery-images/";

// Create directory if it doesn't exist
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Check if a file was uploaded
if(isset($_FILES["image"])) {
    $file = $_FILES["image"];
    
    // Get file information
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
    // Allow certain file formats
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    
    if(in_array($fileType, $allowTypes)) {
        // Upload file to the server
        if(move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            header("Location: gallery.php?success=1");
            exit();
        } else {
            header("Location: gallery.php?error=upload");
            exit();
        }
    } else {
        header("Location: gallery.php?error=type");
        exit();
    }
} else {
    header("Location: gallery.php?error=nofile");
    exit();
}
?> 