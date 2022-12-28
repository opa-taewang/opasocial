@extends('layouts.app')
@section('title', getOption('app_name') . ' - Services')
@section('content')

<?php
$packagesNew = [];
foreach($packages as $k => $v)
{
  $packagesNew[$v->service->name]['name'] = $v->service->name;
  $packagesNew[$v->service->name]['id'] = $v->service->id;
  $packagesNew[$v->service->name]['service_id'] = $v->service_id;
  $packagesNew[$v->service->name]['data'][] = $v;
}
?>
<style>
.like {
    color: red;
}
</style>
 </br> </br>

<div class="row">
    <div class="col-md-12">
        <div class="well table-well">
            <div class="table-responsive">
                <table class="serviceTable table table-sm">
                    <thead class="thead-dark">
                        <tr>
                          <th class="nowrap">@lang('general.package_id')</th>
                          <th class="width-service-name">@lang('general.name')</th>
                          <th class="nowrap">PRICE</th>
                          <th class="nowrap">@lang('general.minimum_quantity')</th>
                          <th class="nowrap">@lang('general.maximum_quantity')</th>
                          <th>@lang('general.description')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                                    @if($service->packages->count() > 0)
                                <!--CATEGORY NAME PRINT-->
                                <tr class="cateRow">
                                    <td colspan="7"><div class="cate-head">{{ $service->name }}</div></td>
                                </tr>
                                <!--CATEGORY NAME PRINT-->
                            <!--SERVICE NAME TABLE-->
                            @foreach($packages as $package)
                                            @if($package->service_id == $service->id) 
                            <tr>
                                <td data-th="@lang('general.package_id')">{{ $package->id }}</td>
                                <td data-th="@lang('general.name')">{{ $package->name }}</td>
                                
                                <td class="text-center" data-th="PRICE"><span style="color:#4510c2;">
                                     @php $price = isset($userPackagePrices[$package->id]) ? $userPackagePrices[$package->id] : $package->price_per_item;
                                @endphp
                                @if ($package->maximum_quantity > '1000' && $package->maximum_quantity != $package->minimum_quantity)
                                        {{ getOption('currency_symbol') . number_format(($price * getOption('display_price_per')),2, getOption('currency_separator'), '') .''. ' Per 1000 Quantity' }}
                                        
                                        @elseif ($package->maximum_quantity <= '1000' && $package->maximum_quantity != '1' && $package->maximum_quantity != $package->minimum_quantity)
                                        {{ getOption('currency_symbol') . number_format(($price * $package->maximum_quantity),2, getOption('currency_separator'), '')  .''. ' Per ' . $package->maximum_quantity . ' Quantity'}}
                                        @elseif ($package->maximum_quantity = $package->minimum_quantity )
                                        {{ getOption('currency_symbol') . number_format(($price * $package->maximum_quantity),2, getOption('currency_separator'), '')  .''. ' Per Package'}}
                                        @endif</span></td>
                                <td class="text-center" data-th="@lang('general.minimum_quantity')"><span style="color:#2096f3;">{{ $package->minimum_quantity }}</span></td>
                                <td class="text-center" data-th="@lang('general.maximum_quantity')"><span style="color:#96119e;">{{ $package->maximum_quantity }}</span></td>
                                <td data-th="@lang('general.description')">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#serviceDesc{{ $package->id }}">Read More</button>
                                    <div class="modal fade" id="serviceDesc{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                              <h4 class="modal-title" id="myModalLabel">{{ $package->name }}</h4>
                                            </div>
                                            <div class="modal-body">
                                              {{ $package->description }}
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </td>
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
@endsection
