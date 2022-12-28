@extends('layouts.app')
@section('title', getOption('app_name') . ' - PayTM')
@section('content')
<div style="display: none;">
    <form action="{{$paytmurl}}" id="payment_form" method="POST">
        @foreach($params as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <input type="hidden" name="CHECKSUMHASH" value="{{$mychecksum}}">
    </form>
</div>
<div class="row">
    <div class="col-md-12">
        <h2 style="text-align: center;">Processing Add Funds Transaction</h2>
        <div style="text-align: center;">
            <img src="https://i.imgur.com/h7B1ePr.png" alt="PayU Logo" width="50%">
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