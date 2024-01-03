@extends('layouts.menu') <!-- Kế thừa file menu.blade.php trong thư mục layouts, dùng header và footer -->

@section('content')
<link rel="stylesheet" href="{{ asset('css/wheel.css') }}">

<h1 style="text-align:center;">Nhấn spin để vận mệnh chọn món cho bạn (≧◡≦) </h1>
<div id="container">
    <div id="wheelOfFortune">
        <canvas id="wheel" width="300" height="300"></canvas>
        <div id="spin">SPIN asd asd asd as dasd as dasd asd asd as d</div>
    </div>
    <div id="message"></div> 
</div>
<script>
const sectorsFromPHP = @json($foods);
</script>    
<script src="{{ asset('js/wheel.js') }}"></script>
@endsection
