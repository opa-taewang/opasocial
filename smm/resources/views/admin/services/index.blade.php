@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - services')
@section('content')
<style type="text/css">
.btn-delete-record{
    border-top-left-radius: 3px !important; 
    border-bottom-left-radius: 3px !important; 
}
td.details-control {
    background: url(../images/details_open.png) no-repeat center center;
    cursor: pointer;
    width: 18px;
}
tr.shown td.details-control {
    background: url(../images/details_close.png) no-repeat center center;
}
element.style {
}
.btn-xs, .btn-group-xs > .btn {
    padding: 5px;
    font-size: 11px;
}
.btn {
    padding: 7px 12px;
}
.btn-group-xs>.btn, .btn-xs {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
</style>
    <div class="row">
        <div class="col-md-12 mtn10">
            <div class="mb10">
                <a href="{{ url('/admin/services/create') }}" class="btn btn-primary btn-sm">Create Service</a>
                <a href="{{ url('/admin/packages/create') }}" class="btn btn-primary btn-sm">Create Package</a>
                <a href="#" class="btn btn-danger btn-sm pull-right deletepkg" style="margin-left: 2px;">Delete</a>
                <a href="#" class="btn btn-warning btn-sm pull-right inactivepkg" style="margin-left: 2px;">Mark Inactive</a>
                <a href="#" class="btn btn-success btn-sm pull-right activepkg">Mark Active</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table  id="mydatatable"  class="table mydatatable table-bordered table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="input-sm checkbox-allsvc" style="height:13px"> @lang('general.service_id')</th>
                                <th>Sort</th>
                                <th>@lang('general.name')</th>
                                <th>@lang('general.status')</th>
                                <th>Action</th>
                                <th></th>
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
        <table class="table details-table mydatatable_details table-hover" id="service-@{{id}}">
            <thead>
                <tr>
                    <th><input type="checkbox" class="input-sm checkbox-allpkg" style="height:13px" service_id="@{{id}}"> ID</th>
                    <th>Sort</th>
                    <th>Name</th>
                    <th>API Name</th>
                    <th>Price</th>
                    <th>Min - Max</th>
                    <th>Feature</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </script> 
    <script>
    var template = Handlebars.compile($("#details-template").html());
    var table = $('#mydatatable').DataTable({
                    processing: true,
                    pageLength: 100,
                    stateSave: true,
                    order: [ [1, 'asc'] ],
                    ajax: '{!! url('admin/services-index/data') !!}',
                    columns: [
                        {data: 'ids', name: 'ids', orderable: false},
                        {data: 'position', name: 'position'},
                        {data: 'name', name: 'name'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                        {
                            "className":      'details-control',
                            "orderable":      false,
                            "searchable":      false,
                            "data":           null,
                            "defaultContent": ''
                        },
                    ]
                });

    // Add event listener for opening and closing details
    $('#mydatatable').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'service-' + row.data().id;
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
            paging: false,
            searching: false,
            order: [ [1, 'asc'] ],
            info: false,
            ajax: data.details_url,
            columns: [
                { data: 'id', name: 'id', orderable: false },
                { data: 'position', name: 'position' },
                { data: 'name', name: 'name', orderable: false  },
                {data: 'apiname', name: 'apiname', orderable: false },
                { data: 'price_per_item', name: 'price_per_item', orderable: false  },
                { data: 'minimum_quantity', name: 'minimum_quantity' , orderable: false },
                { data: 'features', name: 'features', orderable: false  },
                { data: 'status', name: 'status' , orderable: false },
                { data: 'action', name: 'action', orderable: false  },
            ]
        });
    };
    $(document).on('click', '.checkbox-allsvc', function () {
        $('.row-checkboxsvc').prop('checked',$(this).prop('checked'));
    });
    $(document).on('click', '.checkbox-allpkg', function () {
        var m = $(this);
        var t = m.attr('service_id');
        console.log(m);
        console.log(t);
        $('.row-checkboxpkg-'+t).prop('checked',m.prop('checked'));
    });
    $('.inactivepkg').on('click', function (e) {
        var isAnyRowSelected = false;
        var selsvc = '';
        $('.row-checkboxsvc').each(function () {
            var z = $(this);
            if (z.is(':checked')) {
                isAnyRowSelected = true;
                selsvc = selsvc + z.val() + ',';
            }
        });
        var selpkg = '';
        $('.row-checkboxpkg').each(function () {
            var z = $(this);
            if (z.is(':checked')) {
                isAnyRowSelected = true;
                selpkg = selpkg + z.val() + ',';
            }
        });
        var msg = 'Selected service/packages will be marked inactive. Are you sure?';
        if(isAnyRowSelected == false){
            bootbox.alert("Select a service/package to mark it inactive.");
            return;
        }else{
            selsvc = selsvc + '0';
            selpkg = selpkg + '0';
        }

        bootbox.confirm({
            message: msg,
            buttons: {
                cancel: {
                    label: 'No',
                    className: 'btn-default'
                },
                confirm: {
                    label: 'Yes',
                    className: 'btn-primary'
                },
            },
            callback: function (result) {
                if (result) {
                // alert(baseUrl + '/order/delete/' + sel);
                  $.ajax({
                      url: baseUrl + '/admin/inactive/' + selsvc + '/' + selpkg,
                      type: "GET",
                      success: function (packages) {
                        bootbox.alert({
                            message: "Inactived Successfully.",
                            callback: function () {
                                window.location.href = '/admin/services';
                            }
                        }) 
                      }
                  });
                }
            }
        });
    });
    $('.activepkg').on('click', function (e) {
        var isAnyRowSelected = false;
        var selsvc = '';
        $('.row-checkboxsvc').each(function () {
            var z = $(this);
            if (z.is(':checked')) {
                isAnyRowSelected = true;
                selsvc = selsvc + z.val() + ',';
            }
        });
        var selpkg = '';
        $('.row-checkboxpkg').each(function () {
            var z = $(this);
            if (z.is(':checked')) {
                isAnyRowSelected = true;
                selpkg = selpkg + z.val() + ',';
            }
        });
        var msg = 'Selected service/packages will be marked active. Are you sure?';
        if(isAnyRowSelected == false){
            bootbox.alert("Select a service/package to mark it active.");
            return;
        }else{
            selsvc = selsvc + '0';
            selpkg = selpkg + '0';
        }

        bootbox.confirm({
            message: msg,
            buttons: {
                cancel: {
                    label: 'No',
                    className: 'btn-default'
                },
                confirm: {
                    label: 'Yes',
                    className: 'btn-primary'
                },
            },
            callback: function (result) {
                if (result) {
                // alert(baseUrl + '/order/delete/' + sel);
                  $.ajax({
                      url: baseUrl + '/admin/active/' + selsvc + '/' + selpkg,
                      type: "GET",
                      success: function (packages) {
                        bootbox.alert({
                            message: "Actived Successfully.",
                            callback: function () {
                                window.location.href = '/admin/services';
                            }
                        }) 
                      }
                  });
                }
            }
        });
    });
    $('.deletepkg').on('click', function (e) {
        var isAnyRowSelected = false;
        var selsvc = '';
        $('.row-checkboxsvc').each(function () {
            var z = $(this);
            if (z.is(':checked')) {
                isAnyRowSelected = true;
                selsvc = selsvc + z.val() + ',';
            }
        });
        var selpkg = '';
        $('.row-checkboxpkg').each(function () {
            var z = $(this);
            if (z.is(':checked')) {
                isAnyRowSelected = true;
                selpkg = selpkg + z.val() + ',';
            }
        });
        var msg = 'Selected service/packages will be deleted. Are you sure?';
        if(isAnyRowSelected == false){
            bootbox.alert("Select a service/package to delete it.");
            return;
        }else{
            selsvc = selsvc + '99999999';
            selpkg = selpkg + '99999999';
        }

        bootbox.confirm({
            message: msg,
            buttons: {
                cancel: {
                    label: 'No',
                    className: 'btn-default'
                },
                confirm: {
                    label: 'Yes',
                    className: 'btn-danger'
                },
            },
            callback: function (result) {
                if (result) {
                // alert(baseUrl + '/order/delete/' + sel);
                  $.ajax({
                      url: baseUrl + '/admin/delete/' + selsvc + '/' + selpkg,
                      type: "GET",
                      success: function (packages) {
                        bootbox.alert({
                            message: "Deleted Successfully.",
                            callback: function () {
                                window.location.href = '/admin/services';
                            }
                        }) 
                      }
                  });
                }
            }
        });
    });
    </script>
@endpush