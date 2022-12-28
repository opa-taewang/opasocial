@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Package - '.$package->name)
@section('content')
<style>
    .badge-info {
        background-color: #1abc9c;
    }.badge-used {
        background-color: #bdc3c7;
    }
    .foo {
      float: right;
      width: 10px;
      height: 10px;
      margin: 8px;
      border: 1px solid rgba(0, 0, 0, .2);
    }
    
    .free {
      background: #1abc9c;
    }
    .used {
        background: #bdc3c7;
    }
</style>
<link href="{{ url('css/tagsinput.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/dropzone.css') }}" rel="stylesheet" type="text/css">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/packages') }}"><i class="fa fa-dashboard"></i> @lang('menus.packages')</a></li>
                <li class="active">@lang('menus.edit')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-form">
                <form
                        role="form"
                        id="form"
                        method="POST"
                        action="{{ url('/admin/packages/'.$package->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">@lang('forms.edit_package')</legend>
                        <div class="form-group{{ $errors->has('service_id') ? ' has-error' : '' }}">
                            <label for="service_id" class="control-label">@lang('forms.service')</label>
                            <select name="service_id"
                                    id="service_id"
                                    data-validation="required"
                                    class="form-control">
                                @if( ! $services->isEmpty() )
                                    @foreach( $services as $service)
                                        <option value="{{ $service->id }}"
                                                @if($service->id == $package->service_id)
                                                selected
                                                @endif
                                        > {{ $service->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('service_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('service_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">@lang('forms.name')</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $package->name }}"
                                   data-validation="required"
                                   id="name"
                                   name="name">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        
                        <div class="form-group{{ $errors->has('price_per_item') ? ' has-error' : '' }}">
                            <label for="price_per_item" class="control-label">@lang('forms.price')</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $package->price_per_item }}"
                                   data-validation="number"
                                   placeholder="00.00000"
                                   data-validation-allowing="float"
                                   id="price_per_item"
                                   name="price_per_item">
                            @if ($errors->has('price_per_item'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('price_per_item') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('minimum_quantity') ? ' has-error' : '' }}">
                            <label for="minimum_quantity" class="control-label">@lang('forms.minimum_quantity')</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $package->minimum_quantity }}"
                                   data-validation="number"
                                   id="minimum_quantity"
                                   name="minimum_quantity">
                            @if ($errors->has('minimum_quantity'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('minimum_quantity') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('maximum_quantity') ? ' has-error' : '' }}">
                            <label for="maximum_quantity" class="control-label">@lang('forms.maximum_quantity')</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $package->maximum_quantity }}"
                                   data-validation="number"
                                   id="maximum_quantity"
                                   name="maximum_quantity">
                            @if ($errors->has('maximum_quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('maximum_quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="control-label">@lang('forms.description')</label>
                            <textarea
                                    class="form-control"
                                    data-validation="required"
                                    id="description"
                                    onkeyup="auto_grow(this)"
                                    style="resize: none;overflow: hidden;min-height: 50px;"
                                    name="description">{{ $package->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="refillbtn" class="control-label">@lang('new.rflbtn')</label>
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="refillbtn"
                                    name="refillbtn">
                                <option
                                        value="0"
                                        {{ $package->refillbtn == '0' ? 'selected' : '' }}>No
                                </option>
                                <option
                                        value="1"
                                        {{ $package->refillbtn == '1' ? 'selected' : '' }}>Yes
                                </option>
                            </select>
                        </div>
                        <div class="form-group{{ $errors->has('refill_time') ? ' has-error' : '' }}">
                            <label for="refill_time" class="control-label">No. of Refills</label>
                            <input name="refill_time"
                                   id="refill_time"
                                   type="text"
                                   value="{{ $package->refill_time }}"
                                   class="form-control"
                                   placeholder="0">
                            @if ($errors->has('refill_time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('refill_time') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('refill_period') ? ' has-error' : '' }}">
                            <label for="refill_period" class="control-label">Refill period (Days)</label>
                            <input name="refill_period"
                                   id="refill_period"
                                   type="text"
                                   value="{{ $package->refill_period }}"
                                   class="form-control"
                                   placeholder="0">
                            @if ($errors->has('refill_period'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('refill_period') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="custom_comments" class="control-label">@lang('forms.custom_comments')</label>
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="custom_comments"
                                    name="custom_comments">
                                <option
                                        value="0"
                                        {{ $package->custom_comments == '0' ? 'selected' : '' }}>No
                                </option>
                                <option
                                        value="1"
                                        {{ $package->custom_comments  == '1' ? 'selected' : '' }}>Yes
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="features" class="control-label">@lang('new.features')</label>
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="features"
                                    name="features">
                                <option
                                        value="No"
                                        {{ $package->features == 'No' ? 'selected' : '' }}>No
                                </option>
                                <option
                                        value="Drip Feed"
                                        {{ $package->features == 'Drip Feed' ? 'selected' : '' }}>@lang('new.df')
                                </option>
                                
                            </select>
                        </div>
                        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                            <label for="position" class="control-label">Sort Order</label>
                            <input name="position"
                                   id="position"
                                   type="text"
                                   value="{{ $package->position }}"
                                   class="form-control"
                                   data-validation="number"
                                   placeholder="">
                            @if ($errors->has('position'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('position') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="control-label">@lang('forms.status')</label>
                            <select
                                    class="form-control"
                                    data-validation="required"
                                    id="status"
                                    name="status">
                                <option
                                        value="ACTIVE"
                                        {{ $package->status == 'ACTIVE' ? 'selected' : '' }}
                                >ACTIVE
                                </option>
                                <option
                                        value="INACTIVE"
                                        {{ $package->status == 'INACTIVE' ? 'selected' : '' }}
                                >INACTIVE
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="preferred_api_id" class="control-label">@lang('forms.api')</label>
                            <select class="form-control" name="preferred_api_id" id="preferred_api_id">
                                <option value="">Select</option>
                                @if(! $apis->isEmpty()):
                                @foreach ($apis as  $api):
                                <option value="{{$api->id}}" {{ ($api->id == $package->preferred_api_id) ? 'selected' : '' }}>{{$api->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group{{ $errors->has('seller_package_id') ? ' has-error' : '' }}">
                            <label for="seller_package_id" class="control-label">Seller Package ID</label>
                            <input type="text"
                                   class="form-control"
                                   id="seller_package_id"
                                   value="{{ $api_package_id }}"
                                   name="seller_package_id" {{isset($package->preferred_api_id) ? '' : 'readonly'}}>
                            @if ($errors->has('seller_package_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('seller_package_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('cost_per_item') ? ' has-error' : '' }}">
                            <label for="cost_per_item" class="control-label">Cost Per Item</label>
                            <input type="text"
                                   class="form-control"
                                   id="cost_per_item"
                                   value="{{ $package->cost_per_item }}"
                                   name="cost_per_item">
                            @if ($errors->has('cost_per_item'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cost_per_item') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('seller_cost') ? ' has-error' : '' }}">
                            <label for="seller_cost" class="control-label">Seller Cost</label>
                            <input type="text"
                                   class="form-control"
                                   id="seller_cost"
                                   value="{{ $package->seller_cost }}"
                                   name="seller_cost">
                            @if ($errors->has('seller_cost'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('seller_cost') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        
                        <div class="form-group">
                            <button type="submit" id="submit" class="btn btn-primary">@lang('buttons.update')</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
            function auto_grow(element) {
                element.style.height = "5px";
                element.style.height = (element.scrollHeight+10)+"px";
            }       
            $(function () {
                $("textarea").each(function () {
                    this.style.height = (this.scrollHeight+10)+'px';
                });
                $('#preferred_api_id').change(function () {
                    var preferred_api_id = $(this).val();
                    if (preferred_api_id !== '') {
                        $('#seller_package_id').prop('readonly',false);
                    }else{
                        $('#seller_package_id').prop('readonly',true);
                    }
                });
            });    </script>     
<script src="{{ url('js/tagsinput.js') }}"></script>
<script src="{{ url('js/dropzone.js') }}"></script>
    <script>
            function auto_grow(element) {
                element.style.height = "5px";
                element.style.height = (element.scrollHeight+10)+"px";
            }
            $(document).ready(function(){
                var up=0;
                Dropzone.options.myDropzone= {
                    url: '{{ url("/admin/packages/ajax/".$package->id) }}',
                    autoProcessQueue: false,
                    uploadMultiple: false,
                    parallelUploads: 1,
                    maxFiles: 1,
                    maxFilesize: 500,
                    addRemoveLinks: true,
                    sending: function(file, xhr, formData) {
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("service_id", $("#service_id").val());
                        formData.append("name", $("#name").val());
                        formData.append("price_per_item", $("#price_per_item").val());
                        formData.append("minimum_quantity", $("#minimum_quantity").val());
                        formData.append("maximum_quantity", $("#maximum_quantity").val());
                        formData.append("description", $("#form > fieldset > div:nth-child(7) > div:nth-child(3) > div").html());
                        formData.append("refillbtn", $("#refillbtn").val());
                        formData.append("custom_comments", $("#custom_comments").val());
                        formData.append("features", $("#features").val());
                        formData.append("position", $("#position").val());
                        formData.append("status", $("#status").val());
                        formData.append("preferred_api_id", $("#preferred_api_id").val());
                        formData.append("license_codes", $("#license_codes").val());
                        formData.append("ajax", 1);
                    },
                    init: function() {
                        dzClosure = this;
                        $("#submit").on("click", function(e) {
                            up=1;
                            $('#submit').html('<i class="fa fa fa-spinner fa-spin"></i> Processing...');
                            if (dzClosure.getQueuedFiles().length > 0) {
                                e.preventDefault();
                                e.stopPropagation();
                                $('#submit').prop('disabled', true);
                                dzClosure.processQueue();                        
                            } 
                        });
                        this.on("sendingmultiple", function(data, xhr, formData) {
                            
                        });
                    },
                    success: function(file, response)
                    {
                        alert('success');
                        $('#submit').prop('disabled', false);
                        location.reload();
                    },
                    error: function(file, response)
                    {
                        alert('error');
                        $('#submit').prop('disabled', false);
                        location.reload();
                    }
                }
                
            });
    </script>
@endpush