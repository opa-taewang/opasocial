@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Edit Banned IP')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/ips') }}"><i class="fa fa-dashboard"></i> Banned IPs</a></li>
                <li class="active">@lang('menus.edit')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/ips/'.$ip->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Edit Banned IP</legend>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="control-label">Address</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $ip->address }}"
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
                            <select class="form-control" data-validation="required"id="reason" name="reason">
                                <option value="Chargeback Scam" {{ ($ip->reason == 'Chargeback Scam' )?'selected':'' }}>Chargeback Scam</option>
                                <option value="Payment Fraud" {{ ($ip->reason == 'Payment Fraud' )?'selected':'' }}>Payment Fraud</option>
                                <option value="Spam Account" {{ ($ip->reason == 'Spam Account' )?'selected':'' }}>Spam Account</option>
                                <option value="Support Ticket Spam" {{ ($ip->reason == 'Support Ticket Spam' )?'selected':'' }}>Support Ticket Spam</option>
                                <option value="Testing Funds Spam" {{ ($ip->reason == 'Testing Funds Spam' )?'selected':'' }}>Testing Funds Spam</option>
                                <option value="Fraud Activity" {{ ($ip->reason == 'Fraud Activity' )?'selected':'' }}>Fraud Activity</option>
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
                                <option value="1" {{ ($ip->blocked == 1 )?'selected':'' }}>Block</option>
                                <option value="0" {{ ($ip->blocked == 0 )?'selected':'' }}>Un-Block</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('buttons.update')</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
@endsection