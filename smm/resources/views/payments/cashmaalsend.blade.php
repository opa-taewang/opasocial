@extends('layouts.app')
@section('title', getOption('app_name') . ' - Cashmaal')
@section('content')
<div style="display: none;">
    <form action="https://www.cashmaal.com/Pay/" id="payment_form" method="POST">
    <input type="hidden" name="pay_method" value="">
    <input type="hidden" name="amount" value="{{ $amount }}">
    <input type="hidden" name="currency" value="USD">
    <input type="hidden" name="succes_url" value="{{ url('payment/cashmaal/success') }}">
    <input type="hidden" name="cancel_url" value="{{ url('payment/cashmaal/cancel') }}">
    <input type="hidden" name="client_email" value="{{ auth()->user()->email }}">
    <input type="hidden" name="web_id" value="{{ $webid }}">
    <input type="hidden" name="order_id" value="{{ $order_id }}">
    <input type="hidden" name="addi_info" value="{{ getOption('app_name') }} Add funds payment made by {{ auth()->user()->name }} ({{ auth()->user()->email }})">
    <input type="submit" name="Submit" value="Pay With Cash-Maal">
    
    </form>
</div>
<div class="row">
    <div class="col-md-12">
        <h2 style="text-align: center;">Processing Add Funds Transaction</h2>
        <div style="text-align: center;">
            <img src="/images/cashmaal.png" alt="Cashmaal Logo" width="50%">
        </div>
        <h1 style="text-align: center;"><i class="fa fa-spinner fa-spin"></i></h1>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.getElementById('payment_form').submit();
</script>
@endpush