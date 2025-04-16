<?php
session_start();
require 'db.php';

// Set email once
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['set_email'])) {
    $_SESSION['user_email'] = $_POST['set_email'];
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Post message or reply
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['message']) && isset($_SESSION['user_email'])) {
    $message = $_POST['message'];
    $email = $_SESSION['user_email'];
    $parent_id = $_POST['parent_id'] ?? null;

    $stmt = $conn->prepare("INSERT INTO discussions (email, message, parent_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $email, $message, $parent_id);
    $stmt->execute();
}

// Delete message
if (isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    $conn->query("DELETE FROM discussions WHERE id = $delete_id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch and organize messages
$results = $conn->query("SELECT * FROM discussions ORDER BY created_at ASC");
$posts = [];
while ($row = $results->fetch_assoc()) {
    $row['children'] = [];
    $posts[$row['id']] = $row;
}

$tree = [];
foreach ($posts as $id => &$post) {
    if ($post['parent_id']) {
        $posts[$post['parent_id']]['children'][] = &$post;
    } else {
        $tree[] = &$post;
    }
}
unset($post);
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <title>Discussion Forum</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans p-6">
  <div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-indigo-400">💬 Discussion Forum</h1>
      <a href="AAindex.php" class="text-sm font-semibold bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow transition">
        ← Back to Home
      </a>
    </div>

    <?php if (!isset($_SESSION['user_email'])): ?>
      <!-- Email Login Form -->
      <form method="POST" class="bg-gray-800 p-4 rounded-lg mb-8 shadow-lg">
        <label class="block mb-2 text-white font-medium">Enter your email to join the chat:</label>
        <input type="email" name="set_email" required placeholder="Your Email" class="w-full p-2 mb-3 bg-gray-700 border border-gray-600 rounded text-white">
        <button class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white font-semibold">Join</button>
      </form>
    <?php else: ?>
      <!-- Show Logged In User -->
      <p class="mb-4 text-green-400">Logged in as: <strong><?= htmlspecialchars($_SESSION['user_email']) ?></strong></p>

      <!-- New Thread Form -->
      <form method="POST" class="bg-gray-800 p-4 rounded-lg mb-8 shadow-lg">
        <textarea name="message" required placeholder="Start a new discussion..." class="w-full p-3 bg-gray-700 border border-gray-600 rounded mb-4 text-white"></textarea>
        <input type="hidden" name="parent_id" value="">
        <button class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white font-semibold">Post</button>
      </form>
    <?php endif; ?>

    <?php
    function displayPost($post, $level = 0) {
        ?>
        <div class="bg-gray-800 p-4 rounded-lg mb-4 shadow-lg <?= $level > 0 ? 'border-l-4 border-indigo-500 pl-4' : '' ?>">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-indigo-300 mb-1"><?= htmlspecialchars($post['email']) ?></p>
                    <p class="mb-2"><?= htmlspecialchars($post['message']) ?></p>
                    <small class="text-gray-400"><?= $post['created_at'] ?></small>
                </div>
                <form method="POST" onsubmit="return confirm('Delete this post?');">
                    <input type="hidden" name="delete_id" value="<?= $post['id'] ?>">
                    <button class="text-red-400 hover:text-red-600 ml-4 text-lg">🗑</button>
                </form>
            </div>

            <?php if (isset($_SESSION['user_email'])): ?>
                <form method="POST" class="mt-3">
                    <textarea name="message" placeholder="Reply..." required class="w-full p-2 bg-gray-700 border border-gray-600 rounded text-white mb-2"></textarea>
                    <input type="hidden" name="parent_id" value="<?= $post['id'] ?>">
                    <button class="bg-indigo-500 hover:bg-indigo-600 px-3 py-1 rounded text-sm">Reply</button>
                </form>
            <?php endif; ?>

            <?php foreach ($post['children'] as $child): ?>
                <?php displayPost($child, $level + 1); ?>
            <?php endforeach; ?>
        </div>
        <?php
    }

    foreach ($tree as $thread) {
        displayPost($thread);
    }
    ?>
  </div>
</body>
</html>
