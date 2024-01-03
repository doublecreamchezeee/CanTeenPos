@extends('layouts.admin')

@section('title','Cập nhật Phiếu Nhập')

@section('content-header','Cập nhật Phiếu Nhập')

@section('content')
    <form action="{{ route('PhieuNhap.update', $phieuNhap->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="MaNV">Mã NV</label>
            <input type="text" class="form-control" id="MaNV" name="MaNV" value="{{ $phieuNhap->MaNV }}">
        </div>
        <div class="form-group">
            <label for="MaSp">Mã Sp</label>
            <input type="text" class="form-control" id="MaSp" name="MaSp" value="{{ $phieuNhap->MaSp }}">
        </div>
        <div class="form-group">
            <label for="MaPhieu">Mã Phiếu</label>
            <input type="text" class="form-control" id="MaPhieu" name="MaPhieu" value="{{ $phieuNhap->MaPhieu }}">
        </div>
        <div class="form-group">
            <label for="Dongia">Đơn giá</label>
            <input type="number" class="form-control" id="Dongia" name="Dongia" value="{{ $phieuNhap->Dongia }}">
        </div>
        <div class="form-group">
            <label for="Ngaylap">Ngày lập</label>
            <input type="date" class="form-control" id="Ngaylap" name="Ngaylap" value="{{ $phieuNhap->Ngaylap }}">
        </div>
        <div class="form-group">
            <label for="SoLuong">Số lượng</label>
            <input type="number" class="form-control" id="SoLuong" name="SoLuong" value="{{ $phieuNhap->SoLuong }}">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
