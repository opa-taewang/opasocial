@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Fund Load History')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="mb10">
                <a data-toggle="modal" data-target="#addfunds" class="btn btn-primary btn-sm">Add Funds</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table mydatatable table-bordered table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>@lang('general.transaction_id')</th>
                                <th>@lang('general.user_id')</th>
                                <th>@lang('general.user')</th>
                                <th>@lang('general.payment_method')</th>
                                <th>@lang('general.date')</th>
                                <th>@lang('general.amount')</th>
                                <th>Amount INR</th>
                                <th>@lang('general.details')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="addfunds" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="viewTitle">Add Funds</h5>
      </div>
      <form role="form" method="POST"  action="{{ url('/admin/add-funds/admin') }}">
        {{ csrf_field() }}
          <div class="modal-body">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">User Email</label>
                <input type="text" class="form-control" placeholder="User Email" data-validation="required" id="email" name="email">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                        <label for="payment_method_id" class="control-label">@lang('general.payment_method')</label>
                        <select
                                class="form-control"
                                data-validation="required"
                                id="payment_method_id"
                                name="payment_method_id">
                            <option value="">Select</option>
                            @foreach($paymentMethods as $payment)
                                <option value="{{ $payment->id }}">{{$payment->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group{{ $errors->has('fund') ? ' has-error' : '' }}">
                        <label for="fund" class="control-label">@lang('forms.funds')</label>
                        <input type="text"
                               class="form-control"
                               value=""
                               id="fund"
                               data-validation="number"
                               data-validation-allowing="float"
                               name="fund">
                        @if ($errors->has('fund'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fund') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                        <label for="details" class="control-label">@lang('general.details')</label>
                        <textarea name="details"
                                  class="form-control"
                                  data-validation="required"
                                  rows="4"
                                  style="height: 80px;"
                                  id="details"></textarea>
                        @if ($errors->has('details'))
                            <span class="help-block">
                                <strong>{{ $errors->first('details') }}</strong>
                            </span>
                        @endif
                    </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('.mydatatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                order: [ [0, 'desc'] ],
                ajax: '{!! url('admin/funds-load-history/data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'payment_method.name', name: 'payment_method.name',sortable:false,searchable:false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'amount', name: 'amount'},
                    {data: 'amountconversion', name: 'amountconversion', sortable:false},
                    {data: 'details', name: 'details', sortable:false}
                ]
            });
        })
    </script>
@endpush