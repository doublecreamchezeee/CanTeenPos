@extends('layouts.menu')

@section('content')


<!-- Vacations -->
<section class="tiles">
	@foreach ($products as $product)
								<article class="style3">
									<span class="image">
										<img src="{{ Storage::url('public/' . $product->image) }}" alt="" />
									</span>
									<a href="#" data-toggle='modal' data-target='#GuestDetail' 
										imgURL="{{Storage::url('public/' . $product->image)}}" 
										namePro="{{$product->name}}"
									>
										<h2>{{$product->name}}</h2>
										
										<p><strong>{{$product->price}}</strong></p>

										<p>
											{{$product->description}}
		                                </p>
									</a>
								</article>
	@endforeach

	{{ $products->render()}}
@include('guest.detail')
</section>


							
@endsection

@section('script')
	var name = $(this).data('namePro')

	$('#GuestDetail').find('.modal-body')

	$('#GuestDetail').modal('show')
@endsection
