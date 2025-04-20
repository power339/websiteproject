<?php
session_start();
$conn = new mysqli("localhost", "root", "", "auth_system");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["user"] = $email;
            header("Location: AAindex.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" class="dark transition-all duration-300">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class' }
  </script>
</head>
<body class="min-h-screen bg-gray-900 transition-all duration-300">

  <!-- Navbar -->
  <header class="bg-[#2c2f48] px-6 py-4 flex justify-between items-center sticky top-0 z-50">
    <div class="text-xl font-bold text-white">PeerConnect</div>
    <nav>
      <a href="home.php" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold transition">
       <- Back to Home
      </a>
    </nav>
  </header>

  <!-- Login Form -->
  <div class="flex justify-center items-center min-h-screen px-4">
    <div class="w-full max-w-md p-10 rounded-3xl bg-white shadow-2xl space-y-6">
      <h2 class="text-3xl font-bold text-center text-indigo-600">Log in</h2>

      <?php if (!empty($error)) : ?>
        <div class="bg-red-600 text-white p-3 rounded-lg text-center">
          <?= $error ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-4">
          <label class="block text-sm font-semibold text-black">Email</label>
          <input type="email" name="email" required
            class="w-full p-3 border border-gray-600 bg-gray-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-6">
          <label class="block text-sm font-semibold text-black">Password</label>
          <input type="password" name="password" required
            class="w-full p-3 border border-gray-600 bg-gray-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <button type="submit"
          class="w-full bg-gradient-to-tr from-indigo-500 to-blue-600 text-white py-3 rounded-xl font-semibold hover:scale-105 transition">
          Log in
        </button>
      </form>

      <p class="text-center text-sm text-gray-700">
        Don't have an account?
        <a href="login.php" class="text-indigo-400 font-semibold hover:underline">Sign up</a>
      </p>
    </div>
  </div>
</body>
</html>
