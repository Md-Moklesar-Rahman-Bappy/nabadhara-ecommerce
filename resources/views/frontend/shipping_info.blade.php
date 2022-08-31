@extends('frontend.layouts.app')

@section('content')


<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-4">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Checkout</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section pt-0">
	<div class="container">
        <div class="row">
            <div class="col-12">
            	<div class="medium_divider"></div>
            	<div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
            	<div class="medium_divider"></div>
            </div>
        </div>

        <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="heading_s1">
                        <h4>Billing and Shipping Details</h4>
                    </div>
                    <div class="form-group">
                        <label for="">Name *</label>
                        <input type="text" class="form-control" name="name" value="{{Auth()->user()->name}}" placeholder="{{ translate('Your full name')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Email *</label>
                        <input type="text" class="form-control" name="email" value="{{Auth()->user()->email}}" placeholder="{{ translate('Your email')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Full Address *</label>
                        <input type="text" class="form-control" name="address" value="{{Auth()->user()->address}}" placeholder="{{ translate('Enter your full address')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Country *</label>
                        <div class="custom_select">
                            <select class="form-control" name="country" required>
                                <option value="">Select Country</option>
                                @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        @if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'area_wise_shipping')
                            <label for="">City *</label>
                            <select class="form-control" name="city" required>
                                <option value="">Select City</option>
                                @foreach (\App\City::get() as $key => $city)
                                    <option value="{{ $city->name }}">{{ $city->getTranslation('name') }}</option>
                                @endforeach
                            </select>
                        @else
                            <label for="">City *</label>
                            <input type="text" class="form-control" placeholder="{{ translate('Enter your city')}}" value="{{Auth()->user()->city}}" name="city" required>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Post Code *</label>
                        <input type="text" class="form-control" value="{{Auth()->user()->postal_code}}" placeholder="{{ translate('Enter Postal code')}}" name="postal_code" required>
                    </div>

                    <div class="form-group">
                        <label for="number">Phone *</label>
                        <input type="number" lang="en" min="0" class="form-control" value="{{Auth()->user()->phone}}" placeholder="{{ translate('Enter phone')}}" name="phone" required>
                    </div>

                    @if (Auth()->check())
                        <input type="hidden" name="checkout_type" value="logged">
                    @else
                        <input type="hidden" name="checkout_type" value="guest">
                    @endif
                    
                    {{-- <div class="heading_s1">
                        <h4>Additional information</h4>
                    </div>
                    <div class="form-group mb-0">
                        <textarea rows="5" class="form-control" placeholder="Order notes"></textarea>
                    </div> --}}

                    @php
                        $admin_products = array();
                        $seller_products = array();
                        foreach (Session::get('cart') as $key => $cartItem){
                            if(\App\Product::find($cartItem['id'])->added_by == 'admin'){
                                array_push($admin_products, $cartItem['id']);
                            }
                            else{
                                $product_ids = array();
                                if(array_key_exists(\App\Product::find($cartItem['id'])->user_id, $seller_products)){
                                    $product_ids = $seller_products[\App\Product::find($cartItem['id'])->user_id];
                                }
                                array_push($product_ids, $cartItem['id']);
                                $seller_products[\App\Product::find($cartItem['id'])->user_id] = $product_ids;
                            }
                        }
                    @endphp

                    <div style="display: ;">
                        
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="heading_s1">
                            <h4>Your Orders</h4>
                        </div>
                        <div class="table-responsive order_table">
                            @php
                                $total = 0;
                                $tax = 0;
                                $shipping = 0;
                                $product_shipping_cost = 0;
                                //$shipping_region = Session::get('shipping_info')['city'];
                            @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td>{{ $product_name_with_choice }} <span class="product-qty">x {{ $cartItem['quantity'] }}</span></td>
                                            <td>{{ single_price(($cartItem['price']+$cartItem['tax'])*$cartItem['quantity']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>{{translate('Sub Total')}}</th>
                                        <td>{{ single_price($total) }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{translate('Tax')}}</th>
                                        <td>{{single_price($tax)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{translate('Shipping')}}</th>
                                        <td>{{single_price($shipping)}}</td>
                                    </tr>
                                    @if (Session::has('club_point'))
                                        <tr>
                                            <th>{{translate('Redeem point')}}</th>
                                            <td>{{ single_price(Session::get('club_point')) }}</td>
                                        </tr>
                                    @endif
                                    @if (Session::has('coupon_discount'))
                                    <tr>
                                        <th>{{translate('Coupon Discount')}}</th>
                                        <td>{{single_price(Session::get('coupon_discount'))}}</td>
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
                                        <th>{{translate('Total')}}</th>
                                        <td><strong>{{ single_price($total) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div>
                        <div class="payment_method">
                            <div class="heading_s1">
                                <h4>Payment</h4>
                            </div>
                            <div class="payment_option">
                                @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                    @php
                                        $digital = 0;
                                        $cod_on = 1;
                                        foreach(Session::get('cart') as $cartItem){
                                            if($cartItem['digital'] == 1){
                                                $digital = 1;
                                            }
                                            if($cartItem['cash_on_delivery'] == 0){
                                                $cod_on = 0;
                                            }
                                        }
                                    @endphp
                                    @if($digital != 1 && $cod_on == 1)
                                        <div class="custome-radio">
                                            <input class="form-check-input online_payment" required="" type="radio" name="payment_option" id="cashondelivery" value="cash_on_delivery" checked>
                                            <label class="form-check-label" for="cashondelivery">{{ translate('Cash on Delivery')}}</label>
                                            <p data-method="option3" class="payment-text"></p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <button type="submit" name="owner_id" value="{{ App\User::where('user_type', 'admin')->first()->id }}" class="btn btn-fill-out btn-block">{{ translate('Place Order')}}</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->



{{-- <section class="mb-4">
    <div class="container text-left">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
                    @csrf

                    @if(Auth::check())
                        <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                <div class="shadow-sm bg-white p-4 rounded mb-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ translate('Name')}}</label>
                                        <input type="text" class="form-control" name="name" placeholder="{{ translate('Name')}}" required>
                                    </div>
    
                                    <div class="form-group">
                                        <label class="control-label">{{ translate('Email')}}</label>
                                        <input type="text" class="form-control" name="email" placeholder="{{ translate('Email')}}" required>
                                    </div>
    
                                    <div class="form-group">
                                        <label class="control-label">{{ translate('Address')}}</label>
                                        <input type="text" class="form-control" name="address" placeholder="{{ translate('Address')}}" required>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ translate('Select your country')}}</label>
                                                <select class="form-control aiz-selectpicker" data-live-search="true" name="country">
                                                    @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                @if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'area_wise_shipping')
                                                    <label class="control-label">{{ translate('City')}}</label>
                                                    <select class="form-control aiz-selectpicker" data-live-search="true" name="city" required>
                                                        @foreach (\App\City::get() as $key => $city)
                                                            <option value="{{ $city->name }}">{{ $city->getTranslation('name') }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <label class="control-label">{{ translate('City')}}</label>
                                                    <input type="text" class="form-control" placeholder="{{ translate('City')}}" name="city" required>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">{{ translate('Postal code')}}</label>
                                                <input type="text" class="form-control" placeholder="{{ translate('Postal code')}}" name="postal_code" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">{{ translate('Phone')}}</label>
                                                <input type="number" lang="en" min="0" class="form-control" placeholder="{{ translate('Phone')}}" name="phone" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="checkout_type" value="logged">
                                </div>
                                
                                
                            </div>
                        </div>
                        @else
                            <div class="shadow-sm bg-white p-4 rounded mb-4">
                                <div class="form-group">
                                    <label class="control-label">{{ translate('Name')}}</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ translate('Name')}}" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{ translate('Email')}}</label>
                                    <input type="text" class="form-control" name="email" placeholder="{{ translate('Email')}}" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{ translate('Address')}}</label>
                                    <input type="text" class="form-control" name="address" placeholder="{{ translate('Address')}}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{ translate('Select your country')}}</label>
                                            <select class="form-control aiz-selectpicker" data-live-search="true" name="country">
                                                @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            @if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'area_wise_shipping')
                                                <label class="control-label">{{ translate('City')}}</label>
                                                <select class="form-control aiz-selectpicker" data-live-search="true" name="city" required>
                                                    @foreach (\App\City::get() as $key => $city)
                                                        <option value="{{ $city->name }}">{{ $city->getTranslation('name') }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <label class="control-label">{{ translate('City')}}</label>
                                                <input type="text" class="form-control" placeholder="{{ translate('City')}}" name="city" required>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{ translate('Postal code')}}</label>
                                            <input type="text" class="form-control" placeholder="{{ translate('Postal code')}}" name="postal_code" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{ translate('Phone')}}</label>
                                            <input type="number" lang="en" min="0" class="form-control" placeholder="{{ translate('Phone')}}" name="phone" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="checkout_type" value="guest">
                            </div>
                    @endif

                    
                    @php
                        $admin_products = array();
                        $seller_products = array();
                        foreach (Session::get('cart') as $key => $cartItem){
                            if(\App\Product::find($cartItem['id'])->added_by == 'admin'){
                                array_push($admin_products, $cartItem['id']);
                            }
                            else{
                                $product_ids = array();
                                if(array_key_exists(\App\Product::find($cartItem['id'])->user_id, $seller_products)){
                                    $product_ids = $seller_products[\App\Product::find($cartItem['id'])->user_id];
                                }
                                array_push($product_ids, $cartItem['id']);
                                $seller_products[\App\Product::find($cartItem['id'])->user_id] = $product_ids;
                            }
                        }
                    @endphp

                    <div class="card mb-3 shadow-sm border-0 rounded">
                        <div class="card-header p-3">
                            <h5 class="fs-16 fw-600 mb-0">{{ get_setting('site_name') }} {{ translate('Products') }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($admin_products as $key => $cartItem)
                                @php
                                    $product = \App\Product::find($cartItem);
                                @endphp
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <span class="mr-2">
                                            <img
                                                src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                class="img-fit size-60px rounded"  height="100px"
                                                alt="{{  $product->getTranslation('name')  }}"
                                            >
                                        </span>
                                        <span class="fs-14 opacity-60">{{ $product->getTranslation('name') }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                            <div class="row border-top pt-3">
                                <div class="col-md-6">
                                    <h6 class="fs-15 fw-600">{{ translate('Choose Delivery Type') }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row gutters-5">
                                        <div class="col-6">
                                            <label class="aiz-megabox d-block bg-white mb-0">
                                                <input
                                                    type="radio"
                                                    name="shipping_type_{{ \App\User::where('user_type', 'admin')->first()->id }}"
                                                    value="home_delivery"
                                                    onchange="show_pickup_point(this)"
                                                    data-target=".pickup_point_id_admin"
                                                    checked
                                                >
                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                    <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <label class="aiz-megabox d-block bg-white mb-0">
                                                <input
                                                    type="radio"
                                                    name="shipping_type_{{ \App\User::where('user_type', 'admin')->first()->id }}"
                                                    value="pickup_point"
                                                    onchange="show_pickup_point(this)"
                                                    data-target=".pickup_point_id_admin"
                                                >
                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                    <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-4 pickup_point_id_admin d-none">
                                        <select
                                            class="form-control aiz-selectpicker"
                                            name="pickup_point_id_{{ \App\User::where('user_type', 'admin')->first()->id }}"
                                            data-live-search="true"
                                        >
                                                <option>{{ translate('Select your nearest pickup point')}}</option>
                                            @foreach (\App\PickupPoint::where('pick_up_status',1)->get() as $key => $pick_up_point)
                                                <option
                                                    value="{{ $pick_up_point->id }}"
                                                    data-content="<span class='d-block'>
                                                                    <span class='d-block fs-16 fw-600 mb-2'>{{ $pick_up_point->getTranslation('name') }}</span>
                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ $pick_up_point->getTranslation('address') }}</span>
                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i>{{ $pick_up_point->phone }}</span>
                                                                </span>"
                                                >
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-footer justify-content-end">
                            
                        </div>
                    </div>

                    @if (!empty($seller_products))
                        @foreach ($seller_products as $key => $seller_product)
                            <div class="card mb-3 shadow-sm border-0 rounded">
                                <div class="card-header p-3">
                                    <h5 class="fs-16 fw-600 mb-0">{{ \App\Shop::where('user_id', $key)->first()->name }} {{ translate('Products') }}</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($seller_product as $cartItem)
                                        @php
                                            $product = \App\Product::find($cartItem);
                                        @endphp
                                        <li class="list-group-item">
                                            <div class="d-flex">
                                                <span class="mr-2">
                                                    <img
                                                        src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        class="img-fit size-60px rounded" height="100px"
                                                        alt="{{  $product->getTranslation('name')  }}"
                                                    >
                                                </span>
                                                <span class="fs-14 opacity-60">{{ $product->getTranslation('name') }}</span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                        <div class="row border-top pt-3">
                                            <div class="col-md-6">
                                                <h6 class="fs-15 fw-600">{{ translate('Choose Delivery Type') }}</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row gutters-5">
                                                    <div class="col-6">
                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio"
                                                                name="shipping_type_{{ $key }}"
                                                                value="home_delivery"
                                                                onchange="show_pickup_point(this)"
                                                                data-target=".pickup_point_id_{{ $key }}"
                                                                checked
                                                            >
                                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    @if (is_array(json_decode(\App\Shop::where('user_id', $key)->first()->pick_up_point_id)))
                                                    <div class="col-6">
                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio"
                                                                name="shipping_type_{{ $key }}"
                                                                value="pickup_point"
                                                                onchange="show_pickup_point(this)"
                                                                data-target=".pickup_point_id_{{ $key }}"
                                                            >
                                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    @endif
                                                </div>
                                                @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                    @if (is_array(json_decode(\App\Shop::where('user_id', $key)->first()->pick_up_point_id)))
                                                    <div class="mt-4 pickup_point_id_{{ $key }} d-none">
                                                        <select
                                                            class="form-control aiz-selectpicker"
                                                            name="pickup_point_id_{{ $key }}"
                                                            data-live-search="true"
                                                        >
                                                                <option>{{ translate('Select your nearest pickup point')}}</option>
                                                            @foreach (json_decode(\App\Shop::where('user_id', $key)->first()->pick_up_point_id) as $pick_up_point)
                                                                @if (\App\PickupPoint::find($pick_up_point) != null)
                                                                <option
                                                                    value="{{ \App\PickupPoint::find($pick_up_point)->id }}"
                                                                    data-content="<span class='d-block'>
                                                                                    <span class='d-block fs-16 fw-600 mb-2'>{{ \App\PickupPoint::find($pick_up_point)->getTranslation('name') }}</span>
                                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ \App\PickupPoint::find($pick_up_point)->getTranslation('address') }}</span>
                                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i> {{ \App\PickupPoint::find($pick_up_point)->phone }}</span>
                                                                                </span>"
                                                                >
                                                                </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer justify-content-end">
                                    <button type="submit" name="owner_id" value="{{ $key }}" class="btn fw-600 btn-primary">{{ translate('Continue to Payment')}}</a>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-header p-3">
                            <h3 class="fs-16 fw-600 mb-0">
                                {{ translate('Select a payment option')}}
                            </h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-xxl-8 col-xl-10 mx-auto">
                                    <div class="row gutters-10">
                                        @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                            @php
                                                $digital = 0;
                                                $cod_on = 1;
                                                foreach(Session::get('cart') as $cartItem){
                                                    if($cartItem['digital'] == 1){
                                                        $digital = 1;
                                                    }
                                                    if($cartItem['cash_on_delivery'] == 0){
                                                        $cod_on = 0;
                                                    }
                                                }
                                            @endphp
                                            @if($digital != 1 && $cod_on == 1)
                                                <div class="col-6 col-md-4">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="cash_on_delivery" class="online_payment" type="radio" name="payment_option" checked>
                                                        <span class="d-block p-3 aiz-megabox-elem">
                                                            <img src="{{ static_asset('assets/img/cards/cod.png')}}" class="img-fluid mb-2">
                                                            <span class="d-block text-center">
                                                                <span class="d-block fw-600 fs-15">{{ translate('Cash on Delivery')}}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endif
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>

                            @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                <div class="bg-white border mb-3 p-3 rounded text-left d-none">
                                    <div id="manual_payment_description">

                                    </div>
                                </div>
                            @endif
                            {{-- @if (Auth::check() && \App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                                <div class="separator mb-3">
                                    <span class="bg-white px-3">
                                        <span class="opacity-60">{{ translate('Or')}}</span>
                                    </span>
                                </div>
                                <div class="text-center py-4">
                                    <div class="h6 mb-3">
                                        <span class="opacity-80">{{ translate('Your wallet balance :')}}</span>
                                        <span class="fw-600">{{ single_price(Auth::user()->balance) }}</span>
                                    </div>
                                    @if(Auth::user()->balance < $total)
                                        <button type="button" class="btn btn-secondary" disabled>{{ translate('Insufficient balance')}}</button>
                                    @else
                                        <button  type="button" onclick="use_wallet()" class="btn btn-primary fw-600">{{ translate('Pay with wallet')}}</button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="pt-3">
                        <label class="aiz-checkbox">
                            <input type="checkbox" required id="agree_checkbox">
                            <span class="aiz-square-check"></span>
                            <span>{{ translate('I agree to the')}}</span>
                        </label>
                        <a href="{{ route('terms') }}">{{ translate('terms and conditions')}}</a>,
                        <a href="{{ route('returnpolicy') }}">{{ translate('return policy')}}</a> &
                        <a href="{{ route('privacypolicy') }}">{{ translate('privacy policy')}}</a>
                    </div>

                    <div class="row align-items-center pt-3">
                        <div class="col-6">
                            <a href="{{ route('home') }}" class="link link--style-3">
                                <i class="las la-arrow-left"></i>
                                {{ translate('Return to shop')}}
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" name="owner_id" value="{{ App\User::where('user_type', 'admin')->first()->id }}" class="btn fw-600 btn-primary">{{ translate('Place Order')}}</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                @include('frontend.partials.cart_summary')
            </div>
        </div>
    </div>
</section> --}}


@endsection

@section('modal')
<div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ translate('New Address')}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Address')}}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{ translate('Your Address')}}" rows="1" name="address" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Country')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="country" required>
                                    <option value="">Select Country</option>
                                    @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'area_wise_shipping')
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('City')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city" required>
                                        
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('City')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="{{ translate('Your City')}}" name="city" value="" required>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Postal code')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Phone')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('+880')}}" name="phone" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{  translate('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('New Address') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" id="edit_modal_body">

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">

    function edit_address(address) {
        var url = '{{ route("addresses.edit", ":id") }}';
        url = url.replace(':id', address);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'GET',
            success: function (response) {
                $('#edit_modal_body').html(response);
                $('#edit-address-modal').modal('show');
                AIZ.plugins.bootstrapSelect('refresh');
                var country = $("#edit_country").val();
                get_city(country);
            }
        });
    }
    

    function submitOrder(el){
            $(el).prop('disabled', true);
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                AIZ.plugins.notify('danger','{{ translate('You need to agree with our policies') }}');
                $(el).prop('disabled', false);
            }
        }
    

    $(document).on('change', '[name=country]', function() {
        var country = $(this).val();
        get_city(country);
    });
    
    function get_city(country) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-city')}}",
            type: 'POST',
            data: {
                country_name: country
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="city"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
    
    function add_new_address(){
        $('#new-address-modal').modal('show');
    }
    
</script>
@endsection
