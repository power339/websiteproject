<?php
session_start();
$conn = new mysqli("localhost", "root", "", "auth_system");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Email already registered. Please log in.";
    } else {
        // Insert the new user
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        if ($stmt->execute()) {
            $success = "You have successfully registered! Redirecting...";
            header("refresh:3;url=AAindex.php");
        } else {
            $error = "Error during registration.";
        }
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" class="dark transition-all duration-300">
<head>
  <meta charset="UTF-8">
  <title>Signup Page</title>
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
      <a href="AAindex.php" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold transition">
        Back
      </a>
    </nav>
  </header>

  <!-- Signup Form -->
  <div class="flex justify-center items-center min-h-screen px-4">
    <div class="w-full max-w-md p-10 rounded-3xl bg-white shadow-2xl space-y-6">
      <h2 class="text-3xl font-bold text-center text-indigo-600">Sign Up</h2>

      <?php if (!empty($error)) : ?>
        <div class="bg-red-600 text-white p-3 rounded-lg text-center">
          <?= $error ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($success)) : ?>
        <div class="bg-green-600 text-white p-3 rounded-lg text-center">
          <?= $success ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-4">
          <label class="block text-sm font-semibold text-black">Full Name</label>
          <input type="text" name="name" required
            class="w-full p-3 border border-gray-600 bg-gray-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

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
          Sign up
        </button>
      </form>

      <p class="text-center text-sm text-gray-700">
        Already have an account?
        <a href="login1.php" class="text-indigo-400 font-semibold hover:underline">Log in</a>
      </p>
    </div>
  </div>
</body>
</html>
