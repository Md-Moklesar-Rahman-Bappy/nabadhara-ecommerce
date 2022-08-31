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

    .offerselectbtn{
        background: white;
        color: black;
        padding: 5px 10px;
        border: 1px solid #046a70;
    }
    .active{
        background: #046a70;
        color: white;
        border: 1px solid #046a70;
    }
    .offerselectbtn:hover{
        background: #046a70;
        color: white;
        border: 1px solid #046a70;
    }

    .checkofferbtn{
        background: #046a70;
        color: white;
        border: 1px solid #046a70;
    }
    .checkofferbtn:hover{
        background: #05696e;
        color: white;
        border: 1px solid #05696e;
    }
    
    .table .selecttd{
        padding-top: 20px;
        padding-bottom: 20px;
        text-justify: center;
    }

    .table .selecttd:hover{
        background: #046a70;
        color: white;
    }

    .scrolling-wrapper {
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
    }

    table.table{
        border:1px solid #046a70;
        text-align: center;
    }
    table.table > tbody > tr > th{
        border: 1px solid #046a70;
        width: 70px;
    }
    table.table > tbody > tr > td{
        border:1px solid #046a70;
        padding: 7px;
    }
    table.table > tbody > tr > td.www{
        width: 30%;
    }

    table.table > tbody > tr > td.price{
        width: 80px;
    }
    .box {
        width: 150px;
        text-align: left;
        height: 35px;
        background: #046a70; 
        padding: 7px 10px; 
        color: white; 
        font-size: 12px;
        position: relative;
        float: left;
        border-radius: 1px 0px 2px 0px;
    }

    .box.arrow-right:after {
        content: " ";
        position: absolute;
        right: -49px;
        top: 0px;
        border-top: 0px solid transparent;
        border-right: none;
        border-left: 50px solid #046a70;
        border-bottom: 35px solid transparent;
    }

    .retailer_box {
        width: 29.5%;
        text-align: left;
        min-height: 35px;
        background: #046a70; 
        padding: 7px 10px; 
        color: white; 
        font-size: 12px;
        position: relative;
        float: left;
    }
    .retailer_time_box{
        width: 100%;
        text-align: center;
        height: auto;
        background: #046a70; 
        padding: 7px 2px; 
        color: white; 
        font-size: 12px;
    }

    .retailer_box.arrow-right:after {
        content: " ";
        position: absolute;
        right: -29px;
        top: 0px;
        border-top: 0px solid transparent;
        border-right: none;
        border-left: 30px solid #046a70;
        border-bottom: 35px solid transparent;
    }
    .box_details {
        width: 65%;
        text-align: center;
        float: right;
        min-height: 35px;
        background: #046a70;  
        color: white; 
        padding: 7px 10px; 
        font-size: 12px;
    }

    @media only screen and (max-width: 480px) {
        .retailer_box {
            width: 36%;
            text-align: left;
            min-height: 35px;
            background: #046a70; 
            padding: 7px 10px; 
            color: white; 
            font-size: 12px;
            position: relative;
            float: left;
        }
        .retailer_box.arrow-right:after {
            content: " ";
            position: absolute;
            right: -29px;
            top: 0px;
            border-top: 0px solid transparent;
            border-right: none;
            border-left: 30px solid #046a70;
            border-bottom: 35px solid transparent;
        }
        .box_details {
            width: 56%;
            text-align: center;
            float: right;
            min-height: 35px;
            background: #046a70;  
            color: white; 
            padding: 7px 10px; 
            font-size: 12px;
        }
    }

    .select_item_li{
        user-select: none;
        max-height: 50px;
        min-height: 50px;
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
    }
    .select_item_li .li_text{
        font-size: 15px;
        color: black;
        padding: 3px 8px;
        margin: 3px;
        border: 1px solid #046a70;
        display: inline-block;
    }

    .select_item_li .li_text{
        font-size: 15px;
        border-radius: 13px;
        color: black;
        padding: 3px 8px;
        border: 1px solid #046a70;
        display: inline-block;
    }

    .select_item_li .li_text:hover{
        background: #046a70;
        color: white;
        transition-duration: .3s;
    }

    .select_item_li .selected{
        background: #046a70;
        color: white;
    }

    /* width */
    .select_item_li::-webkit-scrollbar {
        display: none;
        height: 5px;
    }

    .select_item_li:hover::-webkit-scrollbar {
        display: block;
        height: 5px;
    }

    /* Track */
    .select_item_li::-webkit-scrollbar-track {
        background: transparent;
    }
    
    /* Handle */
    .select_item_li::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    .scrolling-wrapper::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .item_card{
        border-radius: 0px 0px 5px 5px;
        box-shadow: #046a70 0px 1px 2px;
        cursor: pointer;
    }
    .item_card:hover{
        border-radius: 0px 0px 5px 5px;
        box-shadow: #046a70 0px 1px 4px;
        transition-duration: .3s;
    }

    .item_card_retailer{
        border: 1px solid #046a70;
        border-radius: 0px 0px 5px 5px;
        cursor: pointer;
    }

    .item_card_retailer:hover{
        border-radius: 0px 0px 5px 5px;
        box-shadow: #046a70 0px 1px 2px;
        transition-duration: .4s;
    }

    .p_items{
        font-size: 15px; 
        text-decoration: none; 
        font-weight: 500; 
        padding: 0px;
    }

    .amount_table{
        height: 260px;
    }
    #amount_input{
        height: 260px;
        border: none;
    }

    #select_dp{
        font-size: 12.5px;
        height: auto;
        padding: 5px;
    }

    #amount_item{
        background: white;
        padding: 2px;
        height: 80px;
        font-size: 14.5px;
        border: 1px solid #046a70;
    }

    #amount_item:hover{
        background: #046a70;
        transition-duration: .3s;
        color: white;
        cursor: pointer;
    }
    .amount{
        position: absolute;
        left: 25px;
        bottom: 50%;
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
            <div class="row justify-content-center">
                <div class="col-md-6 p-0 m-0">
                    <div class="card">
                        <div class="card-header p-0">
                            <div class="row">
                                <div class="col-3">
                                    <a href="{{ route('topup.enterNumber') }}">
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

                            <div class="card border-0 p-0 mt-4 mb-0 text-center" id="drivepack_tab_header" style="display: none;">
                                <div class="card-body p-0">
                                    <h6>Select Area</h6>
                                    <form action="" method="">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 p-1">
                                                <select name="" id="select_dp" class="form-control form-control-sm">
                                                    <option value="" selected>Select Division</option>
                                                </select>
                                            </div>
                                            <div class="col-4 p-1">
                                                <select name="" id="select_dp" class="form-control form-control-sm">
                                                    <option value="" selected>Select District</option>
                                                </select>
                                            </div>
                                            <div class="col-4 p-1">
                                                <select name="" id="select_dp" class="form-control form-control-sm">
                                                    <option value="" selected>Default Sorting</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-12 p-1">
                                    <div class="select_item_li">
                                        <div style="padding: 0px; text-align: center;">
                                            <a href="javascript:void(0)" class="li_text selected" id="offertypebtn_1">Amount</a>
                                            <a href="javascript:void(0)" class="li_text" id="offertypebtn_2">Minute</a>
                                            <a href="javascript:void(0)" class="li_text" id="offertypebtn_3">Call Rate</a>
                                            <a href="javascript:void(0)" class="li_text" id="offertypebtn_4">Internet</a>
                                            <a href="javascript:void(0)" class="li_text" id="offertypebtn_5">Bundle</a>
                                            <a href="javascript:void(0)" class="li_text" id="offertypebtn_6">Drive Pack</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="card border-0 p-0 m-0" id="amount_tab" style="display: ;">
                                        <div class="card-body p-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-5 col-sm-4  col-4 p-1 text-center">
                                                    <button class="btn btn-sm btn-fill-out" style="border-radius: 25px;" data-toggle="modal" data-target="#check_offer_modal">Check Offer</button>
                                                </div>
                                                <div class="col-lg-6 col-md-7 col-sm-8 col-8 p-1 text-center">
                                                    <button class="btn btn-sm btn-fill-out" style="border-radius: 25px;" data-toggle="modal" data-target="#check_offer_modal">Powerload Offer</button>
                                                </div>
                                            </div>
                                            @error('recharge_amount')
                                                <div class="row mt-3 mb-3">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger pt-2 pb-2 text-center" style="width: 100%;" >{{ $message }}</div>
                                                    </div>
                                                </div> 
                                            @enderror
                                            <form action="{{ route('topup.submitstep2') }}" method="POST">
                                                @csrf
                                                <div class="row mt-3 mb-3">
                                                    <div class="col-md-6 col-6 pl-4" style="height: 320px;">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_1" data-amount="10" id="amount_item">
                                                                <div class="">৳ 10</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_2" data-amount="20" id="amount_item">
                                                                <div class="">৳ 20</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_3" data-amount="30" id="amount_item">
                                                                <div class="">৳ 30</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_4" data-amount="50" id="amount_item">
                                                                <div class="">৳ 50</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_5" data-amount="70" id="amount_item">
                                                                <div class="">৳ 70</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_6" data-amount="100" id="amount_item">
                                                                <div class="">৳ 100</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_7" data-amount="200" id="amount_item">
                                                                <div class="">৳ 200</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_8" data-amount="300" id="amount_item">
                                                                <div class="">৳ 300</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_9" data-amount="500" id="amount_item">
                                                                <div class="">৳ 500</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_10" data-amount="700" id="amount_item">
                                                                <div class="">৳ 700</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_11" data-amount="1000" id="amount_item">
                                                                <div class="">৳ 1000</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 d-flex flex-row justify-content-center align-items-center amount_val_12" data-amount="2000" id="amount_item">
                                                                <div class="">৳ 2000</div>
                                                            </div>
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
                                                    <div class="col-md-6 col-6" style="height: 320px;">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-8 col-8 d-flex flex-row justify-content-center align-items-center" style="height: 320px;">
                                                                <div class="">
                                                                    <input type="number" name="recharge_amount" id="recharge_amount" style="height: 320px; width: 100%; font-size: 32px; text-align: center; border: 0px; padding: 0px;" class="form-control" placeholder="৳ 0" value="{{ $r_amount }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-4 p-0 d-flex flex-row justify-content-center align-items-center" style="height: 320px;">
                                                                <div class="">
                                                                    <button type="submit" style="border-radius: 25px;" id="amount_input_btn" class="btn btn-sm btn-fill-out"><i class="fa fa-long-arrow-right" style="font-size: 35px;"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-lg-6 col-md-5 col-sm-4  col-4 p-1">
                                                        <table class="table table-bordered text-center amount_table" style="user-select: none; cursor: pointer;">
                                                            <tr>
                                                                <td class="selecttd">৳ 1</td>
                                                                <td class="selecttd">৳ 10</td>
                                                                <td class="selecttd">৳ 20</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="selecttd">৳ 50</td>
                                                                <td class="selecttd">৳ 70</td>
                                                                <td class="selecttd">৳ 85</td>
                                                            </tr><tr>
                                                                <td class="selecttd">৳ 99</td>
                                                                <td class="selecttd">৳ 100</td>
                                                                <td class="selecttd">৳ 150</td>
                                                            </tr><tr>
                                                                <td class="selecttd active">৳ 300</td>
                                                                <td class="selecttd">৳ 500</td>
                                                                <td class="selecttd">৳ 1000</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-lg-6 col-md-7 col-sm-8 col-8 p-1">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control text-center" id="amount_input" placeholder="৳ 0" style="font-size: 25px;" />
                                                            <div class="input-group-addon">
                                                                <button type="submit" style="border-radius: 25px;" id="amount_input_btn" class="btn btn-sm btn-fill-out"><i class="fa fa-long-arrow-right" style="font-size: 35px;"></i></button>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div class="row">
                                                    <div class="col p-1">
                                                        <h4 class="p-4 text-white text-center" style="background: #046a70; border-radius: 35px;">Available Balance: @auth {{ Auth::user()->balance }} @endauth Tk</h4>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card border-0 p-0 m-0" id="minute_tab" style="display: none;">
                                        <div class="card-body p-0">
                                            <form action="" method="">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="box arrow-right">Cashback Offer</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-1 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-phone"></i> 700 min</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>

                                                                        <span class="text-muted  p_items badge mr-1"><i class="fa fa-star-o"></i> 50 tk Cashback</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row p-2 mt-3 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-phone"></i> 700 min</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="box arrow-right">Popular Offer</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-1 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-phone"></i> 700 min</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card border-0 p-0 m-0" id="callrate_tab" style="display: none;">
                                        <div class="card-body p-0">
                                            <form action="" method="">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="box arrow-right">Cashback Offer</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-1 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-phone"></i> 1p/sec</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>

                                                                        <span class="text-muted  p_items badge mr-1"><i class="fa fa-star-o"></i> 50 tk Cashback</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row p-2 mt-3 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-phone"></i> 1p/sec</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="box arrow-right">Popular Offer</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-1 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-phone"></i> 1p/sec</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card border-0 p-0 m-0" id="internet_tab" style="display: none;">
                                        <div class="card-body p-0">
                                            <form action="" method="">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="box arrow-right">Cashback Offer</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-1 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-globe"></i> 500 MB</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>

                                                                        <span class="text-muted  p_items badge mr-1"><i class="fa fa-star-o"></i> 50 tk Cashback</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row p-2 mt-3 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-globe"></i> 500 MB</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="box arrow-right">Popular Offer</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-1 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-globe"></i> 500 MB</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card border-0 p-0 m-0" id="bundle_tab" style="display: none;">
                                        <div class="card-body p-0">
                                            <form action="" method="">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="box arrow-right">Cashback Offer</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-2 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-globe"></i> 500 MB</span>
                                                                    
                                                                        <span class="text-dark badge p_items mr-1"><i class="fa fa-phone"></i> 500 min</span>
                                                                    
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-comment"></i> 500 sms</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>

                                                                        <div class="row mt-1">
                                                                            <div class="col" style="font-size: 14px;">
                                                                                <span class="text-muted"><i class="fa fa-star-o"></i> 50 tk Cashback</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row p-2 mt-4 mb-3">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-globe"></i> 500 MB</span>
                                                                    
                                                                        <span class="text-dark badge p_items mr-1"><i class="fa fa-phone"></i> 500 min</span>
                                                                    
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-comment"></i> 500 sms</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="box arrow-right">Popular Offer</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-2 mb-3">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-globe"></i> 500 MB</span>
                                                                    
                                                                        <span class="text-dark badge p_items mr-1"><i class="fa fa-phone"></i> 500 min</span>
                                                                    
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-comment"></i> 500 sms</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card border-0 p-0 m-0" id="drivepack_tab" style="display: none;">
                                        <div class="card-body p-0">
                                            <form action="" method="">
                                                @csrf
                                                <div class="row mb-2">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card_retailer">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="retailer_box arrow-right ">Retailer No: 50</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-2 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-globe"></i> 500 MB</span>
                                                                    
                                                                        <span class="text-dark badge p_items mr-1"><i class="fa fa-phone"></i> 500 min</span>
                                                                    
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-comment"></i> 500 sms</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>

                                                                        <div class="row mt-1">
                                                                            <div class="col" style="font-size: 14px;">
                                                                                <span class="text-muted"><i class="fa fa-star-o"></i> 50 tk Cashback</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="retailer_time_box">Package Duration: 11/09/2021 10.00AM to 19/09/2021 10.00PM</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card_retailer">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="retailer_box arrow-right ">Retailer No: 51</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-2 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-globe"></i> 500 MB</span>
                                                                    
                                                                        <span class="text-dark badge p_items mr-1"><i class="fa fa-phone"></i> 500 min</span>
                                                                    
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-comment"></i> 500 sms</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>

                                                                        <div class="row mt-1">
                                                                            <div class="col" style="font-size: 14px;">
                                                                                <span class="text-muted"><i class="fa fa-star-o"></i> 50 tk Cashback</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="retailer_time_box">Package Duration: 11/09/2021 10.00AM to 19/09/2021 10.00PM</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-12 p-1">
                                                        <div class="card p-0 item_card_retailer">
                                                            <div class="card-body p-0">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="retailer_box arrow-right ">Retailer No: 52</div>
                                                                    </div>
                                                                </div>
                                                                <div class="row p-2 mt-2 mb-2">
                                                                    <div class="col-8" style="float: left;">
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-globe"></i> 500 MB</span>
                                                                    
                                                                        <span class="text-dark badge p_items mr-1"><i class="fa fa-phone"></i> 500 min</span>
                                                                    
                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-comment"></i> 500 sms</span>

                                                                        <span class="text-dark p_items badge mr-1"><i class="fa fa-clock"></i> 7 Days</span>

                                                                        <div class="row mt-1">
                                                                            <div class="col" style="font-size: 14px;">
                                                                                <span class="text-muted"><i class="fa fa-star-o"></i> 50 tk Cashback</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4" style="text-align: right; font-size: 18px;">
                                                                        <span class="badge" style="border-radius: 20px; padding: 10px; background: #046a70; color: white;"> ৳ 500</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="retailer_time_box">Package Duration: 11/09/2021 10.00AM to 19/09/2021 10.00PM</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    {{-- <div class="card border-0 p-0 m-0" id="bundle_tab" style="display: none;">
                                        <div class="card-body p-0">
                                            <form action="{{ route('topup.submitstep2') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 p-1">
                                                        <a href="javasctipt:void(0)">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="www" colspan="3" style="background: #046a70; color: white; font-size: 14px; padding: 7px;">Special Offer</td>
                                                                        <td colspan="6"></td>
                                                                    </tr>
                                                                    <tr style="width: 100%;">
                                                                        <td style="background: #046a70; color: white;"><i class="fa fa-globe"></i></td>
                                                                        <td>10 GB</td>
                                                                        <td style="background: #046a70; color: white;"><i class="fas fa-phone"></i></td>
                                                                        <td>100 min</td>
                                                                        <td style="background: #046a70; color: white;"><i class="fa fa-star-o"></i></td>
                                                                        <td>15 tk cashback</td>
                                                                        <td style="background: #046a70; color: white;"><i class="fa fa-clock"></i></td>
                                                                        <td>7 days</td>
                                                                        <td class="price" style="background: #046a70; color: white;">275 tk</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </a>
                                                        <a href="javasctipt:void(0)">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="www" colspan="3" style="background: #046a70; color: white; font-size: 14px; padding: 7px;">Old Offer</td>
                                                                        <td colspan="6"></td>
                                                                    </tr>
                                                                    <tr style="width: 100%;">
                                                                        <td style="background: #046a70; color: white;"><i class="fa fa-globe"></i></td>
                                                                        <td>3 GB</td>
                                                                        <td style="background: #046a70; color: white;"><i class="fas fa-phone"></i></td>
                                                                        <td>100 min</td>
                                                                        <td style="background: #046a70; color: white;"><i class="fa fa-clock"></i></td>
                                                                        <td colspan="2">15 days</td>
                                                                        <td class="price" style="background: #046a70; color: white;">187 tk</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </a>
                                                        <a href="javasctipt:void(0)">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="www" colspan="3" style="background: #046a70; color: white; font-size: 14px; padding: 7px;">Low Price</td>
                                                                        <td colspan="6"></td>
                                                                    </tr>
                                                                    <tr style="width: 100%;">
                                                                        <td style="background: #046a70; color: white;"><i class="fa fa-globe"></i></td>
                                                                        <td>500 MB</td>
                                                                        <td style="background: #046a70; color: white;"><i class="fas fa-phone"></i></td>
                                                                        <td>50 min</td>
                                                                        <td style="background: #046a70; color: white;"><i class="fa fa-star-o"></i></td>
                                                                        <td>5 tk cashback</td>
                                                                        <td style="background: #046a70; color: white;"><i class="fa fa-clock"></i></td>
                                                                        <td>3 days</td>
                                                                        <td class="price" style="background: #046a70; color: white;">80 tk</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            $(document).on('click', '#offertypebtn_1', function(){
                $('#amount_tab').show();
                $('#minute_tab').hide();
                $('#callrate_tab').hide();
                $('#internet_tab').hide();
                $('#bundle_tab').hide();
                $('#drivepack_tab').hide();
                $('#drivepack_tab_header').hide();

                $('#offertypebtn_1').addClass('selected');
                $('#offertypebtn_2').removeClass('selected');
                $('#offertypebtn_3').removeClass('selected');
                $('#offertypebtn_4').removeClass('selected');
                $('#offertypebtn_5').removeClass('selected');
                $('#offertypebtn_6').removeClass('selected');
            })
            $(document).on('click', '#offertypebtn_2', function(){
                $('#amount_tab').hide();
                $('#minute_tab').show();
                $('#callrate_tab').hide();
                $('#internet_tab').hide();
                $('#bundle_tab').hide();
                $('#drivepack_tab').hide();
                $('#drivepack_tab_header').hide();

                $('#offertypebtn_1').removeClass('selected');
                $('#offertypebtn_2').addClass('selected');
                $('#offertypebtn_3').removeClass('selected');
                $('#offertypebtn_4').removeClass('selected');
                $('#offertypebtn_5').removeClass('selected');
                $('#offertypebtn_6').removeClass('selected');
            })
            $(document).on('click', '#offertypebtn_3', function(){
                $('#amount_tab').hide();
                $('#minute_tab').hide();
                $('#callrate_tab').show();
                $('#internet_tab').hide();
                $('#bundle_tab').hide();
                $('#drivepack_tab').hide();
                $('#drivepack_tab_header').hide();

                $('#offertypebtn_1').removeClass('selected');
                $('#offertypebtn_2').removeClass('selected');
                $('#offertypebtn_3').addClass('selected');
                $('#offertypebtn_4').removeClass('selected');
                $('#offertypebtn_5').removeClass('selected');
                $('#offertypebtn_6').removeClass('selected');
            })
            $(document).on('click', '#offertypebtn_4', function(){
                $('#amount_tab').hide();
                $('#minute_tab').hide();
                $('#callrate_tab').hide();
                $('#internet_tab').show();
                $('#bundle_tab').hide();
                $('#drivepack_tab').hide();
                $('#drivepack_tab_header').hide();

                $('#offertypebtn_1').removeClass('selected');
                $('#offertypebtn_2').removeClass('selected');
                $('#offertypebtn_3').removeClass('selected');
                $('#offertypebtn_4').addClass('selected');
                $('#offertypebtn_5').removeClass('selected');
                $('#offertypebtn_6').removeClass('selected');
            })
            $(document).on('click', '#offertypebtn_5', function(){
                $('#amount_tab').hide();
                $('#minute_tab').hide();
                $('#callrate_tab').hide();
                $('#internet_tab').hide();
                $('#bundle_tab').show();
                $('#drivepack_tab').hide();
                $('#drivepack_tab_header').hide();

                $('#offertypebtn_1').removeClass('selected');
                $('#offertypebtn_2').removeClass('selected');
                $('#offertypebtn_3').removeClass('selected');
                $('#offertypebtn_4').removeClass('selected');
                $('#offertypebtn_5').addClass('selected');
                $('#offertypebtn_6').removeClass('selected');
            })
            $(document).on('click', '#offertypebtn_6', function(){
                $('#amount_tab').hide();
                $('#minute_tab').hide();
                $('#callrate_tab').hide();
                $('#internet_tab').hide();
                $('#bundle_tab').hide();
                $('#drivepack_tab').show();
                $('#drivepack_tab_header').show();

                $('#offertypebtn_1').removeClass('selected');
                $('#offertypebtn_2').removeClass('selected');
                $('#offertypebtn_3').removeClass('selected');
                $('#offertypebtn_4').removeClass('selected');
                $('#offertypebtn_5').removeClass('selected');
                $('#offertypebtn_6').addClass('selected');
            })
        })
    </script>

    <script>
        $(function() {
            for (i = 1; i <= 12; i++) {
                (function(i) {
                    $(".amount_val_" + i).click(function() {
                        var amount = $(".amount_val_" + i).data('amount');
                        $("#recharge_amount").val(amount);
                    });
                })(i);
            }
        });
    </script>
@endsection
