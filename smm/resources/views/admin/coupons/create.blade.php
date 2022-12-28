@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - New Coupon')
<link rel="stylesheet" type="text/css" href="{{ url('css/jquery.multiselect.css') }}">
<style>
    .w-50{width:50% !important;}
    .mb-1{margin-bottom:1em;}
    .ml-10{margin-left:10px;}
    .flex{display:flex;}
    .badge-warning{background-color:#ffc107!important;}
    .hours{background-image: url({{url('/images/clock.png')}}) !important;background-repeat: no-repeat;background-size: 15px;background-position: 2px 8px;padding-left: 20px !important;}
    .funds{background-image: url({{url('/images/price.png')}}) !important;background-repeat: no-repeat;background-size: 15px;background-position: 2px 8px;padding-left: 20px !important;}
</style>
@section('content')
<link 
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/coupons') }}"> Coupons</a></li>
                <li class="active">@lang('menus.new')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-form">
                <form role="form" method="POST" action="{{ url('/admin/coupons/store') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Create Coupon</legend>
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="control-label">Code</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ old('code') }}"
                                   data-validation="required"
                                   id="code"
                                   name="code">
                            @if ($errors->has('code'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('min_funds') ? ' has-error' : '' }}">
                            <label for="min_funds" class="control-label">Minimum User Funds</label>
                            <input type="number"
                                   class="form-control"
                                   value="{{ old('min_funds') }}"
                                   id="min_funds"
                                   data-validation="min_funds"
                                   name="min_funds">
                            @if ($errors->has('min_funds'))
                                <span class="help-block">
                                        <strong>Minimum User Funds is a required field</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('account_age') ? ' has-error' : '' }}">
                            <label for="account_age" class="control-label">Minimum User Account Age</label>
                            <input type="number"
                                   class="form-control"
                                   value="{{ old('account_age') }}"
                                   id="min_funds"
                                   data-validation="account_age"
                                   name="account_age">
                            @if ($errors->has('account_age'))
                                <span class="help-block">
                                        <strong>Minimum User Account Age is a required field</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('max_usage') ? ' has-error' : '' }}">
                            <label for="max_usage" class="control-label">Usage</label>
                            <input type="number"
                                   class="form-control"
                                   value="{{ old('max_usage') }}"
                                   id="max_usage"
                                   data-validation="number"
                                   data-validation-allowing="float"
                                   name="max_usage">
                            @if ($errors->has('max_usage'))
                                <span class="help-block">
                                        <strong>Usage is required field</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="control-label">Amount</label>
                            <input type="amount"
                                   class="form-control"
                                   value="{{ old('amount') }}"
                                   id="amount"
                                   data-validation="number"
                                   data-validation-allowing="float"
                                   name="amount">
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                        <strong>Amount is required field</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('expiry') ? ' has-error' : '' }}">
                            <label for="expiry" class="control-label">Expiry</label>
                            <input type="date"
                                   class="form-control"
                                   value="{{ old('expiry') }}"
                                   id="expiry"
                                   data-validation="date"
                                   name="expiry">
                            @if ($errors->has('expiry'))
                                <span class="help-block">
                                        <strong>expiry is required field</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group" style="display:none;">
                            <label for="users" class="control-label">Select Users</label>
                            <select class="form-control" multiple data-validation="required" id="users" name="users[]">
                                @foreach($users as $key => $user)
                                <option value="{{$key}}">{{$user}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('users'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('users') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Set Time and Funds</label>
                            <small class="badge badge-warning mb-1">e.g A persons who added above $50 in last 24 hours can use this coupon.</small>
                            <div class="flex">
                                <input type="number" class="form-control w-50 hours" name="hours" placeholder="Enter hours e.g 24" />
                                <input type="number" class="form-control w-50 ml-10 funds" name="funds" placeholder="Enter funds e.g 50" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">@lang('forms.status')</label>
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="status"
                                    name="status">
                                <option
                                        value="active">Active
                                </option>
                                <option
                                        value="deactive">Deactivate
                                </option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('buttons.create')</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
<script src="{{ url('js/jquery.multiselect.js') }}"></script>
<script>
$(document).ready(function(){
    $('#users').multiselect({
        columns: 1,
        placeholder: 'Select Users',
        search: true,
        selectAll: true
    });
});
</script>
@endsection