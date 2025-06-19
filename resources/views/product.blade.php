<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Produk - TokoKita</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .glow:hover {
      box-shadow: 0 0 10px rgba(255,255,255,0.1), 0 0 20px rgba(255,255,255,0.2);
    }
  </style>
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-700 to-pink-600 min-h-screen text-white flex">

  <!-- Sidebar -->
 <x-navbar></x-navbar>

  <!-- Main Content -->
  <main class="flex-1 p-4 sm:p-6 md:p-10 ml-16 md:ml-0">

    <!-- Header kanan atas -->
    <x-header-right></x-header-right>

    <!-- Search bar -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4" data-aos="fade-down" data-aos-delay="100">
      <form action="#" method="GET" class="flex items-center bg-white/10 rounded-xl px-4 py-2 w-full md:w-1/2 shadow-sm focus-within:ring-2 ring-white/30 transition">
        <i class="ph ph-magnifying-glass text-lg text-white/70 mr-2"></i>
        <input 
          type="text" 
          name="q" 
          placeholder="Cari produk kamu..." 
          class="bg-transparent w-full placeholder-white/60 text-white outline-none"
        />
      </form>
    </div>

    <h1 class="text-3xl font-bold mb-4" data-aos="fade-down" data-aos-delay="200">Semua Produk</h1>

   <!-- Grid Produk -->
<!-- Grid Produk -->
<div id="produk-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="300">
  @foreach ($products as $product)
    @php
      $stockCount = $product->stocks->count();
    @endphp
    <div class="bg-white/10 p-4 rounded-xl shadow-lg glow transition"
         data-nama="{{ $product->name }}"
         data-deskripsi="{{ $product->description }}">
      <img src="{{ asset('storage/' . $product->image) }}" class="rounded mb-3 w-full h-40 object-cover" alt="Produk">

      <h3 class="text-lg font-semibold mb-1">{{ $product->name }}</h3>
      <p class="text-sm text-white/70 mb-2">{{ $product->description }}</p>

      <!-- Tampilkan jumlah stok -->
      <p class="text-sm mb-2">
        Stok: <span class="{{ $stockCount > 0 ? 'text-green-400' : 'text-red-400' }}">{{ $stockCount }}</span>
      </p>

      <div class="flex justify-between items-center">
        <span class="text-yellow-300 font-semibold">
          Rp {{ number_format($product->price, 0, ',', '.') }}
        </span>

        @if($stockCount > 0)
          <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-3 py-1 rounded text-sm transition">
              Tambah
            </button>
          </form>
        @else
          <button class="bg-gray-500 px-3 py-1 rounded text-sm opacity-50 cursor-not-allowed" disabled>
            Habis
          </button>
        @endif
      </div>

      @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mt-3 text-sm">
          {{ session('success') }}
        </div>
      @endif
    </div>
  @endforeach
</div>




<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: true });

  // Script Search Produk
  document.querySelector('input[name="q"]').addEventListener('input', function(e) {
    const keyword = e.target.value.toLowerCase();
    const produkList = document.querySelectorAll('#produk-container > div');

    produkList.forEach(function(produk) {
      const nama = produk.getAttribute('data-nama')?.toLowerCase() || '';
      const deskripsi = produk.getAttribute('data-deskripsi')?.toLowerCase() || '';

      if (nama.includes(keyword) || deskripsi.includes(keyword)) {
        produk.style.display = 'block';
      } else {
        produk.style.display = 'none';
      }
    });
  });
</script>

</body>
</html>
