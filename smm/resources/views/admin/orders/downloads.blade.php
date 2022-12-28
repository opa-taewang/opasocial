@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Downloads')
@section('content')
@php
        $status = $status ?? false;
        $dataURL = "admin/downloadrecords-ajax/data";
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Script Name</th>
                                <th>UserId</th>
                                <th>Last Downloaded IP</th>
                                <th>Downloads</th>
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
                order: [[1, 'desc']],
                ajax: '{!! url($dataURL) !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'script_name', name: 'script_name'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'ip', name: 'ip'},
                    {data: 'downloads', name: 'downloads'},
                ]
            });

        });
    </script>
@endpush