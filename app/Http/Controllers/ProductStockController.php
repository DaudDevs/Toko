<?php

// app/Http/Controllers/ProductStockController.php

namespace App\Http\Controllers;

use App\Models\ProductStock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductStockController extends Controller
{

    public function create()
{
    $products = Product::all(); // ambil semua produk
    return view('admin', compact('products'));
}
     public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
        ]);

        ProductStock::create($validated);

        return redirect()->back()->with('success', 'Isi produk berhasil ditambahkan.');
    }

    public function update(Request $request, ProductStock $stock)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $stock->update($validated);

        return redirect()->back()->with('success', 'Isi produk berhasil diperbarui.');
    }

    public function destroy(ProductStock $stock)
    {
        $stock->delete();
        return redirect()->back()->with('success', 'Isi produk berhasil dihapus.');
    }
}

