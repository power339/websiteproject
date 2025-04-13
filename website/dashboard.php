<?php
require 'db.php';

// Handle file upload
if (isset($_FILES['file'])) {
    $filename = $_FILES['file']['name'];
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];

    $uploadDir = 'uploads/';
    $filePath = $uploadDir . basename($filename);

    if (move_uploaded_file($fileTmp, $filePath)) {
        $conn->query("INSERT INTO files (filename, size, path, uploaded_at) VALUES ('$filename', $fileSize, '$filePath', NOW())");
    }
}

// Handle soft delete
if (isset($_POST['delete'])) {
    $id = (int)$_POST['id'];
    $type = $_POST['type'];
    $table = $type === 'file' ? 'files' : 'posts';
    $conn->query("UPDATE $table SET deleted_at = NOW() WHERE id = $id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch files
$files = $conn->query("SELECT * FROM files WHERE deleted_at IS NULL ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <title>PeerConnect Files</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            primary: '#8b5cf6',
            danger: '#ef4444',
          },
          fontFamily: {
            outfit: ['Outfit', 'sans-serif'],
          },
          boxShadow: {
            glow: '0 0 20px #8b5cf6',
          }
        }
      }
    }
  </script>
</head>

<body class="bg-gradient-to-br from-gray-900 to-black text-white font-outfit">

  <!-- Navbar -->
  <header class="backdrop-blur-md bg-[#1f1f2e]/70 border-b border-indigo-500/20 px-6 py-4 shadow-lg flex justify-between items-center sticky top-0 z-50">
    <div class="text-2xl font-bold text-indigo-400">📁 PeerConnect</div>
    <nav>
      <ul class="flex gap-6 text-sm font-medium">
        <li><a href="AAindex.php" class="text-indigo-300 hover:text-white transition">Home</a></li>
        <li><a href="about.php" class="hover:text-indigo-300">About</a></li>
        <li><a href="review.php" class="hover:text-indigo-300">Review</a></li>
        <li><a href="discussion.php" class="hover:text-indigo-300">Discussion</a></li>
        <li><a href="dashboard.php" class="hover:text-indigo-300">Upload</a></li>
        <li><a href="login1.php" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg transition font-semibold">Login</a></li>
      </ul>
    </nav>
  </header>

  <!-- Upload Section -->
  <section class="w-full max-w-3xl mx-auto mt-16 mb-12 p-8 bg-white/5 border border-indigo-500/30 backdrop-blur-lg rounded-2xl shadow-glow relative overflow-hidden">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-3xl font-bold text-indigo-400">📤 Upload Your Files</h2>
      <a href="recyclebin.php" class="text-sm font-semibold bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow transition">🗑 Recycle Bin</a>
    </div>
    <form action="" method="POST" enctype="multipart/form-data" class="space-y-5">
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-300">Choose File</label>
        <input type="file" name="file" required class="w-full file:bg-indigo-600 file:text-white file:rounded file:px-4 file:py-2 bg-gray-900 text-white border border-gray-600 rounded-lg p-3 transition hover:file:bg-indigo-700" />
      </div>
      <button type="submit" class="w-full py-3 text-lg font-semibold bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-lg shadow-indigo-500/40 transition transform hover:scale-105">
        🚀 Upload Now
      </button>
    </form>
  </section>

  <!-- File List -->
  <section class="max-w-4xl mx-auto bg-white/5 backdrop-blur-lg border border-indigo-400/20 p-6 rounded-xl shadow-glow">
    <h2 class="text-2xl font-semibold text-indigo-300 mb-6">📁 Uploaded Files</h2>
    <ul class="space-y-4" id="file-list">
      <?php $count = 0; while ($file = $files->fetch_assoc()): $count++; $hidden = $count > 4 ? 'hidden' : ''; ?>
        <li class="bg-gray-800/80 border border-gray-600 p-4 rounded-lg file-item <?= $hidden ?> flex justify-between items-center shadow-md hover:shadow-indigo-600/40 transition">
          <div>
            <p class="font-medium"><?= htmlspecialchars($file['filename']) ?> (<?= round($file['size'] / 1024, 2) ?> KB)</p>
            <button class="text-indigo-400 underline download-btn" data-url="<?= $file['path'] ?>" data-name="<?= $file['filename'] ?>">Download</button>
          </div>
          <form method="POST">
            <input type="hidden" name="id" value="<?= $file['id'] ?>">
            <input type="hidden" name="type" value="file">
            <button name="delete" class="text-red-500 hover:text-red-700 text-xl">🗑</button>
          </form>
        </li>
      <?php endwhile; ?>
    </ul>
    <?php if ($count > 4): ?>
      <button id="viewMoreBtn" class="mt-6 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">⬇️ View More</button>
    <?php endif; ?>
  </section>

  <script>
    // View More
    const btn = document.getElementById('viewMoreBtn');
    if (btn) {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.file-item.hidden').forEach(el => el.classList.remove('hidden'));
        btn.style.display = 'none';
      });
    }

    // Download
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.download-btn').forEach(button => {
        button.addEventListener('click', async () => {
          const fileUrl = button.getAttribute('data-url');
          const fileName = button.getAttribute('data-name');
          try {
            const response = await fetch(fileUrl);
            if (!response.ok) throw new Error("File not found");

            const blob = await response.blob();
            const downloadLink = document.createElement('a');
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = fileName;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
          } catch (error) {
            alert("❌ Error downloading file: " + error.message);
          }
        });
      });
    });
  </script>

</body>
</html>