@extends('layouts.admin')

@section('title','Receipt List')
@section('content-header','Receipt List')


@section('content-actions')
<a href="{{route('receipts.create')}}" class="btn btn-primary">Create</a>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.min.css')}}"> 
@endsection

@section('content')

<div class="card receipt-list">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total cost</th>
                    <th>List product</th>
                    <th>Payment type</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($receipts as $receipt)
                <tr>
                    <td>{{$receipt->id}}</td>
                    <td>{{$receipt->total_cost}}</td>
                    <td>KKK</td>
                    <td>{{$receipt->payment_type}}</td>

                    <td>
                        <span class="right badge badge-{{ $receipt->status ? 'success' : 'danger' }}">{{$receipt->status ? 'Paid' : 'Unpaid'}}</span>
                    </td>
                    <td>{{$receipt->created_at}}</td>
                    <td>
                        <a href="{{ route('receipts.edit', $receipt) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('receipts.destroy', $receipt)}}"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $receipts->render()}}
    </div>
</div>
@endsection
    
@section('scripts')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="module">
    $(document).ready(function() {
        $(document).on('click', '.btn-delete', function() {
            var $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this receipt?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.post($this.data('url'), {
                        _method: 'DELETE',
                        _token: '{{csrf_token()}}'
                    }, function(res) {
                        $this.closest('tr').fadeOut(500, function() {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>
@endsection