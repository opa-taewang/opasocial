@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Refill Requests')
@section('content')

    @php
        $status = $status ?? false;
        $dataURL = $status ? "/admin/refills-filter-ajax/$status/data" : "/admin/refills-ajax/data";
    @endphp
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px;">
            <div class="mb10">
                <a href="{{ url('/admin/refill-complete') }}" class="btn btn-primary btn-sm">Complete All</a>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm hide" id="apply-all">Apply</button>
            </div>
            <div class="btn-group">
                <a href="{{ url('/admin/refills/list') }}" class="btn btn-default btn-sm btn btn-default btn-sm {{ $status == false ? 'active' : '' }}">ALL</a>
                <a href="{{ url('/admin/refills-filter/pending') }}" class="btn btn-default btn-sm {{ $status == 'pending' ? 'active' : '' }}">Pending</a>
                <a href="{{ url('/admin/refills-filter/inprogress') }}" class="btn btn-default btn-sm {{ $status == 'inprogress' ? 'active' : '' }}">In Progress</a>
                <a href="{{ url('/admin/refills-filter/completed') }}" class="btn btn-default btn-sm {{ $status == 'completed' ? 'active' : '' }}">Completed</a>
                <a href="{{ url('/admin/refills-filter/cancelled') }}" class="btn btn-default btn-sm {{ $status == 'cancelled' ? 'active' : '' }} ">Cancelled</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table  id="mydatatable" class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('general.order_id')</th>
                                <th>@lang('new.api')</th>
                                <th>@lang('new.apiorderid')</th>
                                <th>@lang('general.status')</th>
                                <th>@lang('general.date')</th>
                                <th width="8%">@lang('general.action')</th>
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

        </table>
    </script> 
    <script>
    var template = Handlebars.compile($("#details-template").html());
    var table = $('#mydatatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            order: [[4, 'desc']],
            ajax: '{!! url($dataURL) !!}',
                columnDefs: [
                    { targets: [6], className: "dt-right"},
                ],
            columns: [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "searchable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'api_order_id', name: 'api_order_id'},
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
                { data: 'name', name: 'id' },
                { data: 'desc', name: 'unit' }
            ]
        })
    }
    </script>
@endpush