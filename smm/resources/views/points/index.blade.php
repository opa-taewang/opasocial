@extends('layouts.app')
@section('title', getOption('app_name') . ' - Points History')
@section('content')
<style>
    .dataTables_filter { display: none; }
</style>
<div class="inner-dashboard servicePage orderPage">
    <div class="row">
        <div class="col-lg-12">
            <div class="well">
                <div class="table-responsive">
                    <table class="rwd-table table mydatatable table-striped table-sm" style="width: 99.9%">
                        <thead class="thead-dark">
                            <tr>
                                <th><i class="material-icons">format_list_numbered</i> ID</th>
                                <th><i class="material-icons">calendar_today</i> @lang('general.date')</th>
                                <th><i class="material-icons">money</i> @lang('general.amount')</th>
                                <th>Status</th>
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
            var table = $('.mydatatable').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                "ordering": false,
                info: false,
                pageLength: 25,
                order: [ [0, 'desc'] ],
                ajax: '{!! url('/points-history-index/data') !!}',
                columns: [
                    {data: 'id', name: 'id', sortable:false},
                    {data: 'created_at', name: 'created_at', sortable:false},
                    {data: 'amount', name: 'amount', sortable:false},
                    {data: 'status', name: 'status', sortable:false}
                ]
            });
            $('#dataSearchBox').on( 'keyup', function () {
       table.search( this.value ).draw();
    });
        })
    </script>
@endpush