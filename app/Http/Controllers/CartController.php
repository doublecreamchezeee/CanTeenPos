<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Models\Product;
use App\Models\Models\Receipt;
use App\Models\Models\DetailReceipt;

use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $id = $request->input('id'); // Lấy id từ form
        $quantity = $request->input('quantity'); // Lấy số lượng từ form

        $Product = Product::find($id);

        $cart = session()->get('cart'); // Lấy giỏ hàng từ session

        // Nếu giỏ hàng không tồn tại thì tạo một giỏ hàng mới
        if(!$cart) {
            $cart = [
                    $id => [
                        "name" => $Product->name,
                        "quantity" => $quantity,
                        "price" => $Product->price,
                    ]
            ];

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Món ăn đã được thêm vào giỏ hàng!');
        }

        // Nếu món ăn tồn tại thì tăng số lượng
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Món ăn đã được thêm vào giỏ hàng!');
        }

        // Nếu món ăn không tồn tại trong giỏ hàng thì thêm vào với số lượng từ form
        $cart[$id] = [
            "name" => $Product->name,
            "quantity" => $quantity,
            "price" => $Product->price,
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Món ăn đã được thêm vào giỏ hàng!');
    }

    public function checkout()
    {
        $cart = session()->get('cart');
        return view('guest.checkout', compact('cart'));
    }

    public function deleteAll()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Giỏ hàng đã được xoá!');
    }

    public function updateQuantity(Request $request, $id)
    {
        $quantity = $request->input('quantity'); // Lấy số lượng từ form

        $cart = session()->get('cart'); // Lấy giỏ hàng từ session

        // Nếu món ăn tồn tại trong giỏ hàng thì cập nhật số lượng
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật!');
        }
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart'); // Lấy giỏ hàng từ session

        // Nếu món ăn tồn tại trong giỏ hàng thì xoá nó
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Món ăn đã được xoá khỏi giỏ hàng!');
        }
    }

    public function payment(Request $request)
    {
    DB::beginTransaction();
    $cart = session()->get('cart');
    $total = 0;

    // Tạo đơn hàng mới
    $receipt = new Receipt();

    do {
        $id = rand(100000, 999999); // Tạo ID ngẫu nhiên có 6 chữ số
    } while (Receipt::find($id)); // Thay 'Receipt' bằng tên Model của bạn
    
    $receipt->id = $id;
    

    try {
        foreach ($cart as $id => $details) {
            $Product = Product::find($id); // Lấy món ăn từ cơ sở dữ liệu

            // Kiểm tra xem số lượng sản phẩm trong kho có đủ không
            if($Product->quantity < $details['quantity']) {
                return redirect()->back()->with('fail', 'Sản phẩm ' . $Product->name . ' không đủ số lượng trong kho.');
            }

            // Cập nhật số lượng sản phẩm trong kho
            $Product->quantity -= $details['quantity'];
            $Product->save();

            // Tính tổng tiền
            $total += $details['quantity'] * $Product->price;
        }

        $receipt->total_cost = $total;
        $receipt->save();

        foreach ($cart as $id => $details) {
            // Tạo chi tiết hoá đơn, db DetailReceipt
            $detailReceipt = new DetailReceipt();
            $detailReceipt->receipt_id = $receipt->id;
            $detailReceipt->product_id = $id;
            $detailReceipt->quantity = $details['quantity'];
            $detailReceipt->unit_price = $Product->price;
            $detailReceipt->save();
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        DB::commit();

        return redirect()->route('homepage')->with('payment_success', ['id' => $receipt->id, 'total' => $receipt->total_cost]);
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('homepage')->with('payment_fail', '');
    }
    }

}
