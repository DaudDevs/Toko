<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductStock;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = $carts->sum(fn($item) => $item->product->price * $item->quantity);

        return view('keranjang', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            ['quantity' => 0]
        );

        $cart->increment('quantity');
        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) abort(403);
        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function checkout()
{
    $user = Auth::user();
    $carts = Cart::with('product')->where('user_id', $user->id)->get();

    if ($carts->isEmpty()) {
        return back()->with('error', 'Keranjang kosong.');
    }

    $total = $carts->sum(function ($cart) {
        return $cart->product->price * $cart->quantity;
    });

    if ($user->saldo < $total) {
        return back()->with('error', 'Saldo tidak cukup.');
    }

    $isiProduk = [];

    // Validasi stok
    foreach ($carts as $cart) {
        $availableStock = ProductStock::where('product_id', $cart->product_id)->count();

        if ($availableStock < $cart->quantity) {
            return back()->with('error', "Stok tidak cukup untuk produk: {$cart->product->name}. Sisa stok hanya $availableStock.");
        }
    }

    // Jika validasi berhasil, lanjut proses
    foreach ($carts as $cart) {
        $stocks = ProductStock::where('product_id', $cart->product_id)
                    ->take($cart->quantity)
                    ->get();

        foreach ($stocks as $stock) {
            $isiProduk[] = [
                'product_name' => $cart->product->name,
                'content' => $stock->content
            ];
            $stock->delete(); // hapus stok setelah checkout
        }
    }

    // Kurangi saldo user
    $user->saldo -= $total;
    $user->save();

    // Kosongkan keranjang
    Cart::where('user_id', $user->id)->delete();

    // Redirect ke halaman checkout sukses
    return redirect()->route('checkout.show')->with([
        'isiProduk' => $isiProduk,
        'total' => $total,
        'success' => 'Checkout berhasil!',
    ]);
}

}

