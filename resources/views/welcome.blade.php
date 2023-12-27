@extends('layouts.menu')

@section('content')
<h1>Menu đa dạng các món ăn trong ngày!</h1>
<p>Đa dạng các món ăn và giàu chất dinh dưỡng. Ngoài ra còn có các loại nước ngọt và bánh trái,...</p>

<p>Nếu bạn cần tìm kiếm món ăn:</p>
<form action="" method="GET">
	<div class="row">
		<div class="col-md-3">
			<label>Filter by Type</label>
			<select name="types" id="">
				<option value="">Select Type</option>
				
			</select>
		</div>
	</div>
</form>

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
		<h3>Không tìm thấy món ăn, vui lòng nhập tên khác hoặc trở lại menu để chọn món!</h3>
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

	@endif
@endif

@endsection

@include('guest.detail')


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