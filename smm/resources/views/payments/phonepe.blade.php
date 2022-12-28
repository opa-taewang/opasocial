@extends('layouts.app')
@section('title', getOption('app_name') . ' - Phonepe')
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
                    <img src="https://www.phonepe.com/images/generic/PhonePe-Logo.svg" alt="PayPal Logo"width="100"width="26">
                </div>
<div class="text-center">
<h4>Send to this UPI ID <br><h2><b>Dcreato@ybl</b></h2></h4><button class="btn" style= "color:#96119E;" id="myInput" data-clipboard-text="Dcreato@ybl">
    Copy
</button><br>Min 100 INR<br>Don't pay with GPAY,PAYTM
</div>
                <form id="payment-form"
                      role="form"
                      method="POST"
                      action="{{ url('/payment/add-funds/phonepe') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <div class="form-group">
                            <p id="card-errors" style="color:red"></p>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="padding-bottom: 0;margin-bottom:0">
                            <label class="control-label" for="transaction_id">Transaction ID [Example: P200515165123452912345]</label>
                            <input class="form-control"
                                   name="transaction_id"
                                   id="transaction_id"
                                   data-validation="required"
                                   type="text">
                            @if ($errors->has('transaction_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('transaction_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}" style="padding-bottom: 0;margin-bottom:0">
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
                        <div class="form-group" style="margin-top:15px;">
                            <button type="submit" class="btn btn-primary btn-block submit-btn">@lang('buttons.pay')</button>
                        </div>
                    </fieldset>
                </form>
                <div class="text-center">
<h6> AFTER SENDING THE AMOUNT THROUGH PHONEPE&nbsp;<br>ENTER TRANSACTION ID AND AMOUNT<br>SEE EXAMPLE BELOW</h6>
                <div style="text-align: center;">
                    <img src="/images/38kvz9P.jpg" width="320"  alt="PhonPe Logo" style="
  object-fit:cover;">
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script>
    $(function () {
    new ClipboardJS('.btn');

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
    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>
@endpush