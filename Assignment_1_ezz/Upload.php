<?php
$imageDirectory = 'uploads/';

// Function to save uploaded image and return its path
function saveImage($image) {
    global $imageDirectory;
    
    // Generate a unique filename for the image
    $imageName = uniqid() . '_' . basename($image['name']);
    $targetPath = $imageDirectory . $imageName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
        return $targetPath;
    } else {
        return false;
    }
}


?>