@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - API Fetch')
@section('content')
    <div class="row">
        <div class="col-md-4  col-md-offset-4" style="margin-bottom: 5px;">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/apifetch/show') }}">
                    {{ csrf_field() }}
                    @if( ! $apis->isEmpty() )
	                    <fieldset class="scheduler-border">
	                        <div class="form-group{{ $errors->has('service_id') ? ' has-error' : '' }}">
	                            <select name="api_id"
	                                    id="api_id"
	                                    data-validation="required"
	                                    class="form-control">
	                                <option value="">Select an API</option>
	                                    @foreach( $apis as $api)
	                                        <option value="{{ $api->id }}"> {{ $api->name  }}</option>
	                                    @endforeach
	                            </select>
	                            @if ($errors->has('api_id'))
	                                <span class="help-block">
	                                <strong>{{ $errors->first('api_id') }}</strong>
	                            </span>
	                            @endif
	                        </div>
	                        <div class="form-group{{ $errors->has('profit_percentage') ? ' has-error' : '' }}">
	                            <input type="text"
	                                   class="form-control"
	                                   data-validation="number"
	                                   placeholder="Profit Percentage"
	                                   data-validation-allowing="float"
	                                   id="profit_percentage"
	                                   value="{{ old('profit_percentage') }}"
	                                   name="profit_percentage">
	                            @if ($errors->has('profit_percentage'))
	                                <span class="help-block">
	                                        <strong>{{ $errors->first('profit_percentage') }}</strong>
	                                    </span>
	                            @endif
	                        </div>
	                        <div class="form-group" style="float:right">
	                            <button type="submit" id="btn-proceed" class="btn btn-primary">Fetch Packages</button>
	                        </div>
	                        <td> <a class="btn btn-primary" href="{{ URL::to('admin/remove_table/1') }}"><i class="fa fa-edit"></i>
        Remove Temporary Fetch</a></td>
	                    </fieldset>
	                  @else
	                    <span class="help-block">
	                                <strong>No APIs configured with package end point. Please update your API configurations.</strong>
	                    </span>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection