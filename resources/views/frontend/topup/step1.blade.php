@extends('frontend.layouts.app')

@section('content')

<style>
    .logo-box{
        padding: 5px;
        border: 1px solid #DFDFDF;
        background: white;
        height: 50px;
        width: 50px;
        border-radius: 5px;
        justify-content: center;
    }

    .text-box{
        padding-top: 5px;
        border: 1px solid transparent;
        background: transparent;
        height: 50px;
        border-radius: 5px;
        justify-content: center;
    }

    .btn-box{
        padding: 0px 10px;
        border: 1px solid #DFDFDF;
        background: transparent;
        height: 50px;
        width: 60px;
        border-radius: 5px;
        justify-content: center;
    }

    .btn-box:hover{
        transition-duration: .3s;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
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
                            <div class="row">
                                <div class="col-3">
                                    <a href="{{ route('topup.index') }}">
                                        <div class="btn-box" style="float: left;">
                                            <img src="{{ static_asset('assets/img/topup/back.png') }}" class="img-fluid" style="height: 100%; width: 100%;" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6" style="text-align: center;">
                                    <div class="text-box">
                                        <h3><strong>Mobile Recharge</strong></h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="logo-box" style="float: right;">
                                        <img src="{{ static_asset('assets/img/topup') }}/@if(Session::get('operator_name') == 'Grameenphone')grameenphone.png @elseif(Session::get('operator_name') == 'Robi')robi.png @elseif(Session::get('operator_name') == 'Airtel')airtel.png @elseif(Session::get('operator_name') == 'Banglalink')banglalink.png @elseif(Session::get('operator_name') == 'Teletalk')teletalk.png  @endif" class="img-fluid" style="height: 40px; width: 40px; float: right;" alt="" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                if(Session::get('operator_name') == 'Grameenphone'){
                                    $placeholder = '017 XXXXXXXX';
                                }
                                else if(Session::get('operator_name') == 'Robi'){
                                    $placeholder = '018 XXXXXXXX';
                                }
                                else if(Session::get('operator_name') == 'Airtel'){
                                    $placeholder = '016 XXXXXXXX';
                                }
                                else if(Session::get('operator_name') == 'Banglalink'){
                                    $placeholder = '019 XXXXXXXX';
                                }
                                else if(Session::get('operator_name') == 'Teletalk'){
                                    $placeholder = '015 XXXXXXXX';
                                }
                                else{
                                    $placeholder = '';
                                }
                            @endphp
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <form method="post" action="{{route('topup.submitNumber')}}">
                                        @csrf
                                        <input type="hidden" name="operator" value="{{ Session::get('operator_name') }}" />
                                        <label for="number">Mobile Number</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="mobile_number" id="number" placeholder="{{ $placeholder }}" autocomplete="off">
                                            
                                            <div class="input-group-append pl-2">
                                                <button type="submit" class="btn btn-sm btn-fill-out" style="padding: 0px 30px;"><i class="fa fa-long-arrow-right" style="font-size: 34px;"></i></button>
                                            </div>
                                        </div>
                                        @error('mobile_number')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </form>
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
