@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Edit User Group')
@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.multiselect.css') }}" />
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/groups') }}"><i class="fa fa-dashboard"></i> User's Group</a></li>
                <li class="active">@lang('menus.edit')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/groups/'.$group->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Edit Group</legend>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Name</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $group->name }}"
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
                                   value="{{ $group->price_percentage }}"
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
                                   value="{{ ($group->funds_limit)?$group->funds_limit:0 }}"
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
                                   value="{{ ($group->point_percent)?$group->point_percent:0 }}"
                                   data-validation="required"
                                   id="point_percent"
                                   name="point_percent">
                            @if ($errors->has('point_percent'))
                                <span class="help-block">
                                        <strong>Point Percent is required</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('packages') ? ' has-error' : '' }}">
                            <label for="packages" class="control-label">Select Packages</label>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>@lang('general.package_id')</th>
                                <th>@lang('general.name')</th>
                                <th><input type="checkbox" class="input-sm checkbox-all" id="selall"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if( ! empty($packages) )
                            
                                @php
                                $pkg_ids=explode(",",$group->package_ids);
                                @endphp
                                
                                @foreach($packages as $key => $package)
                                <tr>
                                        <td>{{ $package->id }}</td>
                                        <td>{{ $package->name }}</td>
                                        <td><input 
                                                type="checkbox" 
                                                class="input-sm form-control row-checkbox" 
                                                name="packages[]" 
                                                value="{{$package->id}}"
                                                @if(in_array($package->id,$pkg_ids))
                                                    {{ 'checked' }}
                                                    @php
                                                        $key += 1;
                                                    @endphp
                                                @endif
                                                >
                                        </td>
                                    </tr>
                                @endforeach
                             @else
                                <tr>
                                    <td colspan="3">No Record Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="form-group">
                          <input type="checkbox" {{($group->isdefault)?'checked':''}} name="isdefault" id="html">
                          <label for="html">Default Group</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('buttons.update')</button>
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
<script>
            $(function () {
                if('{{$pkg_ids == $key}}'){
                    $('.checkbox-all').trigger('click');
                }
            }); 
        $(document).on('click', '.checkbox-all', function () {
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
        });     
    </script>
@endpush