@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Orders')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="api-status-msg" class="alert no-auto-close " style="position: relative;display: none;z-index:5">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px;">
            <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px;">
            <div class="btn-group">
                <button type="button" class="btn btn-danger btn-sm hide" id="apply-all">Send</button>
            </div>
            
        </div>
    </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                        <a href="/admin/orders-filters/manual">Check Pending</a>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="frm-apply-all" action="{{ url('/admin/pending-orders-bulk-update') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="input-sm checkbox-all"></th>
                                <th>@lang('general.order_id')</th>
                                <th>@lang('general.user')</th>
                                <th>@lang('general.service')</th>
                                <th>@lang('general.package')</th>
                                <th>@lang('general.link')</th>
                                <th>@lang('general.quantity')</th>
                                <th>@lang('general.start_counter')</th>
                                <th>@lang('general.remains')</th>
                                <th>@lang('general.api')</th>
                                <th>@lang('general.action')</th>
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
                order: [[0, 'desc']],
                ajax: '{!! url('/admin/automate/send-orders-index/data') !!}',
                columns: [
                    {data: 'bulk', name: 'bulk', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'package.service.name', name: 'package.service.name'},
                    {data: 'package.name', name: 'package.name'},
                    {data: 'link', name: 'link'},
                    {data: 'quantity', name: 'quantity', orderable:false},
                    {data: 'start_counter', name: 'start_counter', orderable:false},
                    {data: 'remains', name: 'remains', orderable:false},
                    {data: 'api', name: 'api', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                aoColumnDefs: [ {
                     aTargets: [ 0 ],
                     mRender: function ( data, type, full ) {
                      return $("<div/>").html(data).text(); 
                      }
                } ]
            });

            $(document).on('click', '.send-api', function () {

                var id = $(this).data('id');
                var package_id = $(this).data('package_id');
                var api_id = $('#api_' + id).val();
                if (api_id === '') {
                    $('#api_' + id).focus();
                    return false;
                }

                var button = $(this);
                var tr = $(this).parents('tr');
                button
                    .find('span')
                    .text('')
                    .addClass('glyphicon glyphicon-refresh spinning');
                $('.send-api').attr('disabled', 'disabled');

                $.ajax({
                    url: baseUrl + '/admin/automate/send-order-to-api',
                    type: 'POST',
                    data: {'id': id, 'api_id': api_id, 'package_id': package_id},
                    dataType: 'JSON',
                    success: function (resp) {
                        $('#api-status-msg')
                            .removeClass('alert-info alert-warning alert-danger')
                            .addClass(resp.css_class)
                            .html(resp.message).show();
                        if (resp.success) {
                            tr.remove();
                        } else {
                            button
                                .find('span')
                                .text('@lang("buttons.send")')
                                .removeClass('glyphicon glyphicon-refresh spinning');
                        }
                    },
                    complete: function () {
                        $('.send-api').removeAttr('disabled');
                    }
                });

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