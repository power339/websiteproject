<?php
require 'db.php';
$result = $conn->query("SELECT * FROM files ORDER BY uploaded_at DESC");
while ($row = $result->fetch_assoc()) {
  echo "
    <div class='bg-gray-700 p-4 rounded-lg mb-4'>
      <p class='font-medium'>{$row['filename']} ({$row['size']} bytes)</p>
      <a href='download.php?file={$row['id']}' class='text-blue-400 underline'>Download</a>
    </div>
  ";
}
?>
