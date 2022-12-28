@extends('moderator.layouts.app')
@section('title', getOption('app_name') . ' - Tickets')
@section('content')
@php
        $topic = $topic ?? false;
        if($topic){
            if($topic == 'new' || $topic == 'message' || $topic == 'open'  || $topic == 'all'  ){
                $dataURL =  "/moderator/ticket-new-ajax/$topic/data";
            }else {
                $dataURL =  "/moderator/ticket-filter-ajax/$topic/data";
            }
        }else{
            $dataURL =  "/moderator/ticket-new-ajax/open/data";
        } 
    @endphp
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px;">
            <div class="btn-group">
                <a href="{{ url('/moderator/support/tickets') }}" class="btn btn-default btn-sm {{ $topic == false ? 'active' : '' }}">Open</a>
                <a href="{{ url('/moderator/ticket-filter/all') }}" class="btn btn-default btn-sm {{ $topic == 'all' ? 'active' : '' }}">ALL</a>
                <a href="{{ url('/moderator/ticket-filter/payment') }}" class="btn btn-default btn-sm {{ $topic == 'payment' ? 'active' : '' }}">Payment</a>
                <a href="{{ url('/moderator/ticket-filter/order') }}" class="btn btn-default btn-sm {{ $topic == 'order' ? 'active' : '' }}">Order</a>
                <a href="{{ url('/moderator/ticket-filter/refill') }}" class="btn btn-default btn-sm {{ $topic == 'refill' ? 'active' : '' }}">Refill</a>
                <a href="{{ url('/moderator/ticket-filter/cancel') }}" class="btn btn-default btn-sm {{ $topic == 'cancel' ? 'active' : '' }}">Cancel</a>
                <a href="{{ url('/moderator/ticket-filter/others') }}" class="btn btn-default btn-sm {{ $topic == 'others' ? 'active' : '' }}">Others</a>
                <a href="{{ url('/moderator/ticket-new/PremiumAccounts') }}" class="btn btn-default btn-sm {{ $topic == 'PremiumAccounts' ? 'active' : '' }}">Premium Accounts</a>
                <a href="{{ url('/moderator/ticket-new/new') }}" class="btn btn-default btn-sm {{ $topic == 'new' ? 'active' : '' }}">New Tickets</a>
                <a href="{{ url('/moderator/ticket-new/message') }}" class="btn btn-default btn-sm {{ $topic == 'message' ? 'active' : '' }}">New Messages</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>@lang('general.ticket_id')</th>
                                <th>@lang('general.user')</th>
                                <th>Topic</th>
                                <th>@lang('general.subject')</th>
                                <th>@lang('general.description')</th>
                                <th>@lang('general.new_messages')</th>
                                <th>@lang('general.status')</th>
                                <th>@lang('general.date')</th>
                                <th class="text-center">@lang('general.action')</th>
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
                order: [ [0, 'desc'] ],
                ajax: '{!! url($dataURL) !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'topic', name: 'topic',sortable:false},
                    {data: 'subject', name: 'subject',sortable:false},
                    {data: 'description', name: 'description', sortable:false},
                    {data: 'unread_message_count', name: 'unread_message_count', sortable:false, searchable:false},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', sortable:false, searchable:false}
                ],
                aoColumnDefs: [ {
                     aTargets: [ 4 ],
                     mRender: function ( data, type, full ) {
                      return $("<div/>").html(data).text(); 
                      }
                } ]
            });
        })
    </script>
@endpush