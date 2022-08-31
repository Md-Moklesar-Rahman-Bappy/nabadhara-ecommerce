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

    table.table-bordered{
        border:1px solid #046a70;
        margin-top:20px;
    }
    table.table-bordered > tbody > tr > th{
        border-left: 1px solid #046a70;
        border-right: 1px solid #046a70;
        border-top: 1px solid #046a70;
        border-bottom: 1px solid #DEE2E6;
        width: 50%;
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid #046a70;
        width: 50%;
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
                <div class="col-md-5">
                    <div class="card border-0">
                        <div class="card-header border-0" style="background: #046a70; color: white;">
                            <div class="row">
                                <div class="col-3 text-left">
                                    <a href="{{ route('topup.step3') }}" style="text-decoration: none; color: white;"><i class="fa fa-long-arrow-left" style="font-size: 34px;"></i></a>
                                </div>
                                <div class="col-6 text-center mt-2" style="font-size: 16px;">
                                    Confirm to Mobile Recharge
                                </div>
                                <div class="col-3 text-right">
                                    <a href="{{ route('topup.index') }}" style="text-decoration: none; color: white;"><i class="fa fa-times" style="font-size: 34px;"></i></a>
                                </div>
                            </div>
                        </div>
                        @php
                            if(session()->get('recharge_amount') != ''){
                                $recharge_amount = session()->get('recharge_amount');
                            }
                            else {
                                $recharge_amount = '';
                            }

                            if(session()->get('operator_name') != ''){
                                $operator_name = session()->get('operator_name');
                            }
                            else {
                                $operator_name = '';
                            }

                            if(session()->get('total_amount') != ''){
                                $total_amount = session()->get('total_amount');
                            }
                            else {
                                $total_amount = '';
                            }

                            if(session()->get('recharge_commission') != ''){
                                $recharge_commission = session()->get('recharge_commission');
                            }
                            else {
                                $recharge_commission = '';
                            }

                            if(session()->get('total_charge') != ''){
                                $total_charge = session()->get('total_charge');
                            }
                            else {
                                $total_charge = '';
                            }

                            if(session()->get('sim_type') != ''){
                                $sim_type = session()->get('sim_type');
                            }
                            else {
                                $sim_type = '';
                            }

                            if(session()->get('new_balance') != ''){
                                $remaining_balance = session()->get('new_balance');
                            }
                            else {
                                $remaining_balance = '';
                            }
                        @endphp
                        <form action="{{ route('topup.submitstep4') }}" method="POST">
                            @csrf
                            <div class="card-body p-0 border-0">
                                <table class="table table-bordered mt-0 mb-0">
                                    <tbody>
                                        <tr class="text-center" style="background: #fafafa;">
                                            <th>Request Amount</th>
                                            <th>New Balance</th>
                                        </tr>
                                        <tr class="text-center">
                                            <td>৳ {{ $recharge_amount }}</td>
                                            <td>৳ {{ $remaining_balance }}</td>
                                        </tr>
    
                                        <tr class="text-center" style="background: #fafafa;">
                                            <th>Charge/tk</th>
                                            <th>Mobile Operator</th>
                                        </tr>
                                        <tr class="text-center">
                                            <td>৳ {{ $total_charge }}</td>
                                            <td>{{ $operator_name }}</td>
                                        </tr>
    
                                        <tr class="text-center" style="background: #fafafa;">
                                            <th>Reg Comm/tk</th>
                                            <th>Type</th>
                                        </tr>
                                        <tr class="text-center">
                                            <td>৳ {{ $recharge_commission }}</td>
                                            <td>{{ $sim_type }}</td>
                                        </tr>
    
                                        <tr class="text-center" style="background: #fafafa;">
                                            <th>Payable Amount</th>
                                            <th></th>
                                        </tr>
                                        <tr class="text-center">
                                            <td>৳ {{ $total_amount }}</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer p-0 m-0" >
                                <button class="btn btn-sm btn-fill-out btn-block pt-3 pb-3">Confrm <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </form> 
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
    
    </script>
@endsection
