@extends('frontend.layouts.app')
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-4">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>My Account</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">My Account</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<div class="main_content">
    <!-- START SECTION SHOP -->
    <div class="section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('frontend.inc.user_side_nav')
                </div>
                <div class="col-lg-9 col-md-8">
                    @yield('panel_content')
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
</div>
@endsection