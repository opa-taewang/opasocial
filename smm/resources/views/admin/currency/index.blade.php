@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Orders')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <p>Conversation Formula: Dollar=Exchange Rate* Dollar<p>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12 mtn10">
            <div class="mb10">
                <a href="{{ url('/admin/currency/create') }}" class="btn btn-primary btn-sm">@lang('buttons.create_new')</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                            <th>Currency Name</th>
                            <th>Currency Code</th>
                            <th>Symbol</th>
                            <th>Exchange Rate</th>
                            <th> Action</th>
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
                ajax: '{!! url('admin/currency-data') !!}',
                columns: [

                    // {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'symbol',name:'symbol'},
                    {data: 'rate', name: 'rate'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endpush