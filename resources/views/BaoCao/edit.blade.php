@extends('layouts.admin')

@section('title', 'Cập nhật Báo Cáo')

@section('content-header', 'Cập nhật Báo Cáo')

@section('content')
<form action="{{ route('BaoCao.edit', $baoCao->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="MaBaoCao">Mã Báo Cáo</label>
        <input type="text" name="MaBaoCao" class="form-control @error('MaBaoCao') is-invalid @enderror"
            id="MaBaoCao" placeholder="Report Code" value="{{ $baoCao->MaBaoCao }}">
        @error('MaBaoCao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="MaNV">Mã Nhân Viên</label>
        <input type="text" name="MaNV" class="form-control @error('MaNV') is-invalid @enderror"
            id="MaNV" placeholder="Employee Code" value="{{ $baoCao->MaNV }}">
        @error('MaNV')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="ThoiGianLap">Thời Gian Lập Báo Cáo</label>
        <input type="datetime-local" name="ThoiGianLap" class="form-control @error('ThoiGianLap') is-invalid @enderror"
            id="ThoiGianLap" placeholder="Time Created" value="{{ $baoCao->ThoiGianLap }}">
        @error('ThoiGianLap')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="GiaiDoanBaoCao">Giai Đoạn Báo Cáo</label>
        <input type="text" name="GiaiDoanBaoCao" class="form-control @error('GiaiDoanBaoCao') is-invalid @enderror"
            id="GiaiDoanBaoCao" placeholder="Report Stage" value="{{ $baoCao->GiaiDoanBaoCao }}">
        @error('GiaiDoanBaoCao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="TongDoanhThu">Tổng Doanh Thu</label>
        <input type="number" name="TongDoanhThu" class="form-control @error('TongDoanhThu') is-invalid @enderror"
            id="TongDoanhThu" placeholder="Total Revenue" value="{{ $baoCao->TongDoanhThu }}">
        @error('TongDoanhThu')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <!-- Add more fields for other report details -->

    <button class="btn btn-primary" type="submit">Cập nhật</button>
</form>
@endsection

@section('scripts')
<!-- Include necessary scripts for reports -->
@endsection
