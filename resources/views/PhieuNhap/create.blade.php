@extends('layouts.admin')

@section('title','Tạo Phiếu Nhập')

@section('content-header','Tạo Phiếu Nhập')

@section('content')
    <form action="{{ route('PhieuNhap.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="MaNV">Mã NV</label>
            <input type="text" class="form-control" id="MaNV" name="MaNV" value="{{ Auth::id() }}" readonly>
        </div>
        <div class="form-group">
            <label for="MaSp">Mã Sp</label>
            <input type="text" class="form-control" id="MaSp" name="MaSp">
        </div>
        <div class="form-group">
            <label for="MaPhieu">Mã Phiếu</label>
            <input type="text" class="form-control" id="MaPhieu" name="MaPhieu">
        </div>

        <div class="form-group">
            <label for="Ngaylap">Ngày lập</label>
            <input type="datetime-local" class="form-control" id="Ngaylap" name="Ngaylap" value="{{ now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d\TH:i') }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="Dongia">Đơn giá</label>
            <input type="number" class="form-control" id="Dongia" name="Dongia">
        </div>
        <div class="form-group">
            <label for="SoLuong">Số lượng</label>
            <input type="number" class="form-control" id="SoLuong" name="SoLuong">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
