@extends('layouts.app')
@section('title', getOption('app_name') . ' - Order New Panel' )
@section('content')
@php
$scroll = getOption('neworder_scroll',true);
@endphp
<div class="inner-dashboard neworderPage">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success">
                <p>You can now buy a child panel for <strong>{{(isset($amount))?$amount:'null'}}</strong> per month! (deducted from your balance). A child panel is your own website to sell SMM Services. You will simply connect it to us and sell directly to your clients!</p>
            </div>
            <div class="well ">
                <div class="wellHeader">
                    <h2>@lang('forms.new') Order New Panel</h2>
                </div>
                @if(request()->is('child-panels*'))
                    @if(Session::has('alert'))
                    <div style="font-size: 15px" class="alert alert-{{ Session::get('alertClass') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ Session::get('alert') }}
                    </div>
                    @endif
                @endif
                @if(auth()->user()->funds >= (float)substr((isset($amount))?$amount:'$0',1))
                <form role="form" method="POST" action="{{ url('/child-panels') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
                        <label for="domain" class="control-label">Domain</label>
                        <input name="domain" id="domain" value="{{ old('domain') }}" type="text" data-validation="required" class="form-control">
                        @if ($errors->has('domain'))
                            <span class="help-block">
                            <strong>{{ $errors->first('domain') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="alert alert-info">
                            Please visit your Domain registrar's dashboard to change nameservers to:<br>
                            <strong><div class="host-address">ns1.hostndots.com</div></strong>
                            <strong><div class="host-address">ns2.hostndots.com</div></strong>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('admin_user') ? ' has-error' : '' }}">
                        <label for="admin_user" class="control-label">Admin Email</label>
                        <input name="admin_user" id="admin_user" value="{{ old('admin_user') }}" type="email" data-validation="required" class="form-control">
                        @if ($errors->has('admin_user'))
                            <span class="help-block">
                            <strong>{{ $errors->first('admin_user') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Admin Password</label>
                        <input name="password" id="password"  type="password" data-validation="required" class="form-control">
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('$panel->status') ? ' has-error' : '' }}">
                        <label for="confirmed" class="control-label">Confirm Password</label>
                        <input name="confirmed" id="confirmed" type="password" data-validation="required" class="form-control">
                        @if ($errors->has('confirmed'))
                            <span class="help-block">
                            <strong>{{ $errors->first('confirmed') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                            <label for="amount" class="control-label">Amount</label>
                            <input type="text" value="{{(isset($amount))?$amount:''}}" class="form-control" readonly disabled/>
                        </div>
                    <button type="submit" class="btn btn-primary">Submit Order</button>
                </form>
                @else
                <div class="alert alert-warning">
                    <p>Please add funds, current balance is less than {{$amount}}.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection