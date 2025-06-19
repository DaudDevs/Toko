<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Checkout Sukses - TokoKita</title>
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

  <!-- Box -->
  <div class="bg-white/10 p-8 rounded-2xl shadow-xl max-w-xl w-full space-y-6" data-aos="zoom-in">
    <!-- Icon -->
    <div class="text-5xl text-green-400 text-center">
      <i class="ph ph-check-circle"></i>
    </div>

    <!-- Title -->
    <h1 class="text-2xl font-bold text-center">Pembayaran Berhasil!</h1>

    <!-- Deskripsi -->
    <p class="text-white/80 text-sm text-center">
      ⚠️ <strong>Penting: Akses Hanya Sekali</strong><br>
      Produk digital ini hanya dapat diakses dan diunduh satu kali saja.<br>
      Pastikan Anda menggunakan perangkat yang sesuai dan koneksi internet yang stabil.<br><br>
      Jika terjadi kesalahan seperti:<br>
      - File terhapus<br>
      - Gagal unduh<br>
      - Terputus koneksi<br>
      - Coba akses ulang<br><br>
      ⛔ Tidak ada akses ulang atau bantuan teknis.<br>
      Dengan melanjutkan, Anda setuju bahwa tanggung jawab akses berada di tangan Anda.
    </p>

    <!-- Isi Produk -->
    <div class="bg-white/5 p-4 rounded-lg space-y-2">
      <h2 class="font-semibold text-white text-center">Produk Digital Anda</h2>
      <ul class="text-sm text-white/90 list-disc pl-6">
        @foreach($isiProduk as $item)
          <li><strong>{{ $item['product_name'] }}</strong>: {{ $item['content'] }}</li>
        @endforeach
      </ul>
    </div>

    <!-- Total -->
    <div class="text-center text-yellow-300 font-semibold text-lg">
      Total: Rp {{ number_format($total, 0, ',', '.') }}
    </div>


    <!-- Kembali ke dashboard -->
    <div class="text-center">
      <a href="{{ route('dashboard') }}" class="text-white/70 text-sm hover:underline">
        Kembali ke Dashboard
      </a>
    </div>
  </div>

  <!-- Footer -->
  <x-footer></x-footer>

  <!-- Script AOS -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });
  </script>
</body>
</html>
