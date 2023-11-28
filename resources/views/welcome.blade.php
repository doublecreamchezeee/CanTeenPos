@extends('layouts.menu')

@section('content')
<!-- Vacations -->
<section class="tiles">
								<article class="style1">
									<span class="image">
										<img src="{{('images/product-1-720x480.jpg') }}" alt="" />
									</span>
									<a href="#">
										<h2>Lorem ipsum dolor sit amet, consectetur</h2>
										
										<p><del>$11.00</del> <strong> $9.95</strong></p>

										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, aspernatur?
		                                </p>
									</a>
								</article>
								<article class="style2">
									<span class="image">
										<img src="{{('images/product-2-720x480.jpg') }}" alt="" />
									</span>
									<a href="#">
										<h2>Lorem ipsum dolor sit amet, consectetur</h2>
										
										<p><del>$11.00</del> <strong> $9.95</strong></p>

										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, ea.
		                                </p>
									</a>
								</article>
								<article class="style3">
									<span class="image">
										<img src="{{('images/product-3-720x480.jpg') }}" alt="" />
									</span>
									<a href="#">
										<h2>Lorem ipsum dolor sit amet, consectetur</h2>
										
										<p><del>$11.00</del> <strong> $9.95</strong></p>

										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, qui.
		                                </p>
									</a>
								</article>

								<article class="style4">
									<span class="image">
										<img src="{{('images/product-4-720x480.jpg') }}" alt="" />
									</span>
									<a href="#">
										<h2>Lorem ipsum dolor sit amet, consectetur</h2>
										
										<p><del>$11.00</del> <strong> $9.95</strong></p>

										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos, non!
		                                </p>
									</a>
								</article>

								<article class="style5">
									<span class="image">
										<img src="{{('images/product-5-720x480.jpg') }}" alt="" />
									</span>
									<a href="#">
										<h2>Lorem ipsum dolor sit amet, consectetur</h2>
										
										<p><del>$11.00</del> <strong> $9.95</strong></p>

										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, nam.
		                                </p>
									</a>
								</article>

								<article class="style6">
									<span class="image">
										<img src="{{('images/product-6-720x480.jpg') }}" alt="" />
									</span>
									<a href="#">
										<h2>Lorem ipsum dolor sit amet, consectetur</h2>
										
										<p><del>$11.00</del> <strong> $9.95</strong></p>

										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, quod.
		                                </p>
									</a>
								</article>
							</section>



							<div class="card product-list">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Barcode</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    {{-- <td><img class="product-img" src="{{ asset('storage/' . $product->image) }}" alt=""></td>                    <td><img class="product-img" src="{{ Storage::url('app/' . $product->image) }}" alt=""></td> --}}
                    <td><img class="product-img" src="{{ Storage::url('public/' . $product->image) }}" alt=""></td>

                    <td>{{$product->barcode}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>

                    
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->render()}}
    </div>
</div>
@endsection