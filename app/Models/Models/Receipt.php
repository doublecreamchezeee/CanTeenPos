<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    // user -> receipt 
    // cart -> detail receipt 
    // user-cart table -> detail-receipt table 
    public function cart()
    {
        return $this->belongsToMany(Product::class,"detail_receipts")->withPivot('quantity');
    }
}

