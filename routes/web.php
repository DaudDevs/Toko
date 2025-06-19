<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStockController;
use App\Http\Middleware\AdminOnly;
use App\Models\Deposit;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

Route::get('/', [DashboardController::class, 'home']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\Auth\RegisterController;

Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'show'])->name('register.form');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('register');

use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


Route::middleware(['auth'])->group(function(){
    Route::get('/produk', [ProductController::class, 'index'])->name('product');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/keranjang/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/keranjang/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/checkout', function () {
    $isiProduk = session('isiProduk', []);
    $total = session('total', 0);

    if (empty($isiProduk)) {
        return redirect()->route('keranjang')->with('error', 'Tidak ada data checkout.');
    }

    return view('checkout', compact('isiProduk', 'total'));
})->name('checkout.show');

    
});

 

Route::middleware(['auth'])->group(function () {
    Route::get('/deposit', [DepositController::class, 'index'])->name('deposit.index');
    Route::post('/deposit', [DepositController::class, 'store'])->name('deposit.store');
});

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/deposit/riwayat', [DepositController::class, 'history'])->name('deposit.history');
});


Route::middleware([AdminOnly::class])->group(function () {
    // Halaman admin utama
    Route::get('/admin', [DepositController::class, 'admin'])->name('admin');

    Route::get('/debug/update-proof', function () {
    $deposit = Deposit::whereNull('proof')->first();

    if (!$deposit) {
        return 'Tidak ada data deposit yang perlu diupdate.';
    }

    // Pastikan file benar-benar ada di folder storage/app/public/bukti_deposit
    $deposit->proof = 'bukti_deposit/bukti1.jpg';
    $deposit->save();

    return 'Berhasil update deposit ID: ' . $deposit->id;
});

    // Deposit
    Route::post('/deposit/{deposit}/confirm', [DepositController::class, 'confirm'])->name('deposit.confirm');
    Route::post('/deposit/{deposit}/reject', [DepositController::class, 'reject'])->name('deposit.reject');

    // Produk
    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/product/show/{product}', [ProductController::class, 'show'])->name('admin.product.show');
    Route::put('/admin/product/update/{product}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/admin/product/destroy/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    // Isi Produk
    Route::post('/admin/product/stock/create', [ProductStockController::class, 'store'])->name('admin.product.stock.create');
    Route::put('/admin/product/stock/update/{stock}', [ProductStockController::class, 'update'])->name('admin.product.stock.update');
    Route::delete('/admin/product/stock/destroy/{stock}', [ProductStockController::class, 'destroy'])->name('admin.product.stock.destroy');
});



