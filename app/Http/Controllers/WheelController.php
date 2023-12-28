<?php
namespace App\Http\Controllers;
use App\Models\Models\Product;

use Illuminate\Http\Request;


class WheelController extends Controller
{
    public function index()
    {
        $foods = Product::where('status', 1)->get();
        return view('guest.wheel', compact('foods'));
    }
}
