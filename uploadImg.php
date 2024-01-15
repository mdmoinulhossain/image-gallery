<?php

// ******************** Multi File Upload ****************************
$uploadDirectory = './ImgFile/';

if (!empty($_FILES['file-upload']['tmp_name'][0])) {
    $files = $_FILES['file-upload'];

    // Loop through each file
    for ($i = 0; $i < count($files['name']); $i++) {
        $uploadedFile = $files['tmp_name'][$i];
        $originalFilename = $files['name'][$i];
        $currentDateTime = date("Y-m-d--H-i-s"); // For Unique name
        $destination = $uploadDirectory . $originalFilename . $currentDateTime;

        $typeAllowed = ['image/jpg', 'image/jpeg', 'image/png'];

        // Check Image file type
        if (!in_array($files['type'][$i], $typeAllowed)) {
            echo "Image $originalFilename must be in jpg, jpeg, png format!<br/>";
            continue; // Skip to the next iteration of the loop
        }

        // Check Image file Size (less than 1 mb)
        if ($files['size'][$i] > 1024 * 1024) {
            echo "Image $originalFilename must be less than 1 MB!<br/>";
            continue; // Skip to the next iteration of the loop
        }

        // Move the uploaded file
        if (move_uploaded_file($uploadedFile, $destination)) {
            echo "File $originalFilename uploaded successfully.<br/>";
        } else {
            echo "Error uploading file $originalFilename.<br/>";
        }
    }
} else {
    echo "No files were submitted. <br/> <a href='./index.php'> Back</a>";
}
