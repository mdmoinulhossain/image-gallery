<?php
require "./DisplayImg.php";
$images = DisplayImg("./ImgFile");

if ($images === null) {
    echo "Image Not found!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image-gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-file-input {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .custom-file-input input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .custom-file-input label {
            background-color: #3d692c;
            color: #fff;
            padding: 13px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <main class="px-5 my-5">
        <form action="./uploadImg.php" method="post" enctype="multipart/form-data" class="border-b-2 border-purple-500 flex justify-between items-center gap-x-1 pb-2">
            <div>
                <?php
                if (isset($_GET['success'])) {
                    $imageToDelete = $_GET['success'];
                    echo "<h3 class='text-red-700 text-lg successMessage'>$imageToDelete</h3>";
                }
                ?>
            </div>
            <div>
                <strong class="text-purple-800">Select image to upload: </strong>
                <div class="custom-file-input cursor-pointer">
                    <input type="file" name="file-upload[]" id="fileToUpload" multiple>
                    <label for="fileToUpload">Choose File</label>
                </div>
                <input type="submit" value="Upload Image" name="submit" class="bg-purple-500 p-3 rounded-md text-white hover:bg-purple-600 cursor-pointer">
            </div>
        </form>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 my-10">
            <?php foreach ($images as $image) : ?>
                <div class="grid gap-4">
                    <div>
                        <a class="delete-btn" href="./delete.php?delete_image=<?php echo urlencode(basename($image)); ?>">Delete</a>
                        <img src=<?php echo $image; ?> alt="" class="h-auto max-w-full rounded-lg">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script>
            document.getElementById('fileToUpload').addEventListener('change', function() {
                var files = this.files;
                var fileList = document.querySelector('.custom-file-input label');

                // Display the number of files selected
                if (files.length === 1) {
                    fileList.innerText = '1 file selected';
                } else {
                    fileList.innerText = files.length + ' files selected';
                }
            });
        </script>

        <script src="./script.js"></script>
</body>

</html>