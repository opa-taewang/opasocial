@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Edit BroadCast')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/broadcast') }}"><i class="fa fa-dashboard"></i>@lang('new.broadcasts')</a></li>
                <li class="active">@lang('forms.edit')({{$broadcast->id}})</li>
            </ol>
        </div>
    </div>
    @php
      // echo phpinfo();
    @endphp
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/broadcast/'.$broadcast->id.'/update') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">@lang('new.broadcast_details')</legend>
                        <div class="form-group">
                            <label for="mtitle" class="control-label">@lang('new.title')</label>
                            <input type="text"
                                   class="form-control"
                                   id="mtitle"
                                   value="{{ $broadcast->MsgTitle }}"
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
                                 data-validation="required">{{ $broadcast->MsgText }}</textarea>
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
                                        {{ $broadcast->Icon === 'success' ? 'selected' : '' }}
                                >@lang('new.success')
                                </option>
                                <option
                                        value="warning"
                                        {{ $broadcast->Icon === 'warning' ? 'selected' : '' }}
                                >@lang('new.warning')
                                </option>
                                <option
                                        value="info"
                                        {{ $broadcast->Icon === 'info' ? 'selected' : '' }}
                                >@lang('new.information')
                                </option>
                                <option
                                        value="error"
                                        {{ $broadcast->Icon === 'error' ? 'selected' : '' }}
                                >@lang('new.error')
                                </option>
                                <option
                                        value="question"
                                        {{ $broadcast->Icon === 'question' ? 'selected' : '' }}
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
                                        {{ $broadcast->MsgStatus == '1' ? 'selected' : '' }}
                                >@lang('new.active')
                                </option>
                                <option
                                        value="0"
                                        {{ $broadcast->MsgStatus == '0' ? 'selected' : '' }}
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
                                   value="{{ $broadcast->StartTime }}"
                                   name="mstime"
                                   data-validation="required">
                        </div>
                        <div class="form-group">
                            <label for="metime" class="control-label">@lang('new.expire_time')</label>
                            <input type="text"
                                   class="form-control"
                                   id="metime"
                                   value="{{ $broadcast->ExpireTime }}"
                                   name="metime"
                                   data-validation="required">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">@lang('buttons.update')</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div> 
@endsection
@push('scripts')
<script src="/js/nicedit/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() {
     new nicEditor({
        fullPanel : true
        // buttonList : [
        // 'bold',
        // 'italic',
        // 'underline',
        // 'left',
        // 'center',
        // 'right',
        // 'justify',
        // 'ol',
        // 'ul',
        // 'fontSize',
        // 'fontFamily',
        // 'fontFormat',
        // 'indent',
        // 'outdent',
        // 'upload',
        // 'forecolor',
        // 'bgcolor',
        // 'link',
        // 'unlink',
        // 'removeformat',
        // 'html'
        // ]
        }).panelInstance('')
    });
</script>
@endpush