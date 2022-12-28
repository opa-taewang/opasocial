@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Send Message')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/users') }}"><i class="fa fa-dashboard"></i> @lang('menus.users')</a></li>
                <li class="active">@lang('new.sendmsg')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/users/message') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">@lang('new.sendmsg')</legend><hr>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="control-label" style="font-size: 20px"><a href="edit">{{$user->name}}</a> (@lang('new.id'): {{$user->id}})</label>
                            <input type="hidden"
                                   class="form-control"
                                   data-validation="required"
                                   id="user_id"
                                   value="{{$user->id}}"
                                   name="user_id" >
                        </div>
                        <div class="form-group">
                            <label for="type" class="control-label">@lang('new.type')</label>
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="type"
                                    name="type">
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
                            @if ($errors->has('type'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">@lang('new.msgtitle')</label>
                            <input type="text"
                                   class="form-control"
                                   data-validation="required"
                                   id="title"
                                   value="{{ old('title') }}"
                                   name="title">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="control-label">@lang('new.message')</label>
                            <textarea
                                    class="form-control"
                                    data-validation="required"
                                    id="message"
                                    style="height: 150px;resize:none"
                                    name="message">{{old('message')}}</textarea>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('buttons.send')</button>    
                            <a href="{{ url('/admin/users/') }}" class="btn btn-inverse" title="Discard">@lang('new.discard')</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default panel-custom-bordered">
                <div class="panel-heading">
                    @lang('new.sentmsg')
                </div>
                <div class="panel-body note-from-admin-body" style="overflow:auto;">
                    {!! $note !!}
                </div>
            </div>
        </div> 
    </div>  
@endsection