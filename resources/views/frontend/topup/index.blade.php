@extends('frontend.layouts.app')

@section('content')

<style>
    .logo-box{
        padding: 10px;
        border: 1px solid #DFDFDF;
        background: white;
        height: 75px;
        width: 75px;
        border-radius: 10px;
        justify-content: center;
    }

    .logo-box:hover{
        transition-duration: .3s;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .text-box{
        padding-top: 5px;
        border: 1px solid transparent;
        background: transparent;
        height: 50px;
        border-radius: 5px;
        justify-content: center;
    }

</style>

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-2">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">
    <div class="section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-box text-center">
                                <h3><strong>Mobile Recharge</strong></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="text-muted">Select Operator</h6>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-4 mb-3">
                                    <a href="{{ route('topup.selectOperator',['operator_name'=>'Grameenphone']) }}">
                                        <div class="logo-box">
                                            <img src="{{ static_asset('assets/img/topup/grameenphone.png') }}" class="img-fluid" style="padding: 5px; height: auto; width: 100%;" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-4 mb-3">
                                    <a href="{{ route('topup.selectOperator',['operator_name'=>'Robi']) }}">
                                        <div class="logo-box">
                                            <img src="{{ static_asset('assets/img/topup/robi.png') }}" class="img-fluid" style="padding: 5px; height: auto; width: 100%;" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-4 mb-3">
                                    <a href="{{ route('topup.selectOperator',['operator_name'=>'Airtel']) }}">
                                        <div class="logo-box">
                                            <img src="{{ static_asset('assets/img/topup/airtel.png') }}" class="img-fluid" style="padding: 5px; height: auto; width: 100%;" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-4 mb-3">
                                    <a href="{{ route('topup.selectOperator',['operator_name'=>'Banglalink']) }}">
                                        <div class="logo-box">
                                            <img src="{{ static_asset('assets/img/topup/banglalink.png') }}" class="img-fluid" style="padding: 5px; height: auto; width: 100%;" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-4 mb-3">
                                    <a href="{{ route('topup.selectOperator',['operator_name'=>'Teletalk']) }}">
                                        <div class="logo-box">
                                            <img src="{{ static_asset('assets/img/topup/teletalk.png') }}" class="img-fluid mt-3" style="padding: 5px; height: auto; width: 100%;" alt="">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- <div class="col-md-12">
                    <div class="blog_img">
                        <a href="blog-single.html">
                            <img src="assets/images/blog_small_img2.jpg" alt="blog_small_img2">
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->

@endsection

@section('modal')
    
@endsection

@section('script')
    <script type="text/javascript">
    
    </script>
@endsection
