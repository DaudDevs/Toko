<?php

// app/Models/Deposit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'bukti', 'status',
    ];

    // Relasi: Deposit milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

