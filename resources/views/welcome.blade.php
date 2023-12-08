@extends('layouts.menu')

@section('content')
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
							</p>
						</div>

						<div class="woocommerce-variation-add-to-cart variations_button woocommerce-variation-add-to-cart-disabled">
							<button type="submit" class="single_add_to_cart_button button alt disabled wc-variation-selection-needed">Add to cart</button>
							<input type="hidden" name="add-to-cart">
							<div class="quantity buttons_added">
								<input type="button" value="-" class="minus">
								<input type="number" id="quantity_6572ecb056853" class="input-text qty text" step="1" min="0" max="" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="">
								<input type="button" value="+" class="plus">
							</div>
						</div>

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

			})

		})

    });

</script>
@endsection