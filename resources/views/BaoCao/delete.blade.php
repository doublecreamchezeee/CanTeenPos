@extends('layouts.admin')

@section('title', 'Xóa Báo Cáo')

@section('content-header', 'Xóa Báo Cáo')

@section('content')
<form action="{{ route('BaoCao.destroy', $baoCaos->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <p>Bạn có thực sự muốn xóa báo cáo này?</p>
    
    <button class="btn btn-danger" type="submit">Xóa</button>
</form>
@endsection
