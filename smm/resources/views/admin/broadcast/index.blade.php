@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Broadcasts')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="mb10">
                <a href="{{ url('/admin/broadcast/create') }}" class="btn btn-primary btn-sm">Create New Broadcast</a>
            </div>        	
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>@lang('new.id')</th>
                                <th>@lang('new.type')</th>
                                <th>@lang('new.title')</th>
                                <th>@lang('new.message')</th>
                                <th>@lang('new.status')</th>
                                <th>@lang('new.start_time')</th>
                                <th>@lang('new.expire_time')</th>
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
                ajax: '{!! url('admin/broadcast-index/data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'Icon', name: 'Icon'},
                    {data: 'MsgTitle', name: 'MsgTitle'},
                    {data: 'MsgText', name: 'MsgText'},
                    {data: 'MsgStatus', name: 'MsgStatus',sortable:false},
                    {data: 'StartTime', name: 'StartTime', sortable:false},
                    {data: 'ExpireTime', name: 'ExpireTime'},
                    {data: 'action', name: 'action', sortable:false, searchable:false}
                ]
            });
        })
    </script>
@endpush