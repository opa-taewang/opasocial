@extends('layouts.app')
@section('title', getOption('app_name') . ' - New Ticket')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}"> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/support') }}">@lang('menus.ticket')</a></li>
                <li class="active">@lang('menus.new')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-form">
                <form role="form" method="POST" action="{{ url('/support/ticket/store') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">@lang('forms.new_ticket')</legend>
                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="subject" class="control-label">@lang('forms.subject')</label>
                            <input type="text"
                                   class="form-control"
                                   id="subject"
                                   value="{{ old('subject') }}"
                                   name="subject"
                                   data-validation="required">
                            @if ($errors->has('subject'))
                                <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                            <form role="form" method="POST" action="{{ url('/support/'.$ticket->id.'/message') }}">
                                {{ csrf_field() }}
                                <div class="form-group panel-border-top {{ $errors->has('content') ? ' has-error' : '' }}">
                                    <label for="message" class="control-label">@lang('general.new_message')</label>
                                    <textarea class="form-control" id="content" name="content" rows="4" data-validation="required"></textarea>
                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <button class="btn btn-primary" type="submit">@lang('buttons.send')</button>
                            </form>
                        </div>
                    </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="/js/nicedit2/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() {
     new nicEditor({
        buttonList : [
        'upload'
        ]}).panelInstance('description')
    });
</script>
@endpush