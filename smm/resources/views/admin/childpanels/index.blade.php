@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Child Panel Orders')
@section('content')
    <div class="row">
        <div class="col-md-12 mtn10">
            <div class="mb10">
                <a class="btn btn-primary btn-sm" href="{{url('admin/child-panels/orders/sync')}}"><i class="fab fa-ravelry" aria-hidden="true"></i> Sync</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>User Email</th>
                                <th>Domain</th>
                                <th>Admin User</th>
                                <th>Admin Password</th>
                                <th>Buyer</th>
                                <th>Amount</th>
                                <th>@lang('general.status')</th>
                                <th>@lang('general.date')</th>
                                <th>Last Updated</th>
                                <th>Action</th>
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
                ajax: '{!! url('admin/child-panels-orders/data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'domain', name: 'domain'},
                    {data: 'admin_user', name: 'admin_user'},
                    {data: 'admin_password', name: 'admin_password'},
                    {data: 'buyer', name: 'buyer'},
                    {data: 'amount', name: 'amount'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        })
    </script>
@endpush