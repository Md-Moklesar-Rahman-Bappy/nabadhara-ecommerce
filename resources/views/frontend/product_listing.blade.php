@extends('frontend.layouts.app')

@if (isset($category_id))
    @php
        $meta_title = \App\Category::find($category_id)->meta_title;
        $meta_description = \App\Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = \App\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')
    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini p-4">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>{{ translate('Shop') }}</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{ translate('Home') }}</a></li>
                        @if(!isset($category_id))
                            <li class="breadcrumb-item">
                                <a href="{{ route('search') }}">{{ translate('Shop')}}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{ route('search') }}">{{ translate('Shop')}}</a>
                            </li>
                        @endif
                        @if(isset($category_id))
                            <li class="breadcrumb-item">
                                <a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">"{{ \App\Category::find($category_id)->getTranslation('name') }}"</a>
                            </li>
                        @endif
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
            <form class="" id="search-form" action="" method="GET">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row align-items-center mb-4 pb-1">
                            <div class="col-12">
                                <div class="product_header">
                                    <div class="product_header_left">
                                        <div>
                                            <h1 class="h6">
                                                @if(isset($category_id))
                                                    {{ \App\Category::find($category_id)->getTranslation('name') }}
                                                @elseif(isset($query))
                                                    {{ translate('Search result for ') }}"{{ $query }}"
                                                @else
                                                    {{ translate('All Products') }}
                                                @endif
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="product_header_right">
                                        <div class="products_view">
                                            <a href="javascript:Void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                                            <a href="javascript:Void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
                                        </div>
                                        <div class="custom_select">
                                            <select class="form-control form-control-sm" name="sort_by" onchange="filter()">
                                                <option value="" disabled selected>{{ translate('Default Sorting')}}</option>
                                                <option value="newest" @isset($sort_by) @if ($sort_by == 'newest') selected @endif @endisset>{{ translate('Newest')}}</option>
                                                <option value="oldest" @isset($sort_by) @if ($sort_by == 'oldest') selected @endif @endisset>{{ translate('Oldest')}}</option>
                                                <option value="price-asc" @isset($sort_by) @if ($sort_by == 'price-asc') selected @endif @endisset>{{ translate('Price low to high')}}</option>
                                                <option value="price-desc" @isset($sort_by) @if ($sort_by == 'price-desc') selected @endif @endisset>{{ translate('Price high to low')}}</option>
                                            </select>
                                        </div>
                                        <div class="custom_select">
                                            <select class="form-control form-control-sm" name="sort_pagination" onchange="filter()">
                                                <option value="" disabled selected>{{ translate('Showing') }}</option>
                                                <option value="12">12</option>
                                                <option value="15">15</option>
                                                <option value="18">18</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row shop_container">
                            @foreach ($products as $key => $product)
                                <div class="col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img">
                                            <a href="{{ route('product', $product->slug) }}">
                                                <img
                                                    class="img-fit lazyload"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                    alt="{{  $product->getTranslation('name')  }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})"><i class="icon-basket-loaded"></i> {{ translate('Add to Cart') }}</a>
                                                    </li>

                                                    <li><a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})"><i class="icon-shuffle"></i></a></li>
                                                    
                                                    <li><a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="{{ route('product', $product->slug) }}">{{ $product->getTranslation('name') }}</a></h6>
                                            <div class="product_price">
                                                <span class="price">{{ home_discounted_base_price($product->id) }}</span>

                                                @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <del>{{ home_base_price($product->id) }}</del>
                                                @endif
                                            </div>
                                            <div class="rating_wrap">
                                                {{ renderStarRating($product->rating) }}
                                                <span class="rating_num">({{\App\Review::where('product_id', $product->id)->get()->count()}})</span>
                                            </div>
                                            
                                            {{-- <div class="pr_desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                            </div> --}}
                                            

                                            {{-- <div class="pr_switch_wrap">
                                                <div class="product_color_switch">
                                                    <span class="active" data-color="#87554B"></span>
                                                    <span data-color="#333333"></span>
                                                    <span data-color="#DA323F"></span>
                                                </div>
                                            </div> --}}

                                            <div class="list_product_action_box pt-5 mt-5">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})"><i class="icon-basket-loaded"></i> Add To Cart</a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="top"><i class="icon-shuffle"></i></a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="top"><i class="icon-heart"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                    <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                                        {{ translate('Club Point') }}:
                                        <span class="fw-700 float-right">{{ $product->earn_point }}</span>
                                    </div>
                                @endif --}}

                                
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <ul class="pagination mt-3 justify-content-center pagination_style1">
                                    <div class="aiz-pagination aiz-pagination-center mt-4">
                                        {{ $products->links() }}
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                        <div class="sidebar">
                            <div class="widget">
                                <h5 class="widget_title">{{ translate('Categories')}}</h5>
                                <ul class="widget_categories">
                                    @if (!isset($category_id))
                                        @foreach (\App\Category::where('level', 0)->get() as $category)
                                            <li class="mb-2 ml-2">
                                                <a href="{{ route('products.category', $category->slug) }}"><span class="categories_name">{{ $category->getTranslation('name') }}</span></a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="mb-2">
                                            <a href="{{ route('search') }}">
                                                <i class="las la-angle-left"></i>
                                                {{ translate('All Categories')}}
                                            </a>
                                        </li>
                                        @if (\App\Category::find($category_id)->parent_id != 0)
                                            <li class="mb-2">
                                                <a href="{{ route('products.category', \App\Category::find(\App\Category::find($category_id)->parent_id)->slug) }}">
                                                    <span class="categories_name">
                                                        <i class="las la-angle-left"></i>
                                                        {{ \App\Category::find(\App\Category::find($category_id)->parent_id)->getTranslation('name') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="mb-2">
                                            <a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">
                                                <span class="categories_name">
                                                    <i class="las la-angle-left"></i>
                                                    {{ \App\Category::find($category_id)->getTranslation('name') }}
                                                </span>
                                            </a>
                                        </li>
                                        @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category_id) as $key => $id)
                                            <li class="ml-4 mb-2">
                                                <a class="text-reset fs-14" href="{{ route('products.category', \App\Category::find($id)->slug) }}"><span class="categories_name">{{ \App\Category::find($id)->getTranslation('name') }}</span></a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="widget">
                                <h5 class="widget_title">{{ translate('Filter')}}</h5>
                                <div class="filter_price">
                                    <div id="price_filter" data-min="0" data-max="500" data-min-value="50" data-max-value="350" data-price-sign="$"></div>
                                    <div class="price_range">
                                        <span>Price: <span id="flt_price"></span></span>
                                        <input type="hidden" id="price_first">
                                        <input type="hidden" id="price_second">
                                    </div>
                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget_title">{{ translate('Brands')}}</h5>
                                <div class="custom_select">	
                                    <select class="form-control form-control-sm" name="brand" onchange="filter()">
                                        <option value="">{{ translate('All Brands')}}</option>
                                        @foreach (\App\Brand::all() as $brand)
                                            <option value="{{ $brand->slug }}" @isset($brand_id) @if ($brand_id == $brand->id) selected @endif @endisset>{{ $brand->getTranslation('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget_title">Size</h5>
                                <div class="product_size_switch">
                                    <span>xs</span>
                                    <span>s</span>
                                    <span>m</span>
                                    <span>l</span>
                                    <span>xl</span>
                                    <span>2xl</span>
                                    <span>3xl</span>
                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget_title">Color</h5>
                                <div class="product_color_switch">
                                    @foreach ($all_colors as $key => $color)
                                        <label class="aiz-megabox" data-toggle="tooltip" data-title="{{ \App\Color::where('code', $color)->first()->name }}">
                                            <input
                                                type="radio"
                                                style="display:none;"
                                                name="color"
                                                value="{{ $color }}"
                                                onchange="filter()"
                                                @if(isset($selected_color) && $selected_color == $color) checked @endif
                                            >
                                            <span data-color="{{$color}}"></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            {{-- @foreach ($attributes as $key => $attribute)
                                @if (\App\Attribute::find($attribute['id']) != null)
                                    <div class="bg-white shadow-sm rounded mb-3">
                                        <div class="fs-15 fw-600 p-3 border-bottom">
                                            {{ translate('Filter by') }} {{ \App\Attribute::find($attribute['id'])->getTranslation('name') }}
                                        </div>
                                        <div class="p-3">
                                            <div class="aiz-checkbox-list">
                                                @if(array_key_exists('values', $attribute))
                                                    @foreach ($attribute['values'] as $key => $value)
                                                        @php
                                                            $flag = false;
                                                            if(isset($selected_attributes)){
                                                                foreach ($selected_attributes as $key => $selected_attribute) {
                                                                    if($selected_attribute['id'] == $attribute['id']){
                                                                        if(in_array($value, $selected_attribute['values'])){
                                                                            $flag = true;
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <label class="aiz-checkbox">
                                                            <input
                                                                type="checkbox"
                                                                name="attribute_{{ $attribute['id'] }}[]"
                                                                value="{{ $value }}" @if ($flag) checked @endif
                                                                onchange="filter()"
                                                            >
                                                            <span class="aiz-square-check"></span>
                                                            <span>{{ $value }}</span>
                                                        </label>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach --}}
                            {{-- <div class="widget">
                                <div class="shop_banner">
                                    <div class="banner_img overlay_bg_20">
                                        <img src="{{ static_asset('assets/images/sidebar_banner_img.jpg') }}" alt="sidebar_banner_img">
                                    </div> 
                                    <div class="shop_bn_content2 text_white">
                                        <h5 class="text-uppercase shop_subtitle">New Collection</h5>
                                        <h3 class="text-uppercase shop_title">Sale 30% Off</h3>
                                        <a href="#" class="btn btn-white rounded-0 btn-sm text-uppercase">Shop Now</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    </div>
    <!-- END MAIN CONTENT -->

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
@endsection
