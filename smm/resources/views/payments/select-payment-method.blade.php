@extends('layouts.app')
@section('title', getOption('app_name') . '- Select Payment method')
@section('content')
    @if( ! $paymentMethods->isEmpty() )
    <div class="inner-dashboard add-funds">
        <div class="row">
            <div class="col-sm-6">
                <div class="well">
                    <div class="wellHeader">
                        <h2>@lang('general.select_payment_method') (Auto)</h2>
                    </div>
                    <div class="list-group">
                    @foreach($paymentMethods as $paymentMethod)
                            <a href="{{ url('/payment/add-funds/'.$paymentMethod->slug) }}" class="list-group-item">
                                @if($paymentMethod->slug=="payu")
                                <img class="list-img" src="/custom_main/19/images/{{ $paymentMethod->slug }}.png" alt="payment-icon">
                                @elseif($paymentMethod->slug=="perfectmoney")
                                <img class="list-img" src="/custom_main/19/images/{{ $paymentMethod->slug }}.png" alt="payment-icon">
                                @else
                                <img class="list-img" src="/custom_main/19/images/{{ $paymentMethod->slug }}.png" alt="payment-icon">
                                @endif
                                <span class="list-title">{{ $paymentMethod->name }}</span>
                                <span class="ring-icon"></span>
                            </a>
                    @endforeach
                    <a href="{{ url('/payment/add-funds/coupon') }}" class="list-group-item">
                        <img class="list-img" src="{{ url('images/coupon.png') }}" alt="payment-icon">
                        <span class="list-title">COUPON CODE</span>
                                                        <span class="ring-icon"></span>
<br>
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="well">
                    <div class="wellHeader">
                        <h2>@lang('general.select_payment_method') (Manual)</h2>
                    </div>
                    {!!  getPageContent('add-funds') !!}
                </div>
            </div>
        </div>
    </div>
    @endif
    
@endsection