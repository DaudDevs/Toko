<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - TokoKita</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet"/>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .glass {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .glow-btn:hover {
      box-shadow: 0 0 10px rgba(255,255,255,0.3), 0 0 20px rgba(99,102,241,0.5);
    }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-600 via-purple-700 to-pink-600 flex items-center justify-center px-4">

  <div class="w-full max-w-md p-8 rounded-2xl glass text-white shadow-2xl" data-aos="zoom-in">
    <h2 class="text-3xl font-bold mb-6 text-center">Masuk ke <span class="text-yellow-300">TokoKita</span></h2>

    {{-- Pesan error --}}
    @if ($errors->any())
      <div class="bg-red-500 text-white text-sm p-3 rounded mb-4">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
      @csrf

      <div>
        <label for="email" class="block mb-1 text-sm font-medium">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-300">
      </div>

      <div class="relative">
        <label for="password" class="block mb-1 text-sm font-medium">Kata Sandi</label>
        <input type="password" id="password" name="password" required
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-300">
        <button type="button" onclick="togglePassword()" class="absolute right-3 top-9 text-white">
          <i id="eyeIcon" class="ph ph-eye text-xl"></i>
        </button>
      </div>

      <button type="submit"
        class="w-full py-3 rounded-lg bg-yellow-300 text-indigo-800 font-bold hover:bg-yellow-400 glow-btn transition-all duration-300">
        Masuk
      </button>
    </form>

    <p class="mt-6 text-sm text-center text-white/80">Belum punya akun?
      <a href="/register" class="text-yellow-300 hover:underline">Daftar di sini</a>
    </p>
  </div>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });

    function togglePassword() {
      const pass = document.getElementById('password');
      const icon = document.getElementById('eyeIcon');
      if (pass.type === 'password') {
        pass.type = 'text';
        icon.className = 'ph ph-eye-slash text-xl';
      } else {
        pass.type = 'password';
        icon.className = 'ph ph-eye text-xl';
      }
    }
  </script>
</body>
</html>
