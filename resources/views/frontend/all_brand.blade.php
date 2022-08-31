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
            		<h1>{{ translate('All Brands')}}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ translate('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ translate('All Brands')}}</li>
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
        <div class="">
            <div class="row row-cols-xxl-6 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 gutters-10">
                @foreach (\App\Brand::all() as $brand)
                    <div class="col text-center">
                        <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-3 mb-3 border border-light rounded hov-shadow-md">
                            <img src="{{ uploaded_asset($brand->logo) }}" class="lazyload mx-auto" style="height: 70px; width: 100px;" alt="{{ $brand->getTranslation('name') }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
<!-- END SECTION BLOG -->

</div>
<!-- END MAIN CONTENT -->

@endsection
