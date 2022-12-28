@extends('moderator.layouts.app')
@section('title', getOption('app_name') . ' - Edit Drip Feed Order')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/moderator') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/moderator/dripfeed') }}"><i class="fa fa-dashboard"></i>@lang('new.dfo')</a></li>
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
                        action="{{ url('/moderator/dripfeed/') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">@lang('new.dfod')</legend>
                        <div class="form-group">
                            <label class="control-label">@lang('new.dfoi')</label>
                            <input type="text" name="id" class="form-control" value="{{ $dripfeed->id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.user')</label>
                            <input type="text" name="name" class="form-control" value="{{ $dripfeed->user->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.service')</label>
                            <input type="text" name="service" class="form-control" value="{{ $dripfeed->package->service->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.package')</label>
                            <input type="text" name="package_id" class="form-control" value="{{ $dripfeed->package->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.link')</label>
                            <input type="text" name="link" class="form-control" value="{{ $dripfeed->link }}" data-validation="required" readonly>
                        </div>
                        @if((bool)$dripfeed->package->custom_comments)
                            <div class="form-group">
                                <label class="control-label">@lang('forms.custom_comments')</label>
                                <textarea class="form-control"
                                          name="custom_comments"
                                          id="custom_comments"
                                          style="height: 150px;" readonly>{{ $dripfeed->custom_comments }}</textarea>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label">@lang('new.runqty')</label>
                            <input type="text" name="quantity" class="form-control" value="{{ $dripfeed->run_quantity }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('new.runs')</label>
                            <input type="text" name="order_source" class="form-control" value="{{ $dripfeed->runs }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('new.runtrig')</label>
                            <input type="text" name="order_source" class="form-control" value="{{ $dripfeed->runs_triggered }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('new.interval')</label>
                            <input type="text" name="quantity" class="form-control" value="{{ $dripfeed->interval }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('new.totqty')</label>
                            <input type="text" name="quantity" class="form-control" value="{{ $dripfeed->run_quantity * $dripfeed->runs }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.total') Amount</label>
                            <input type="text" name="price" class="form-control" value="{{ getOption('currency_symbol') . $price }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">@lang('forms.date')</label>
                            <input type="text" name="date" class="form-control" value="{{ $dripfeed->created_at }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">@lang('forms.status')</label>
                            @php
                                $disabled = '';
                                if(in_array(strtoupper($dripfeed->status),['PARTIAL','CANCELLED','COMPLETED'])){
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
                                        {{ $dripfeed->status === title_case('SUBMITTED') ? 'selected' : '' }}
                                >SUBMITTED
                                </option>
                                <option
                                        value="INPROGRESS"
                                        {{ $dripfeed->status === title_case('INPROGRESS') ? 'selected' : '' }}
                                >INPROGRESS
                                </option>
                                <option
                                        value="PARTIAL"
                                        {{ $dripfeed->status === title_case('PARTIAL') ? 'selected' : '' }}
                                >PARTIAL
                                </option>
                                <option
                                        value="COMPLETED"
                                        {{ $dripfeed->status === title_case('COMPLETED') ? 'selected' : '' }}
                                >COMPLETED
                                </option>
                                <option
                                        value="CANCELLED"
                                        {{ $dripfeed->status === title_case('CANCELLED') ? 'selected' : '' }}
                                >CANCELLED [Total Amount will be refunded ]
                                </option>

                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                            @endif
                        </div>
                        @if (!in_array(strtoupper($dripfeed->status), ['COMPLETED', 'PARTIAL', 'CANCELLED']))
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">@lang('buttons.update')</button>
                            </div>
                        @endif
                    </fieldset>
                </form>
            </div>
        </div>
@endsection