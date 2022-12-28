@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Fund Records')
@section('content')
    @php
        $dataURL = "/admin/fund-records/data/$id";
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table mydatatable table-bordered table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>@lang('general.user_id')</th>
                                <th>@lang('general.user')</th>
                                <th>Reason</th>
                                <th>@lang('general.date') & Time</th>
                                <th>Before</th>
                                <th>Change Amount</th>
                                <th>After</th>
                                <th>@lang('general.details')</th>
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
                order: [ [3, 'desc'] ],
                ajax: '{!! url($dataURL) !!}',
                columns: [
                    {data: 'user_id', name: 'user_id'},
                    {data: 'name', name: 'name'},
                    {data: 'reason', name: 'reason'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'pricebefore', name: 'pricebefore'},
                    {data: 'amount', name: 'amount'},
                    {data: 'priceafter', name: 'priceafter'},
                    {data: 'details', name: 'details', sortable:false}
                ],
                aoColumnDefs: [ {
                     aTargets: [ 7 ],
                     mRender: function ( data, type, full ) {
                      return $("<div/>").html(data).text(); 
                      }
                } ]
            });
        })
    </script>
@endpush