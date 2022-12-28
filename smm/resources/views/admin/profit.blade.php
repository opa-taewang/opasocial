@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Profit')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="height: 10px;">&nbsp;</div>
            <div class="panel panel-default">
                <div class="panel-body p0">
                    <div class="table-responsive">
                        <table class="table table-bordered services-table">
                            <tbody>
                                    <tr>
                                        <th>Date</th>
                                        <th>Sale</th>
                                        <th>Cost</th>
                                        <th>Profit</th>
                                    </tr>
                            @if( ! empty($data) )
                                @foreach($data as $record)
                                    <tr>
                                        <td>{{ $record['dt'] }}</td>
                                        <td>{{ getOption('currency_symbol') . $record['price'] }}</td>
                                        <td>{{ getOption('currency_symbol') . $record['cost'] }}</td>
                                        <td>{{ getOption('currency_symbol') . ($record['price'] - $record['cost']) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No Record Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
