@extends('layouts.admin')

@section('title','Tạo Báo Cáo')

@section('content-header','Tạo Báo Cáo')

@section('content')
    <form action="{{ route('BaoCao.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="MaNV">Mã NV</label>
            <input type="text" class="form-control" id="MaNV" name="MaNV" value="{{ Auth::id() }}" readonly>
        </div>
        <div class="form-group">
            <label for="MaBaoCao">Mã Báo Cáo</label>
            <input type="text" class="form-control" id="MaBaoCao" name="MaBaoCao">
        </div>
        <div class="form-group">
            <label for="ThoiGianLap">Ngày lập</label>
            <input type="datetime-local" class="form-control" id="ThoiGianLap" name="ThoiGianLap" value="{{ now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d\TH:i') }}" >
        </div>
        
        <div class="form-group">
            <label for="GiaiDoanBaoCao">Giai Đoạn Báo Cáo</label>
            <select name="GiaiDoanBaoCao" id="GiaiDoanBaoCao" class="form-control" required >
                <option value="bc_ngay">Ngày</option>
                <option value="bc_thang">Tháng</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
