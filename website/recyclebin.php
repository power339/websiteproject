<?php
require 'db.php';

// Handle restore actions
if (isset($_GET['restore_file'])) {
  $id = (int)$_GET['restore_file'];
  $conn->query("UPDATE files SET deleted_at = NULL WHERE id = $id");
  header("Location: recyclebin.php");
  exit();
}

// Handle permanent delete actions
$passcode = "1234"; // Shared team passcode
$deleteError = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['permanent_delete'])) {
  $id = (int)$_POST['id'];
  $type = $_POST['type'];
  $enteredPasscode = $_POST['passcode'];

  if ($enteredPasscode === $passcode) {
    if ($type === 'file') {
      $conn->query("DELETE FROM files WHERE id = $id");
    }
    header("Location: recyclebin.php");
    exit();
  } else {
    $deleteError = "Incorrect passcode!";
  }
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <title>Recycle Bin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
  .glitch-cursor {
    position: fixed;
    width: 100px;
    height: 100px;
    pointer-events: none;
    background: radial-gradient(circle, #0ff 10%, transparent 40%), 
                radial-gradient(circle, #f0f 10%, transparent 60%);
    mix-blend-mode: difference;
    border-radius: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.2s ease-out;
    z-index: 50;
    animation: glitch-flicker 0.4s infinite;
  }

  @keyframes glitch-flicker {
    0%, 100% { filter: blur(0.5px) brightness(1.2); }
    50% { filter: blur(1px) brightness(2); }
  }
</style>
</head>
<body class="bg-gray-900 text-white min-h-screen p-6 relative overflow-hidden">
  <div id="glitch-background" class="pointer-events-none fixed inset-0 z-0">
    <div></div>
  </div>

  <header class="flex items-center justify-between mb-8 relative z-10">
    <h1 class="text-3xl font-bold">🗑️ Recycle Bin</h1>
    <a href="dashboard.php" class="bg-primary px-4 py-2 rounded bg-indigo-600 hover:bg-indigo-700 transition">← Back </a>
  </header>

  <?php if ($deleteError): ?>
    <div class="mb-4 p-4 bg-red-600 text-white rounded relative z-10">❌ <?= $deleteError ?></div>
  <?php endif; ?>

  <div class="relative z-10">
    <!-- Deleted Files -->
    <div class="bg-gray-800 p-6 rounded-xl">
      <h2 class="text-xl font-semibold mb-4">Deleted Files</h2>
      <ul class="space-y-4">
        <?php
        $files = $conn->query("SELECT * FROM files WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC");
        while ($file = $files->fetch_assoc()):
        ?>
          <li class="bg-gray-700 p-4 rounded-lg">
            <p class="font-medium"><?= htmlspecialchars($file['filename']) ?> (<?= round($file['size'] / 1024, 2) ?> KB)</p>
            <p class="text-sm text-gray-400 mb-2">Deleted on <?= date("M j, Y", strtotime($file['deleted_at'])) ?></p>
            <div class="flex gap-2">
              <a href="?restore_file=<?= $file['id'] ?>" class="bg-green-600 hover:bg-green-700 px-3 py-1 rounded text-sm">Restore</a>
              <button onclick="showPasscodeModal('<?= $file['id'] ?>', 'file')" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm">Delete Forever</button>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>

  <!-- Modal -->
  <div id="passcodeModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
    <form method="POST" class="bg-gray-800 p-6 rounded-lg shadow-lg space-y-4 w-96">
      <h3 class="text-lg font-bold">Enter Passcode to Delete Permanently</h3>
      <input type="password" name="passcode" placeholder="Team passcode..." required class="w-full p-2 rounded bg-gray-700 text-white">
      <input type="hidden" name="id" id="modal-id">
      <input type="hidden" name="type" id="modal-type">
      <button type="submit" name="permanent_delete" class="bg-red-600 hover:bg-red-700 w-full py-2 rounded">Confirm Delete</button>
      <button type="button" onclick="hidePasscodeModal()" class="w-full py-2 rounded bg-gray-600 hover:bg-gray-500">Cancel</button>
    </form>
  </div>

  <script>
    function showPasscodeModal(id, type) {
      document.getElementById('modal-id').value = id;
      document.getElementById('modal-type').value = type;
      document.getElementById('passcodeModal').classList.remove('hidden');
    }
    function hidePasscodeModal() {
      document.getElementById('passcodeModal').classList.add('hidden');
    }

    const glitch = document.getElementById('glitch-background').querySelector('div');
    document.addEventListener('mousemove', (e) => {
      const target = e.target;
      const glitchable = ['P', 'H1', 'H2', 'H3', 'BUTTON', 'A', 'INPUT', 'TEXTAREA', 'LABEL'];
      if (glitchable.includes(target.tagName)) {
        glitch.style.left = `${e.clientX}px`;
        glitch.style.top = `${e.clientY}px`;
        glitch.style.opacity = '0.6';
        glitch.style.animation = 'cyber-glitch 0.3s ease-in-out';
      } else {
        glitch.style.opacity = '0';
        glitch.style.animation = 'none';
      }
    });
  </script>
</body>
</html>