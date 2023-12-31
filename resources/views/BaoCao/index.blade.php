@extends('layouts.admin')

@section('title','Danh sách Phiếu Báo Cáo')
@section('content-header','Danh sách Phiếu Báo Cáo')

@section('content-actions')
    <a href="{{route('BaoCao.create')}}" class="btn btn-primary">Thêm Báo Cáo</a>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.min.css')}}"> 
@endsection

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Mã Báo Cáo</th>
                <th>Mã Nhân Viên</th>
                <th>Thời Gian Lập</th>
                <th>Giai Đoạn Báo Cáo</th>
                <th>Tổng Doanh Thu</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <!-- Dữ liệu của Phiếu Báo Cáo sẽ được hiển thị ở đây -->
        <tbody>
            <!-- Dùng vòng lặp để hiển thị danh sách Phiếu Báo Cáo -->
            @foreach ($baoCaos as $baoCao)
                <tr>
                    <td>{{$baoCao->MaBaoCao}}</td>
                    <td>{{$baoCao->MaNV}}</td>
                    <td>{{$baoCao->ThoiGianLap}}</td>
                    <td>{{$baoCao->GiaiDoanBaoCao}}</td>
                    <td>{{$baoCao->TongDoanhThu}}</td>
                    <!-- Thêm nút thao tác hoặc xem chi tiết tại đây -->
                    <td>
                        <a href="{{ route('BaoCao.edit', $baoCao->id) }}" class="btn btn-warning">Update</a>
                        <form action="{{ route('BaoCao.destroy', $baoCao->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<!-- Thêm scripts cần thiết cho Phiếu Báo Cáo nếu có -->
@endsection
