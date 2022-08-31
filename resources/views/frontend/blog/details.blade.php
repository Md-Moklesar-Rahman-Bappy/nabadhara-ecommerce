@extends('frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@stop

@section('meta_description'){{ $blog->meta_description }}@stop

@section('meta_keywords'){{ $blog->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('product', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

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
        	<div class="col-xl-9">
            	<div class="single_post">
                	<h2 class="blog_title">{{$blog->title}}</h2>
                    <ul class="list_none blog_meta">
                        <li><i class="ti-calendar"></i> {{ $blog->created_at->format('F d, Y') }}</li>
                        @if($blog->category != null)
                            <li title="Category"><i class="fa fa-cube"></i> {{ $blog->category->category_name }}</li>
                        @endif
                    </ul>
                    <div class="blog_img">
                        <img src="{{ uploaded_asset($blog->banner) }}"
                        alt="{{ $blog->title }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';" style="max-height: 500px;" style="max-height: 500px;">
                    </div>
                    <div class="blog_content">
                        <div class="blog_text">
                            {!! $blog->description !!}
                        </div>
                    </div>
                    {{-- @if (get_setting('facebook_comment') == 1)
                    <div>
                        <div class="fb-comments" data-href="{{ route("blog",$blog->slug) }}" data-width="" data-numposts="5"></div>
                    </div>
                    @endif --}}
                </div>
            </div>
        	<div class="col-xl-3 mt-4 pt-2 mt-xl-0 pt-xl-0">
            	<div class="sidebar">
                	{{-- <div class="widget">
                        <div class="search_form">
                            <form> 
                                <input required="" class="form-control" placeholder="Search..." type="text">
                                <button type="submit" title="Subscribe" class="btn icon_search" name="submit" value="Submit">
                                    <i class="ion-ios-search-strong"></i>
                                </button>
                            </form>
                        </div>
                    </div> --}}
                	<div class="widget">
                    	<h5 class="widget_title">{{ translate('Recent Posts')}}</h5>
                        <ul class="widget_recent_post">
                            @foreach ($recentblogs as $recentblog)
                                <li>
                                    <div class="post_footer">
                                        <div class="post_img">
                                            <a href="{{ url("blog").'/'. $recentblog->slug }}"><img src="{{ uploaded_asset($recentblog->banner) }}" alt="{{ $recentblog->title }}"  onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';" style="max-height: 50px;"></a>
                                        </div>
                                        <div class="post_content">
                                            <h6><a href="{{ url("blog").'/'. $recentblog->slug }}">{{$recentblog->title}}</a></h6>
                                            <p class="small m-0">{{ $recentblog->created_at->format('F d, Y') }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            
                    	</ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget_title">Categories</h5>
                        <ul class="widget_archive">
                            @foreach ($categories as $category)
                                @php
                                    $post_count = \App\Blog::where('category_id', $category->id)->get()->count();
                                @endphp
                                <li><a href="javascript:void(0)"><span class="archive_year">{{$category->category_name}} </span><span class="archive_num">({{$post_count}})</span></a></li>
                            @endforeach
                        </ul>
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
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    @endif
@endsection