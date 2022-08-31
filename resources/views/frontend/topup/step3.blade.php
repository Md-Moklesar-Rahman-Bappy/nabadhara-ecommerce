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

    .typeselectbtn{
        background: white;
        color: black;
        border: 1px solid #046a70;
    }
    .active{
        background: #046a70;
        color: white;
        border: 1px solid #046a70;
    }
    .typeselectbtn:hover{
        background: #046a70;
        color: white;
        border: 1px solid #046a70;
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
    <div class="section pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3">
                                    <a href="{{ route('topup.step2') }}">
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
                                        <img src="{{ static_asset('assets/img/topup/null.png') }}" class="img-fluid" style="height: 40px; width: 40px; float: right;" alt="" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-3">
                                    <img src="" class="rounded-circle" style="height: 70px; width: 70px; float: left;" alt="" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                                <div class="col-6 text-center mt-2">
                                    @guest
                                        Not User
                                    @else
                                        {{ Auth::user()->name }}
                                    @endguest
                                    
                                    <br>
                                    {{ Session::get('mobile_number') }}
                                </div>
                                <div class="col-3 mt-2">
                                    <img src="{{ static_asset('assets/img/topup') }}/@if(Session::get('operator_name') == 'Grameenphone')grameenphone.png @elseif(Session::get('operator_name') == 'Robi')robi.png @elseif(Session::get('operator_name') == 'Airtel')airtel.png @elseif(Session::get('operator_name') == 'Banglalink')banglalink.png @elseif(Session::get('operator_name') == 'Teletalk')teletalk.png  @endif" class="img-fluid" style="height: 40px; width: 40px; float: right;" alt="" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                            </div>

                            @php
                                if(session()->get('recharge_amount') != ''){
                                    $r_amount = session()->get('recharge_amount');
                                }
                                else {
                                    $r_amount = '';
                                }
                            @endphp

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="card border-0">
                                        <div class="card-header" style="background: #046a70; color: white;">Selected Package</div>
                                        <div class="card-body">
                                            <form action="{{ route('topup.submitstep3') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-8 p-1 text-center">
                                                        <label for="" style="font-size: 13px;">Amount</label>
                                                        <input type="number" class="form-control text-center" style="font-size: 13.5px; height: 35px;" value="{{ $r_amount }}" readonly>
                                                    </div>
                                                    <div class="col-lg-3 col-md-8 p-1 text-center">
                                                        <label for="" style="font-size: 13px;">Charge</label>
                                                        <input type="number" name="charge" class="form-control text-center" style="font-size: 13.5px; height: 35px;" value="0" readonly>
                                                    </div>
                                                    <div class="col-lg-3 col-md-8 p-1 text-center">
                                                        <label for="" style="font-size: 13px; margin-top: -20px;">Reg Comm/tk</label>
                                                        <input type="number" name="commission" class="form-control text-center" style="font-size: 13.5px; height: 35px;" value="0" readonly>
                                                    </div>
                                                    <div class="col-lg-3 col-md-8 p-1 text-center">
                                                        <label for="" style="font-size: 13px;">Total</label>
                                                        <input type="number" name="total_amount" class="form-control text-center" style="font-size: 13.5px; height: 35px;"  value="{{ $r_amount }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-12 p-1">
                                                        <label for="" style="font-size: 13px;">Select Type</label>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="hidden" name="sim_type" id="sim_type" />
                                                                <button type="button" class="btn btn-sm typeselectbtn prepaid_sim">Prepaid</button>
                                                                <button type="button" class="btn btn-sm typeselectbtn postpaid_sim">Postpaid</button>
                                                                @if (session()->get('operator_name') == 'Grameenphone')
                                                                    <button type="button" class="btn btn-sm typeselectbtn skitto_sim">Skitto</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                @error('sim_type')
                                                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                                                @enderror
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-md-12 p-1">
                                                        <label for="" style="font-size: 13px;">Enter T-Pin</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control text-center" name="tpin" id="number" autocomplete="off">
                                                            
                                                            <div class="input-group-prepend ml-2">
                                                                <button type="submit" class="btn btn-sm btn-fill-out" style="padding: 0px 30px;"><i class="fa fa-long-arrow-right" style="font-size: 34px;"></i></button>
                                                            </div>
                                                        </div>
                                                        @error('tpin')
                                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

<!-- Modal -->
<div class="modal fade" id="check_offer_modal" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5 text-center text-danger">
                No Offer Found
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.prepaid_sim').on('click', function(){
                $('#sim_type').val('Prepaid');
                $('.prepaid_sim').addClass('active');
                $('.postpaid_sim').removeClass('active');
                $('.skitto_sim').removeClass('active');
            })
            $('.postpaid_sim').on('click', function(){
                $('#sim_type').val('Postpaid');
                $('.prepaid_sim').removeClass('active');
                $('.postpaid_sim').addClass('active');
                $('.skitto_sim').removeClass('active');
            })
            $('.skitto_sim').on('click', function(){
                $('#sim_type').val('Skitto');
                $('.prepaid_sim').removeClass('active');
                $('.postpaid_sim').removeClass('active');
                $('.skitto_sim').addClass('active');
            })
        })
    </script>
@endsection
