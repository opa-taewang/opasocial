@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Synced Changes')
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px;">
            <div class="btn-group">
                <a href="{{ url('/admin/mail') }}" class="btn btn-primary btn-sm">Sync Again</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>API</th>
                                <th>API Name</th>
                                <th>Package ID</th>
                                <th>Package Name</th>
                                <th>Change</th>
                                <th>Action Done</th>
                                <th>When</th>
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
                order: [ [6, 'desc'] ],
                ajax: '{!! url('admin/synced-index/data') !!}',
                columns: [
                    {data: 'api_id', name: 'api_id'},
                    {data: 'api_name', name: 'api_name'},
                    {data: 'package_id', name: 'package_id'},
                    {data: 'package_name', name: 'package_name'},
                    {data: 'reason', name: 'reason'},
                    {data: 'action', name: 'action'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        })
    </script>
@endpush