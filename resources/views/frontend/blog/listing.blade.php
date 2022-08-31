@extends('frontend.layouts.app')

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-4">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>{{ translate('Blog')}}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ translate('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ translate('Blog')}}</li>
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
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="blog_post blog_style2 box_shadow1">
                        <div class="blog_img">
                            <a href="{{ url("blog").'/'. $blog->slug }}">
                                <img src="{{ uploaded_asset($blog->banner) }}" alt="{{ $blog->title }}"  onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';" style="max-height: 200px;">
                            </a>
                        </div>
                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h5 class="blog_title"><a href="{{ url("blog").'/'. $blog->slug }}">{{ $blog->title }}</a></h5>
                                <ul class="list_none blog_meta">
                                    <li><i class="ti-calendar"></i> {{ $blog->created_at->format('F d, Y') }}</li>
                                    @if($blog->category != null)
                                        <li title="Category"><i class="fa fa-cube"></i> {{ $blog->category->category_name }}</li>
                                    @endif
                                    
                                </ul>
                                <p>{{ $blog->short_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12 mt-2 mt-md-4">
                <div class="pagination pagination_style1 justify-content-center">
                    <div class="aiz-pagination aiz-pagination-center mt-4">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END SECTION BLOG -->

</div>
<!-- END MAIN CONTENT -->

{{-- <section class="pb-4">
    <div class="container">
        <div class="card-columns">
            @foreach($blogs as $blog)
                <div class="card mb-3 overflow-hidden shadow-sm">
                    <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset d-block">
                        <img
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($blog->banner) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid lazyload "
                        >
                    </a>
                    <div class="p-4">
                        <h2 class="fs-18 fw-600 mb-1">
                            <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset">
                                {{ $blog->title }}
                            </a>
                        </h2>
                        @if($blog->category != null)
                        <div class="mb-2 opacity-50">
                            <i>{{ $blog->category->category_name }}</i>
                        </div>
                        @endif
                        <p class="opacity-70 mb-4">
                            {{ $blog->short_description }}
                        </p>
                        <a href="{{ url("blog").'/'. $blog->slug }}" class="btn btn-soft-primary">
                            {{ translate('View More') }}
                        </a>
                    </div>
                </div>
            @endforeach
            
        </div>
        <div class="aiz-pagination aiz-pagination-center mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</section> --}}
@endsection
