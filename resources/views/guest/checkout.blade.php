<?php
use App\Models\Models\Product
?>

@extends('layouts.menu')
@include('guest.flash-message')

@section('content')
    <head>
        <title>Checkout</title>
    </head>
    <body>
        <h1>Thanh toán</h1>
        <div style="text-align: right">
            <form action="{{ route('cart.deleteAll') }}" method="POST">
                @csrf
                <button type="submit">Xóa tất cả</button>
            </form>
        </div>

        @if(session('cart'))
            <?php $total = 0 ?>
            <table>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Điều chỉnh số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th></th>
                </tr>
                @foreach(session('cart') as $id => $details)
                <?php
                $Product = Product::find($id); // Lấy món ăn từ cơ sở dữ liệu

                if($Product->quantity == 0) {
                    unset($cart[$id]);
                    echo "<script>alert('Món {$Product->name} đã hết hàng');</script>";
                }

                if(isset($cart[$id])) {
                    $price = $Product->price;
                    #Tính (tạm thời) thành tiền
                    $total += $details['quantity'] * $price;
                    ?>
                        <tr>
                            <td>{{ $details['name'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>
                                @if($details['quantity'] > 0)
                                    <form action="{{ route('cart.updateQuantity', $id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="quantity" min="1" max="{{ $Product->quantity }}" value="{{ $details['quantity'] }}">
                                        <button type="submit">Cập nhật</button>
                                    </form>
                                @endif
                            </td>
                            <td>{{ number_format($price) }}</td>
                            <td>{{ number_format($details['quantity'] * $price) }}</td>
                            <td>
                                <form action="{{ route('cart.removeFromCart', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Xoá</button>
                                </form>
                            </td>
                        </tr>
                <?php
                }
                ?>
                @endforeach
            </table>
            <div style="text-align: right">
            <h3>Tổng tiền: {{ number_format($total) }} VNĐ</h3>
            <form action="{{ route('cart.payment') }}" method="POST">
                @csrf
                <button type="submit">Thanh toán</button>
            </form>
            </div>
        @else
            <p>Giỏ hàng trống</p>
        @endif
    </body>
@endsection