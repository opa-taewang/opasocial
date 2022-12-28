@extends('layouts.app')
@section('title', getOption('app_name') . ' - My Drip Feed Orders')
@section('content')
<style>
.dataTables_filter,
table.dataTable thead .sorting_desc::after { 
    display: none; 
}
</style>
<div class="inner-dashboard orderPage">
    <div class="row">
        <div class="col-lg-12">
            <div class="well">
                <div class="table-responsive">
                    <table id="mydatatable" class="orderTable table table-sm mydatatable "style="width: 99.9%">
                        <thead class="thead-dark">
                        <tr>
                            <th>@lang('general.package_id')</th>
                            <th>@lang('general.link')</th>
                            <th>@lang('general.service')</th>
                            <th>@lang('general.status')</th>
                            <th>Details</th>
                            <!--<th></th>-->
                            <!--<th>@lang('general.package')</th>-->
                            <!--<th>@lang('general.amount')</th>-->
                            <!--<th>@lang('general.quantity')</th>-->
                            <!--<th>@lang('new.runs')</th>-->
                            <!--<th>@lang('new.intervalo')</th>-->
                            <!--<th>@lang('new.totqty')</th>-->
                            <!--<th>@lang('general.date')</th>-->
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
                lengthChange: false,
                "ordering": false,
                info: false,
                pageLength: 25,
                order: [ [1, 'desc'] ],
                ajax: '{!! url('/dripfeed-index/data') !!}',
                columns: [
                    // {
                    //     "className":      'details-control',
                    //     "orderable":      false,
                    //     "searchable":      false,
                    //     "data":           null,
                    //     "defaultContent": ''
                    // },
                    {
                        data: 'id', 
                        name: 'id',
                        sortable:false
                    },
                    {
                        data: 'link', 
                        name: 'link', 
                        sortable:false
                    },
                    {
                        data: 'package.service.name', 
                        name: 'package.service.name',
                        sortable:false
                    },
                    {
                        data: 'status', 
                        name: 'status',
                        sortable:false
                    },
                    {
                        data: {
                                'package.name' : "package.name", 
                                'total_price' : "amount",
                                'run_quantity' : "quantity",
                                'runs': "runs",
                                'interval': "interval",
                                'total_quantity': "total_quantity",
                                'created_at':"created_at"
                        },
                        mRender : function(data, type, full) {
                            return '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#serviceDesc'+(new Date().getTime()).toString(36)+'">Read More</button><div class="modal fade" id="serviceDesc'+(new Date().getTime()).toString(36)+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title" id="myModalLabel">Description</h4></div><div class="modal-body">@lang("general.package"): '+data.package.name+'<br>@lang("general.amount"): '+data.run_price+'<br>@lang("general.quantity"): '+data.run_quantity+'<br>@lang("new.runs"): '+data.runs+'<br>@lang("new.intervalo"): '+data.interval+'<br>@lang("new.totqty"): '+data.total_quantity+'<br>@lang("general.date"): '+data.created_at+'</div></div></div></div>'; 
                        },
                        sortable:false
                    }
                    // {data: 'package.name', name: 'package.name'},
                    // {data: 'total_price', name: 'total_price', sortable:false, searchable:false},
                    // {data: 'run_quantity', name: 'run_quantity', sortable:false, searchable:false},
                    // {data: 'runs', name: 'runs', sortable:false, searchable:false},
                    // {data: 'interval', name: 'interval', sortable:false, searchable:false},
                    // {data: 'total_quantity', name: 'total_quantity', sortable:false, searchable:false},
                    // {data: 'created_at', name: 'created_at'}

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
                { data: 'start_counter', name: 'start_counter' },
                { data: 'remains', name: 'remains' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' }
            ]
        })
    }
    $('#dataSearchBox').on( 'keyup', function () {
       table.search( this.value ).draw();
    });
    </script>
@endpush