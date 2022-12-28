@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - New BroadCast')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/broadcast') }}"><i class="fa fa-dashboard"></i>@lang('new.broadcasts')</a></li>
                <li class="active">@lang('forms.new')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/broadcast') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">@lang('new.broadcast_details')</legend>
                        <div class="form-group">
                            <label for="mtitle" class="control-label">@lang('new.title')</label>
                            <input type="text"
                                   class="form-control"
                                   id="mtitle"
                                   value=""
                                   name="mtitle"
                                   data-validation="required">
                        </div>
                        <div class="form-group{{ $errors->has('mtext') ? ' has-error' : '' }}">
                            <label for="mtext" class="control-label">@lang('new.message')</label>
                            <textarea rows="5"
                                   class="form-control"
                                   id="mtext"
                                   value=""
                                   name="mtext"
                                   style="height: 100px;"
                                 data-validation="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="mtype" class="control-label">@lang('new.type')</label>
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="mtype"
                                    name="mtype">
                                <option
                                        value="success"
                                >@lang('new.success')
                                </option>
                                <option
                                        value="warning"
                                >@lang('new.warning')
                                </option>
                                <option
                                        value="info"
                                        selected
                                >@lang('new.information')
                                </option>
                                <option
                                        value="error"
                                >@lang('new.error')
                                </option>
                                <option
                                        value="question"
                                >@lang('new.question')
                                </option>
                            </select>
                            @if ($errors->has('mtype'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('mtype') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="mstatus" class="control-label">@lang('forms.status')</label>
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="mstatus"
                                    name="mstatus">
                                <option
                                        value="1"
                                        selected
                                >@lang('new.active')
                                </option>
                                <option
                                        value="0"
                                >@lang('new.inactive')
                                </option>
                            </select>
                            @if ($errors->has('mstatus'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('mstatus') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="mstime" class="control-label">@lang('new.start_time')</label>
                            <input type="text"
                                   class="form-control"
                                   id="mstime"
                                   value="{{ date_format(date_create("now", new DateTimeZone(auth()->user()->timezone)), 'Y-m-d H:i:s')  }}"
                                   name="mstime"
                                   data-validation="required">
                        </div>
                        <div class="form-group">
                            <label for="metime" class="control-label">@lang('new.expire_time')</label>
                            <input type="text"
                                   class="form-control"
                                   id="metime"
                                   value="{{ date_format(date_create("now", new DateTimeZone(auth()->user()->timezone))->modify('+1 day'), 'Y-m-d H:i:s')  }}"
                                   name="metime"
                                   data-validation="required">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">@lang('buttons.create')</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div> 
@endsection