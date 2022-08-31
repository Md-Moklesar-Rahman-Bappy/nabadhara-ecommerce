@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:price:currency" content="{{ \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')
<style>
    .starrating {
        margin-top: 10px;
        border: none;
        float: left;
    }

    .starrating > label {
        color: #90A0A3;
        float: right;
    }

    .starrating > label:before {
        margin: 5px;
        font-size: 1.5em;
        font-family: FontAwesome;
        content: "\f005";
        display: inline-block;
    }

    .starrating > input {
        display: none;
    }

    .starrating > input:checked ~ label,
    .starrating:not(:checked) > label:hover,
    .starrating:not(:checked) > label:hover ~ label {
        color: #FECE31;
    }

    .starrating > input:checked + label:hover,
    .starrating > input:checked ~ label:hover,
    .starrating > label:hover ~ input:checked ~ label,
    .starrating > input:checked ~ label:hover ~ label {
        color: #FECE31;
    }
</style>
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-4">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Product Detail</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Product Detail</li>
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
	<div class="container">
		<div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                @php
                    $photos = explode(',', $detailedProduct->photos);
                @endphp
                <div class="product-image">
                    @foreach ($detailedProduct->stocks as $key => $stock)
                        @if ($stock->image != null)
                            <div class="carousel-box img-zoom product_img_box">
                                <img
                                    class="img-fluid"
                                    src="{{ uploaded_asset($stock->image) }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                                <a href="javascript:void(0)" class="product_img_zoom" title="Zoom">
                                    <span class="linearicons-zoom-in"></span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($photos as $key => $photo)
                        <div class="carousel-box img-zoom product_img_box">
                            <img
                                class="img-fluid"
                                src="{{ uploaded_asset($photo) }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                            >
                            <a href="javascript:void(0)" class="product_img_zoom" title="Zoom">
                                <span class="linearicons-zoom-in"></span>
                            </a>
                        </div>
                    @endforeach
                    
                    <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                        @foreach ($photos as $key => $photo)
                        <div class="item">
                            <a href="javascript:void(0)" class="product_gallery_item active" data-image="{{ uploaded_asset($photo) }}" data-zoom-image="{{ uploaded_asset($photo) }}">
                                <img src="{{ uploaded_asset($photo) }}" />
                            </a>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 class="product_title">{{ $detailedProduct->getTranslation('name') }}</h4>
                        <div class="product_price">
                            <span class="price">{{ home_discounted_base_price($detailedProduct->id) }}</span>
                            @if(home_base_price($detailedProduct->id) != home_discounted_base_price($detailedProduct->id))
                                <del>{{ home_base_price($detailedProduct->id) }}</del>
                                @php
                                    $unitprice = \App\Product::find($detailedProduct->id)->unit_price;
                                    $purchaseprice = \App\Product::find($detailedProduct->id)->purchase_price;
                                    $diff = $unitprice - $purchaseprice;
                                    $offpercentage = ($diff / $unitprice) * 100;
                                @endphp
                                <div class="on_sale">
                                    <span>{{floor($offpercentage)}}% Off</span>
                                </div>
                            @endif
                        </div>
                        <div class="rating_wrap">
                            @php
                                $total = 0;
                                $total += $detailedProduct->reviews->count();
                            @endphp
                            <span>
                                {{ renderStarRating($detailedProduct->rating) }}
                            </span>
                            <span class="rating_num">({{ $total }} {{ translate('reviews')}})</span>
                                
                        </div>
                        <br><br>
                        <br><br>
                        <div class="product_sort_info">
                            <ul>
                                <li><i class="linearicons-shield-check"></i> Salex Brand Warranty</li>
                                <li><i class="linearicons-sync"></i> 7 Day Return Policy</li>
                                @if ($detailedProduct->cash_on_delivery == 1)
                                    <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li>
                                @else
                                    <li><i class="linearicons-bag-dollar"></i> Cash on Delivery not available</li>
                                @endif
                                
                            </ul>
                        </div>
                        <br>
                        <ul class="product-meta">
                            @php
                                $qty = 0;
                                if($detailedProduct->variant_product){
                                    foreach ($detailedProduct->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                    }
                                }
                                else{
                                    $qty = $detailedProduct->current_stock;
                                }
                            @endphp
                            @if ($qty > 0)
                                <li>Stock Status: <span class="badge badge-md badge-inline badge-pill badge-success">{{ translate('In stock')}}</span></li>
                            @else
                                <li>Stock Status: <span class="badge badge-md badge-inline badge-pill badge-danger">{{ translate('Out of stock')}}</span></li>
                            @endif

                            @if($detailedProduct->stock_visibility_state != 'hide')
                                <li>Available: <span>{{ $qty }} {{ translate('items')}}</span></li>
                            @endif


                        </ul>
                    </div>
                    

                    <form id="option-choice-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                        @if (count(json_decode($detailedProduct->colors)) > 0)
                            <div class="pr_switch_wrap">
                                <span class="switch_lable">{{ translate('Color')}}</span>
                                <div class="product_color_switch">
                                    @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ \App\Color::where('code', $color)->first()->name }}">
                                            <input
                                                type="radio"
                                                name="color"
                                                value="{{ \App\Color::where('code', $color)->first()->name }}"
                                                @if($key == 0) checked @endif
                                            >
                                            <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                <span class="size-30px d-inline-block rounded" style="background: {{ $color }};"></span>
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <hr />
                        @else
                            <br><br>
                            <hr />
                        @endif

                        <div class="cart_extra">
                            <div class="cart-product-quantity">
                                <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 120px;">
                                    <button class="btn btn-sm btn-light" type="button" data-type="minus" data-field="quantity" disabled="" style="padding: 7px; border-radius: 50%;">
                                        <i class="fa fa-minus ml-1"></i>
                                    </button>
                                    <input type="text" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number form-control" style="background: white;" placeholder="1" value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}" max="10" readonly>
                                    
                                    <button class="btn btn-sm btn-light" type="button" data-type="plus" data-field="quantity" style="padding: 7px; border-radius: 50%;">
                                        <i class="fa fa-plus ml-1"></i>
                                    </button>
                                </div>
                            </div>


                            <div class="cart_btn">
                                @if ($qty > 0)
                                    <button class="btn btn-fill-out btn-addtocart" type="button" onclick="addToCart()"><i class="icon-basket-loaded"></i> {{ translate('Add to cart')}}</button>
                                @else
                                    <button type="button" class="btn btn-fill-out btn-addtocart" disabled>
                                        <i class="icon-basket-loaded"></i> {{ translate('Out of Stock')}}
                                    </button>
                                @endif

                                <a class="add_compare" href="javascript:void(0)" onclick="addToCompare({{ $detailedProduct->id }})"><i class="icon-shuffle"></i></a>
                                <a class="add_wishlist" href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})"><i class="icon-heart"></i></a>
                            </div>
                        </div>
                    </form>

                    
                    <hr />


                    <ul class="product-meta">
                        <li>Category: <a href="#">{{ $detailedProduct->category->name }}</a></li>
                        <li>Tags: {{ $detailedProduct->tags }}</li>
                    </ul>
                    
                    <div class="product_share">
                        <span>Share:</span>
                        <ul class="social_icons">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="large_divider clearfix"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="tab-style3">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">{{ translate('Description')}}</a>
                      	</li>
                        @if($detailedProduct->video_link != null)
                            <li class="nav-item">
                                <a class="nav-link" id="video-info-tab" data-toggle="tab" href="#video-info" role="tab" aria-controls="video-info" aria-selected="false">{{ translate('Video')}}</a>
                            </li>
                        @endif

                        @if($detailedProduct->pdf != null)
                            <li class="nav-item">
                                <a class="nav-link" id="pdf-info-tab" data-toggle="tab" href="#pdf-info" role="tab" aria-controls="pdf-info" aria-selected="false">{{ translate('Downloads')}}</a>
                            </li>
                        @endif
                      	
                      	<li class="nav-item">
                        	<a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews ({{$detailedProduct->reviews->count()}})</a>
                      	</li>
                    </ul>
                	<div class="tab-content shop_info_tab">
                      	<div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                        	<?php echo $detailedProduct->getTranslation('description'); ?>
                      	</div>

                      	<div class="tab-pane fade" id="video-info" role="tabpanel" aria-labelledby="video-info-tab">
                        	<div class="embed-responsive embed-responsive-16by9">
                                @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                                    <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                                    <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                @endif
                            </div>
                      	</div>

                        <div class="tab-pane fade" id="pdf-info" role="tabpanel" aria-labelledby="pdf-info-tab">
                        	<a href="{{ uploaded_asset($detailedProduct->pdf) }}" class="btn btn-primary">{{  translate('Download') }}</a>
                      	</div>

                      	<div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        	<div class="comments">
                                @if(count($detailedProduct->reviews) > 0)
                                    <h5 class="product_tab_title">{{$detailedProduct->reviews->count()}} Review For <span>{{$detailedProduct->name}}</span></h5>
                                @endif
                            	
                                <ul class="list_none comment_list mt-4">
                                    @foreach ($detailedProduct->reviews as $key => $review)
                                        @if($review->user != null)
                                            <li>
                                                <div class="comment_img">
                                                    <img 
                                                    @if($review->user->avatar_original !=null)
                                                        src="{{ uploaded_asset($review->user->avatar_original) }}"
                                                    @else
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    @endif 
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';" />
                                                </div>
                                                <div class="comment_block">
                                                    <div class="rating_wrap">
                                                        @for ($i=0; $i < $review->rating; $i++)
                                                            <i class="fa fa-star text-warning"></i>
                                                        @endfor
                                                        @for ($i=0; $i < 5-$review->rating; $i++)
                                                            <i class="fa fa-star-o"></i>
                                                        @endfor
                                                    </div>
                                                    <p class="customer_meta">
                                                        <span class="review_author">{{ $review->user->name }}</span>
                                                        <span class="comment-date">{{ date('d-m-Y', strtotime($review->created_at)) }}</span>
                                                    </p>
                                                    <div class="description">
                                                        <p>{{ $review->comment }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                @if(count($detailedProduct->reviews) <= 0)
                                    <div class="opacity-70 mb-4">
                                        {{  translate('There have been no reviews for this product yet.') }}
                                    </div>
                                @endif
                        	</div>

                            @if(Auth::check())
                                @php
                                    $commentable = false;
                                @endphp
                                @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                    @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                        @php
                                            $commentable = true;
                                        @endphp
                                    @endif
                                @endforeach
                                @if ($commentable)
                                    <div class="review_form field_form">
                                        <h5>{{ translate('Write a review')}}</h5>
                                        <form class="row mt-3"action="{{ route('reviews.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">

                                            <div class="form-group col-12">
                                                <div class="star_rating">
                                                    <div class="starrating">
                                                        <input type="radio" id="star5" name="rating" value="5" />
                                                        <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                                        <input type="radio" id="star4" name="rating" value="4" />
                                                        <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                                        <input type="radio" id="star3" name="rating" value="3" />
                                                        <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                                        <input type="radio" id="star2" name="rating" value="2" />
                                                        <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                                        <input type="radio" id="star1" name="rating" value="1" />
                                                        <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-12">
                                                <textarea required="required" class="form-control" name="comment" placeholder="{{ translate('Your review *')}}" rows="4"></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input required="required" placeholder="Enter Name *" class="form-control" name="name" value="{{ Auth::user()->name }}" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input required="required" placeholder="Enter Email *" class="form-control" name="email" value="{{ Auth::user()->email }}" disabled>
                                            </div>
                                        
                                            <div class="form-group col-12">
                                                <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endif
                      	</div>
                	</div>
                </div>
            </div>
        </div>

        <div class="row">
        	<div class="col-12">
            	<div class="small_divider"></div>
            	<div class="divider"></div>
                <div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="heading_s1">
                	<h3>{{ translate('Related products')}}</h3>
                </div>
            	<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                    @foreach (filter_products(\App\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(8)->get() as $key => $related_product)
                        <div class="item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="{{ route('product', $related_product->slug) }}">
                                        <img src="{{ uploaded_asset($related_product->thumbnail_img) }}"
                                        alt="{{ $related_product->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            {{-- <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                             --}}
                                            <li><a href="#"><i class="icon-shuffle"></i></a></li>
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ route('product', $related_product->slug) }}">{{ $related_product->getTranslation('name') }}</a></h6>
                                    <div class="product_price">
                                        <span class="price">{{ home_discounted_base_price($related_product->id) }}</span>
                                        @if(home_base_price($related_product->id) != home_discounted_base_price($related_product->id))
                                            <del>{{ home_base_price($related_product->id) }}</del>
                                            @php
                                                $unitprice = \App\Product::find($related_product->id)->unit_price;
                                                $purchaseprice = \App\Product::find($related_product->id)->purchase_price;
                                                $diff = $unitprice - $purchaseprice;
                                                $offpercentage = ($diff / $unitprice) * 100;
                                            @endphp
                                            <div class="on_sale">
                                                <span>{{floor($offpercentage)}}% Off</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="rating_wrap">
                                        {{ renderStarRating($related_product->rating) }}
                                        @php
                                            $total = 0;
                                            $rating = 0;
                                            foreach ($related_product->user->products as $key => $seller_product) {
                                                $total += $seller_product->reviews->count();
                                                $rating += $seller_product->reviews->sum('rating');
                                            }
                                        @endphp
                                        
                                        <span class="rating_num">({{\App\Review::where('product_id', $related_product->id)->get()->count()}})</span>
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
<!-- END SECTION SHOP -->
</div>
<!-- END MAIN CONTENT -->


@endsection

@section('modal')
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600" data-dismiss="modal">{{ translate('Cancel')}}</button>
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                            </div>
                        </form>

                        <div class="text-center mb-3">
                            <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                            <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                        </div>
                        @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <div class="separator mb-3">
                                <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                            </div>
                            <ul class="list-inline social colored text-center mb-5">
                                @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                            <i class="lab la-google"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            getVariantPrice();
    	});

        function CopyToClipboard(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
            // if (document.selection) {
            //     var range = document.body.createTextRange();
            //     range.moveToElementText(document.getElementById(containerid));
            //     range.select().createTextRange();
            //     document.execCommand("Copy");

            // } else if (window.getSelection) {
            //     var range = document.createRange();
            //     document.getElementById(containerid).style.display = "block";
            //     range.selectNode(document.getElementById(containerid));
            //     window.getSelection().addRange(range);
            //     document.execCommand("Copy");
            //     document.getElementById(containerid).style.display = "none";

            // }
            // AIZ.plugins.notify('success', 'Copied');
        }
        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }

    </script>
@endsection
