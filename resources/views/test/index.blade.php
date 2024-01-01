@extends('layouts.admin')

@section('title','Test List')
@section('content-header','Test List')


@section('content-actions')
{{-- <a href="{{route('products.create')}}" class="btn btn-primary">Create</a> --}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.min.css')}}"> 
@endsection

@section('content')
<div class="card product-list">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
