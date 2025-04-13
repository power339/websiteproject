<?php
require 'db.php';

// Fetch files
$files = $conn->query("SELECT * FROM files WHERE deleted_at IS NULL ORDER BY uploaded_at DESC");
$count = 0;

while ($file = $files->fetch_assoc()) {
    $count++;
    $hidden = $count > 4 ? 'hidden' : '';
    ?>
    <li class="bg-gray-700 p-4 rounded-lg file-item <?= $hidden ?> flex justify-between items-start">
      <div>
        <p class="font-medium"><?= $file['filename'] ?> (<?= round($file['size'] / 1024, 2) ?> KB)</p>
        <a href="download.php?file=<?= $file['id'] ?>" class="text-blue-400 underline">Download</a>
      </div>
      <form method="POST">
        <input type="hidden" name="id" value="<?= $file['id'] ?>">
        <input type="hidden" name="type" value="file">
        <button name="delete" class="ml-4 text-red-500 hover:text-red-700">🗑</button>
      </form>
    </li>
    <?php
}
?>
