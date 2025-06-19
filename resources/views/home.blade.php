<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TokoKita Elegan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .glass {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .glow-btn:hover {
      box-shadow: 0 0 10px rgba(255,255,255,0.4), 0 0 20px rgba(99,102,241,0.6);
    }
  </style>
</head>
<body class="text-white bg-gray-900">

  <!-- Navbar -->
  <nav class="w-full fixed top-0 z-50 flex justify-between items-center px-8 py-4 glass rounded-b-xl shadow-md">
    <div class="text-2xl font-bold">Toko<span class="text-indigo-300">Kita</span></div>
    <a href="{{ route ('login')}}" class="bg-white text-indigo-600 font-semibold py-2 px-5 rounded-lg glow-btn transition-all duration-300">
      Login
    </a>
  </nav>

  <!-- Hero Section -->
  <section class="min-h-screen flex items-center justify-center px-6 text-center pt-24 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-indigo-600 via-purple-700 to-pink-600">
    <div data-aos="fade-up">
      <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 drop-shadow-md">Temukan Produk<br><span class="text-yellow-300">Premium & Stylish</span></h1>
      <p class="text-lg md:text-xl text-white/90 mb-8">Hadirkan gaya hidup modern dengan produk terbaik pilihan kami.</p>
      <a href="{{ route ('login')}}" class="bg-white text-indigo-700 font-semibold py-3 px-8 rounded-full glow-btn transition-all duration-300">Jelajahi Produk</a>
    </div>
  </section>

  <!-- Produk Unggulan -->
  <section id="produk" class="py-20 px-6 bg-gradient-to-b from-white via-gray-100 to-white text-gray-800 rounded-t-[3rem] -mt-20 shadow-inner">
    <div class="grid md:grid-cols-3 gap-10">
  @forelse($products as $product)
  <div class="rounded-2xl shadow-lg hover:shadow-xl transition p-6 bg-white" data-aos="zoom-in" data-aos-delay="100">
    <img src="{{ asset('storage/' . $product->image) }}" class="rounded-lg mb-4 w-full h-48 object-cover" alt="{{ $product->name }}">
    <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
    <p class="text-gray-600 mb-3">{{ $product->description }}</p>
    <span class="text-indigo-600 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
  </div>
  @empty
  <p class="col-span-3 text-center text-gray-500">Tidak ada produk tersedia.</p>
  @endforelse
</div>
  </section>

  <!-- CTA Section -->
  <section class="py-20 text-center bg-gradient-to-br from-yellow-400 via-pink-500 to-indigo-600 text-white shadow-2xl">
    <div data-aos="fade-up">
      <h2 class="text-4xl font-bold mb-6 drop-shadow">Beli Sekarang dan Dapatkan Penawaran Terbaik</h2>
      <a href="{{ route ('login')}}" class="mt-4 inline-block bg-white text-indigo-600 font-bold py-3 px-8 rounded-full glow-btn transition-all duration-300">Mulai Belanja</a>
    </div>
  </section>

  <!-- Footer -->
  <x-footer></x-footer>

  <!-- AOS Script -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: true
    });
  </script>
</body>
</html>
