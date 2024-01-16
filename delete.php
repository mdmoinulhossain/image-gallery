<?php
function deleteImage($imagePath)
{
    // Get the absolute path to the image directory
    $imageDir = __DIR__ . '/ImgFile/';

    // Combine the directory path and image file name
    $fullImagePath = $imageDir . $imagePath;

    // Check if the file exists before attempting to delete
    if (file_exists($fullImagePath)) {
        // Attempt to delete the file
        if (unlink($fullImagePath)) {
            $success = "Image deleted successfully.";
            header("location: ./index.php?success=$success");
        } else {
            echo "Unable to delete the image.";
        }
    } else {
        echo "Image not found.";
    }
}


// Check if the delete_image parameter is set in the URL
if (isset($_GET['delete_image'])) {
    // Get the image path from the URL parameter
    $imageToDelete = $_GET['delete_image'];

    // Call the deleteImage function with the image path
    deleteImage($imageToDelete);
}
