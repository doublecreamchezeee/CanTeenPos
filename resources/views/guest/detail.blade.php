<!-- Modal -->
<div class="modal fade" id="proModal" tabindex="-1" role="dialog">
	<div class="modal-dialog custom-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('CHI TIẾT MÓN ĂN') }}</h2>
                <button type="button" class="btn" data-bs-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="modal-content-wrapper">
                <div class="large-7 columns">
                    <img id="image" src="" alt="Product Image">
                </div>

                <div class="large-3 columns">
                    <h3><span class='name'></span></h3>
                    <h4>
                        <span class='price'></span>
                        <span class="woocommerce-Price-currencySymbol">₫</span>
                    </h4>
                    <p>Số lượng còn lại: <span class='quantity'></span></p>
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

			<div class='modal-footer'>
			</div>
        </div>
    </div>
</div>

<style>
.custom-modal-dialog {
    width: auto;
    height: auto;
}

#image {
    max-width: 100%;
    height: auto;
}
</style>