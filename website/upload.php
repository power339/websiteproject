<?php
require 'db.php';

if ($_FILES['file']) {
    $file = $_FILES['file'];
    $filename = basename($file['name']);
    $tmpName = $file['tmp_name'];
    $size = $file['size'];
    $destination = __DIR__ . '/uploads/' . $filename;


    if (move_uploaded_file($tmpName, $destination)) {
        $stmt = $conn->prepare("INSERT INTO files (filename, size, path) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $filename, $size, $destination);
        $stmt->execute();
        header("Location: dashboard.php");
    } else {
        echo "Upload failed.";
    }
}
?>