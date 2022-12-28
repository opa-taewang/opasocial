@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - User Groups')
@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.multiselect.css') }}" />
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/groups') }}"> User's Groups</a></li>
                <li class="active">@lang('menus.new')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/groups') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">New Group</legend>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Name</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   data-validation="required"
                                   id="name"
                                   name="name">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('pricepercentage') ? ' has-error' : '' }}">
                            <label for="pricepercentage" class="control-label">Price percentage</label>
                            <input type="number"
                                   class="form-control"
                                   value="{{ old('pricepercentage') }}"
                                   data-validation="required"
                                   id="pricepercentage"
                                   name="pricepercentage">
                            @if ($errors->has('pricepercentage'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('pricepercentage') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('funds_limit') ? ' has-error' : '' }}">
                            <label for="funds_limit" class="control-label">Funds Limit</label>
                            <input type="number"
                                   class="form-control"
                                   value="0"
                                   data-validation="required"
                                   id="funds_limit"
                                   name="funds_limit">
                            @if ($errors->has('funds_limit'))
                                <span class="help-block">
                                        <strong>Funds Limit is required</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('point_percent') ? ' has-error' : '' }}">
                            <label for="point_percent" class="control-label">Point Percent</label>
                            <input type="number"
                                   class="form-control"
                                   value="0"
                                   data-validation="required"
                                   id="point_percent"
                                   name="point_percent">
                            @if ($errors->has('point_percent'))
                                <span class="help-block">
                                        <strong>Funds Limit is required</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('packages') ? ' has-error' : '' }}">
                            <label for="packages" class="control-label">Select Packages</label>
                            <select id="multiple-checkboxes" name="packages[]" class="selectpicker" multiple>
                                @foreach($packages as $key => $package)
                                <option value="{{$package->id}}"><span class="ptext">{{$key+1}}. {{$package->name}}</span></option>
                                @endforeach
                            </select>
                            @if ($errors->has('packages'))
                                <span class="help-block">
                                        <strong>Please select atleast one package</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                          <input type="checkbox" name="isdefault" id="html">
                          <label for="html">Make Default Group</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('buttons.create')</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
@endsection
@push('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.multiselect.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#multiple-checkboxes').multiselect({
            columns: 1,
            placeholder: 'Select Packages',
            search: true,
            selectAll: true
        });
    });
</script>
@endpush