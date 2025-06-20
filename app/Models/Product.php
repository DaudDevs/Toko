<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'description', 'image',
    ];

    // Relasi: Produk memiliki banyak stok
    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function product_stock()
{
    return $this->hasMany(ProductStock::class);
}
}

