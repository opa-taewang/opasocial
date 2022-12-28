@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Users')
@section('content')
    <div class="row">
        <div class="col-md-12 mtn10">
            <div class="mb10">
                <a href="{{ url('/admin/users/create') }}" class="btn btn-primary btn-sm">@lang('buttons.create_new')</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>@lang('general.user_id')</th>
                                <th>User</th>
                                <th>UserID</th>
                                <th>Referred</th>
                                <th>Count</th>
                                <th>Date</th>
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
                order: [ [4, 'desc'] ],
                ajax: '{!! url('admin/users-referralajax/data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'refUid', name: 'refUid'},
                    {data: 'rname', name: 'rname'},
                    {data: 'count', name: 'count'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        })
    </script>
@endpush