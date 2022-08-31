<div class="modal-body added-to-cart">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <i class="fa fa-check-circle fa-3x"></i>
                        <h3>{{ translate('Item added to your cart!')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-8 offset-lg-2 text-center">
                       <img src="{{ uploaded_asset($product->thumbnail_img) }}" data-src="" height="100px" style="" alt="Product Image"> 
                       <br><br>

                        <h6>{{  $product->getTranslation('name')  }}</h6>
                        
                        <span>{{ translate('Price')}}:</span>
                        <strong>
                            {{ single_price(($data['price']+$data['tax'])*$data['quantity']) }}
                        </strong>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="text-center">
                        <button class="btn btn-outline-primary mb-3 mb-sm-0" data-dismiss="modal">{{ translate('Back to shopping')}}</button>
                        <a href="{{ route('cart') }}" class="btn btn-primary mb-3 mb-sm-0">{{ translate('Proceed to Checkout')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
