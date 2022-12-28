@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - My Orders')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table mydatatable table-bordered table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th>@lang('general.transaction_id')</th>
                                <th>Package</th>
                                <th>Buyer Name</th>
                                <th>Referral Name</th>
                                <th>@lang('general.amount')</th>
                                <th>Transferred Fund</th>
                                <th>@lang('general.date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $index => $transaction)
                            <tr>
                            <td>{{$index+1 }}</td>
                                <td>{{$transaction->packages->name}}</td>
                                <td>{{$transaction->Buser->name}}</td>
                                <td>{{$transaction->Ruser->name}}</td>
                                <td>{{$transaction->price}}</td>
                                <td>{{$transaction->transferedFund}}</td>
                                <td>{{$transaction->created_at}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
