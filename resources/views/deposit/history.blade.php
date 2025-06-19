<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Deposit - TokoKita</title>
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

    <h1 class="text-3xl font-bold mb-6" data-aos="fade-down">Riwayat Deposit</h1>

    @if(session('success'))
      <div class="bg-green-400 text-gray-900 px-4 py-3 rounded font-medium shadow mb-6" data-aos="fade-up">
        {{ session('success') }}
      </div>
    @endif

    <div class="bg-white/10 p-6 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="100">
      <table class="w-full text-sm text-white/90">
        <thead>
          <tr class="border-b border-white/20 text-left">
            <th class="py-2">Tanggal</th>
            <th class="py-2">Jumlah</th>
            <th class="py-2">Status</th>
            <th class="py-2">Bukti</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($deposits as $d)
            <tr class="border-b border-white/10 hover:bg-white/5 transition">
              <td class="py-3">{{ \Carbon\Carbon::parse($d->created_at)->translatedFormat('d M Y') }}</td>
              <td>Rp {{ number_format($d->amount, 0, ',', '.') }}</td>
              <td>
                @if($d->status === 'pending')
                  <span class="bg-yellow-400 text-gray-900 px-3 py-1 rounded-full text-xs font-semibold">Menunggu</span>
                @elseif($d->status === 'approved')
                  <span class="bg-green-400 text-gray-900 px-3 py-1 rounded-full text-xs font-semibold">Berhasil</span>
                @elseif($d->status === 'rejected')
                  <span class="bg-red-400 text-gray-900 px-3 py-1 rounded-full text-xs font-semibold">Ditolak</span>
                @endif
              </td>
              <td>
                @if($d->proof)
                  <a href="{{ asset('storage/' . $d->proof) }}" target="_blank" class="underline text-yellow-300 text-xs">Lihat Bukti</a>
                @else
                  <span class="text-white/50 text-xs">-</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center py-6 text-white/70">Belum ada data deposit.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <x-footer></x-footer>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });
  </script>
</body>
</html>
