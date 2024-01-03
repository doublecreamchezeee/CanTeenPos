@extends('layouts.admin')

@section('title','Chi tiết Phiếu Nhập')

@section('content-header','Chi tiết Phiếu Nhập')

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Mã Sp</th>
                <th>Mã Phiếu</th>
                <th>Ngày lập</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $phieuNhap->MaNV }}</td>
                <td>{{ $phieuNhap->MaSp }}</td>
                <td>{{ $phieuNhap->MaPhieu }}</td>
                <td>{{ $phieuNhap->Ngaylap }}</td>
                <td>{{ $phieuNhap->Dongia }}</td>
                <td>{{ $phieuNhap->SoLuong }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
