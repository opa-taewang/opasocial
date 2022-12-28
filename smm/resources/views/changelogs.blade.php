@extends('layouts.app')
@section('title', getOption('app_name') . ' - ChangeLogs')
@section('content')
<style>
.dataTables_filter { 
    display: none;
}
table.dataTable thead .sorting::after,
table.dataTable thead .sorting_desc::after,
.dataTables_length {
    display: none;
}
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="well">
            <div class="table-responsive">
                <table class="serviceTable table table-sm mydatatable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Package ID</th>
                            <th>Package Name</th>
                            <th>Change</th>
                            <th>When</th>
                        </tr>
                    </thead>
                </table>
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
                                order: [ [3, 'desc'] ],
                ajax: '{!! url('/synced-index/data') !!}',
                columns: [
                    {data: 'package_id', name: 'package_id'},
                    {data: 'package_name', name: 'package_name'},
                    {data: {
                         'action': "action",
                        'color':"color"
                        },
                    render : function(data, type, row) {
                            if(data)
                                return' <span style="background-color:'+data.color+';color:white;">'+data.action+'</span>';
                                else
                                return '';
                        },name: 'action'},
                     {data: 'created_at', name: 'created_at'},
                    
                ]
            });
        })
    </script>
@endpush