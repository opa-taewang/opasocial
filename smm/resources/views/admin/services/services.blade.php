@extends('layouts.app')
@section('title', getOption('app_name') . ' - Services')
@section('content')
    @if(Auth::check())
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px">
            <div class="btn-group pull-right">
                <a href="\changeCurrency\{{Auth::user()->currency == 'INR' ? 'USD' : 'INR'}}" class="btn btn-danger btn-lg" style="width:100%">Change My Panel Currency to {{Auth::user()->currency == 'INR' ? 'USD $' : 'INR ₹'}}</a>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px">
            <div class="btn-group pull-right">
                <a href="/changeGuestCurrency/{{$csymbol == '$' ? 'INR' : 'USD'}}" class="btn btn-warning btn-lg" style="background-color: {{getOption('theme_color')}};color: {{getOption('background_color')}};"> Switch Currency to {{$csymbol == '$' ? 'INR ₹' : 'USD $'}}</a>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div style="height: 10px;">&nbsp;</div>
            <div class="panel panel-default">
                <div class="panel-body p0">
                    <div class="table-responsive">
                        <table class="table table-bordered services-table">
                            <tbody>
                                @foreach($services as $service)
                                    @if($service->packages->count() > 0)
                                        <tr>
                                              <td colspan="7" class="theme-bg" style="color:white;background-color: #6a45c4">{{ $service->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('general.package_id')</th>
                                            <th>@lang('general.name')</th>
                                            <th>@lang('general.price_per_item') {{ getOption('display_price_per') }}</th>
                                            <th>@lang('general.minimum_quantity')</th>
                                            <th>@lang('general.maximum_quantity')</th>
                                            <th>@lang('general.description')</th>
                                            <th>Average Time <i class="fas fa-info-circle" data-toggle="popover" data-trigger="hover" data-content="Average time taken by Last 10 Completed Orders Per 1000 Quantity"></i></th>
                                        </tr>
                                        @foreach($packages as $package)
                                            @if($package->service_id == $service->id)
                                            <tr>
                                                <td>{{ $package->id }}</td>
                                                <td>{{ $package->name }}</td>
                                                <td>
                                                    @php
                                                        $price = isset($userPackagePrices[$package->id]) ? $userPackagePrices[$package->id] : $package->price_per_item;
                                                    @endphp
                                                    {{ $csymbol . number_formats(($price * getOption('display_price_per')),2, getOption('currency_separator'), '') }}
                                                </td>
                                                <td>{{ $package->minimum_quantity }}</td>
                                                <td>{{ $package->maximum_quantity }}</td>
                                                <td>{!! nl2br($package->description) !!}</td>
                                                <td>{{ $package->performance }}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
              $(document).ready(function() {
                $('[data-toggle="popover"]').popover({
                  html: true, 
                  placement: 'auto left'
                });
              });
    </script>
@endpush
