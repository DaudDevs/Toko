<?php

// app/Models/ProductStock.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'content'];

    // Relasi: Stok milik satu produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
