<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status',true)->latest()->paginate();
        if($key = request()->key) 
        {
            $products = Product::where('status',true)
                ->where('name','like',"%$key%")
                ->latest()->paginate();
        }

        return view('welcome')->with('products', $products);
    }

    // handle detail product ajax request
    public function detail($request)
    {
        $id = $request->id;
        $products = Product::find($id);

        return response()->json($products);
    }


}
