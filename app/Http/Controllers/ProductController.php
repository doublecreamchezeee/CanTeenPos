<?php

namespace App\Http\Controllers;

use App\Models\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(4);
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Product::getEnumValues();
        return view('products.create', compact('types'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/products');
        }
        $product = Product::create([
            "name" => $request->name,
            "description" => $request->description,
            "image" => $image_path,
            "barcode" => $request->barcode,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "status" => $request->status,
            "type" => $request->type,
        ]);

        if (! $product){
            return redirect()->back()->with("error","There is a problem while creating product");
        }
        return redirect()->route('products.index')->with("success","Create proudct successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $types = Product::getEnumValues(); // Retrieve all types from your database
        return view('products.edit', compact('product', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->barcode = $request->barcode;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->type = $request->type;
        $product->status = $request->status;
        
        
        if ($request->hasFile('image')){
            Storage::delete($product->image);

            $image_path = $request->file('image')->store('public/products');

            $product->image = $image_path;
        }

        if (! $product->save()){
            return redirect()->back()->with("error","There is a problem while updating product");
        }
        return redirect()->route('products.index')->with("success","Update proudct successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image){
            Storage::delete($product->image);
        }
        $product->delete();

        return response()->json([
            "success"=> true,
        ]);

    }
}
