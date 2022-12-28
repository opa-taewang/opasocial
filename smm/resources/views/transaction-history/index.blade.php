@extends('layouts.app')
@section('title', getOption('app_name') . ' - My Orders')
@section('content')
<style>
    .dataTables_filter { display: none; }
</style>
<div class="inner-dashboard orderPage">
    <div class="row">
        <div class="col-lg-12">
            <div class="well">
                <div class="table-responsive">
                    <table class="table mydatatable table-sm" style="width: 99.9%">
                        <thead class="thead-dark">
                            <tr>
                                <th>@lang('general.transaction_id')</th>
                                <th>@lang('general.date')</th>
                                <th>@lang('general.payment_method')</th>
                                <th>@lang('general.amount')</th>
                                <th>@lang('general.details')</th>
                                <th>Amount ( If $ Converted)</th>
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
            var table = $('.mydatatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                lengthChange: false,
                info: false,
                order: [ [0, 'desc'] ],
                ajax: '{!! url('account/funds-load-history-index/data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'payment_method.name', name: 'payment_method.name',sortable:false,searchable:false},
                    {data: 'amount', name: 'amount', sortable:false},
                    {data: 'details', name: 'details', sortable:false},
                    {data: 'amountconversion', name: 'amountconversion', sortable:false}
                ]
            });
             $('#dataSearchBox').on( 'keyup', function () {
       table.search( this.value ).draw();
    });
        })
    </script>
@endpush