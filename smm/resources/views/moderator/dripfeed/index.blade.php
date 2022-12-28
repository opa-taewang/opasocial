@extends('moderator.layouts.app')
@section('title', getOption('app_name') . ' - Drip Feed Orders')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="mydatatable" class="table mydatatable table-bordered table-hover "style="width: 99.9%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('general.package_id')</th>
                                <th>@lang('general.user')</th>
                                <th>@lang('general.service')</th>
                                <th>@lang('general.package')</th>
                                <th>@lang('general.link')</th>
                                <th>@lang('general.amount')</th>
                                <th>@lang('general.quantity')</th>
                                <th>@lang('new.runs')</th>
                                <th>@lang('new.intervalo')</th>
                                <th>@lang('new.totqty')</th>
                                <th>@lang('general.status')</th>
                                <th>@lang('general.date')</th>
                                <th class="text-center" width="8%">@lang('general.action')</th>
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
    <script src="https://cdn.jsdelivr.net/handlebarsjs/4.0.5/handlebars.min.js"></script>
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table details-table mydatatable_details" id="refill-@{{id}}">
            <thead>
                <tr>
                    <th>@lang('new.orderid')</th>
                    <th>@lang('new.apiorderid')</th>
                    <th>@lang('forms.start_counter')</th>
                    <th>@lang('forms.remains')</th>
                    <th>@lang('forms.status')</th>
                    <th>@lang('forms.date')</th>
                </tr>
            </thead>
        </table>
    </script> 
    <script>
    var template = Handlebars.compile($("#details-template").html());
    var table = $('.mydatatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                order: [ [1, 'desc'] ],
                ajax: '{!! url('/moderator/dripfeed-index/data') !!}',
                columns: [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "searchable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    {data: 'id', name: 'id'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'package.service.name', name: 'package.service.name'},
                    {data: 'package.name', name: 'package.name'},
                    {data: 'link', name: 'link', sortable:false},
                    {data: 'total_price', name: 'total_price', sortable:false, searchable:false},
                    {data: 'run_quantity', name: 'run_quantity', sortable:false, searchable:false},
                    {data: 'runs', name: 'runs', sortable:false, searchable:false},
                    {data: 'interval', name: 'interval', sortable:false, searchable:false},
                    {data: 'total_quantity', name: 'total_quantity', sortable:false, searchable:false},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
    // Add event listener for opening and closing details
    $('#mydatatable').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'refill-' + row.data().id;
        console.log(tableId);
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });

    function initTable(tableId, data) {
        console.log(data.details_url);
        $('#' + tableId).DataTable({
            // processing: true,
            serverSide: true,
            paging: false,
            searching: false,
            ordering: false,
            info: false,
            ajax: data.details_url,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'api_order_id', name: 'api_order_id' },
                { data: 'start_counter', name: 'start_counter' },
                { data: 'remains', name: 'remains' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' }
            ]
        })
    }
    </script>
@endpush