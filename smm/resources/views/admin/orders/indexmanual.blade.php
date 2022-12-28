@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Orders')
@section('content')

    @php
        $dataURL = "/admin/orders-filters-ajax/manual/data";
    @endphp
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
            <div class="btn-group">
                <a href="{{ url('/admin/orders/') }}" class="btn btn-default btn-sm btn btn-default btn-sm ">ALL</a>
                <a href="{{ url('/admin/orders-filter/pending') }}" class="btn btn-default btn-sm ">Pending</a>
                <a href="{{ url('/admin/orders-filter/inprogress') }}" class="btn btn-default btn-sm ">In Progress</a>
                <a href="{{ url('/admin/orders-filter/completed') }}" class="btn btn-default btn-sm ">Completed</a>
                <a href="{{ url('/admin/orders-filter/partial') }}" class="btn btn-default btn-sm ">Partial</a>
                <a href="{{ url('/admin/orders-filter/refunded') }}" class="btn btn-default btn-sm ">Refunded</a>
                <a href="{{ url('/admin/orders-filter/cancelled') }}" class="btn btn-default btn-sm ">Cancelled</a>
              <a href="{{ url('/admin/orders-filters/manual') }}" class="btn btn-default btn-sm active">Manual</a>
            </div>
            <ul class="nav nav-pills ">
                <li class="pull-right search">
                    <div class="input-group">
                        <input id="dataSearchBox" type="text" name="search" class="form-control" value="" placeholder="Search orders">
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
                                <th>Api @lang('general.order_id')</th>
                                <th>@lang('general.user')</th>
                                <th>@lang('general.service')</th>
                                <th>@lang('general.package')</th>
                                <th>@lang('general.link')</th>
                                <th>@lang('general.amount')</th>
                                <th>@lang('general.quantity')</th>
                                <th>@lang('general.start_counter')</th>
                                <th>@lang('general.remains')</th>
                                <th>@lang('general.status')</th>
                                <th>@lang('general.date')</th>
                                <th class="text-center" width="5%">@lang('general.action')</th>
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
                    {data: 'bulk', name: 'bulk', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'api_order_id', name: 'api_order_id'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'package.service.name', name: 'package.service.name'},
                    {data: 'package.name', name: 'package.name'},
                    {data: 'link', name: 'link'},
                    {data: 'price', name: 'price', sortable: false, searchable: false},
                    {data: 'quantity', name: 'quantity', sortable: false, searchable: false},
                    {data: 'start_counter', name: 'start_counter', sortable: false, searchable: false},
                    {data: 'remains', name: 'remains', sortable: false, searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
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