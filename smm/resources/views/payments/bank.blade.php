@extends('layouts.app')
@section('title', getOption('app_name') . ' - Bank/Manual/Other')
@section('content')
<div class="inner-dashboard add-funds">
    <!--<div class="row">-->
    <!--    <div class="col-md-12">-->
    <!--        <ol class="breadcrumb">-->
    <!--            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>-->
    <!--            <li><a href="{{ url('/payment/add-funds') }}"> @lang('menus.payment_methods')</a></li>-->
    <!--            <li class="active">Bank//Other</li>-->
    <!--        </ol>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                {{ $details }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                {!!  getPageContent('bank-account-page') !!}
            </div>
        </div>
    </div>
</div>
@endsection