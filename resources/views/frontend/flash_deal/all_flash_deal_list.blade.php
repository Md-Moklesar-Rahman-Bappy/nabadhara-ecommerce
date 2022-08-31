@extends('frontend.layouts.app')

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-4">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>{{ translate('Flash Deals')}}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ translate('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ translate('Flash Deals')}}</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content" style="background: #F7F8FB;">
    <section class="mb-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 gutters-10">                           
                @foreach($all_flash_deals as $single)
                <div class="col">
                    <div class="bg-white rounded shadow-sm mb-3">
                        <a href="{{ route('flash-deal-details', $single->slug) }}" class="d-block text-reset">
                            <img
                                src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ uploaded_asset($single->banner) }}"
                                alt="{{ $single->title }}"
                                class="img-fluid lazyload rounded">
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
</div>
@endsection
