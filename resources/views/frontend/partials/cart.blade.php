<li class="dropdown cart_dropdown">
    <a class="nav-link cart_trigger" href="#" data-toggle="dropdown">
        @if(Route::currentRouteName() == 'home')
            <i class="linearicons-bag2"></i>
        @else
            <i class="linearicons-cart"></i>
        @endif
        @if(Session::has('cart'))
            <span class="cart_count">{{ count(Session::get('cart'))}}</span>
        @else
            <span class="cart_count">0</span>
        @endif
        @if (Session::has('cart'))
            @if (count($cart = Session::get('cart')) > 0)
                @php
                    $total = 0;
                @endphp
                @foreach($cart as $key => $cartItem)
                    @php
                        $product = \App\Product::find($cartItem['id']);
                        $total = $total + $cartItem['price']*$cartItem['quantity'];
                    @endphp
                @endforeach
                <span class="amount"><span class="currency_symbol"></span>{{ single_price($total) }}</span>
            @endif
        @endif
    </a>
    <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
        @if (Session::has('cart'))
            @if (count($cart = Session::get('cart')) > 0)
                <ul class="cart_list">
                    @php
                        $total = 0;
                    @endphp
                    @foreach($cart as $key => $cartItem)
                        @php
                            $product = \App\Product::find($cartItem['id']);
                            $total = $total + $cartItem['price']*$cartItem['quantity'];
                        @endphp
                        @if ($product != null)
                            <li>
                                <a href="javascript:void(0)" onclick="removeFromCart({{ $key }})" class="item_remove"><i class="ion-close"></i></a>
                                <a href="{{ route('product', $product->slug) }}"><img
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                    class="img-fit lazyload size-60px rounded"
                                    alt="{{  $product->getTranslation('name')  }}"
                                >
                                {{  $product->getTranslation('name')  }}</a>
                                <span class="cart_quantity"> {{ $cartItem['quantity'] }}x <span class="cart_amount"> <span class="price_symbole"></span></span>{{ single_price($cartItem['price']) }}</span>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="cart_footer">
                    <p class="cart_total"><strong>{{translate('Subtotal')}}:</strong> <span class="cart_price"> <span class="price_symbole"></span></span>{{ single_price($total) }}</p>
                    <p class="cart_buttons">
                        <a href="{{ route('cart') }}" class="btn btn-fill-line view-cart">{{translate('View cart')}}</a> 
                        @if (Auth::check())
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-fill-out checkout">{{translate('Checkout')}}</a>
                        @endif
                    </p>
                </div>
            @else
                <div class="text-center p-3">
                    <i class="fa fa-frown fa-3x opacity-60 mb-3"></i>
                    <h3 class="h6 fw-700">{{translate('Your Cart is empty')}}</h3>
                </div>
            @endif
        @else
            <div class="text-center p-3">
                <i class="fa fa-frown fa-3x opacity-60 mb-3"></i>
                <h3 class="h6 fw-700">{{translate('Your Cart is empty')}}</h3>
            </div>
        @endif
    </div>
</li>