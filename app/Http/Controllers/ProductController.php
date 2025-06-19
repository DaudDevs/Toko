<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('stocks')->get();
        return view('product', compact('products'));
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show($id)
{
    $product = Product::with('product_stock')->findOrFail($id);
    $deposits = Deposit::all(); // ⬅️ ini yang bikin error hilang
    $products = Product::all(); // jika admin.blade.php butuh ini juga

    return view('admin', compact('product', 'deposits', 'products'));
}

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
}
