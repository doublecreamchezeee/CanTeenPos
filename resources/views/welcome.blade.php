@extends('layouts.menu')

@section('content')


<!-- Vacations -->
<section class="tiles">
	@foreach ($products as $product)
								<article class="style3">
									<span class="image">
										<img src="{{ Storage::url('public/' . $product->image) }}" alt="" />
									</span>
									<a href="#">
										<h2>{{$product->name}}</h2>
										
										<p><strong>{{$product->price}}</strong></p>

										<p>
											{{$product->description}}
		                                </p>
									</a>
								</article>
	@endforeach

	{{ $products->render()}}

</section>


							
@endsection
