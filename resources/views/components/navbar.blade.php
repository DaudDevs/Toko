<aside class="bg-indigo-900 w-16 md:w-48 h-screen md:h-auto fixed md:relative top-0 left-0 flex flex-col items-center py-6 space-y-8 shadow-lg z-50">
  <div class="text-xl font-bold hidden md:block">TokoKita</div>
  <a href="{{ route ('dashboard')}}" class="text-white hover:text-yellow-300" title="Dashboard">
    <i class="ph ph-house-simple text-2xl"></i>
  </a>
  <a href="{{ route ('product')}}" class="text-white hover:text-yellow-300" title="Produk Saya">
    <i class="ph ph-package text-2xl"></i>
  </a>
  <a href="{{ route ('cart.index')}}" class="text-white hover:text-yellow-300" title="Keranjang">
    <i class="ph ph-shopping-cart-simple text-2xl"></i>
  </a>
  <a href="{{ route ('deposit.index')}}" class="text-white hover:text-yellow-300" title="Deposit">
    <i class="ph ph-wallet text-2xl"></i>
  </a>
  <a href="{{ route ('deposit.history')}}" class="text-white hover:text-yellow-300" title="Riwayat Deposit">
    <i class="ph ph-clock-counter-clockwise text-2xl"></i>
  </a>
</aside>
