<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(4);
        return view('welcome')->with('products', $products);
    }
}
