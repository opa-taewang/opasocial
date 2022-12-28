@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - System Settings')
@section('content')
    <link rel="stylesheet" href="{{ asset('js/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-palette-color-picker/palette-color-picker.css') }}">
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
                        <h4>System Info</h4>

                        <div class="form-group{{ $errors->has('Installed_Domain') ? ' has-error' : '' }}">
                            <label for="Installed_Domain" class="control-label">Installed Domain</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{config('console.domain')}}"
                                   id="Installed_Domain" disabled readonly>
                            @if ($errors->has('Installed_Domain'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Installed_Domain') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('version') ? ' has-error' : '' }}">
                            <label for="version" class="control-label">Panel Version</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{config('console.version')}}"
                                   id="version" disabled readonly>
                            @if ($errors->has('version'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('version') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('license') ? ' has-error' : '' }}">
                            <label for="license" class="control-label">Panel License</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{config('console.license')}}"
                                   id="license" disabled readonly>
                            @if ($errors->has('license'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('license') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('installtime') ? ' has-error' : '' }}">
                            <label for="installtime" class="control-label">Installed On</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{config('console.installtime')}}"
                                   id="installtime" disabled readonly>
                            @if ($errors->has('installtime'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('installtime') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('licensetype') ? ' has-error' : '' }}">
                            <label for="licensetype" class="control-label">License Type</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{config('console.licensetype')}}"
                                   id="licensetype" disabled readonly>
                            @if ($errors->has('licensetype'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('licensetype') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="control-label"> MXZ Username</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{config('console.username')}}"
                                   id="username" disabled readonly>
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('secretcode') ? ' has-error' : '' }}">
                            <label for="secretcode" class="control-label">Secret Code</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{config('console.secretcode')}}"
                                   id="secretcode" disabled readonly>
                            @if ($errors->has('secretcode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('secretcode') }}</strong>
                                </span>
                            @endif
                        </div>
                 
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('js/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-palette-color-picker/palette-color-picker.js') }}"></script>
<script>
 function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("secretcode");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}   
</script>
<script>
    $(function () {
        //bootstrap WYSIHTML5 - text editor
        $("#home_page_description").wysihtml5({
            toolbar: {
                "font-styles": true, // Font styling, e.g. h1, h2, etc.
                "emphasis": true, // Italics, bold, etc.
                "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
                "html": true, // Button which allows you to edit the generated HTML.
                "link": false, // Button to insert a link.
                "image": false, // Button to insert an image.
                "color": true, // Button to change color of font
                "blockquote": true, // Blockquote,
                "size": 'sm'
            }
        });

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