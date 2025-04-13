<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <title>About - PeerConnect</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-[#1e1e2f] to-[#2a2a40] text-white">

  <!-- Header (dashboard-style navbar) -->
  <header class="bg-[#2c2f48] px-6 py-4 shadow-md flex items-center justify-between">
    <div class="text-xl font-bold text-white tracking-wide">PeerConnect</div>
    <nav>
      <ul class="flex space-x-6 text-sm font-medium">
        <li><a href="AAindex.php" class="hover:text-blue-400 transition">Home</a></li>
        <li><a href="about.php" class="text-blue-400 font-semibold">About</a></li>
        <li><a href="review.php" class="hover:text-blue-400 transition">Review</a></li>
        <li><a href="discussion.php" class="hover:text-blue-400 transition">Discussion Area</a></li>
        <li><a href="dashboard.php" class="hover:text-blue-400 transition">Upload</a></li>
        <li> 
          <a href="login1.php" class="bg-indigo-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md transition">
            Login
          </a>
        </li>
      </ul>
    </nav>
  </header>

  <!-- About Section -->
  <section class="py-20 px-6 max-w-5xl mx-auto text-center">
    <h1 class="text-3xl font-semibold mb-6"> About PeerConnect</h1>
    <p class="text-lg leading-relaxed text-gray-200">
      PeerConnect is a platform built to help students collaborate, share resources, and learn together. Whether you're looking to share your notes, collaborate on group projects, or find peer reviews for your work, PeerConnect is here to connect you with like-minded learners across the world.
      <br><br>
      We believe in the power of peer-to-peer learning and the importance of sharing knowledge. Our mission is to build a community where students can grow together, help each other succeed, and make learning a more interactive experience.
    </p>
    <div class="mt-10">
      <a href="AAindex.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-lg px-6 py-3 rounded transition">← Back to Home</a>
    </div>
  </section>

  <!-- Meet the Team Section -->
  <section class="bg-gray-800 py-12 px-6 text-center">
    <h2 class="text-2xl font-semibold mb-8">Meet the Team</h2>
    <div class="max-w-4xl mx-auto grid md:grid-cols-3 gap-6">
      <div class="bg-gray-700 p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold text-indigo-300 mb-4">Jane Doe</h3>
        <p class="text-gray-300 text-sm">Co-Founder & CEO - Passionate about transforming the way students learn and collaborate worldwide.</p>
      </div>
      <div class="bg-gray-700 p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold text-indigo-300 mb-4">John Smith</h3>
        <p class="text-gray-300 text-sm">Co-Founder & CTO - Innovating technologies to enhance learning experiences and facilitate global collaboration.</p>
      </div>
      <div class="bg-gray-700 p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold text-indigo-300 mb-4">Emily Davis</h3>
        <p class="text-gray-300 text-sm">Community Manager - Building a thriving community of learners and ensuring everyone’s voice is heard.</p>
      </div>
    </div>
  </section>

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
          <li><a href="AAindex.php" class="hover:text-pink-400 transition">Home</a></li>
          <li><a href="about.php" class="hover:text-pink-400 transition">About</a></li>
          <li><a href="review.php" class="hover:text-pink-400 transition">Review</a></li>
          <li><a href="discussion.php" class="hover:text-pink-400 transition">Discussion</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-xl font-semibold mb-4 text-pink-300">Stay Connected</h4>
        <p class="text-sm text-indigo-200 mb-2">Follow us on social media to stay updated!</p>
        <div class="flex space-x-4">
          <!-- Social Icons -->
          <a href="#" class="hover:text-pink-400">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22.46 6c-.77.35-1.6.59-2.46.7a4.28 4.28 0 001.88-2.36..."></path>
            </svg>
          </a>
          <a href="#" class="hover:text-pink-400">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2.04c-5.5 0-9.96 4.46-9.96 9.96..."></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div class="text-center mt-10 text-sm text-indigo-300">© 2025 PeerConnect. Crafted with 💙 for learners everywhere.</div>
  </footer>

</body>
</html>
