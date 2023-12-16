<?php

namespace App\Http\Controllers;

use App\Models\Models\Receipt;
use App\Models\Models\Product;
use App\Models\Models\DetailReceipt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        // Lấy danh sách các receipt (tôi giả định 1 receipt có nhiều detail_receipt)
        $receipts = Receipt::latest()->paginate(4);
    
        // Duyệt qua từng receipt và cập nhật total_cost
        foreach ($receipts as $receipt) {
            // Lấy chi tiết hóa đơn của receipt
            $detailReceipts = DetailReceipt::where('receipt_id', $receipt->id)->get();
    
            // Tính tổng chi phí
            $totalCost = 0;
            foreach ($detailReceipts as $detailReceipt) {
                $totalCost += $detailReceipt->quantity * $detailReceipt->unit_price;
            }
    
            $payment_type = "cash"; 
            // Cập nhật total_cost trong receipt
            $receipt->update([
                'total_cost' => $totalCost,
            ]);
        }
    

        return view('receipts.index')->with('receipts', $receipts);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function createReceipt()
    {
        $newIDCreate = Receipt::latest()->count() + 1;
        $receipt = Receipt::create([
            "id" => $newIDCreate,
            "total_cost" => 0,
            'payment_type' => "cash",
        ]);

        if (!$receipt){
            return redirect()->back()->with("error","There is a problem while creating receipt");
        }
        return redirect()->route('receipts.create');
    }
    

    public function create(Request $request)
    {
        $receipt = Receipt::where('id',Receipt::max('id'))->first();
        // $receipt = Receipt::find(1);

        if ($request->wantsJson()) {
            // if ($request->type === 0 ){
            //     // $newIDCreate = DetailReceipt::latest()->count() + 1;
            //     // $product = Product::where('barcode', $request->barcode)->first();
            //     // $detail_receipt = DetailReceipt::create([
            //     //     "id" => $newIDCreate,
            //     //     "receipt_id" => $receipt->id,
            //     //     "product_id" => $product->id,
            //     // ]);
            //     // if (!$detail_receipt){
            //     //     return response("ERROR");
            //     // }
            //     // $cartItems = $receipt->cart()->get();
            //     return response($receipt,204);
            // }
            $cartItems = $receipt->cart()->get();
            return response($cartItems);
        }

        return view('receipts.create')  ;
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
        $unitPrice = $product->price;

        $receiptID = $request->receiptID;
        $receipt = 0;
        if (is_null($receiptID)){
            $receipt = Receipt::where('id',Receipt::max('id'))->first();
        }
        else {
            $receipt = Receipt::where('id',$receiptID)->first();
        }

        $cart = $receipt->cart()->where('barcode',$barcode)->first();

                
        if ($cart){
            // check product quantity
            if ($product->quantity <= $cart->pivot->quantity){
                return response([
                    'message' => 'Product available only: ' . $product->quantity,
                ], 400);
            }
            // update quantity
            $cart->pivot->quantity = $cart->pivot->quantity + 1;
            $cart->pivot->save();
        } else {
            if ($product->quantity < 1){
                return response([
                    'message' => 'Product out of stock',
                ], 400);
            }
            $receipt->cart()->attach($product->id, ['quantity' => 1, 'unit_price' => $unitPrice]);
        }

        return response($receipt, 204);
    }

    public function changeQty(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // $product = Product::find($request->product_id);

        $product = Product::find($request->product_id);

        $receiptID = $request->receiptID;
        $receipt = Receipt::where('id',$receiptID)->first();
        $cart = $receipt->cart()->where('product_id',$request->product_id)->first();
        
        if ($cart){
            // check product quantity
            if ($product->quantity < $request->quantity){
                return response([
                    'message' => 'Product available only: ' . $product->quantity,
                ], 400);
            }
            $cart->pivot->quantity = $request->quantity;
            $cart->pivot->save();
        }
        
        return response([
            'success' => true
        ]);

    }

    public function delete(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $receiptID = $request->receiptID;
        $receipt = Receipt::where('id',$receiptID)->first();

        $receipt->cart()->detach($request->product_id);

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
