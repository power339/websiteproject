<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <title>PeerConnect Discussion</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            outfit: ['Outfit', 'sans-serif'],  /* This font is added here */
          },
          colors: {
            primary: '#6366f1',
            secondary: '#ec4899',
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet"> <!-- Font link added here -->
</head>
<body class="bg-gray-900 text-white font-outfit h-screen flex flex-col"> <!-- font-outfit class applied here -->

  <!-- Navbar -->
  <header class="bg-[#2c2f48] px-6 py-4 shadow-md flex justify-between items-center sticky top-0 z-50">
    <div class="text-xl font-bold text-white">Peer Connections</div>
    <nav>
      <ul class="flex gap-6 text-md font-medium text-white">
        <li><a href="AAindex.php" class="hover:text-indigo-300 transition">Home</a></li>
        <li><a href="about.php" class="hover:text-indigo-300 transition">About</a></li>
        <li><a href="review.php" class="hover:text-indigo-300 transition">Review</a></li>
        <li><a href="discussion.php" class="text-blue-400 font-semibold">Discussion Area</a></li>
        <li><a href="dashboard.php" class="hover:text-indigo-300  transition">Upload</a></li>
        <li>
          <a href="login1.php"
             class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold transition">
            Login
          </a>
        </li>
      </ul>
    </nav>
  </header>

  <!-- Chat Container -->
  <main class="flex-1 flex flex-col p-4 max-w-4xl mx-auto w-full">
    
    <!-- Messages Area -->
    <div id="chat-box" class="flex-1 overflow-y-auto mb-4 p-4 bg-gray-800 rounded-xl space-y-4 shadow-inner">
      
      <!-- Message: User -->
      <div class="flex justify-end">
        <div class="flex items-start space-x-3">
          <div class="w-12 h-12 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xl">
            S
          </div>
          <div class="bg-primary text-white p-3 rounded-lg max-w-xs shadow-md">
            <p class="text-sm">Hey! Is anyone working on the assignment?</p>
            <p class="text-xs mt-1 text-gray-200 text-right">You • 10:32 AM</p>
          </div>
        </div>
      </div>

      <!-- Message: Other -->
      <div class="flex justify-start">
        <div class="flex items-start space-x-3">
          <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xl">
            A
          </div>
          <div class="bg-gray-700 text-white p-3 rounded-lg max-w-xs shadow-md">
            <p class="text-sm">Yep, I started last night. Got stuck on question 3 tho 😅</p>
            <p class="text-xs mt-1 text-gray-400">Alex • 10:34 AM</p>
          </div>
        </div>
      </div>

      <!-- More messages can be added dynamically -->
    </div>

    <!-- Input Area -->
    <form id="chat-form" class="flex gap-3">
      <input type="text" id="message-input" placeholder="Type your message..." class="flex-1 p-3 rounded-lg bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary"/>
      <button type="submit" class="bg-primary px-5 py-3 rounded-lg hover:bg-indigo-700 transition font-medium">Send 🚀</button>
    </form>

  </main>

  <!-- Scroll to bottom + Optional JS -->
  <script>
    const form = document.getElementById('chat-form');
    const chatBox = document.getElementById('chat-box');
    const input = document.getElementById('message-input');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const message = input.value.trim();
      if (!message) return;

      // Append message to chat box (simulate sending)
      const msgDiv = document.createElement('div');
      msgDiv.className = 'flex justify-end';
      msgDiv.innerHTML = ` 
        <div class="flex items-start space-x-3">
          <div class="w-12 h-12 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xl">
            U
          </div>
          <div class="bg-primary text-white p-3 rounded-lg max-w-xs shadow-md">
            <p class="text-sm">${message}</p>
            <p class="text-xs mt-1 text-gray-200 text-right">You • Just now</p>
          </div>
        </div>
      `;
      chatBox.appendChild(msgDiv);
      chatBox.scrollTop = chatBox.scrollHeight;
      input.value = '';
    });
  </script>

</body>
</html>
