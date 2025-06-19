<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
{
    // Misalnya hanya menampilkan 6 produk terbaru
    $products = Product::latest()->take(2)->get();

    return view('dashboard', compact('products'));
}
public function home()
{
    // Misalnya hanya menampilkan 6 produk terbaru
    $products = Product::latest()->take(2)->get();

    return view('home', compact('products'));
}
}

