@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Orders')
@section('content')

    @php
        $status = $status ?? false;
        $dataURL = $status ? "/admin/orders-filter-ajax/$status/data" : "/admin/orders-ajax/data";
    @endphp
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px;">
            <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px;">
            <div class="btn-group">
                <button type="button" class="btn btn-danger btn-sm hide" id="apply-all">Apply</button>
            </div>
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-inverse btn-sm checkbtn hide" id="PENDING">PENDING</button>
                <button type="button" class="btn btn-inverse btn-sm checkbtn hide" id="INPROGRESS">IN PROGRESS</button>
                <button type="button" class="btn btn-inverse btn-sm checkbtn hide" id="PROCESSING">PROCESSING</button>
                <button type="button" class="btn btn-inverse btn-sm checkbtn hide" id="COMPLETED">COMPLETED</button>
                <button type="button" class="btn btn-inverse btn-sm checkbtn hide" id="PARTIAL">PARTIAL</button>
                <button type="button" class="btn btn-inverse btn-sm checkbtn hide" id="REFUNDED">REFUNDED</button>
                <button type="button" class="btn btn-inverse btn-sm checkbtn hide" id="CANCELLED">CANCELLED</button>
            </div>
        </div>
    </div>
            <div class="btn-group">
                <a href="{{ url('/admin/orders/') }}" class="btn btn-default btn-sm btn btn-default btn-sm {{ $status == false ? 'active' : '' }}">ALL</a>
                <a href="{{ url('/admin/orders-filter/pending') }}" class="btn btn-default btn-sm {{ $status == 'pending' ? 'active' : '' }}">Pending</a>
                <a href="{{ url('/admin/orders-filter/inprogress') }}" class="btn btn-default btn-sm {{ $status == 'inprogress' ? 'active' : '' }}">In Progress</a>
                <a href="{{ url('/admin/orders-filter/completed') }}" class="btn btn-default btn-sm {{ $status == 'completed' ? 'active' : '' }}">Completed</a>
                <a href="{{ url('/admin/orders-filter/partial') }}" class="btn btn-default btn-sm {{ $status == 'partial' ? 'active' : '' }}">Partial</a>
                <a href="{{ url('/admin/orders-filter/refunded') }}" class="btn btn-default btn-sm {{ $status == 'refunded' ? 'active' : '' }}">Refunded</a>
                <a href="{{ url('/admin/orders-filter/cancelled') }}" class="btn btn-default btn-sm {{ $status == 'cancelled' ? 'active' : '' }} ">Cancelled</a>
                <a href="{{ url('/admin/orders-filter/processing') }}" class="btn btn-default btn-sm {{ $status == 'processing' ? 'active' : '' }} ">Processing</a>
            </div>
                        <ul class="nav nav-pills ">
                <li class="pull-right search">
                    <div class="input-group">
                        <input id="dataSearchBox" type="text" name="search" class="form-control" value="" placeholder="Search order id">
                    </div>
                </li>
            
                <li class="pull-right search">
                    <div class="input-group">
                        <input id="dataSearchBoxus" type="text" name="search" class="form-control" value="" placeholder="Search Links">
                    </div>
                </li>
                
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="frm-apply-all" action="{{ url('/admin/orders-bulk-update') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="input-sm checkbox-all"></th>
                                <th>@lang('general.order_id')</th>
                                <th class="text-center" width="5%">@lang('general.action')</th>
                                <th>Api @lang('general.order_id')</th>
                                <th>User Name</th>
                                <th>@lang('general.service')</th>
                                <th>@lang('general.package')</th>
                                <th>@lang('general.link')</th>
                                <th>@lang('general.amount')</th>
                                <th>@lang('general.quantity')</th>
                                <th>@lang('general.start_counter')</th>
                                <th>@lang('general.remains')</th>
                                <th>@lang('general.status')</th>
                                <th>Source</th>
                                <th>@lang('general.date')</th>
                                
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

             var daataTable =$('.mydatatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                lengthChange: false,
                order: [ [1, 'desc'] ],
                info: false,
                ajax: '{!! url($dataURL) !!}',
                 language: {
        search: "_INPUT_",
        searchPlaceholder: "Search Username"
    },
                columns: [
                    {data: 'bulk', name: 'bulk', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'api_order_id', name: 'api_order_id'},
                    {data: 'user.username', name: 'user.username'},
                    {data: 'package.service.name', name: 'package.service.name'},
                    {data: 'package.name', name: 'package.name'},
                    {data: 'link', name: 'link'},
                    {data: 'price', name: 'price', sortable: false, searchable: false},
                    {data: 'quantity', name: 'quantity', sortable: false, searchable: false},
                    {data: 'start_counter', name: 'start_counter', sortable: false, searchable: false},
                    {data: 'remains', name: 'remains', sortable: false, searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'source', name: 'source'},
                    {data: 'created_at', name: 'created_at'},
                ],
                aoColumnDefs: [ {
                     aTargets: [ 4,5,6 ],
                     mRender: function ( data, type, full ) {
                      return $("<div/>").html(data).text(); 
                      }
                } ]
            });
            $('#dataSearchBox').on( 'keyup', function () {
                search=this.value.replace(/\s/g, '').split(',');
                search = search.join('|');
                daataTable.column(1).search(search === null ?'':"^("+search+")$", true, false).draw();
                if(this.value==="" || this.value===null) {
                    daataTable.column(1).search(search, false).draw();
                }
            });
            $('#dataSearchBoxus').on( 'keyup', function () {
                search=this.value.replace(/\s/g, '').split(',');
                search = search.join('|');
                daataTable.column(7).search(search === null ?'':"^("+search+")$", true, false).draw();
                if(this.value==="" || this.value===null) {
                    daataTable.column(7).search(search, false).draw();
                }
            });
            

            $(document).on('click', '.checkbox-all', function () {
                $('.row-checkbox').trigger('click');
                $('#apply-all').removeClass('hide');
                $('.checkbtn').removeClass('hide');
                var isAnyRowSelected = false;
                $('.row-checkbox').each(function () {
                    var z = $(this);
                    if (z.is(':checked')) {
                        isAnyRowSelected = true;
                    }
                });
                if(isAnyRowSelected == false){
                    $('#apply-all').addClass('hide');
                    $('.checkbtn').addClass('hide');
                }
            });

            $(document).on('click', '.row-checkbox', function () {
                $('#apply-all').removeClass('hide');
                $('.checkbtn').removeClass('hide');
                var t = $(this);
                if (t.is(':checked')) {
                    t.parents('tr').find('.row-edit').removeAttr('readonly');
                    t.parents('tr').attr('style', 'background-color:#dedede');
                } else {
                    t.parents('tr').find('.row-edit').attr('readonly', 'readonly');
                    t.parents('tr').removeAttr('style');
                    var isAnyRowSelected = false;
                    $('.row-checkbox').each(function () {
                        var z = $(this);
                        if (z.is(':checked')) {
                            isAnyRowSelected = true;
                        }
                    });
                    if(isAnyRowSelected == false){
                        $('#apply-all').addClass('hide');
                        $('.checkbtn').addClass('hide');
                    }
                }

            });

            $(document).on('click', '.checkbtn', function () {
                var me = $(this);
                var isAnyRowSelected = false;
                $('.row-checkbox').each(function () {
                    var t = $(this);
                    if (t.is(':checked')) {
                        isAnyRowSelected = true;
                        $('select[name="status[' + t.val() + ']"]').val(me.attr('id'));
                    }
                });
                if(isAnyRowSelected == false){
                    bootbox.alert("No Orders Selected");
                }
            });

            $('#apply-all').on('click', function (e) {

                var form = $('#frm-apply-all');
                var isAnyRowSelected = false; // check if it shouldn't submit empty form

                bootbox.confirm({
                    message: "Confirm to apply bulk update?",
                    buttons: {
                        cancel: {
                            label: 'Cancel',
                            className: 'btn-default'
                        },
                        confirm: {
                            label: 'Confirm',
                            className: 'btn-primary'
                        },
                    },
                    callback: function (result) {
                        if (result) {
                            // Iterate over all checkboxes in the table
                            $('.row-checkbox').each(function () {

                                var t = $(this);

                                if (t.is(':checked')) {

                                    isAnyRowSelected = true; // Row selected

                                    // Order id
                                    $(form).append(
                                        $('<input>')
                                            .attr('type', 'hidden')
                                            .attr('name', t.attr('name'))
                                            .val(t.val())
                                    );
                                    // start count
                                    $(form).append(
                                        $('<input>')
                                            .attr('type', 'hidden')
                                            .attr('name', 'start_counter[' + t.val() + ']')
                                            .val($('input[name="start_counter[' + t.val() + ']"]').val())
                                    );
                                    // remains
                                    $(form).append(
                                        $('<input>')
                                            .attr('type', 'hidden')
                                            .attr('name', 'remains[' + t.val() + ']')
                                            .val($('input[name="remains[' + t.val() + ']"]').val())
                                    );
                                    // status
                                    $(form).append(
                                        $('<input>')
                                            .attr('type', 'hidden')
                                            .attr('name', 'status[' + t.val() + ']')
                                            .val($('select[name="status[' + t.val() + ']"]').find(':selected').text())
                                    );
                                }
                            });

                            if (isAnyRowSelected) {
                                form.submit();
                            }
                        }
                    }
                });

            });

        });
    </script>
@endpush