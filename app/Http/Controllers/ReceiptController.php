<?php

namespace App\Http\Controllers;

use App\Models\Models\Receipt;
use App\Models\Models\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receipts = Receipt::latest()->paginate(4);
        return view('receipts.index')->with('receipts', $receipts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->wantsJson()) {
            $receipt = Receipt::find(1);
            $cartItems = $receipt->cart()->get();
            return response($cartItems);
        }

        $products = Product::where('status', true)->latest()->paginate(10);
        return view('receipts.create')->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo $request;
        $request->validate([
            'barcode' => 'required|exists:products,barcode',
        ]);
        $barcode = $request->barcode;

        $product = Product::where('barcode', $barcode)->first();
        $cart = $request->receipt->cart()->where('barcode', $barcode)->first();
        if ($cart) {
            // check product quantity
            if ($product->quantity <= $cart->pivot->quantity) {
                return response([
                    'message' => 'Product available only: ' . $product->quantity,
                ], 400);
            }
            // update only quantity
            $cart->pivot->quantity = $cart->pivot->quantity + 1;
            $cart->pivot->save();
        } else {
            if ($product->quantity < 1) {
                return response([
                    'message' => 'Product out of stock',
                ], 400);
            }
            $request->receipt->cart()->attach($product->id, ['quantity' => 1]);
        }

        return response('', 204);
    }

    /**
     * Display the specified resource.
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
