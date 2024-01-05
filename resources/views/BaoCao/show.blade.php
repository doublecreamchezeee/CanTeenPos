@extends('layouts.admin')

@section('title', 'Chi Tiết Báo Cáo')

@section('content-header', 'Chi Tiết Báo Cáo')

@section('content')
    <div class="container">
        <h2>Thông tin chi tiết Báo Cáo</h2>
        <ul>
            <li><strong>Mã Báo Cáo:</strong> {{ $baoCao->MaBaoCao }}</li>
            <li><strong>Mã Nhân Viên:</strong> {{ $baoCao->MaNV }}</li>
            <li><strong>Thời Gian Lập Báo Cáo:</strong> {{ $baoCao->ThoiGianLap }}</li>
            <li><strong>Giai Đoạn Báo Cáo:</strong> {{ $baoCao->GiaiDoanBaoCao }}</li>
            <li><strong>Tổng Doanh Thu:</strong> {{ $baoCao->TongDoanhThu }}</li>
            <!-- Add more details as needed -->
        </ul>
    </div>
@endsection
