@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Edit '.$ad->title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/ads') }}"><i class="fa fa-dashboard"></i> Ads & Banners</a></li>
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
                        enctype="multipart/form-data"
                        action="{{ url('/admin/ads/'.$ad->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Edit {{ $ad->title }}</legend>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="control-label">Status</label>
                            <select class="form-control" data-validation="required" name="type" onchange="showType(this)">
                                <option>Select Type</option>
                                <option value="Code" {{ ($ad->code)?'selected':'' }}>Code</option>
                                <option value="Image" {{ ($ad->image)?'selected':'' }}>Image</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }} {{ ($ad->code)?'':'hide' }}" id="code_div">
                            <label for="code" class="control-label">Code</label>
                            <textarea rows="5"
                                   class="form-control"
                                   data-validation="required"
                                   id="code"
                                   name="code">
                                {{ $ad->code }}
                                </textarea>
                            @if ($errors->has('code'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} {{ ($ad->image)?'':'hide' }}" id="image_div">
                            <label for="image" class="control-label">Image</label>
                            <div>
                                @if($ad->title=="Blog Right Sidebar")
                                <img src="{{ ($ad->image)?url('ads/images/'.$ad->image):'https://via.placeholder.com/360x516.png?text=Place+your+ad+banner+(+360+x+516+)' }}" style="width: 360px; height: 516px;" id="banner_img">
                                @else
                                <img src="{{ ($ad->image)?url('ads/images/'.$ad->image):'https://via.placeholder.com/200x140.png?text=Place+your+ad+banner+(+200+x+140+)' }}" style="width: 400px; height: 140px;" id="banner_img">
                                @endif
                                </div>
                            <input type="file"
                                   class="form-control"
                                   id="image"
                                   name="image">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="control-label">Sponsor Link</label>
                            <input type="text"
                                   class="form-control"
                                   data-validation="required"
                                   id="link"
                                   value="{{ $ad->link }}"
                                   name="link" />
                            @if ($errors->has('link'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="control-label">Status</label>
                            <select class="form-control" data-validation="required" name="status">
                                <option value="Enabled" {{ ($ad->status=="Enabled")?'selected':'' }}>Enabled</option>
                                <option value="Disabled" {{ ($ad->status=="Disabled")?'selected':'' }}>Disabled</option>
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
<script>
    function showType(input) {
        if(input.value=="Code")
        {
            $('#code_div').removeClass('hide');
            $('#code').attr('required',true);
            $('#image').attr('required',false);
            $('#image_div').addClass('hide');
        }
        if(input.value=="Image")
        {
            $('#code_div').addClass('hide');
            $('#code').attr('required',false);
            $('#image').attr('required',true);
            $('#image_div').removeClass('hide');
        }
    }
    $(document).ready(function(){
        // $('#banner_img').attr('src','https://smm-script.com/ads/images/1568627185_wideskyscraper_banner.png');
    });
</script>
@endsection