<?php

function DisplayImg($directory, array $exclude = array('.', '..'))
{
    $files = [];

    if (!is_dir($directory)) {
        return null;
    }

    if (!($openDirectory = opendir($directory))) {
        return null;
    }

    while (($readDirectory = readdir($openDirectory)) !== false) {
        // Remove '.' , '..' from directory
        if (in_array($readDirectory, $exclude)) {
            continue;
        }
        // Display files
        $files[] = $directory . '/' . $readDirectory;
    }

    closedir($openDirectory);

    // Check if the array is empty
    if (empty($files)) {
        return null;
    }

    return $files;
}
