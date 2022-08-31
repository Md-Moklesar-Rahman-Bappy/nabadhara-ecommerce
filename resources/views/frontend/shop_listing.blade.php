@extends('frontend.layouts.app')

@section('content')

<style>
    .hov-shadow-md:hover { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important; }
</style>

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-4">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>{{ translate('All Seller Shops')}}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ translate('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ translate('All Seller Shops')}}</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION BLOG -->
<div class="section pt-5">
	<div class="container">
        <div class="row shop_container grid">
            <div class="col-lg-3 col-md-4 col-6">
                @foreach ($shops as $key => $shop)
                    @php
                        $seller = \App\Seller::find($key+1);
                        $total = 0;
                        $rating = 0;
                        foreach ($seller->user->products as $key => $seller_product) {
                            $total += $seller_product->reviews->count();
                            $rating += $seller_product->reviews->sum('rating');
                        }
                    @endphp
                    <div class="product">
                        <div class="">
                            <a href="{{ route('shop.visit', $seller->user->shop->slug) }}">
                                <img src="{{ uploaded_asset($seller->user->shop->logo) }}" alt="{{ $seller->user->shop->name }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>

                        <div class="product_info">
                            <h6 class="product_title"><a href="{{ route('shop.visit', $seller->user->shop->slug) }}">{{ $seller->user->shop->name }}</a></h6>
                            <div class="rating_wrap">
                                <div class="">
                                    @if ($total > 0)
                                        {{ renderStarRating($rating/$total) }}
                                    @else
                                        {{ renderStarRating(0) }}
                                    @endif
                                </div>
                                <span class="rating_num">({{$total}})</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="pagination mt-3 justify-content-center pagination_style1">
                    <div class="aiz-pagination aiz-pagination-center mt-4">
                        {{ $shops->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END SECTION BLOG -->

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