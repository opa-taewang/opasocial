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
  
<div class="row">
    <div class="col-md-12">
        <div class="well table-well">
            <div class="table-responsive">
                <table class="serviceTable table table-sm">
                    <thead class="thead-dark">
                        <tr>
                          <th class="nowrap">@lang('general.package_id')</th>
                          <th class="width-service-name">@lang('general.name')</th>
                          <th class="nowrap">Favorite</th>
                          <th class="nowrap"> PRICE</th>
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
                                <td id="p{{$package->id}}" data-th="Favorite" class="text-center">
                                    <i onclick="addToFavorite({{$service->id}},{{$package->id}},this)" class="{{(in_array($package->id, $favorite_pkgs))?'fas':'far'}} fa-heart"></i>
                                </td>
                                <td class="text-center" data-th="PRICE"><span style="color:#4510c2;">
                                    @php $price = isset($userPackagePrices[$package->id]) ? $userPackagePrices[$package->id] : $package->price_per_item;
                                    if (in_array($package->id, $package_ids)) {
                        		        $price=number_formats($price-($price/100)*$group->price_percentage,2);
                        		        		        $price=getConvertedRate($price);
                    
                        		    }
                                    @endphp
                                    @if ($package->maximum_quantity > '1000' && $package->maximum_quantity != $package->minimum_quantity)
                                        {{ getConversionSymbol() . number_format(($price * getOption('display_price_per')),2, getOption('currency_separator'), '') .''. ' Per 1000 Quantity' }}
                                        
                                        @elseif ($package->maximum_quantity <= '1000' && $package->maximum_quantity != '1' && $package->maximum_quantity != $package->minimum_quantity)
                                        {{ getConversionSymbol() . number_format(($price * $package->maximum_quantity),2, getOption('currency_separator'), '')  .''. ' Per ' . $package->maximum_quantity . ' Quantity'}}
                                        @elseif ($package->maximum_quantity = $package->minimum_quantity )
                                        {{ getConversionSymbol() . number_format(($price * $package->maximum_quantity),2, getOption('currency_separator'), '')  .''. ' Per Package'}}
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
<script>
    function aClass( classname, element ) {
        var cn = element.className;
        if( cn.indexOf( classname ) != -1 ) {
            return;
        }
        if( cn != '' ) {
            classname = ' '+classname;
        }
        element.className = cn+classname;
    }
    function rClass( classname, element ) {
        var cn = element.className;
        var rxp = new RegExp( "\\s?\\b"+classname+"\\b", "g" );
        cn = cn.replace( rxp, '' );
        element.className = cn;
    }
    function addToFavorite(sid,pid,element) {
        $("#p"+pid+" > i.fa-heart").css("visibility","hidden");
        $("#p"+pid).append('<i id="spin'+pid+'" class="fa fa-spinner fa-spin" style="font-size:20px;margin-right: 26px;"></i>');
        $.ajax({
            type: "POST",
            url: document.location.origin+"/addtofavorite",
            data: {
                sid:sid,
                pid:pid,
                _token: '{{csrf_token()}}'},
                success: function(data){
                            if(data=="true"){
                                aClass("fas",element);
                            }
                            else{
                                rClass("fas",element);
                            }
                            $("#p"+pid+" > i#spin"+pid).remove();
                            $("#p"+pid+" > i.fa-heart").css("visibility","visible");
                        }, 
                error: function (error) {
                            $("#p"+pid+" > i#spin"+pid).remove();
                            $("#p"+pid+" > i.fa-heart").css("visibility","visible");
                        }
            });
        }
    </script>
@endsection
