@extends('layouts.app')
@section('title', getOption('app_name') . ' - RazorPay')
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
                @if($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong> {{ $message }}
                    </div>
                @endif
                {!! Session::forget('error') !!}
                @if($message = Session::get('success'))
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Success!</strong> {{ $message }}
                    </div>
                @endif
                {!! Session::forget('success') !!}
                <div class="panel panel-default">
                    <div style="text-align: center;">
                    <img src="https://images.yourstory.com/cs/2/fb7ee200-7579-11e9-995c-171c030e4eb8/1560258757891.png?fm=png&auto=format" alt="Razorpay" width="100" height= "26">
                </div>
    
                    <div class="panel-body text-center">
                        <form action="{!!route('razorpaymentform')!!}" method="POST" >
                        <div style="margin-top: 40px;" class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="control-label">Amount(USD)</label>
                            <input type="number"
                                   class="form-control"
                                   value="{{ old('amount') }}"
                                   id="amount"
                                   data-validation="number"
                                   data-validation-allowing="float"
                                   name="amount">
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group" style="margin-top:15px;">
                            <button type="submit" class="btn btn-primary btn-block submit-btn"><span>Pay</span></button>
                        </div>
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection