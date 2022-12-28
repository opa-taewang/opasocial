@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - System Settings')
@section('content')
    <link rel="stylesheet" href="/js/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">
    <link rel="stylesheet" href="/vendor/jquery-palette-color-picker/palette-color-picker.css">
    <style>
        .btn-default {
            color: #444;
            padding-top: 5px;
            padding-bottom: 5px;
            background-color: #fff;
        }
    </style>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-form">
                <form role="form"
                      method="POST"
                      enctype="multipart/form-data"
                      action="{{ url('/admin/popup-notification/update') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Popup Notifications</legend>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="control-label">Description</label>
                            <textarea
                                    style="height: 150px;"
                                    class="form-control"
                                    data-validation="required"
                                    rows="5"
                                    id="description"
                                    name="description">{{ $notification->value }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <select name="status" id="front_page" class="form-control">
                                <option value="Enabled" {{ (env('Popup_Notifications') == 'Enabled') ? 'selected' : '' }}>Enabled</option>
                                <option value="Disabled" {{ (env('Popup_Notifications') == 'Disabled') ? 'selected' : '' }}>Disabled</option>
                            </select>
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
@push('scripts')
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
<script src="/vendor/jquery-palette-color-picker/palette-color-picker.js"></script>
<script>
    $(function () {

        $('#theme_color').paletteColorPicker({
            colors: [
                "#0073b7",
                "#E53935",
                "#D32F2F",
                "#C62828",
                "#B71C1C",
                "#EC407A",
                "#E91E63",
                "#D81B60",
                "#C2185B",
                "#AD1457",
                "#880E4F",
                "#AB47BC",
                "#9C27B0",
                "#8E24AA",
                "#7B1FA2",
                "#6A1B9A",
                "#4A148C",
                "#7E57C2",
                "#673AB7",
                "#5E35B1",
                "#512DA8",
                "#4527A0",
                "#311B92",
                "#5C6BC0",
                "#3F51B5",
                "#3949AB",
                "#303F9F",
                "#283593",
                "#1A237E",
                "#2196F3",
                "#1976D2",
                "#1565C0",
                "#0D47A1",
                "#03A9F4",
                "#039BE5",
                "#0288D1",
                "#0277BD",
                "#01579B",
                "#26C6DA",
                "#00BCD4",
                "#00ACC1",
                "#0097A7",
                "#00838F",
                "#006064",
                "#26A69A",
                "#00897B",
                "#004D40",
                "#66BB6A",
                "#43A047",
                "#388E3C",
                "#2E7D32",
                "#1B5E20",
                "#9CCC65",
                "#8BC34A",
                "#8BC34A",
                "#689F38",
                "#558B2F",
                "#33691E",
                "#FFEE58",
                "#FDD835",
                "#FBC02D",
                "#F9A825",
                "#F57F17",
                "#A1887F",
                "#8D6E63",
                "#795548",
                "#6D4C41",
                "#5D4037",
                "#4E342E",
                "#3E2723",
                "#BDBDBD",
                "#9E9E9E",
                "#757575",
                "#616161",
                "#424242",
                "#212121",
                "#78909C",
                "#607D8B",
                "#546E7A",
                "#455A64",
                "#263238",
                "#4285f4",
            ]
        });

        $('#background_color').paletteColorPicker({
            colors: [
                "#fff",
                "#e9ebee",
                "#fafafa"
            ]
        });
    });
</script>

@endpush