@extends('layouts.app')
@section('title', getOption('app_name') . ' - PayTM')
@section('content')
<div class="inner-dashboard add-funds">
    <!--<div class="row">-->
    <!--    <div class="col-md-12">-->
    <!--        <ol class="breadcrumb">-->
    <!--            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>-->
    <!--            <li><a href="{{ url('/payment/add-funds') }}"> @lang('menus.payment_methods')</a></li>-->
    <!--            <li class="active">@lang('menus.paypal')</li>-->
    <!--        </ol>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <div style="text-align: left;">
                    <img src="https://i.imgur.com/h7B1ePr.png" alt="PayTM Logo" width="100">
                </div>
                <img src="/img/OfflineMerchant.png" alt="PhonPe Logo" style="width:230px;margin: auto;display: block;">
        <ul class="news-wrap">

<li class="singleNewsBlock">
    <div class="news-desc">
        <p>Scan/Download the <strong>Paytm</strong> QR code Given above</p></div></li>
        <li class="singleNewsBlock">
    <div class="news-desc">
        <p>Go To  <strong>Paytm app</strong> And scan the QR Code</p></div></li>
            <li class="singleNewsBlock">
    <div class="news-desc">
        <p>Pay the  <strong>amount</strong> you wish to add in InstaRaja. (Min 10 INR)</p></div></li>
<li class="singleNewsBlock">
    <div class="news-desc">
        After Sending <strong>Enter Order Number And Amount</strong> in the respective Boxes</div></li>
<li class="singleNewsBlock">
    <div class="news-desc">Click <strong>Pay</strong> after you Enter Correct Txn and Amt</div></li>
<li class="singleNewsBlock">
    
    <div class="news-desc">
        Amount Will Be Added <strong>Automatically!</strong></div></li>
</ul>
                <form id="payment-form" role="form" method="POST" action="{{ url('/payment/add-funds/paytm') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <div class="form-group">
                            <p id="card-errors" style="color:red"></p>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="padding-bottom: 0;margin-bottom:0">
                            <label class="control-label" for="transaction_id">Order ID [Example: 202005082008820033]</label>
                            <input class="form-control" name="transaction_id" id="transaction_id" data-validation="required" type="text">
                            @if ($errors->has('transaction_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('transaction_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}" style="padding-bottom: 0;margin-bottom:0">
                            <label class="control-label" for="amount">@lang('forms.amount') (INR)</label>
                            <input class="form-control" name="amount" id="amount" data-validation="number"type="text">
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group" style="margin-top:15px;">
                            <button type="submit" class="btn btn-primary btn-block submit-btn">@lang('buttons.pay')</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function () {
        $.validate({
            form: '#payment-form',
            modules: 'date',
            validateOnBlur: false,
            onSuccess: function (e) {
                $('.submit-btn').attr('disabled',true).empty().html('<i class="fas fa-spinner fa-pulse"></i>');
            }
        });
    });
</script>
@endpush