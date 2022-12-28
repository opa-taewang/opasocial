@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Ban New IP')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/ips') }}"> Banned IPs</a></li>
                <li class="active">@lang('menus.new')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/ips') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Ban New IP</legend>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="control-label">Address</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ old('address') }}"
                                   data-validation="required"
                                   id="address"
                                   name="address">
                            @if ($errors->has('address'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                            <label for="reason" class="control-label">Reason</label>
                            <select class="form-control" data-validation="required" name="reason">
                                <option value="Chargeback Scam"  selected>Chargeback Scam</option>
                                <option value="Payment Fraud" selected>Payment Fraud</option>
                                <option value="Spam Account" selected>Spam Account</option>
                                <option value="Support Ticket Spam" selected>Support Ticket Spam</option>
                                <option value="Testing Funds Spam"selected>Testing Funds Spam</option>
                                <option value="Fraud Activity" selected>Fraud Activity</option>
                            </select>
                            @if ($errors->has('reason'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="control-label">Status</label>
                            <select class="form-control" data-validation="required" name="status">
                                <option value="1" selected>Block</option>
                                <option value="0">Un-Block</option>
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
@endsection