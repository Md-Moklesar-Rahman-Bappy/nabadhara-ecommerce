@extends('frontend.layouts.app')

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-4">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Shopping Cart</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Shopping Cart</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section pt-5">
    @if ( Session::has('cart') && count(Session::get('cart')) > 0 )
	<div class="container" id="cart-summary">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive shop_cart_table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">{{ translate('Product')}}</th>
                                <th class="product-price">{{ translate('Price')}}</th>
                                <th class="product-quantity">{{ translate('Quantity')}}</th>
                                <th class="product-subtotal">{{ translate('Total')}}</th>
                                <th class="product-remove">{{ translate('Remove')}}</th>
                            </tr>
                        </thead>
                        <tbody>  
                            @php
                                $total = 0;
                                $tax = 0;
                                $shipping = 0;
                                $product_shipping_cost = 0;
                                //$shipping_region = Session::get('shipping_info')['city'];
                            @endphp

                            @foreach (Session::get('cart') as $key => $cartItem)
                                @php
                                $product = \App\Product::find($cartItem['id']);
                                $total = $total + $cartItem['price']*$cartItem['quantity'];
                                $tax += $cartItem['tax']*$cartItem['quantity'];
                                if(isset($cartItem['shipping']) && is_array(json_decode($cartItem['shipping'], true))) {
                                    foreach(json_decode($cartItem['shipping'], true) as $shipping_info => $val) {
                                        if($shipping_region == $shipping_info) {
                                            $product_shipping_cost = (double) $val;
                                        }
                                    }
                                } else {
                                    $product_shipping_cost = (double) $cartItem['shipping'];
                                }
                                
                                if($product->is_quantity_multiplied == 1 && get_setting('shipping_type') == 'product_wise_shipping') {
                                    $product_shipping_cost = $product_shipping_cost * $cartItem['quantity'];
                                }
                                
                                $shipping += $product_shipping_cost;
                                $product_name_with_choice = $product->getTranslation('name');

                                if ($cartItem['variant'] != null) {
                                    $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variant'];
                                }
                                @endphp
                                <tr>
                                    <td class="product-thumbnail"><a href="#"><img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}"></a></td>
                                    <td class="product-name" data-title="Product"><a href="#">{{ $product_name_with_choice }}</a></td>
                                    <td class="product-price" data-title="Price">{{ single_price($cartItem['price']) }}</td>

                                    <td class="product-quantity" data-title="Quantity">
                                        @if($cartItem['digital'] != 1)
                                            <div class="row align-items-center aiz-plus-minus">
                                                <button class="btn btn-sm btn-light" style="border-radius: 50%; padding: 7px;" type="button" data-type="minus" data-field="quantity[{{ $key }}]">
                                                    <i class="fa fa-minus ml-1"></i>
                                                </button>
                                                <input type="text" name="quantity[{{ $key }}]" class="col border-0 text-center flex-grow-1 input-number" placeholder="1" style="width: 25px;" value="{{ $cartItem['quantity'] }}" min="1" max="10" readonly onchange="updateQuantity({{ $key }}, this)">

                                                <button class="btn btn-sm btn-light" style="border-radius: 50%; padding: 7px;" type="button" data-type="plus" data-field="quantity[{{ $key }}]">
                                                    <i class="fa fa-plus ml-1"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="product-subtotal" data-title="Total">{{ single_price(($cartItem['price']+$cartItem['tax'])*$cartItem['quantity']) }}</td>
                                    <td class="product-remove" data-title="Remove"><a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $key }})"><i class="ti-close"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="px-0">
                                    <div class="row no-gutters align-items-center">
                                        @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1)
                                            @if (Session::has('coupon_discount'))
                                                <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                                    <form class="" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="coupon field_form input-group">
                                                            <input type="text" value="{{ \App\Coupon::find(Session::get('coupon_id'))->code }}" class="form-control form-control-sm" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-fill-out btn-sm" type="submit">{{translate('Remove Coupon')}}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                                    <form action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    
                                                        <div class="coupon field_form input-group">
                                                            <input type="text" name="code" class="form-control form-control-sm" placeholder="{{translate('Have coupon code? Enter here')}}" required>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-fill-out btn-sm" type="submit">{{translate('Apply Coupon')}}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                        <div class="d-none d-lg-block col-lg-4"></div>
                                       
                                        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                            @if (Session::has('club_point'))
                                                <div class="col-lg-4 col-md-6 text-center">
                                                    <form class="" action="{{ route('checkout.remove_club_point') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="input-group">
                                                            <input type="text" value="{{ Session::get('club_point')}}" class="form-control form-control-sm" name="point" readonly>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-fill-out btn-sm">{{translate('Remove Redeem Point')}}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @else
                                                @if(Auth::user()->point_balance > 0)
                                                    <div class="col-lg-4 col-md-6 text-center">
                                                        <form class="" action="{{ route('checkout.apply_club_point') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="input-group">
                                                                <input type="text" class="form-control form-control-sm" name="point" placeholder="{{translate('Enter club point here')}}" required>
                                                                <div class="input-group-append">
                                                                    <button type="submit" class="btn btn-fill-out btn-sm">{{translate('Redeem')}}</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @if(isset(Auth::user()->point_balance))
                                                            <div class="mt-2 float-left">
                                                                {{translate('Points Available')}}:
                                                                {{ Auth::user()->point_balance }}
                                                            </div class="mt-2 float-left">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            	<div class="medium_divider"></div>
            	<div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
            	<div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
        	{{-- <div class="col-md-6" style="display: none;">
            	<div class="heading_s1 mb-3">
            		<h6>Calculate Shipping</h6>
                </div>
                <form class="field_form shipping_calculator">
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <div class="custom_select">
                                <select class="form-control">
                                    <option value="">Choose a option...</option>
                                    <option value="AX">Aland Islands</option>
                                    <option value="AF">Afghanistan</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AQ">Antarctica</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="ZW">Zimbabwe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <input required="required" placeholder="State / Country" class="form-control" name="name" type="text">
                        </div>
                        <div class="form-group col-lg-6">
                            <input required="required" placeholder="PostCode / ZIP" class="form-control" name="name" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <button class="btn btn-fill-line" type="submit">Update Totals</button>
                        </div>
                    </div>
                </form>
            </div> --}}
            <div class="col-md-6 offset-md-3">
            	<div class="border p-3 p-md-4">
                    
                    <div class="heading_s1 mb-3">
                        <h6>Cart Totals</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">{{translate('Cart Subtotal')}}</td>
                                    <td class="cart_total_amount">{{ single_price($total) }}</td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">{{translate('Tax')}}</td>
                                    <td class="cart_total_amount">{{single_price($tax)}}</td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">{{translate('Shipping')}}</td>
                                    <td class="cart_total_amount">{{single_price($shipping)}}</td>
                                </tr>
                                @if (Session::has('club_point'))
                                    <tr>
                                        <td class="cart_total_label">{{translate('Redeem point')}}</td>
                                        <td class="cart_total_amount">{{ single_price(Session::get('club_point')) }}</td>
                                    </tr>
                                @endif
                                @if (Session::has('coupon_discount'))
                                <tr>
                                    <td class="cart_total_label">{{translate('Coupon Discount')}}</td>
                                    <td class="cart_total_amount">{{single_price(Session::get('coupon_discount'))}}</td>
                                </tr>
                                @endif
                                
                                <tr>
                                    @php
                                        $total = $total+$tax+$shipping;
                                        if(Session::has('club_point')) {
                                            $total -= Session::get('club_point');
                                        }
                                        if(Session::has('coupon_discount')){
                                            $total -= Session::get('coupon_discount');
                                        }
                                    @endphp
                                    <td class="cart_total_label">{{translate('Total')}}</td>
                                    <td class="cart_total_amount"><strong>{{ single_price($total) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="text-align: center;">
                        @if(Auth::check())
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-fill-out">{{ translate('Proceed To CheckOut')}}</a>
                        @else
                            <button class="btn btn-fill-out" onclick="showCheckoutModal()">{{ translate('Continue to Shipping')}}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="row">
            <div class="col-xl-8 mx-auto">
                    <div class="text-center p-3">
                        <i class="fa fa-frown fa-3x opacity-60 mb-3"></i>
                        <h3 class="h4 fw-700">{{translate('Your Cart is empty')}}</h3>
                    </div>
            </div>
        </div>           
    @endif

    <div class="modal fade" id="GuestCheckout">
        <div class="modal-dialog modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fw-600">{{ translate('Login')}}</h3>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="bg-white p-2">
                        <form role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <input type="text" required="" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" placeholder="{{ translate('Email Or Phone')}}">
                                @else
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <span class="opacity-60" style="font-size: 11.5px;">{{  translate('Use country code before number') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="form-control" required="" type="password" name="password" placeholder="{{ translate('Password')}}">
                            </div>
                            <div class="login_footer form-group">
                                <div class="chek-form">
                                    <div class="custome-checkbox aiz-checkbox">
                                        <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" style="user-select: none;" for="exampleCheckbox1"><span>{{  translate('Remember Me') }}</span></label>
                                    </div>
                                </div>
                                <a href="{{ route('password.request') }}">{{ translate('Forgot password?')}}</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-fill-out btn-block" name="login">{{  translate('Log in') }}</button>
                            </div>
                        </form>
                        <div class="different_login">
                            <span> or</span>
                        </div>
                        <ul class="btn-login list_none text-center">
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                <div class="separator mb-3">
                                    <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                </div>
                                <ul class="list-inline social colored text-center mb-3">
                                    @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                        <li>
                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a>
                                        </li>
                                    @endif
                                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                        <li>
                                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </ul>
                        <div class="form-note text-center">{{ translate('Dont have an account?')}} <a href="{{ route('user.registration') }}">{{ translate('Sign up now')}}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->

@endsection

@section('modal')
    
@endsection

@section('script')
    <script type="text/javascript">
    function removeFromCartView(e, key){
        e.preventDefault();
        removeFromCart(key);
    }

    function updateQuantity(key, element){
        $.post('{{ route('cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', key:key, quantity: element.value}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
        });
    }

    function showCheckoutModal(){
        $('#GuestCheckout').modal();
    }
    </script>
@endsection
