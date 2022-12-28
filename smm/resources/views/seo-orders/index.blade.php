@extends('layouts.app')
@section('title', getOption('app_name') . ' - My Orders')
@section('content')
    @php
        $status = $status ?? false;
        $dataURL = $status ? "/seo-orders-filter-ajax/$status/data" : "/seo-orders-index/data";
    @endphp
<style>
.rwd-table th {
    background-color: #000000
}
.dataTables_filter,
table.dataTable thead .sorting_desc::after{ 
    display: none;
}
</style>
    <div class="inner-dashboard servicePage orderPage">
        <div class="row"> 
            <div class="col-lg-12">
                <div class="well">
                    <ul class="nav nav-tabs">
                        <li class="{{ $status == false ? 'active' : '' }}"><a href="{{ url('/seo-orders/all') }}">ALL</a></li>
                        <li class="{{ $status == 'pending' ? 'active' : '' }}"><a href="{{ url('/seo-orders-filter/pending') }}" >Pending</a></li>
                        <li class="{{ $status == 'inprogress' ? 'active' : '' }}"><a href="{{ url('/seo-orders-filter/inprogress') }}" >In Progress</a></li>
                        <li class="{{ $status == 'processing' ? 'active' : '' }}"><a href="{{ url('/seo-orders-filter/processing') }}" >Processing</a></li>
                        <li class="{{ $status == 'completed' ? 'active' : '' }}"><a href="{{ url('/seo-orders-filter/completed') }}" >Completed</a></li>
                        <li class="{{ $status == 'refunded' ? 'active' : '' }}"><a href="{{ url('/seo-orders-filter/refunded') }}" >Refunded</a></li>
                        <li class="{{ $status == 'cancelled' ? 'active' : '' }}"><a href="{{ url('/seo-orders-filter/cancelled') }}">Cancelled</a></li>
                    </ul>
                    <div class="table-responsive">
                        <table class="orderTable table table-sm mydatatable" style="width: 99.9%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th><i class="material-icons">format_list_numbered</i> @lang('general.order_id')</th>
                                    <th><i class="material-icons">storage</i> Package</th>
                                    <th><i class="material-icons">money</i> Total Amount</th>
                                    <th>Extra Services</th>
                                    <th><i class="material-icons">flare</i> @lang('general.status')</th>
                                    <th><i class="material-icons">cloud_download</i> Digital Files</th>
                                    <th><i class="material-icons">history</i> Created At</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="viewTitle">Order Details</h5>
      </div>
      <div class="modal-body">
        <span class="text-center" style="display:block;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script>
        $(function () {
            new ClipboardJS('.btn-sm');
            var daataTable = $('.mydatatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                lengthChange: false,
                info: false,
                order: [ [0, 'desc'] ],
                ajax: '{!! url($dataURL) !!}',
                columns: [
                    {
                        data: 'id', 
                        name: 'id',

                    },
                    {
                        data: 'package_id', 
                        name: 'package_id', 
                        sortable:true
                    },
                    {
                        data: 'total_amount', 
                        name: 'total_amount', 
                        sortable:true
                    },{
                        data: 'extra_services', 
                        name: 'extra_services', 
                        sortable:false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        sortable:false
                    },
                    {data: 'downloads', name: 'downloads',render: function (data, type, row) {
                        if(data==''){return "N/A";}
                        return '<a class="btn btn-primary" target="_blank" href="{{url("download/seoorder")}}/'+row['id']+'/'+data+'"><i class="fa fa-download"></i> Download</a>';
                    }},{
                        data: 'created_at',
                        name: 'created_at'

                    },{
                        data: 'id',
                        name: 'id',
                        searchable:false,
                        sortable:false,
                        render: function (data, type, row) {
                            return '<button class = "btn btn-info btn-rounded btn-sm" data-toggle="modal" data-target="#view" id="btn'+data+'" onClick = "getDetails(this,'+data+')";>Details</button>'
                        }

                    }
                ]
            });
            $('#dataSearchBox').on( 'keyup', function () {
               daataTable.search( this.value ).draw();
            });
            $('#view').on('hidden.bs.modal',function(){
                $('#view .modal-body').html('<span class="text-center" style="display:block;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>');
            });
        });
        function getDetails(el,id) {
            $.ajax({
	          type: "POST",
	          url: "{{url('get/seo-orders/')}}/"+id+'/details',
	          data: {_token: '{{csrf_token()}}'},
	          success: function(data){
	        	$('#view .modal-body').html(data);
	          }, error: function (error) {
	            console.log(error);
	            alert('System encountered an problem.');
	          }
			});
        }
    </script>
@endpush