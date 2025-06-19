<div class="flex justify-end items-center gap-4 mb-4" data-aos="fade-down">
      <div class="text-sm text-right">
        <div class="font-semibold">
          Halo, <span class="text-yellow-300">{{ Auth::user()->username ?? 'Pengguna' }}</span>
        </div>
        <div class="text-white/80">Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}</div>

      </div>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded text-sm transition">
          Logout
        </button>
      </form>
    </div>