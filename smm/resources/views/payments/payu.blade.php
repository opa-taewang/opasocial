@extends('layouts.app')
@section('title', getOption('app_name') . ' - Paytm')
@section('content')
<div class="inner-dashboard add-funds">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <div class="wellHeader">
                    <h2>PayU</h2>
                    <a class="payment-logo" href="https://www.payu.pl/en" rel="noopener noreferrer" target="_new"><img src="/img/payumoney.png" alt="PayU Logo" width="50%"></a>
                </div>
                <form id="payment-form"
                      role="form"
                      method="POST"
                      action="{{ url('/payment/add-funds/payu') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <p id="card-errors" style="color:red"></p>
                    </div>
                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label class="control-label" for="amount">@lang('forms.amount') (INR)</label>
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

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-btn">@lang('buttons.pay')</button>
                    </div>
                </form>
                <div style="text-align: center;">
                    <img src="/img/wallets.png" alt="PayU Logo" width="50%">
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
                $('.submit-btn')
                    .attr('disabled',true)
                    .empty()
                    .html(spinner);
            }
        });
    });
</script>
@endpush