@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Edit Post')
@section('content')
<link href="{{ url('css/fSelect.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ url('wysiwyg/Blackedit.css') }}">
<link rel="stylesheet" 
      href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" 
      integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" 
      crossorigin="anonymous">
<style>
    #editor {
        min-width: 680px !important;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/blog') }}"> Posts</a></li>
                <li class="active">@lang('menus.edit')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        enctype="multipart/form-data"
                        action="{{ url('/admin/blog/'.$post->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Edit Post</legend>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $post->title }}"
                                   data-validation="required"
                                   id="title"
                                   name="title">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="control-label">Image</label>
                            <input type="file"
                                   class="form-control"
                                   value="{{ old('image') }}"
                                   data-validation="required"
                                   id="image"
                                   name="image">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
                            <label for="short_description" class="control-label">Description</label>
                            <textarea 
                                   class="form-control"
                                   rows="5"
                                   data-validation="required"
                                   id="short_description"
                                   name="short_description">
                                {{ $post->short_description }}
                                </textarea>
                            @if ($errors->has('short_description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('short_description') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <textarea
                                    style="height: 500px"
                                    name="description"
                                    id="description"
                                    data-validation="required"
                                    class="form-control">{{ $post->description }}</textarea>
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="control-label">Status</label>
                            <select name="status" class="form-control" data-validation="required" required>
                                <option value="Active" {{ ($post->status=='Active')?'selected':'' }}>Active</option>
                                <option value="Deactivated" {{ ($post->status=='Deactivated')?'selected':'' }}>Deactivated</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="{{ url('js/fSelect.js') }}"></script>
        <script>
        (function($) {
            $(function() {
                window.fs_test = $('.all_clients').fSelect();
            });
        })(jQuery);
        </script>
        
<script src="{{ url('wysiwyg/blackedit.js') }}"></script>
<script>
    $(document).ready(function() {
        var ed = new Editor('editor');
        ed.init();
    });
    $(window).bind("load",function() {
      $('#editor > div:nth-child(2)').html('{!! $post->description !!}');
    });
</script>
<script src="/js/nicedit/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() {
     new nicEditor({
        buttonList : [
        'bold',
        'italic',
        'underline',
        'left',
        'center',
        'right',
        'justify',
        'ol',
        'ul',
        'fontSize',
        'fontFamily',
        'fontFormat',
        'indent',
        'outdent',
        'upload',
        'forecolor',
        'bgcolor',
        'link',
        'unlink',
        'removeformat'
        ]}).panelInstance('description')
    });
</script>
@endsection