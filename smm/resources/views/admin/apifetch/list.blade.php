@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - API Fetch')
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px;">
            <div class="" style="float:left">
                <h4>API :: {{ $api_id.' - '.$api_name }}</h4>
                <h4>Profit Margin :: {{ getOption('profit_percentage',true) }}%</h4>
            </div>
            <div class="btn-group" style="float:right">
                <button type="button" class="btn btn-info btn-sm"  id="apply-all">Save Selected Packages</button>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12 mt10">            
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="frm-apply-all" action="{{ url('/admin/apifetch/save') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                    <div class="table-responsive">
                        <table class="table mydatatable table-bordered table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="input-sm checkbox-all"></th>
                                <th>Select Service <br> [API Service Name]</th>
                                <th>Package ID <br> [API Package ID]</th>
                                <th>Set Package Name <br> [API Package Name]</th>
                                <th>Set Package Description <br> [API Package Description]</th>
                                <th>Set Price per Item <br> [API Price per Item]</th>
                                <th>Set Minimum <br> [API Minimum]</th>
                                <th>Set Maximum <br> [API Maximum]</th>
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
            var fetch_count = {{ $fetch_count }};
        $(function () {
            $('.mydatatable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                bInfo: false,
                paging: false,
                order: [ [0, 'asc'] ],
                ajax: '{!! url("/admin/apifetch/data") !!}',
                columns: [
                    {data: 'check', name: 'check', sortable:false, searchable:false},
                    {data: 'service', name: 'service', sortable:false, searchable:false},
                    {data: 'package_id', name: 'package_id', sortable:false, searchable:false},
                    {data: 'package_name', name: 'package_name', sortable:false, searchable:false},
                    {data: 'package_description', name: 'package_description', sortable:false, searchable:false},
                    {data: 'price_per_item', name: 'price_per_item', sortable:false, searchable:false},
                    {data: 'minimum_quantity', name: 'minimum_quantity', sortable:false, searchable:false},
                    {data: 'maximum_quantity', name: 'maximum_quantity', sortable:false, searchable:false},
                ],                
                            createdRow: function (row, data, index) {
                                $(row).addClass("trows");
                            }
            });
        })
              $(document).ready(function() {
                $('[data-toggle="popover"]').popover({
                  html: true, 
                  placement: 'auto top'
                });
              });  
                  $(document).on('click', '.checkbox-all', function () {
                $('.row-checkbox').trigger('click');
                $('#apply-all').removeClass('hide');
            });


            $(document).on('click', '.row-checkbox', function () {
                $('#apply-all').removeClass('hide');
                var t = $(this);
                if (t.is(':checked')) {
                    t.parents('tr').find('.row-edit').removeAttr('readonly');
                    t.parents('tr').find('.srvcclass').removeAttr('disabled');
                    t.parents('tr').attr('style', 'background-color:#dedede');
                } else {
                    t.parents('tr').find('.row-edit').attr('readonly', 'readonly');
                    t.parents('tr').find('.srvcclass').attr('disabled', 'disabled');
                    t.parents('tr').removeAttr('style');
                }

            });

            $('#apply-all').on('click', function (e) {

                var form = $('#frm-apply-all');
                var isAnyRowSelected = false; // check if it shouldn't submit  empty form

                bootbox.confirm({
                    message: "Are you sure that you want add/modify selected packages?",
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
                            postdata(1);    
                        }
                    }
                });

            });
            var myKeyVals = [];
            var ocnt = 0;
            var rcnt = 0;
            function postdata(cnt){
                if(cnt <= fetch_count){
                    console.log(cnt);
                    var t = $('input[name="apifetch_id[' + cnt + ']"]').is(':checked');
                    if(t){
                        var temp = { 
                                          cnt : $('input[name="apifetch_id[' + cnt + ']"]').val(),
                                          service : $('select[name="service[' + cnt + ']"]').find(':selected').val(),
                                          _token: "{{ csrf_token() }}",
                                          api_package_id : $('input[name="api_package_idh[' + cnt + ']"]').val(),
                                          package_id : $('input[name="package_idh[' + cnt + ']"]').val(),
                                          package_description : $('textarea[name="package_description[' + cnt + ']"]').val(),
                                          package_name : $('input[name="package_name[' + cnt + ']"]').val(),
                                          price_per_item : $('input[name="price_per_item[' + cnt + ']"]').val(),
                                          minimum_quantity : $('input[name="minimum_quantity[' + cnt + ']"]').val(),
                                          maximum_quantity : $('input[name="maximum_quantity[' + cnt + ']"]').val(),
                                          type : $('input[name="type[' + cnt + ']"]').val()
                                         };
                        myKeyVals[rcnt] = temp; 
                        rcnt++;
                        ocnt++;
                        if(rcnt == 50){
                            var saveData = $.ajax({
                                type: 'POST',
                                url: baseUrl + '/admin/apifetch/save',
                                data: {data : myKeyVals},
                                dataType: "json"
                            });
                            myKeyVals = [];
                            rcnt = 0;
                        }
                        postdata(cnt+1);
                    }else{
                        postdata(cnt+1);
                    }
                }else{
                    console.log(myKeyVals);
                    // alert(myKeyVals);
                    if(rcnt > 0){
                        var saveData = $.ajax({
                            type: 'POST',
                            url: baseUrl + '/admin/apifetch/save',
                            data: {data : myKeyVals},
                            dataType: "json"
                        });
                    }

                bootbox.confirm({
                    message: "Packages Added",
                    buttons: {
                        confirm: {
                            label: 'Ok',
                            className: 'btn-primary'
                        },
                    },
                    callback: function (result) {
                        if (result) {
                            location.href = baseUrl + '/admin/apifetch/redirect';
                        }
                    }
                });
                }

            }     
    </script>
@endpush