@extends('layouts.app')
@section('title', getOption('app_name') . ' - FlutterWave')
@section('content')
<!--<div class="text-center mb-3">-->
<!--    <p class="text-primary text-small">👉 Hey {{ Auth::user()->name }}, wanna get a panel like folgram? <b><a href="https://www.fiverr.com/epycdev/design-or-clone-smm-panel" class="text-dark" target="_blank"> Click here</a></b> 👈</p>-->
<!--</div>-->
<!--<div class="text-center mb-3">-->
<!--    <p class="text-primary text-small">👋 Hey {{ Auth::user()->name }}, Get upto <b> 2.5% </b> Bonus with Stripe ( card ) Deposit. Contact us on Skype : <b>" folgram "</b> to activate Stripe for you.</p>-->
<!--</div>-->
<div class="row justify-content-md-center">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi mdi-currency-ngn"></i> <img src="{{ url('custom_main/19/images/flutterwave1.png') }}" width="150" alt="FlutterWave Logo"></h4>
                <form action="" method="POST">
                    <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label for="amount" class="control-label">Amount(NGN)</label>
                        <input type="number"
                               class="form-control"
                               value="{{ old('amount') }}"
                               id="amount"
                               data-validation="number"
                               data-validation-allowing="float"
                               name="amount" min="{{ getOption('minimum_deposit_amount') }}">
                        @if ($errors->has('amount'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-currency-ngn"></i> Pay Now</button>
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
fbq('track', 'Purchase', {currency: "NGN", value: 1000.00});
</script>
@endpush