<!DOCTYPE html>
<html lang="en" class="dark transition-all duration-300">
<head>
  <meta charset="UTF-8">
  <title>Auth Page with Gradient Cursor</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class' }
  </script>
</head>
<body class="min-h-screen bg-gray-900 transition-all duration-300 relative overflow-hidden">

  <!-- Top Navbar -->
  <header class="bg-[#2c2f48] px-6 py-4 shadow-md flex justify-between items-center sticky top-0 z-50">
    <div class="text-xl font-bold text-white p-6"></div>
    <nav>
      <ul class="flex gap-6 text-sm font-medium text-white">
        <li>
          <a href="AAindex.php"
             class=" bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 text-xl rounded-lg font-semibold transition">
            Back
          </a>
        </li>
      </ul>
    </nav>
  </header>

  <!-- Gradient Cursor Orb -->
  <div id="cursor-orb"></div>

  <!-- Auth Form -->
  <div class="flex justify-center items-center min-h-[calc(100vh-80px)] px-4">
    <div class="w-full max-w-md p-10 rounded-3xl bg-gray-900/70 border border-white/20 shadow-2xl backdrop-blur-md transition-all duration-300 space-y-6 z-20">

      <h2 class="text-3xl font-bold text-center text-white" id="form-title">Login</h2>

      <form id="auth-form" class="space-y-5">
        <input type="hidden" name="auth_type" id="auth_type" value="login">

        <div id="name-field" class="hidden">
          <label class="block text-sm font-semibold text-gray-300">Full Name</label>
          <input type="text" name="name" placeholder="John Doe"
            class="input-field w-full p-3 border border-gray-600 bg-gray-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-300">Email</label>
          <input type="email" name="email" required placeholder="you@example.com"
            class="input-field w-full p-3 border border-gray-600 bg-gray-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <label class="block text-sm font-semibold text-gray-300">Password</label>

        <div>
          <input type="password" name="password" id="password" required placeholder="••••••••"
            class="input-field w-full p-3 border border-gray-600 bg-gray-800 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <button type="submit"
          class="w-full bg-gradient-to-tr from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white py-3 rounded-xl font-semibold shadow-md hover:shadow-xl transition duration-300 transform hover:scale-[1.02]">
          Submit
        </button>
      </form>

      <p class="text-center text-sm text-gray-300">
        <span id="toggle-text">Don't have an account?</span>
        <a href="#" id="toggle-form" class="text-indigo-400 font-semibold hover:underline">Sign up</a>
      </p>

      <!-- Notification -->
      <div id="notification" class="hidden bg-red-600 text-white p-3 rounded-lg mt-4 text-center">
        <span id="notification-message">User not found! Please sign up.</span>
      </div>

      <!-- Success Notification -->
      <div id="success-notification" class="hidden bg-green-600 text-white p-3 rounded-lg mt-4 text-center">
        You have been registered! Redirecting to the home page...
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    const toggleLink = document.getElementById('toggle-form');
    const formTitle = document.getElementById('form-title');
    const authType = document.getElementById('auth_type');
    const nameField = document.getElementById('name-field');
    const toggleText = document.getElementById('toggle-text');
    const authForm = document.getElementById('auth-form');
    const notification = document.getElementById('notification');
    const successNotification = document.getElementById('success-notification');
    const notificationMessage = document.getElementById('notification-message');

    let users = JSON.parse(localStorage.getItem('users')) || []; // Retrieve users from localStorage

    toggleLink.addEventListener('click', (e) => {
      e.preventDefault();
      const isLogin = authType.value === 'login';
      authType.value = isLogin ? 'signup' : 'login';
      formTitle.innerText = isLogin ? 'Sign Up' : 'Login';
      toggleText.innerText = isLogin ? 'Already have an account?' : "Don't have an account?";
      toggleLink.innerText = isLogin ? 'Login' : 'Sign up';
      nameField.classList.toggle('hidden');
    });

    authForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const formData = new FormData(authForm);
      const authTypeValue = formData.get('auth_type');

      if (authTypeValue === 'login') {
        // Simulate login logic
        const email = formData.get('email');
        const password = formData.get('password');

        const user = users.find(u => u.email === email && u.password === password);

        if (!user) {
          // Show warning notification if user not found
          notification.classList.remove('hidden');
          setTimeout(() => {
            notification.classList.add('hidden');
          }, 3000); // Hide after 3 seconds
        } else {
          window.location.href = 'AAindex.php'; // Redirect to home page after successful login
        }
      } else if (authTypeValue === 'signup') {
        // Simulate signup logic
        const name = formData.get('name');
        const email = formData.get('email');
        const password = formData.get('password');

        // Check if the email already exists
        const existingUser = users.find(u => u.email === email);

        if (existingUser) {
          // User already exists, alert to login
          notificationMessage.textContent = "This email is already registered. Please login.";
          notification.classList.remove('hidden');
          setTimeout(() => {
            notification.classList.add('hidden');
          }, 3000); // Hide after 3 seconds
        } else {
          // Add the new user to the users array
          const newUser = { name, email, password };
          users.push(newUser);

          // Save users to localStorage
          localStorage.setItem('users', JSON.stringify(users));

          // Show success notification and redirect after a delay
          successNotification.classList.remove('hidden');
          setTimeout(() => {
            window.location.href = 'AAindex.php'; // Redirect to home page after registration
          }, 3000); // Wait for 3 seconds before redirecting
        }
      }
    });

    const orb = document.getElementById('cursor-orb');
    document.addEventListener('mousemove', e => {
      orb.style.transform = `translate(${e.clientX}px, ${e.clientY}px)`;
    });

    const passwordField = document.getElementById('password');
    passwordField.addEventListener('focus', () => {
      orb.classList.add("focused");
    });
    passwordField.addEventListener('blur', () => {
      orb.classList.remove("focused");
    });

    const inputs = document.querySelectorAll('.input-field');
    inputs.forEach(input => {
      input.addEventListener('mouseenter', () => {
        orb.classList.add('hidden');
      });
      input.addEventListener('mouseleave', () => {
        orb.classList.remove('hidden');
      });
    });
  </script>
</body>
</html>
