<?php
namespace App\Http\Controllers;

use App\Models\Models\Product;
use Illuminate\Http\Request;

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
                    "photo" => $Product->photo
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
        "photo" => $Product->photo
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
}
