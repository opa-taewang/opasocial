@extends('layouts.app')
@section('title', getOption('app_name') . ' - Bitcoin')
@section('content')
<div class="inner-dashboard add-funds">
    <!--<div class="row">-->
    <!--    <div class="col-md-12">-->
    <!--        <ol class="breadcrumb">-->
    <!--            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>-->
    <!--            <li><a href="{{ url('/payment/add-funds') }}"> @lang('menus.payment_methods')</a></li>-->
    <!--            <li class="active">Bitcoin</li>-->
    <!--        </ol>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <div class="wellHeader">
                    <h2>Bitcoin</h2>
                    <a class="payment-logo" href="https://www.coinpayments.net/" rel="noopener noreferrer" target="_new"><img src="https://www.coinpayments.net/images/pub/buynow-grey.png" width="250" alt="CoinPayments Logo"></a>
                </div>
                <form id="payment-form"
                      role="form"
                      method="POST"
                      action="{{ url('/payment/add-funds/bitcoin') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <p id="card-errors" style="color:red"></p>
                    </div>
                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label class="control-label" for="amount">@lang('forms.amount') ({{ getOption('currency_code') }})</label>
                        <input class="form-control"
                               name="amount"
                               id="amount"
                               data-validation="number"
                               type="text">
                        @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group" style="margin-top:15px;">
                        <button type="submit" class="btn btn-primary submit-btn">@lang('buttons.pay')</button>
                    </div>
                </form>
            </div>
        </div>
    </div></div>
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