<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Keranjang - TokoKita</title>
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
<body class="bg-gradient-to-br from-indigo-600 via-purple-700 to-pink-600 min-h-screen text-white flex flex-col md:flex-row">

  <!-- Sidebar -->
  <x-navbar></x-navbar>

  <!-- Main Content -->
<main class="flex-1 p-4 sm:p-6 md:p-10 ml-16 md:ml-0">

    <!-- Header kanan atas -->
    <x-header-right></x-header-right>
@if(session('error'))
  <div class="bg-red-500 text-white px-4 py-3 rounded mb-4 shadow-lg" data-aos="fade-down" data-aos-delay="50">
    {{ session('error') }}
  </div>
@endif

@if(session('success'))
  <div class="bg-green-500 text-white px-4 py-3 rounded mb-4 shadow-lg" data-aos="fade-down" data-aos-delay="50">
    {{ session('success') }}
  </div>
@endif

    <h1 class="text-2xl sm:text-3xl font-bold mb-6" data-aos="fade-down" data-aos-delay="100">Keranjang Belanja</h1>

    <!-- Tabel Keranjang -->
    <div class="bg-white/10 rounded-xl p-4 overflow-auto shadow-md" data-aos="fade-up" data-aos-delay="200">
<!-- Versi Desktop: Tabel -->
<div class="hidden md:block">
  <table class="w-full text-left text-white min-w-[600px]">
    <thead>
      <tr class="border-b border-white/20">
        <th class="p-3">Produk</th>
        <th class="p-3">Harga</th>
        <th class="p-3">Jumlah</th>
        <th class="p-3">Subtotal</th>
        <th class="p-3">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($carts as $cart)
      <tr class="border-b border-white/10">
        <td class="p-3 flex items-center gap-3">
          <img src="{{ asset('storage/' . $cart->product->image) }}" class="w-12 h-12 object-cover rounded" alt="{{ $cart->product->name }}">
          <span>{{ $cart->product->name }}</span>
        </td>
        <td class="p-3">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
        <td class="p-3">{{ $cart->quantity }}</td>
        <td class="p-3">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</td>
        <td class="p-3">
          <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
            @csrf
            @method('DELETE')
            <button class="text-red-400 hover:text-red-600 transition text-sm">Hapus</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center py-4 text-white/70">Keranjang kosong.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<!-- Versi Mobile: Card -->
<div class="block md:hidden space-y-4">
  @forelse ($carts as $cart)
  <div class="bg-white/5 rounded-lg p-4 flex gap-4 items-center shadow">
    <img src="{{ asset('storage/' . $cart->product->image) }}" class="w-16 h-16 object-cover rounded" alt="{{ $cart->product->name }}">
    <div class="flex-1">
      <div class="font-semibold">{{ $cart->product->name }}</div>
      <div class="text-sm text-white/70">Harga: Rp {{ number_format($cart->product->price, 0, ',', '.') }}</div>
      <div class="text-sm text-white/70">Jumlah: {{ $cart->quantity }}</div>
      <div class="text-sm text-yellow-300 font-semibold mt-1">Subtotal: Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</div>
    </div>
    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
      @csrf
      @method('DELETE')
      <button class="text-red-400 hover:text-red-600 text-xs">Hapus</button>
    </form>
  </div>
  @empty
  <div class="text-center py-4 text-white/70">Keranjang kosong.</div>
  @endforelse
</div>



<!-- Total -->
<div class="mt-6 text-right pr-3">
  <div class="text-lg md:text-xl font-semibold mb-2">
    Total: <span class="text-yellow-300">Rp {{ number_format($total, 0, ',', '.') }}</span>
  </div>

  <form action="{{ route('cart.checkout') }}" method="POST">
    @csrf
    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold transition shadow-lg text-sm md:text-base">
      Checkout Sekarang
    </button>
  </form>
</div>





    <!-- Footer -->
    <x-footer></x-footer>

  <!-- AOS -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });
  </script>
</body>
</html>
