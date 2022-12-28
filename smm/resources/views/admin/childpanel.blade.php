@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Child Panel Settings')
@section('content')
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
                <div class="mb10">
            <form role="form" method="post" action="{{url('admin/child-panels/1')}}">
                {{csrf_field()}}
                {{ method_field('PUT') }}
                @if($child_panel=="on")
                <input type="hidden" value="off" name="child_panel" />
                <button type="submit" class="btn btn-warning">Turn Off Child Panel</button>
                @elseif($child_panel=="off" || empty($child_panel))
                <input type="hidden" value="on" name="child_panel" />
                <button type="submit" class="btn btn-info btn-sm">Turn On Child Panel</button>
                @endif
            </form>
        </div>
                              @if(\DB::table('configs')->where('name', 'child_panel_buyer')->value('value')=="smm-script.com")

                <button style="float:right;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#apiModal"><i class="fa fa-ravelry"></i> Update Api key</button>
                @endif
                <form role="form" method="post" action="{{url('admin/child-panels/update/price')}}">
                            {{csrf_field()}}
                      @if(\DB::table('configs')->where('name', 'child_panel_buyer')->value('value')=="smm-script.com")

                        <h4>SMM-SCRIPT Account Info </h4>
                        @if(\DB::table('configs')->where('name', 'child_panel_buyer')->value('value')=="smm-script.com")
    @if(!empty($error))
    <div class="col-12">
        <span class="badge badge-danger">{{$error}}</span>
    </div>
    @endif
    @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Name</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{(isset($info->name)?$info->name:'')}}"
                                   id="name" disabled readonly>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{(isset($info->email)?$info->email:'')}}"
                                   id="email" disabled readonly>
                        </div>
                        <div class="form-group{{ $errors->has('funds') ? ' has-error' : '' }}">
                            <label for="funds" class="control-label">Funds</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{(isset($info->funds)?$info->funds:'')}}"
                                   id="funds" disabled readonly>
                        </div>
                        <div class="form-group{{ $errors->has('api') ? ' has-error' : '' }}">
                            <label for="api" class="control-label">Api Key</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{(isset($info->key)?$info->key:'')}}"
                                   id="api" disabled readonly>
                        </div>
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="control-label">SMM Price</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{(isset($price)?$price:'')}}"
                                   id="price" disabled readonly>
                        </div>
                        @endif
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="api" class="control-label">Amount (for 30 Days)</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{(isset($amount)?$amount:'')}}"
                                   id="amount" name="amount">
                        </div>
                        <div class="form-group{{ $errors->has('buyer') ? ' has-error' : '' }}">
                            <label for="api" class="control-label">Panel Provider</label>
                            <select id="buyer" name="buyer" data-validation="required" class="form-control" required>
                                <option value="">Choose Option</option>
                                <option value="admin" {{($buyer=='admin')?'selected':''}}>Panel Admin</option>
                                <option value="smm-script.com" {{($buyer=='smm-script.com')?'selected':''}}>SMM Script</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit"
                                   class="btn btn-primary"
                                   value="Submit" >
                        </div>
                        </form>
            </div>
        </div>
    </div>
<div class="modal fade" id="apiModal" tabindex="-1" role="dialog" aria-labelledby="apiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="apiModalLabel">Update Api Key</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" action="{{url('admin/child-panels')}}">
          {{csrf_field()}}
          <div class="modal-body">
              <div class="form-group">
                <label for="currentKey" class="control-label">Current Api Key:</label>
                <input type="text" value="{{(isset($info->key)?$info->key:'')}}" class="form-control" id="currentKey" readonly disabled>
              </div>
              <div class="form-group">
                <label for="newKey" class="control-label">New Api Key:</label>
                <input type="text" class="form-control" id="newKey" name="key">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
@push('scripts')

@endpush