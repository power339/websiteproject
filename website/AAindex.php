<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <title>PeerConnect - Collaborative Learning Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-[#1e1e2f] to-[#2a2a40] text-white">

  <!-- Navbar like dashboard.php -->
  <header class="bg-[#2c2f48] px-6 py-4 shadow-md flex justify-between items-center sticky top-0 z-50">
    <div class="text-xl font-bold text-white">PeerConnect</div>
    <nav>
      <ul class="flex gap-6 text-sm font-medium text-white">
        <li><a href="#" class="text-blue-400 font-semibold">Home</a></li>
        <li><a href="about.php" class="hover:text-indigo-300 transition">About</a></li>
        <li><a href="review.php" class="hover:text-indigo-300 transition">Review</a></li>
        <li><a href="discussion.php" class="hover:text-indigo-300 transition">Discussion Area</a></li>
        <li><a href="dashboard.php" class="hover:text-indigo-300 transition">Upload</a></li>
        <li id="auth-link">
          <!-- Login button will be here, and replaced by Logout if the user is logged in -->
        </li>
      </ul>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="relative text-center py-20 bg-cover bg-center" style="background-image: url('https://static.scientificamerican.com/sciam/cache/file/C3D6DFBB-92DD-43D0-A9F8CB9AB477F652_source.jpg?w=1200');">
    <div class="absolute inset-0 bg-black bg-opacity-70"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-6">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Collaborate, Learn, and Grow Together</h1>
      <p class="text-lg mb-6">PeerConnect is a platform designed to facilitate peer-to-peer learning and resource sharing among students.</p>
      <a href="login1.php" class="inline-block bg-indigo-600 hover:bg-indigo-800 text-white text-lg px-6 py-3 rounded-lg font-semibold">🚀 Get Started</a>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-20 px-6 max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold text-indigo-300 text-center mb-12">✨ Why Choose PeerConnect?</h2>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-[#1f1f2e] border border-indigo-500/30 p-6 rounded-xl shadow hover:shadow-xl transition">
        <h3 class="text-xl font-semibold text-indigo-400 mb-2">📚 Resource Sharing</h3>
        <p>Upload and download educational materials, notes, and resources shared by your peers to enhance your learning.</p>
      </div>
      <div class="bg-[#1f1f2e] border border-indigo-500/30 p-6 rounded-xl shadow hover:shadow-xl transition">
        <h3 class="text-xl font-semibold text-indigo-400 mb-2">🧠 Group Study</h3>
        <p>Form virtual study groups with classmates to collaborate on projects, discuss topics, and prepare for exams together.</p>
      </div>
      <div class="bg-[#1f1f2e] border border-indigo-500/30 p-6 rounded-xl shadow hover:shadow-xl transition">
        <h3 class="text-xl font-semibold text-indigo-400 mb-2">⭐ Peer Reviews</h3>
        <p>Get feedback on your work from fellow students and provide constructive reviews to help others improve.</p>
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <!-- <section id="about" class="bg-gray-900 py-16 px-6">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-3xl font-bold text-pink-400 mb-4">👥 About Us</h2>
      <p class="text-gray-300 text-lg">PeerConnect was founded with a mission to build a collaborative space where students can learn together, help each other, and succeed. We believe in the power of shared knowledge and peer support to achieve academic goals and personal growth.</p>
    </div>
  </section> -->

  <!-- Footer -->
  <footer class="bg-gradient-to-br from-indigo-700 via-indigo-800 to-indigo-900 text-white py-16 px-6">
    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-12">
      <div>
        <h3 class="text-2xl font-bold mb-4">PeerConnect 🚀</h3>
        <p class="text-sm text-indigo-200">Empowering students through collaboration and shared knowledge. Join us and grow together in a vibrant academic community.</p>
      </div>
      <div>
        <h4 class="text-xl font-semibold mb-4 text-pink-300">Quick Links</h4>
        <ul class="space-y-2 text-sm">
          <li><a href="about.php" class="hover:text-pink-400 transition">About</a></li>
          <li><a href="review.php" class="hover:text-pink-400 transition">Review</a></li>
          <li><a href="discussion.php" class="hover:text-pink-400 transition">Discussion</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-xl font-semibold mb-4 text-pink-300">Stay Connected</h4>
        <p class="text-sm text-indigo-200 mb-2">Follow us on social media to stay updated!</p>
        <div class="flex space-x-4">
          <a href="#" class="hover:text-pink-400">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22.46 6c-.77.35-1.6.59-2.46.7a4.28 4.28 0 001.88-2.36 8.62 8.62 0 01-2.7 1.03A4.26 4.26 0 0016.1 4c-2.38 0-4.3 1.92-4.3 4.3 0 .34.04.67.1.99-3.57-.18-6.73-1.89-8.84-4.48a4.3 4.3 0 00-.58 2.17c0 1.5.76 2.82 1.91 3.6a4.25 4.25 0 01-1.95-.54v.06c0 2.1 1.5 3.86 3.5 4.26a4.3 4.3 0 01-1.94.07 4.3 4.3 0 004.02 2.99A8.6 8.6 0 014 19.54 12.14 12.14 0 0010.29 21c7.55 0 11.68-6.26 11.68-11.68 0-.18-.01-.36-.02-.54A8.36 8.36 0 0024 6.54a8.6 8.6 0 01-2.54.7z"/>
            </svg>
          </a>
          <a href="#" class="hover:text-pink-400">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2.04c-5.5 0-9.96 4.46-9.96 9.96 0 4.4 2.85 8.14 6.79 9.45.5.1.68-.21.68-.47v-1.7c-2.76.6-3.35-1.33-3.35-1.33-.45-1.14-1.11-1.45-1.11-1.45-.9-.61.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.89 1.53 2.33 1.09 2.9.83.09-.65.35-1.1.64-1.35-2.21-.25-4.55-1.11-4.55-4.95 0-1.1.39-2 .1-2.7 0 0 .83-.27 2.73 1.02A9.42 9.42 0 0112 6.8c.85 0 1.7.11 2.5.32 1.9-1.29 2.73-1.02 2.73-1.02.29.7.1 1.6.1 2.7 0 3.85-2.34 4.7-4.57 4.95.36.3.69.91.69 1.84v2.72c0 .27.18.58.7.48A10 10 0 0022 12c0-5.5-4.46-9.96-10-9.96z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div class="text-center mt-10 text-sm text-indigo-300">© 2025 PeerConnect. Crafted with 💙 for learners everywhere.</div>
  </footer>

  <script>
    // Check if the user is logged in by checking localStorage
    function checkLoginStatus() {
      const isLoggedIn = localStorage.getItem('isLoggedIn');
      const authLink = document.getElementById('auth-link');

      if (isLoggedIn) {
        // User is logged in, show logout button
        authLink.innerHTML = '<a href="#" onclick="logout()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition">Logout</a>';
      } else {
        // User is not logged in, show login button
        authLink.innerHTML = '<a href="login1.php" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold transition">Login</a>';
      }
    }

    function logout() {
      // Remove user login status from localStorage
      localStorage.removeItem('isLoggedIn');
      // Redirect to home page or refresh
      window.location.reload();
    }

    // Initialize login status check on page load
    window.onload = checkLoginStatus;
  </script>

</body>
</html>
