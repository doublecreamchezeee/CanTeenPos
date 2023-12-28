@extends('layouts.menu')

@section('content')
@include('guest.flash-message')

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
</section>

<!-- Modal -->
<div class="modal fade" id="showDetail" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('CHI TIẾT MÓN ĂN') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="large-7 columns">
					<div class="slide first is-selected" style="position: absolute; left: 0%;" bis_skin_checked="1">
                		<img src="product-img" alt="">
                	</div>

				</div>

				<div class="large-5 columns">
					<div class="product-lightbox-inner product-info">
						<h3 itemprop="name" class="entry-title"><span id="product-name"></span></h3>
						<div class="tx-div small" bis_skin_checked="1"></div>
						<div itemprop="offers" itemscope="">
							<p class="price"><span class="woocommerce-Price-amount amount">
								<span id="product-price"></span>&nbsp;
								<span class="woocommerce-Price-currencySymbol">₫</span>
								<p>Số lượng còn lại: <span id="product-quantity"></span></p>
							</p>
						</div>
						<form action="/cart/add" method="post">
							@csrf
							<input type="hidden" name="id" value="{{ $product->id}}">
							<input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}">
							@if ($product->quantity == 0)
								<button type="submit" class="single_add_to_cart_button button alt" disabled>Add to cart</button>
							@else
								<button type="submit" class="single_add_to_cart_button button alt">Add to cart</button>
							@endif
						</form>
					</div>			
				</div>
            </div>
        </div>
    </div>
</div>					
@endsection

@include('guest.detail')


@section('script')
<script type="text/javascript">

    $(document).ready(function() {
        
		$('body').on('click', '#show-detail', function() {
			var proURL = $(this).data('url');
			$.get(proURL, function (data) {
				$('#showDetail').modal('show');
				$('#product-img').attr('src', data.image);
				$('#product-name').text(data.name);
				$('#product-price').text(data.price);
				$('input[name="id"]').val(data.id); // Cập nhật giá trị của input hidden
				$('#product-quantity').text(data.quantity); // Cập nhật số lượng còn lại

				// Định dạng giá sản phẩm
				var formattedPrice = Number(data.price).toLocaleString('en');
            	$('#product-price').text(formattedPrice);

				// Cập nhật trạng thái của nút "Add to cart"
				if (data.quantity == 0) {
                	$('.single_add_to_cart_button').prop('disabled', true);
				} else {
					$('.single_add_to_cart_button').prop('disabled', false);
				}
			})
		})
    });

</script>
@endsection

