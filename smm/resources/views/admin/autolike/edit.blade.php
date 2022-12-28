@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Edit Auto Like Order')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/autolike') }}"><i class="fa fa-dashboard"></i>@lang('new.alo')</a></li>
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
                        action="{{ url('/admin/autolike/') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">@lang('new.alod')</legend>
                        <div class="form-group">
                            <label class="control-label">@lang('new.aloi')</label>
                            <input type="text" name="id" class="form-control" value="{{ $autolike->id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.user')</label>
                            <input type="text" name="name" class="form-control" value="{{ $autolike->user->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.service')</label>
                            <input type="text" name="service" class="form-control" value="{{ $autolike->package->service->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.package')</label>
                            <input type="text" name="package_id" class="form-control" value="{{ $autolike->package->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('new.iguser')</label>
                            <input type="text" name="username" class="form-control" value="{{ $autolike->username }}" data-validation="required" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('new.runqty')</label>
                            <input type="text" name="quantity" class="form-control" value="{{ $autolike->min }} to {{ $autolike->max }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('new.postcnt')</label>
                            <input type="text" name="order_source" class="form-control" value="{{ $autolike->posts }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('new.runtrig')</label>
                            <input type="text" name="order_source" class="form-control" value="{{ $autolike->runs_triggered }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('new.totqty')</label>
                            <input type="text" name="quantity" class="form-control" value="{{ $autolike->run_quantity * $autolike->posts }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.total') Amount</label>
                            <input type="text" name="price" class="form-control" value="{{ getOption('currency_symbol') . $price }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.date')</label>
                            <input type="text" name="date" class="form-control" value="{{ $autolike->created_at }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">@lang('forms.status')</label>
                            @php
                                $disabled = '';
                                if(in_array(strtoupper($autolike->status),['PARTIAL','CANCELLED','COMPLETED'])){
                                    $disabled = 'disabled';
                                }
                            @endphp
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="status"
                                    {{ $disabled }}
                                    name="status">
                                <option
                                        value="SUBMITTED"
                                        {{ $autolike->status === title_case('SUBMITTED') ? 'selected' : '' }}
                                >SUBMITTED
                                </option>
                                <option
                                        value="INPROGRESS"
                                        {{ $autolike->status === title_case('INPROGRESS') ? 'selected' : '' }}
                                >INPROGRESS
                                </option>
                                <option
                                        value="PARTIAL"
                                        {{ $autolike->status === title_case('PARTIAL') ? 'selected' : '' }}
                                >PARTIAL
                                </option>
                                <option
                                        value="COMPLETED"
                                        {{ $autolike->status === title_case('COMPLETED') ? 'selected' : '' }}
                                >COMPLETED
                                </option>
                                <option
                                        value="CANCELLED"
                                        {{ $autolike->status === title_case('CANCELLED') ? 'selected' : '' }}
                                >CANCELLED [@lang('new.totalrefund') ]
                                </option>

                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                            @endif
                        </div>
                        @if (!in_array(strtoupper($autolike->status), ['COMPLETED', 'PARTIAL', 'CANCELLED']))
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">@lang('buttons.update')</button>
                            </div>
                        @endif
                    </fieldset>
                </form>
            </div>
        </div>
@endsection