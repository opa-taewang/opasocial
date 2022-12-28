@extends('layouts.app')
@section('title', getOption('app_name') . ' - Phonepe')
@section('content')
<section class="inner-head">
    
</section>
<section class="add-funds-page">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <div class="login-form">
                <div class="text-center">
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/89/Razorpay_logo.svg/1280px-Razorpay_logo.svg.png" alt="PayPal Logo"width="100"width="26">
                </div>
<div class="text-center">
<h4>Click the Button Below </h4><br><a  class="btn btn-primary btn-block submit-btn" href="http://smm-script.com/add-funds-fg" target="_blank">Pay Now</a><br>After payment, enter the payment id and amount to Complete the Transaction.
</div>
                <form id="payment-form"
                      role="form"
                      method="POST"
                      action="{{ url('/payment/add-funds/razorp') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <div class="form-group">
                            <p id="card-errors" style="color:red"></p>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="padding-bottom: 0;margin-bottom:0">
                            <label class="control-label" for="transaction_id">Payment ID [Example: pay_G2VCuFF64nIAGp]</label>
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
                            <label class="control-label" for="amount">@lang('forms.amount') (USD)</label>
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
                            <button type="submit" class="btn btn-primary btn-block submit-btn">Add Funds</button>
                        </div>
                    </fieldset>
                </form>
                <div class="text-center">
<h6> AFTER SENDING THE AMOUNT THROUGH RAZORPAY&nbsp;<br>ENTER PAYMENT ID AND AMOUNT<br>SEE EXAMPLE BELOW</h6>
                <div style="text-align: center;">
                    <img src="/images/H5I45O.png" width="320"  alt="RazorPay Logo" style="
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