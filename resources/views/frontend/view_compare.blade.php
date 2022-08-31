@extends('frontend.layouts.app')

@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-4">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>{{ translate('Compare')}}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Compare</li>
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
            <div class="col-md-12">
            	<div class="compare_box">
                    <div class="table-responsive">
                        @if(Session::has('compare'))
                            @if(count(Session::get('compare')) > 0)
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr class="pr_image">
                                        <td class="row_title">Product Image</td>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td class="row_img"><img src="{{ uploaded_asset(\App\Product::find($item)->thumbnail_img) }}" alt="{{ translate('Product Image') }}"></td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_title">
                                        <td class="row_title">Product Name</td>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td class="product_name">
                                                <a href="{{ route('product', \App\Product::find($item)->slug) }}">{{ \App\Product::find($item)->getTranslation('name') }}</a>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_price">
                                        <td class="row_title">Price</td>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td class="product_price"><span class="price">{{ single_price(\App\Product::find($item)->unit_price) }}</span></td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_rating">
                                        <td class="row_title">Rating</td>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td>
                                                {{ renderStarRating(\App\Product::find($item)->rating) }} <span>({{\App\Review::where('product_id', $item)->get()->count()}})</span>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_add_to_cart">
                                        <td class="row_title">Add To Cart</td>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td class="row_btn">
                                                <a href="javascript:void(0)" class="btn btn-fill-out" onclick="showAddToCartModal({{ $item }})"><i class="icon-basket-loaded"></i> {{ translate('Add to cart')}}</a>
                                            </td>
                                        @endforeach
                                    </tr>
                                    
                                    <tr class="pr_color">
                                        <td class="row_title">Brand</td>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td>
                                                @if (\App\Product::find($item)->brand != null)
                                                    {{ \App\Product::find($item)->brand->getTranslation('name') }}
                                                @else
                                                    No Brand
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_size">
                                        <td class="row_title">{{ translate('Sub Sub Category')}}</td>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td>
                                                @if (\App\Product::find($item)->subsubcategory != null)
                                                    {{ \App\Product::find($item)->subsubcategory->getTranslation('name') }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_stock">
                                        <td class="row_title">Item Availability</td>
                                        @foreach (Session::get('compare') as $key => $item)
                                            @php
                                                $qty = 0;
                                                $product = \App\Product::find($item);
                                                
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
                                                <td class="row_stock"><span class="in-stock">{{ translate('In-Stock')}}</span></td>
                                            @else
                                                <td class="row_stock"><span class="out-stock">{{ translate('Out of Stock')}}</span></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                    <tr class="pr_remove">
                                        <td class="row_title">Reset</td>
                                        <td colspan="3" class="row_remove">
                                            <a href="{{ route('compare.reset') }}" style="text-decoration: none;" class="text-danger">{{ translate('Reset Compare List')}}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        @else
                            <div class="text-center p-4">
                                <p class="fs-17">{{ translate('Your comparison list is empty')}}</p>
                            </div>
                        @endif
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
