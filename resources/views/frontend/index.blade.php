@extends('frontend.layouts.app')

@section('content')
    <style>
        .custom_scroll::-webkit-scrollbar {
            display: none;
        }
    </style>
    <!-- START SECTION BANNER -->
    <div class="mt-4 staggered-animation-wrap">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-7 offset-lg-3">
                    @if (get_setting('home_slider_images') != null)
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                            @foreach ($slider_images as $key => $value)
                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                                    <div>
                                        <img src="{{ uploaded_asset($slider_images[$key]) }}" alt="" width="100%" height="497" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                    </div>
                                    
                                </a>
                            </div>
                            
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    @endif
                </div>
                @php
                    $num_todays_deal = count(filter_products(\App\Product::where('published', 1)->where('todays_deal', 1 ))->get());
                @endphp
                <div class="col-lg-2 d-none d-lg-block">
                    @if($num_todays_deal > 0)
                        <div class="custom_scroll" style="height: 497px; overflow-y: scroll;">
                            @foreach (filter_products(\App\Product::where('published', 1)->where('todays_deal', '1'))->get() as $key => $product)
                                @if ($product != null)
                                    <div class="shop_banner2 {{$key == 1 ? 'el_banner2' : 'el_banner1' }} {{$key == 3 ? 'el_banner2' : 'el_banner1' }} {{$key == 5 ? 'el_banner2' : 'el_banner1' }} {{$key == 7 ? 'el_banner2' : 'el_banner1' }} {{$key == 9 ? 'el_banner2' : 'el_banner1' }}">
                                        <a href="{{ route('product', $product->slug) }}" class="hover_effect1">
                                            <div class="el_title text_white">
                                                <h6>{{ Str::limit($product->getTranslation('name'), 35, $end='...') }}</h6>
                                                <span>
                                                    <span style="font-size: 12.5px;">{{ home_discounted_base_price($product->id) }}</span>
                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="" style="font-size: 11px; color: red;">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="el_img">
                                                <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->getTranslation('name') }}">
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION BANNER -->

    <div class="main_content">
        <!-- START SECTION SHOP -->
        <div class="section small_pt pb-0">
            <div class="custom-container">
                <div class="row">
                    <div class="col-xl-3 d-none d-xl-block">
                        <div class="sale-banner">
                            <a class="hover_effect1" href="#">
                                <img src="{{ static_asset('assets/images/shop_banner_img6.jpg') }}" alt="shop_banner_img6">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading_tab_header">
                                    <div class="heading_s2">
                                        <h4>Exclusive Products</h4>
                                    </div>
                                    <div class="tab-style2">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tabmenubar" aria-expanded="false"> 
                                            <span class="ion-android-menu"></span>
                                        </button>
                                        <ul class="nav nav-tabs justify-content-center justify-content-md-end" id="tabmenubar" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="arrival-tab" data-toggle="tab" href="#arrival" role="tab" aria-controls="arrival" aria-selected="true">New Arrival</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="featured-tab" data-toggle="tab" href="#featured" role="tab" aria-controls="featured" aria-selected="false">Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="tab_slider">
                                    <div class="tab-pane fade show active" id="arrival" role="tabpanel" aria-labelledby="arrival-tab">
                                        <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                                            @foreach (filter_products(\App\Product::where('published', 1)->orderBy('created_at', 'desc')->limit(8))->get() as $key => $product)
                                                <div class="item">
                                                    <div class="product_wrap">
                                                        <div class="product_img">
                                                            <a href="{{ route('product', $product->slug) }}">
                                                                <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                                <img class="product_hover_img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                            </a>
                                                            <div class="product_action_box">
                                                                <ul class="list_none pr_action_btn">
                                                                    {{-- <li><a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})"><i class="icon-basket-loaded"></i> Add To Cart</a></li> --}}

                                                                    <li><a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})"><i class="icon-shuffle"></i></a></li>
                                                                    {{-- <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li> --}}
                                                                    <li><a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="product_info">
                                                            <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a></h6>
                                                            <div class="product_price">
                                                                <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                                @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                                    <del>{{ home_base_price($product->id) }}</del>
                                                                    @php
                                                                        $unitprice = \App\Product::find($product->id)->unit_price;
                                                                        $purchaseprice = \App\Product::find($product->id)->purchase_price;
                                                                        $diff = $unitprice - $purchaseprice;
                                                                        $offpercentage = ($diff / $unitprice) * 100;
                                                                    @endphp
                                                                    <div class="on_sale">
                                                                        <span>{{floor($offpercentage)}}% Off</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="rating_wrap">
                                                                {{ renderStarRating($product->rating) }}
                                                                @php
                                                                    $total = 0;
                                                                    $rating = 0;
                                                                    foreach ($product->user->products as $key => $seller_product) {
                                                                        $total += $seller_product->reviews->count();
                                                                        $rating += $seller_product->reviews->sum('rating');
                                                                    }
                                                                @endphp
                                                                
                                                                <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                                        <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                                            @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1')->limit(8))->get() as $key => $product)
                                                <div class="item">
                                                    <div class="product_wrap">
                                                        <div class="product_img">
                                                            <a href="{{ route('product', $product->slug) }}">
                                                                <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                                <img class="product_hover_img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                            </a>

                                                            {{-- <a  data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                                                                <i class="las la-shopping-cart"></i> --}}

                                                            <div class="product_action_box">
                                                                <ul class="list_none pr_action_btn">
                                                                    {{-- <li><a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})"><i class="icon-basket-loaded"></i> Add To Cart</a></li> --}}

                                                                    <li><a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})"><i class="icon-shuffle"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="product_info">
                                                            <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a></h6>
                                                            <div class="product_price">
                                                                <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                                @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                                    <del>{{ home_base_price($product->id) }}</del>
                                                                    @php
                                                                        $unitprice = \App\Product::find($product->id)->unit_price;
                                                                        $purchaseprice = \App\Product::find($product->id)->purchase_price;
                                                                        $diff = $unitprice - $purchaseprice;
                                                                        $offpercentage = ($diff / $unitprice) * 100;
                                                                    @endphp
                                                                    <div class="on_sale">
                                                                        <span>{{floor($offpercentage)}}% Off</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="rating_wrap">
                                                                {{ renderStarRating($product->rating) }}
                                                                @php
                                                                    $total = 0;
                                                                    $rating = 0;
                                                                    foreach ($product->user->products as $key => $seller_product) {
                                                                        $total += $seller_product->reviews->count();
                                                                        $rating += $seller_product->reviews->sum('rating');
                                                                    }
                                                                @endphp
                                                                
                                                                <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION SHOP -->
        
        <!-- START SECTION BANNER --> 
        @if (get_setting('home_banner1_images') != null)
            <div class="section pb_20 small_pt">
                <div class="custom-container">
                    @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                    <div class="row">
                        @foreach ($banner_1_imags as $key => $value)
                            <div class="col-md-4">
                                <div class="sale-banner mb-3 mb-md-4">
                                    <a class="hover_effect1" href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}">
                                        <img src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" height="250px">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <!-- END SECTION BANNER --> 

        <!-- START SECTION Flash Deal -->
        @php
            $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();
        @endphp
       
        @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
            <div class="section pt-0 pb-0">
                <div class="custom-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_tab_header">
                                <div class="heading_s2">
                                    <h4>Deal Of The Day</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product_slider carousel_slider owl-carousel owl-theme nav_style3" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "1"}, "650":{"items": "2"}, "1199":{"items": "2"}}'>
                                @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                                    @php
                                        $product = \App\Product::find($flash_deal_product->product_id);
                                    @endphp
                                    @if ($product != null && $product->published != 0)
                                        

                                        <div class="item">
                                            <div class="deal_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product', $product->slug) }}">
                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        alt="{{  $product->getTranslation('name')  }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';" height="300px">
                                                    </a>
                                                </div>
                                                <div class="deal_content">
                                                    <div class="product_info">
                                                        <h5 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  Str::limit($product->getTranslation('name'), 50, $end='...')  }}</a></h5>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="product_price" style="float: left;">
                                                                    <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                                        <del>{{ home_base_price($product->id) }}</del>
                                                                    @endif
                                                                </div>
                                                                <div style="float: right;">
                                                                    {{ renderStarRating($product->rating) }} ({{\App\Review::where('product_id', $product->id)->get()->count()}})
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="deal_progress mb-2">
                                                        @php
                                                            $qty = 0;
                                                            if($product->variant_product){
                                                                foreach ($product->stocks as $key => $stock) {
                                                                    $qty += $stock->qty;
                                                                }
                                                            }
                                                            else{
                                                                $qty = $product->current_stock;
                                                            }
                                                        @endphp
                                                        @if ($qty > 0)
                                                            <span class="stock-sold"><span class="badge badge-md badge-inline badge-pill badge-success">{{ translate('In stock')}}</span></span>
                                                        @else
                                                            <span class="stock-sold"><span class="badge badge-md badge-inline badge-pill badge-danger">{{ translate('Out of stock')}}</span></span>
                                                        @endif

                                                        @if($product->stock_visibility_state != 'hide')
                                                            <span class="stock-available">Available: <strong>{{ $qty }} </strong>{{translate('items')}}</span>
                                                        @endif
                                                    </div>

                                                    <div class="countdown_time countdown_style4 mb-4" data-time="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- END SECTION Flash Deal -->
        
        <!-- START SECTION Trending -->
        @if (\App\BusinessSetting::where('type', 'best_selling')->first()->value == 1)                    
            <div class="section small_pt small_pb">
                <div class="custom-container">
                    <div class="row">
                        <div class="col-xl-3 d-none d-xl-block">
                            <div class="sale-banner">
                                <a class="hover_effect1" href="#">
                                    <img src="{{ static_asset('assets/images/shop_banner_img10.jpg') }}" alt="shop_banner_img10">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9">
                            <div class="row">
                                <div class="col-12">
                                    <div class="heading_tab_header">
                                        <div class="heading_s2">
                                            <h4>Trending products</h4>
                                        </div>
                                        {{-- <div class="view_all">
                                            <a href="#" class="text_default"><i class="linearicons-power"></i> <span>View All</span></a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                                        @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(12)->get() as $key => $product)
                                            <div class="item">
                                                <div class="product_wrap">
                                                    <div class="product_img">
                                                        <a href="{{ route('product', $product->slug) }}">
                                                            <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                            <img class="product_hover_img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                        </a>

                                                        <div class="product_action_box">
                                                            <ul class="list_none pr_action_btn">
                                                                <li><a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})"><i class="icon-basket-loaded"></i> Add To Cart</a></li>

                                                                <li><a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})"><i class="icon-shuffle"></i></a></li>
                                                                {{-- <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li> --}}
                                                                <li><a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product_info">
                                                        <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a></h6>
                                                        <div class="product_price">
                                                            <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                                <del>{{ home_base_price($product->id) }}</del>
                                                                @php
                                                                    $unitprice = \App\Product::find($product->id)->unit_price;
                                                                    $purchaseprice = \App\Product::find($product->id)->purchase_price;
                                                                    $diff = $unitprice - $purchaseprice;
                                                                    $offpercentage = ($diff / $unitprice) * 100;
                                                                @endphp
                                                                <div class="on_sale">
                                                                    <span>{{floor($offpercentage)}}% Off</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="rating_wrap">
                                                            {{ renderStarRating($product->rating) }}
                                                            {{-- @php
                                                                $total = 0;
                                                                $rating = 0;
                                                                foreach ($product->user->products as $key => $seller_product) {
                                                                    $total += $seller_product->reviews->count();
                                                                    $rating += $seller_product->reviews->sum('rating');
                                                                }
                                                            @endphp --}}
                                                            
                                                            <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- END SECTION Trending -->
        <!-- START SECTION CLIENT LOGO -->
        @if (get_setting('top10_categories') != null)
            <div class="section pt-0 small_pb">
                <div class="custom-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_tab_header">
                                <div class="heading_s2">
                                    <h4>Our Brands</h4>
                                </div>
                                {{-- <a href="#" style="float: right;">See All</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="client_logo carousel_slider owl-carousel owl-theme nav_style3" data-dots="false" data-nav="true" data-margin="30" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}, "1199":{"items": "6"}}'>
                                @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
                                @foreach ($top10_brands as $key => $value)
                                    @php $brand = \App\Brand::find($value); @endphp
                                    @if ($brand != null)
                                        <div class="item">
                                            <a href="{{ route('products.brand', $brand->slug) }}" title="{{ $brand->getTranslation('name') }}">
                                                <div class="cl_logo">
                                                    <img src="{{ uploaded_asset($brand->logo) }}"
                                                    alt="{{ $brand->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';" height="100px" />
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- END SECTION CLIENT LOGO -->

        <!-- START SECTION SHOP -->
        <div class="section pt-0 pb_20">
            <div class="custom-container">
                <div class="row">
                    {{-- Featured Products --}}
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading_tab_header">
                                    <div class="heading_s2">
                                        <h4>Featured Products</h4>
                                    </div>
                                    {{-- <div class="view_all">
                                        <a href="#" class="text_default"><span>View All</span></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="product_slider carousel_slider product_list owl-carousel owl-theme nav_style5" data-nav="true" data-dots="false" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "380":{"items": "1"}, "640":{"items": "2"}, "991":{"items": "1"}}'>
                                    <div class="item">
                                        @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->take(3)->get() as $key => $product)
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product', $product->slug) }}">
                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                        <img class="product_hover_img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    </a>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a></h6>
                                                    <div class="product_price">
                                                        <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del>{{ home_base_price($product->id) }}</del>
                                                            @php
                                                                $unitprice = \App\Product::find($product->id)->unit_price;
                                                                $purchaseprice = \App\Product::find($product->id)->purchase_price;
                                                                $diff = $unitprice - $purchaseprice;
                                                                $offpercentage = ($diff / $unitprice) * 100;
                                                            @endphp
                                                            <div class="on_sale">
                                                                <span>{{floor($offpercentage)}}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="rating_wrap">
                                                        {{ renderStarRating($product->rating) }}
                                                        
                                                        <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="item">
                                        @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->skip(3)->take(3)->get() as $key => $product)
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product', $product->slug) }}">
                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                        <img class="product_hover_img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    </a>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a></h6>
                                                    <div class="product_price">
                                                        <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del>{{ home_base_price($product->id) }}</del>
                                                            @php
                                                                $unitprice = \App\Product::find($product->id)->unit_price;
                                                                $purchaseprice = \App\Product::find($product->id)->purchase_price;
                                                                $diff = $unitprice - $purchaseprice;
                                                                $offpercentage = ($diff / $unitprice) * 100;
                                                            @endphp
                                                            <div class="on_sale">
                                                                <span>{{floor($offpercentage)}}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="rating_wrap">
                                                        {{ renderStarRating($product->rating) }}
                                                        
                                                        <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Top Rated Products --}}
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading_tab_header">
                                    <div class="heading_s2">
                                        <h4>Top Rated Products</h4>
                                    </div>
                                    {{-- <div class="view_all">
                                        <a href="#" class="text_default"><span>View All</span></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="product_slider carousel_slider product_list owl-carousel owl-theme nav_style5" data-nav="true" data-dots="false" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "380":{"items": "1"}, "640":{"items": "2"}, "991":{"items": "1"}}'>
                                    <div class="item">
                                        @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale','DESC'))->take(3)->get() as $key => $product)
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product', $product->slug) }}">
                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                        <img class="product_hover_img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    </a>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a></h6>
                                                    <div class="product_price">
                                                        <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del>{{ home_base_price($product->id) }}</del>
                                                            @php
                                                                $unitprice = \App\Product::find($product->id)->unit_price;
                                                                $purchaseprice = \App\Product::find($product->id)->purchase_price;
                                                                $diff = $unitprice - $purchaseprice;
                                                                $offpercentage = ($diff / $unitprice) * 100;
                                                            @endphp
                                                            <div class="on_sale">
                                                                <span>{{floor($offpercentage)}}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="rating_wrap">
                                                        {{ renderStarRating($product->rating) }}
                                                        
                                                        <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="item">
                                        @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale','DESC'))->skip(3)->take(3)->get() as $key => $product)
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product', $product->slug) }}">
                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                        <img class="product_hover_img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    </a>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a></h6>
                                                    <div class="product_price">
                                                        <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del>{{ home_base_price($product->id) }}</del>
                                                            @php
                                                                $unitprice = \App\Product::find($product->id)->unit_price;
                                                                $purchaseprice = \App\Product::find($product->id)->purchase_price;
                                                                $diff = $unitprice - $purchaseprice;
                                                                $offpercentage = ($diff / $unitprice) * 100;
                                                            @endphp
                                                            <div class="on_sale">
                                                                <span>{{floor($offpercentage)}}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="rating_wrap">
                                                        {{ renderStarRating($product->rating) }}
                                                        
                                                        <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- On Sale Products --}}
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading_tab_header">
                                    <div class="heading_s2">
                                        <h4>On Sale Products</h4>
                                    </div>
                                    {{-- <div class="view_all">
                                        <a href="#" class="text_default"><span>View All</span></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="product_slider carousel_slider product_list owl-carousel owl-theme nav_style5" data-nav="true" data-dots="false" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "380":{"items": "1"}, "640":{"items": "2"}, "991":{"items": "1"}}'>
                                    <div class="item">
                                        @foreach (filter_products(\App\Product::where('published', 1)->where('discount', '>', 0)->orderBy('created_at','ASC'))->take(3)->get() as $key => $product)
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product', $product->slug) }}">
                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                        <img class="product_hover_img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    </a>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a></h6>
                                                    <div class="product_price">
                                                        <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del>{{ home_base_price($product->id) }}</del>
                                                            @php
                                                                $unitprice = \App\Product::find($product->id)->unit_price;
                                                                $purchaseprice = \App\Product::find($product->id)->purchase_price;
                                                                $diff = $unitprice - $purchaseprice;
                                                                $offpercentage = ($diff / $unitprice) * 100;
                                                            @endphp
                                                            <div class="on_sale">
                                                                <span>{{floor($offpercentage)}}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="rating_wrap">
                                                        {{ renderStarRating($product->rating) }}
                                                        
                                                        <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="item">
                                        @foreach (filter_products(\App\Product::where('published', 1)->where('discount', '>', 0)->orderBy('created_at','ASC'))->skip(3)->take(3)->get() as $key => $product)
                                            <div class="product_wrap">
                                                <div class="product_img">
                                                    <a href="{{ route('product', $product->slug) }}">
                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                        <img class="product_hover_img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    </a>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a></h6>
                                                    <div class="product_price">
                                                        <span class="price">{{ home_discounted_base_price($product->id) }}</span>
                                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del>{{ home_base_price($product->id) }}</del>
                                                            @php
                                                                $unitprice = \App\Product::find($product->id)->unit_price;
                                                                $purchaseprice = \App\Product::find($product->id)->purchase_price;
                                                                $diff = $unitprice - $purchaseprice;
                                                                $offpercentage = ($diff / $unitprice) * 100;
                                                            @endphp
                                                            <div class="on_sale">
                                                                <span>{{floor($offpercentage)}}% Off</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="rating_wrap">
                                                        {{ renderStarRating($product->rating) }}
                                                        
                                                        <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION SHOP -->

        
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });

            @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
            @endif
        });
    </script>
@endsection
