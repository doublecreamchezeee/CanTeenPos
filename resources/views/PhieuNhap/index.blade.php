@extends('layouts.admin')

@section('title','Danh sách Phiếu Nhập')
@section('content-header','Danh sách Phiếu Nhập')

@section('content-actions')
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPhieuNhapModal">Thêm Phiếu Nhập</button>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.min.css')}}"> 
@endsection

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Mã Phiếu</th>
                <th>Mã Nhân Viên</th>
                <th>Ngày Nhập</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <!-- Dữ liệu của Phiếu Nhập sẽ được hiển thị ở đây -->
        <tbody>
            <!-- Dùng vòng lặp để hiển thị danh sách Phiếu Nhập -->
            @foreach ($phieuNhaps as $phieuNhap)
                <tr>
                    <td>{{$phieuNhap->MaNV}}</td>
                    <td>{{$phieuNhap->MaPhieu}}</td>
                    <td>{{$phieuNhap->MaSp}}</td>
                    <!-- Thêm nút thao tác hoặc xem chi tiết tại đây -->
                    <td>
                        <!-- Thêm các nút hoặc thao tác cho Phiếu Nhập -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<!-- Thêm scripts cần thiết cho Phiếu Nhập nếu có -->
@endsection


