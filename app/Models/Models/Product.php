<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "description",
        "image",
        "barcode",
        "price",
        "quantity",
        "status",
        "type",
    ];

    public static function getEnumValues()
    {
        return ['Food', 'Beverage'];
    }
}
