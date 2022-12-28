@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Edit Currency')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/currency') }}"> Currency</a></li>
                <li class="active">@lang('menus.edit')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/currency/'.$currency->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Edit  Currency</legend>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Currency Name</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $currency->name }}"
                                   data-validation="required"
                                   id="name"
                                   name="name">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="text" class="control-label">Currency Code</label>
                            <input type="text"
                                   class="form-control"
                                   data-validation="required"
                                   value="{{ $currency->code }}"
                                   id="code"
                                   name="code">
                            @if ($errors->has('code'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                            <label for="text" class="control-label">Currency Symbol</label>
                            <input type="text"
                                   class="form-control"
                                   data-validation="required"
                                   value="{{ $currency->symbol }}"
                                   id="symbol"
                                   name="symbol">
                            @if ($errors->has('symbol'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('symbol') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                            <label for="rate" class="control-label">Exchange Rate</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $currency->rate }}"
                                   id="rate"
                                   data-validation="number"
                                   data-validation-allowing="float"
                                   name="rate">
                            @if ($errors->has('rate'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('rate') }}</strong>
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
    </div>
@endsection