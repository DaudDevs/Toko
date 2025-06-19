  <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard - TokoKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
    <style>
      body {
        font-family: 'Poppins', sans-serif;
      }
    </style>
  </head>
  <body class="bg-gradient-to-br from-indigo-700 via-purple-800 to-pink-700 min-h-screen text-white flex">

    <!-- Sidebar -->
    <aside class="w-16 md:w-48 bg-indigo-900 flex flex-col items-center py-6 space-y-8 shadow-lg">
      <div class="text-xl font-bold hidden md:block">Admin</div>
      <a href="#deposit" class="text-white hover:text-yellow-300"><i class="ph ph-wallet text-2xl"></i></a>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 md:p-10 space-y-10">
      <!-- Header -->
      <div class="flex justify-between items-center mb-4" data-aos="fade-down">
        <h1 class="text-3xl font-bold">Dashboard Admin</h1>
        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">Logout</button>
      </div>

      <!-- KONFIRMASI DEPOSIT -->
      <section id="deposit" class="bg-white/10 p-6 rounded-xl shadow-lg" data-aos="fade-up">
        <h2 class="text-xl font-semibold mb-4">Konfirmasi Deposit</h2>
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-white/90">
            <thead>
  <tr class="border-b border-white/20">
    <th class="text-left py-2">User</th>
    <th class="text-left py-2">Jumlah</th>
    <th class="text-left py-2">Bukti</th>
    <th class="text-left py-2">Status</th>
    <th class="text-left py-2">Aksi</th>
  </tr>
</thead>
<tbody>
  @foreach ($deposits as $deposit)

  <tr class="border-b border-white/10">
    <td class="py-2">{{ $deposit->user?->username ?? 'User tidak ditemukan' }}</td>
    <td>Rp {{ number_format($deposit->amount, 0, ',', '.') }}</td>
    <td><a href="{{ asset('storage/' . $deposit->proof) }}" class="underline text-yellow-300" target="_blank">Lihat</a></td>
    <td>
      @if ($deposit->status === 'pending')
        <span class="text-yellow-300 font-medium">Menunggu</span>
      @elseif ($deposit->status === 'approved')
        <span class="text-green-400 font-medium">Disetujui</span>
      @elseif ($deposit->status === 'rejected')
        <span class="text-red-400 font-medium">Ditolak</span>
      @endif
    </td>
    <!-- Tombol aksi di bawah -->
    <td class="space-x-2">
      @if ($deposit->status === 'pending')
        <form action="{{ route('deposit.confirm', $deposit->id) }}" method="POST" class="inline">
          @csrf
          <button class="bg-green-500 px-3 py-1 rounded text-sm hover:bg-green-600" type="submit">Konfirmasi</button>
        </form>
        <form action="{{ route('deposit.reject', $deposit->id) }}" method="POST" class="inline">
          @csrf
          <button class="bg-red-500 px-3 py-1 rounded text-sm hover:bg-red-600" type="submit">Tolak</button>
        </form>
      @else
        <span class="italic text-white/70">Tidak ada aksi</span>
      @endif
    </td>
  </tr>
  @endforeach
</tbody>
          </table>
        </div>
      </section>

      <!-- FORM TAMBAH PRODUK -->
        <section id="produk" class="bg-white/10 p-6 rounded-xl shadow-lg" data-aos="fade-up">
    <h2 class="text-xl font-semibold mb-4">Tambah Produk</h2>
    <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
    @csrf

    <input type="text" name="name" placeholder="Nama Produk"
      class="p-3 bg-white/10 border border-white/20 rounded text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-yellow-300" required>

    <input type="number" name="price" placeholder="Harga (Rp)"
      class="p-3 bg-white/10 border border-white/20 rounded text-white placeholder-white/60" required>

    <textarea name="description" placeholder="Deskripsi Produk"
      class="md:col-span-2 p-3 bg-white/10 border border-white/20 rounded text-white placeholder-white/60 resize-none h-24"></textarea>

    <input type="file" name="image"
      class="md:col-span-2 p-3 bg-white/10 border border-white/20 rounded text-white placeholder-white/60" required>

    <div class="md:col-span-2 text-center">
      <button type="submit"
        class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-6 py-3 rounded-lg transition shadow-lg">Tambah Produk</button>
    </div>
  </form>
  </section>



      <!-- FORM TAMBAH ISI PRODUK -->
      <section class="bg-white/10 p-6 rounded-xl shadow-lg" data-aos="fade-up">
  <h2 class="text-xl font-semibold mb-4">Tambah Isi Produk</h2>
<form method="POST" action="{{ route('admin.product.stock.create') }}" class="grid md:grid-cols-1 gap-4">
  @csrf

  <select name="product_id" required
    class="p-3 bg-white/10 border border-white/20 rounded text-white placeholder-white/60">
    <option value="" disabled selected>Pilih Produk</option>
    @foreach ($products as $product)
        <option value="{{ $product->id }}">{{ $product->name }}</option>
    @endforeach
  </select>

  <textarea name="content" placeholder="Tulis isi produk di sini..." class="p-3 bg-white/10 border border-white/20 rounded text-white placeholder-white/60 resize-none h-28" required></textarea>

  <div class="text-center">
    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-6 py-3 rounded-lg transition shadow-lg">Tambah Isi Produk</button>
  </div>
</form>

</section>


      <tbody>
@foreach ($products as $product)
<tr class="border-b border-white/10 align-top">
  <td class="py-2">
    @if ($product->image)
      <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="w-16 h-16 object-cover rounded">
    @else
      <span class="text-white/50 italic">Tidak ada gambar</span>
    @endif
  </td>
  <td>
    <!-- Info Produk -->
    <div id="produk-info-{{ $product->id }}">
      <strong>{{ $product->name }}</strong><br>
      <span class="text-white/70 text-sm block mb-1">{{ $product->description }}</span>
      <button onclick="toggleEditProduk({{ $product->id }})" class="text-yellow-300 hover:underline text-xs">Edit Produk</button>
    </div>

    <!-- Form Edit Produk -->
    <form id="form-edit-produk-{{ $product->id }}" class="space-y-2 hidden" method="POST" action="{{ route('admin.product.update', $product->id) }}">
      @csrf
      @method('PUT')
      <input type="text" name="name" value="{{ $product->name }}" class="w-full p-2 bg-white/10 border border-white/20 rounded text-white text-sm" />
      <textarea name="description" class="w-full p-2 bg-white/10 border border-white/20 rounded text-white text-sm">{{ $product->description }}</textarea>
      <button type="submit" class="text-xs text-green-300 hover:underline">Simpan</button>
      <button type="button" onclick="toggleEditProduk({{ $product->id }})" class="text-xs text-red-400 hover:underline">Batal</button>
    </form>

    <!-- Isi Produk -->
    <ul class="mt-2 space-y-1 text-sm text-white/70">
      @forelse ($product->stocks as $stock)
      <li class="flex flex-col bg-white/5 px-3 py-2 rounded">
        <div class="flex justify-between items-center">
          <span id="isi-teks-{{ $stock->id }}">{{ $stock->content }}</span>
          <div class="space-x-2">
            <button onclick="toggleEditIsi({{ $stock->id }})" class="text-yellow-300 text-xs hover:underline">Edit</button>
            <form method="POST" action="{{ route('admin.product.stock.destroy', $stock->id) }}" class="inline">
              @csrf
              @method('DELETE')
              <button class="text-red-400 hover:text-red-600 text-xs">Hapus</button>
            </form>
          </div>
        </div>
        <form id="form-edit-isi-{{ $stock->id }}" class="mt-2 hidden" method="POST" action="{{ route('admin.product.stock.update', $stock->id) }}">
          @csrf
          @method('PUT')
          <textarea name="content" class="w-full p-2 bg-white/10 border border-white/20 rounded text-white text-sm">{{ $stock->content }}</textarea>
          <div class="mt-1 space-x-2">
            <button type="submit" class="text-xs text-green-300 hover:underline">Simpan</button>
            <button type="button" onclick="toggleEditIsi({{ $stock->id }})" class="text-xs text-red-400 hover:underline">Batal</button>
          </div>
        </form>
      </li>
      @empty
      <li><em>Belum ada isi produk</em></li>
      @endforelse
    </ul>
  </td>
  <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
  <td>{{ $product->stocks->count() }}</td>
  <td class="space-x-2">
    <a href="{{ route('admin.product.show', $product->id) }}" class="text-yellow-400 hover:underline">Lihat</a>
    <form method="POST" action="{{ route('admin.product.destroy', $product->id) }}" class="inline">
      @csrf
      @method('DELETE')
      <button class="bg-red-500 px-3 py-1 rounded text-sm hover:bg-red-600 text-white">Hapus</button>
    </form>
  </td>
</tr>
@endforeach
</tbody>


    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init({ duration: 1000, once: true });
      function toggleEditIsi(id) {
    const form = document.getElementById('form-edit-isi-' + id);
    const isiTeks = document.getElementById('isi-teks-' + id);

    if (form.classList.contains('hidden')) {
      form.classList.remove('hidden');
      isiTeks.style.display = 'none';
    } else {
      form.classList.add('hidden');
      isiTeks.style.display = 'block';
    }
  }
    </script>
  </body>
  </html>
