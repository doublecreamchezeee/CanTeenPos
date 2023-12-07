<?php

namespace App\Http\Controllers;
use App\Models\Models\Product;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status',true)->latest()->paginate(4);
        return view('welcome')->with('products', $products);
    }
}
