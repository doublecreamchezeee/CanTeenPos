@extends('layouts.admin')

@section('title','Tạo Phiếu Nhập')

@section('content-header','Tạo Phiếu Nhập')

@section('content')
    <form action="{{ route('PhieuNhap.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="MaNV">Mã NV</label>
            <input type="text" class="form-control" id="MaNV" name="MaNV">
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
            <input type="date" class="form-control" id="Ngaylap" name="Ngaylap">
        </div>
        <div class="form-group">
            <label for="SoLuong">Don Gia</label>
            <input type="number" class="form-control" id="Dongia" name="Dongia">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
