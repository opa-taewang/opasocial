@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - New Currency')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/currency') }}">Currency</a></li>
                <li class="active">@lang('menus.new')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/currency/store') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Create Currency</legend>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Curency Name</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   data-validation="required"
                                   id="name"
                                   name="name">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="code" class="control-label">Currency Code</label>
                            <input type="text"
                                   class="form-control"
                                   data-validation="required"
                                   value="{{ old('code') }}"
                                   id="code"
                                   name="code">
                                   @if ($errors->has('code'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="symbol" class="control-label">Currency Symbol</label>
                            <input type="text"
                                   class="form-control"
                                   data-validation="required"
                                   value="{{ old('symbol') }}"
                                   id="symbol"
                                   name="symbol">
                                   @if ($errors->has('symbol'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('symbol') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('funds') ? ' has-error' : '' }}">
                            <label for="rate" class="control-label">Exchange Rate</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ old('rate') }}"
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
                            <button type="submit" class="btn btn-primary">@lang('buttons.create')</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
@endsection