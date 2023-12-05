<form action="" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="modal fade text-left" id="GuestDetail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('CHI TIẾT MÓN ĂN') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="block-UGps8oCAEA" class="pdp-block pdp-block__main-information" bis_skin_checked="1">
                        <div id="block-QLGDQBLP44" class="pdp-block pdp-block__gallery" bis_skin_checked="1">
                            <div id="module_item_gallery_1" class="pdp-block module" bis_skin_checked="1">
                                <div class="item-gallery" data-spm="gallery" bis_skin_checked="1">
                                    <div class="gallery-preview-panel" bis_skin_checked="1">
                                        <div class="gallery-preview-panel__content gallery-preview-panel__content_video" bis_skin_checked="1">
                                            <img class="pdp-mod-common-image gallery-preview-panel__image" alt="Deere Jack Women Pleated Shoulder Bags Elegant Ladies Girls Handbag Chain Bag Cellphone Bag Shopping Travel Work Bags" src="{{ Storage::url('public/' . $product->image) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>