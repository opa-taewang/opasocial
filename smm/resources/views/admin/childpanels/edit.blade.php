@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Edit Child Panel Order')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/child-panels/orders') }}"> Child Panel Orders</a></li>
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
                        action="{{ url('/admin/child-panels/order/'.$order->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Edit Child Panel Order</legend>
                        <div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
                            <label for="domain" class="control-label">Domain</label>
                              <input type="text" value="{{$order->domain}}"  name="domain" required data-validation="required" />
                            @if ($errors->has('domain'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('domain') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('admin_user') ? ' has-error' : '' }}">
                            <label for="admin_user" class="control-label">Admin User</label>
                              <input type="text" value="{{$order->admin_user}}"  name="admin_user" required data-validation="required" />
                            @if ($errors->has('admin_user'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('admin_user') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('admin_password') ? ' has-error' : '' }}">
                            <label for="admin_password" class="control-label">Admin Password</label>
                              <input type="text" value="{{$order->admin_password}}"  name="admin_password" required data-validation="required" />
                            @if ($errors->has('admin_password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('admin_password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">@lang('forms.status')</label>
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="status"
                                    name="status">
                                <option
                                        value="Submitted" {{($order->status=="Submitted")?'selected':''}}>Submitted
                                </option>
                                <option
                                        value="InProgress" {{($order->status=="InProgress")?'selected':''}}>InProgress
                                </option>
                                <option
                                        value="Completed" {{($order->status=="Completed")?'selected':''}}>Completed
                                </option>
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