<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - TokoKita</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet"/>
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

  <div class="w-full max-w-md p-8 rounded-2xl glass text-white shadow-2xl" data-aos="fade-up">
    <h2 class="text-3xl font-bold mb-6 text-center">Daftar di <span class="text-yellow-300">TokoKita</span></h2>

    @if ($errors->any())
      <div class="bg-red-500/20 text-red-300 p-3 rounded mb-4 text-sm">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="space-y-5">
      @csrf

      <!-- Username -->
      <div>
        <label for="username" class="block mb-1 text-sm font-medium">Username</label>
        <input type="text" id="username" name="username" required
          value="{{ old('username') }}"
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-300"
          placeholder="Masukkan username unik">
        @error('username')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Nama -->
      <div>
        <label for="name" class="block mb-1 text-sm font-medium">Nama Lengkap</label>
        <input type="text" id="name" name="name" required
          value="{{ old('name') }}"
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-300"
          placeholder="Masukkan nama lengkap">
        @error('name')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block mb-1 text-sm font-medium">Email</label>
        <input type="email" id="email" name="email" required
          value="{{ old('email') }}"
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-300"
          placeholder="Masukkan email aktif">
        @error('email')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block mb-1 text-sm font-medium">Kata Sandi</label>
        <input type="password" id="password" name="password" required
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-300"
          placeholder="Minimal 8 karakter">
        @error('password')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Konfirmasi Password -->
      <div>
        <label for="password_confirmation" class="block mb-1 text-sm font-medium">Konfirmasi Sandi</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-300"
          placeholder="Ulangi kata sandi">
      </div>

      <!-- Tombol -->
      <button type="submit"
        class="w-full py-3 rounded-lg bg-yellow-300 text-indigo-800 font-bold hover:bg-yellow-400 glow-btn transition-all duration-300">
        Daftar
      </button>
    </form>

    <p class="mt-6 text-sm text-center text-white/80">Sudah punya akun?
      <a href="{{ route('login') }}" class="text-yellow-300 hover:underline">Login di sini</a>
    </p>
  </div>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 1000, once: true });</script>
</body>
</html>
