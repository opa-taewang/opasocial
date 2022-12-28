@extends('layouts.app')
@section('title', getOption('app_name') . ' - My Orders')
@section('content')
    @php
        $status = $status ?? false;
        $dataURL = $status ? "/orders-filter-ajax/$status/data" : "/orders-index/data";
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
    <div class="inner-dashboard orderPage">
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <ul class="nav nav-tabs">
                        <li class="{{ $status == false ? 'active' : '' }}"><a href="{{ url('/orders/') }}">ALL</a></li>
                        <li class="{{ $status == 'pending' ? 'active' : '' }}"><a href="{{ url('/orders-filter/pending') }}">Pending</a></li>
                        <li class="{{ $status == 'inprogress' ? 'active' : '' }}"><a href="{{ url('/orders-filter/inprogress') }}">InProgress</a></li>
                        <li class="{{ $status == 'processing' ? 'active' : '' }}"><a href="{{ url('/orders-filter/processing') }}">Processing</a></li>
                        <li class="{{ $status == 'completed' ? 'active' : '' }}"><a href="{{ url('/orders-filter/completed') }}">Completed</a></li>
                        <li class="{{ $status == 'partial' ? 'active' : '' }}"><a href="{{ url('/orders-filter/partial') }}">Partial</a></li>
                        <li class="{{ $status == 'refunded' ? 'active' : '' }}"><a href="{{ url('/orders-filter/refunded') }}">Refunded</a></li>
                        <li class="{{ $status == 'cancelled' ? 'active' : '' }}"><a href="{{ url('/orders-filter/cancelled') }}">Cancelled</a></li>
                    </ul>
                    <div class="table-responsive">
                        <table class="orderTable table table-sm mydatatable" style="width: 99.9%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>@lang('general.order_id')</th>
                                    <th>@lang('general.link')</th>
                                    <th>@lang('general.service')</th>
                                    <th>@lang('general.status')</th>
                                    <th>Package</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Start Count</th>
                                     <th>Remains</th>
                                    <th>Date</th>
                                  
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script>
        $(function () {
            
            new ClipboardJS('.btn-copy');
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
                        // render : function(data, type, row) {
                        //     return '<span class="mycus-class2">'+data+'</span>'
                        // },
                        name: 'status',
                        sortable:false
                    },
                    
                    {
                        data: 'package.name', 
                        name: 'package.name', 
                        sortable:false
                    },
                    {
                        data: 'price', 
                        name: 'price', 
                        sortable:false
                    },
                    {
                        data: 'quantity', 
                        name: 'quantity', 
                        sortable:false
                    },
                    {
                        data: 'start_counter', 
                        name: 'start_counter', 
                        sortable:false
                    },
                    {
                        data: 'remains', 
                        name: 'remains', 
                        sortable:false
                    },
                    {
                        data: 'created_at', 
                        name: 'created_at', 
                        sortable:false
                    },
                    
                    
                ]
            });
            $('#dataSearchBox').on( 'keyup', function () {
               daataTable.search( this.value ).draw();
            });
        })
    </script>
@endpush