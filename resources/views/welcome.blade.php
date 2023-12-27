@extends('layouts.menu')

@section('content')
@include('guest.flash-message')

<h1>Menu đa dạng các món ăn trong ngày!</h1>
<form action="" class="form-inline">
	<div class="center-text">Nếu bạn cần tìm kiếm món ăn:</div>

	<div class="form-group">
		<input clas="form-control" name="key" placeholder="Search">
		<button type="submit" class="btn btn-pdefault">
			<i class="fa fa-search" aria-hidden="true"></i>
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
				<a href="javascript:void(0)" 
					id="show-detail"
					data-url="{{ route('detail', $product->id) }}">

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

