<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Deposit via QRIS - TokoKita</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
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

    <!-- Title -->
    <h1 class="text-3xl font-bold mb-6" data-aos="fade-down">Deposit via QRIS</h1>

    <!-- Tutorial -->
    <div class="bg-white/10 p-4 rounded-xl mb-6 max-w-3xl mx-auto" data-aos="fade-up">
      <h2 class="text-xl font-semibold mb-2">Tutorial Cara Deposit</h2>
      <ol class="list-decimal list-inside space-y-1 text-white/90 text-sm">
        <li>Buka aplikasi e-wallet kamu (DANA, OVO, Gopay, ShopeePay, dll).</li>
        <li>Scan QRIS di bawah ini menggunakan aplikasi tersebut.</li>
        <li>Masukkan nominal deposit & konfirmasi pembayaran.</li>
        <li>Upload bukti transfer di form bawah.</li>
        <li>Tunggu maksimal 1x24 jam untuk proses konfirmasi.</li>
      </ol>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
  <div class="bg-yellow-400 text-gray-800 p-3 rounded mb-6 max-w-xl mx-auto text-center font-medium" data-aos="fade-up">
    {{ session('success') }}
  </div>
@endif


    <!-- Form Deposit -->
    <div class="bg-white/10 p-6 rounded-xl max-w-xl mx-auto shadow-lg space-y-6" data-aos="fade-up">
      <div>
        <p class="mb-2 font-medium">Scan QRIS berikut untuk melakukan pembayaran:</p>
        <div class="bg-white rounded-lg p-4 w-full flex justify-center">
          <img src="img/qris.jpg" alt="QRIS" class="w-40 h-40 object-contain" />
        </div>
      </div>

      <form action="{{ route('deposit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
  @csrf
  <div>
    <label for="jumlah" class="block text-sm font-semibold mb-1">Jumlah Deposit (Rp)</label>
    <input type="number" id="amount" name="amount" placeholder="Contoh: 100000" required
      class="w-full p-3 rounded-lg bg-white/10 border border-white/20 placeholder-white/60 text-white focus:outline-none focus:ring-2 focus:ring-yellow-300 transition"/>
  </div>
  <div>
    <label for="bukti" class="block text-sm font-semibold mb-1">Upload Bukti Transfer</label>
    <input type="file" id="proof" name="proof" accept="image/*" required
      class="w-full p-2 bg-white/10 border border-white/20 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-yellow-400 file:text-gray-800 hover:file:bg-yellow-300 transition"/>
  </div>
  <div class="text-center">
    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-6 py-3 rounded-lg transition shadow-lg">
      Kirim Konfirmasi Deposit
    </button>
  </div>
</form>

    </div>

    <!-- Riwayat Deposit -->


  <!-- Script -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });

    function showNotif() {
      document.getElementById('notif').classList.remove('hidden');
      setTimeout(() => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }, 200);
    }
  </script>
</body>
</html>
