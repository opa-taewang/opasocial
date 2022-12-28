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
<div class="row">
    <div class="col-sm-12">
        <div class="well">
            <div class="table-responsive">
                <table class="serviceTable table table-sm">
                    <thead class="thead-dark">
                        <tr>
                          <th class="nowrap">@lang('general.package_id')</th>
                          <th class="width-service-name">@lang('general.name')</th>
                          <th class="nowrap">Time Taken</th>
                          <th class="nowrap">Last Order Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if( ! empty($packagesNew) )
                        @php
                            $serviceId=null;
                        @endphp
                        @foreach($packagesNew as $k => $package)
                            @if(is_null($serviceId))
                                <!--CATEGORY NAME PRINT-->
                                <tr class="cateRow">
                                    <td colspan="4"><div class="cate-head">{{ $k }}</div></td>
                                </tr>
                                <!--CATEGORY NAME PRINT-->
                                @php
                                $serviceId=$package['id'];
                                @endphp
                            @endif
                            @if($serviceId != $package['service_id'])
                                <!--CATEGORY NAME PRINT-->
                                <tr class="cateRow">
                                    <td colspan="4"><div class="cate-head">{{ $k }}</div></td>
                                </tr>
                                <!--CATEGORY NAME PRINT-->
                                @php
                                $serviceId = $package['service_id'];
                                @endphp
                            @endif
                            <!--SERVICE NAME TABLE-->
                            @foreach($package['data'] as $k1 => $v1)
                            <tr>
                                <td data-th="@lang('general.package_id')">{{ $v1->id }}</td>
                                <td data-th="@lang('general.name')">{{ $v1->name }}</td>
                                <td data-th="@lang('general.minimum_quantity')"><span style="color:#96119e;">{{ $v1->performance }}</span></td>
                                <td data-th="@lang('general.maximum_quantity')"><span style="color:#2096f3;">{{ $v1->mydate->diffForHumans() }}</span></td>
                            </tr>
                            @endforeach
                        @endforeach
                    @else
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="well">
                                <div class="table-responsive">
                                    <table class="serviceTable table table-sm ">
                                        <thead class="thead-dark">
                                            <tr>
                                              <th class="nowrap">@lang('general.package_id')</th>
                                              <th class="width-service-name">@lang('general.name')</th>
                                              <th class="nowrap">Time Taken</th>
                                              <th class="nowrap">Last Order Completed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">No Record Found</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    
    

@endsection
