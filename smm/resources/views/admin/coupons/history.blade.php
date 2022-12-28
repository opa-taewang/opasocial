@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Coupons History')
@section('content')
    <div class="row">
        <div class="col-md-12 mtn10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Amount</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">@lang('general.action')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
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
                ajax: '{!! url('admin/coupons-history-ajax/data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'coupon_id', name: 'coupon_id'},
                    {data: 'amount', name: 'amount'},
                    {data: 'name', name: 'name'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script>
@endpush