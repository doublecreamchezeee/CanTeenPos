<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaoCao extends Model
{
    protected $table = 'baocao';
    
    protected $fillable = [
        'MaNV',
        'MaBaoCao',
        'ThoiGianLap',
        'GiaiDoanBaoCao',
        'TongDoanhThu', // Add this line
    ];
}
