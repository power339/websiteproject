<?php
require 'db.php';

// Handle new post or reply
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['message'])) {
    $message = $_POST['message'];
    $parent_id = $_POST['parent_id'] ?? null;

    $stmt = $conn->prepare("INSERT INTO discussions (message, parent_id) VALUES (?, ?)");
    $stmt->bind_param("si", $message, $parent_id);
    $stmt->execute();
}

// Handle delete
if (isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    $conn->query("DELETE FROM discussions WHERE id = $delete_id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch all discussions
$threads = $conn->query("SELECT * FROM discussions ORDER BY created_at DESC");
$posts = [];
while ($row = $threads->fetch_assoc()) {
    $posts[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <title>PeerConnect Discussion</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans p-6">
  <div class="max-w-4xl mx-auto">
    <!-- Header with Back to Home -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-indigo-400">💬 Discussion Forum</h1>
      <a href="AAindex.php" class="text-sm font-semibold bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow transition">
        ← Back to Home
      </a>
    </div>

    <!-- New Thread Form -->
    <form method="POST" class="bg-gray-800 p-4 rounded-lg mb-8 shadow-lg">
      <textarea name="message" required placeholder="Start a new discussion..." class="w-full p-3 bg-gray-700 border border-gray-600 rounded mb-4 text-white"></textarea>
      <input type="hidden" name="parent_id" value="">
      <button class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white font-semibold">Post</button>
    </form>

    <!-- Display Threads -->
    <?php foreach ($posts as $post): ?>
      <?php if (!$post['parent_id']): ?>
        <div class="bg-gray-800 p-4 rounded-lg mb-4 shadow-lg">
          <div class="flex justify-between items-start">
            <div>
              <p class="mb-2"><?= htmlspecialchars($post['message']) ?></p>
              <small class="text-gray-400"><?= $post['created_at'] ?></small>
            </div>
            <!-- Delete button for the post -->
            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
              <input type="hidden" name="delete_id" value="<?= $post['id'] ?>">
              <button class="text-red-500 hover:text-red-700 ml-4 text-xl">Delete</button>
            </form>
          </div>

          <!-- Reply Form -->
          <form method="POST" class="mt-3">
            <textarea name="message" placeholder="Reply..." required class="w-full p-2 bg-gray-700 border border-gray-600 rounded text-white mb-2"></textarea>
            <input type="hidden" name="parent_id" value="<?= $post['id'] ?>">
            <button class="bg-indigo-500 hover:bg-indigo-600 px-3 py-1 rounded text-sm">Reply</button>
          </form>

          <!-- Replies -->
          <?php foreach ($posts as $reply): ?>
            <?php if ($reply['parent_id'] == $post['id']): ?>
              <div class="ml-4 mt-3 bg-gray-700 p-3 rounded flex justify-between">
                <div>
                  <p><?= htmlspecialchars($reply['message']) ?></p>
                  <small class="text-gray-400"><?= $reply['created_at'] ?></small>
                </div>
                <!-- Delete button for the reply -->
                <form method="POST" onsubmit="return confirm('Delete this reply?');">
                  <input type="hidden" name="delete_id" value="<?= $reply['id'] ?>">
                  <button class="text-red-400 hover:text-red-600 ml-4 text-lg">🗑</button>
                </form>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</body>
</html>
