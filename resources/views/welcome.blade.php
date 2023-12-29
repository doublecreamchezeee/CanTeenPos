@extends('layouts.menu')

@section('content')
@include('guest.flash-message')

<h1>Menu đa dạng các món ăn trong ngày!</h1>
<p>Đa dạng các món ăn và giàu chất dinh dưỡng. Ngoài ra còn có các loại nước ngọt và bánh trái,...</p>

<p>Nếu bạn cần tìm kiếm món ăn:</p>

<form action="" class="form-inline">
	<div class="form-group">
    	<input class="form-control input-lg" id="inputlg" name="key" type="text" placeholder="Nhập tên món">
		<button type="submit" class="btn btn-pdefault">
			Search
		</button>
	</div>
</form>

<br>
<!-- Vacations -->
<section class="tiles">
@if (isset($products))
	@if ($products->isEmpty()) 
		<h5>Không tìm thấy món ăn, vui lòng nhập tên khác hoặc trở lại menu để chọn món!</h5>
	@else
		@foreach ($products as $product)
			<article class="style3">
				<span class="image">
					<img src="{{ Storage::url('public/' . $product->image) }}" alt="" />
				</span>
				<a href="#"
					class='show_detail'
					data-bs-toggle="modal" 
					data-bs-target="#proModal"
					data-id="{{ $product->id }}"
					data-name="{{ $product->name }}"
					data-price="{{ $product->price }}"
					data-quantity="{{ $product->quantity }}"
					data-image="{{ Storage::url('public/' . $product->image) }}">

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
	@endif
@endif
</section>

@endsection





@section('script')
<script>
	$(document).on('click','.show_detail',function(e)
	{
		let name = $(this).data('name');
		let price = $(this).data('price');
		let quantity = $(this).data('quantity');
		let image = $(this).data('image');

		$('.name').text(name);
		$('.price').text(price);
		$('.quantity').text(quantity);
		$('#image').attr('src',image);

	});
	
</script>
@endsection