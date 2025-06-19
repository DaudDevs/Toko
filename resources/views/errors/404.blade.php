<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Halaman Tidak Ditemukan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-700 to-pink-600 min-h-screen text-white flex flex-col items-center justify-center p-6">

  <div class="bg-white/10 p-8 rounded-2xl shadow-xl max-w-md w-full text-center space-y-6" data-aos="zoom-in">
    <div class="text-5xl text-red-400">
      <i class="ph ph-warning"></i>
    </div>

    <h1 class="text-2xl font-bold text-white">Oops! Halaman Tidak Ditemukan</h1>

    <p class="text-white/80 text-sm">
      Halaman yang kamu cari tidak tersedia atau mungkin telah dipindahkan.
    </p>

    <a href="{{ route('dashboard') }}"
      class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-6 py-3 rounded-full transition duration-200 shadow-md">
      <i class="ph ph-arrow-left mr-2"></i> Kembali ke Dashboard
    </a>
  </div>

  <x-footer></x-footer>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });
  </script>
</body>
</html>
