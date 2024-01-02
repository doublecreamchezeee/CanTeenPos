@extends('layouts.admin')

@section('title','Danh sách Phiếu Nhập')
@section('content-header','Danh sách Phiếu Nhập')

@section('content-actions')
    <a href="{{route('PhieuNhap.create')}}" class="btn btn-primary">Thêm Phiếu Nhập</a>
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
                    <td>{{$phieuNhap->MaPhieu}}</td>
                    <td>{{$phieuNhap->MaNV}}</td>
                    <td>{{$phieuNhap->Ngaylap}}</td>
                    <!-- Thêm nút thao tác hoặc xem chi tiết tại đây -->
                    <td>
                        <!-- Thêm các nút hoặc thao tác cho Phiếu Nhập -->
                            <a href="{{ route('PhieuNhap.show', $phieuNhap->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('PhieuNhap.edit', $phieuNhap->id) }}" class="btn btn-warning">Update</a>
                            <form action="{{ route('PhieuNhap.destroy', $phieuNhap->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
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
<!-- Thêm scripts cần thiết cho Phiếu Nhập nếu có -->
@endsection


