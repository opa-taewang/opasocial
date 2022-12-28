@extends('layouts.app')
@section('title', getOption('app_name') . ' - Perfectmoney')
@section('content')
<style>
    .panel-default{display:none !important;}
    input[type=submit] {
        background-color: #ff4bac;
        cursor: pointer;
        color: #fff;
    }
    input[type="PAYMENT_AMOUNT"] {
        display: none;
    }
</style>
<div class="inner-dashboard add-funds">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/payment/add-funds') }}"> @lang('menus.payment_methods')</a></li>
                <li class="active">Perfectmoney</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-form">
                <h2 class="text-white mt-2" style="color: #fff;"><i class="fa fa-spin fa-spinner"></i> Redirecting...</h2>
                <div class="panel panel-default">
                    <?php
                    $data=[
                        'PAYEE_ACCOUNT' => \App\PaymentMethod::where(array( "config_key" => "PM_MARCHANTID" ))->first()->config_value,
                        'PAYEE_NAME' => \App\PaymentMethod::where(array( "config_key" => "PM_MARCHANT_NAME" ))->first()->config_value,
                        'PAYMENT_AMOUNT' => $amount,
                        'PAYMENT_UNITS' => \App\PaymentMethod::where(array( "config_key" => "PM_UNITS" ))->first()->config_value,
                        'PAYMENT_URL' => \App\PaymentMethod::where(array( "config_key" => "PM_PAYMENT_URL" ))->first()->config_value,
                        'NOPAYMENT_URL' => \App\PaymentMethod::where(array( "config_key" => "PM_NOPAYMENT_URL" ))->first()->config_value
                        ];
                    ?>
                    {!! PerfectMoney::render($data) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('input[type=submit]').click();
    });
</script>