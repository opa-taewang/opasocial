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
    .search {
  width: 100%;
  position: relative;
  display: flex;
}

.searchTerm {
  width: 100%;
  border: 3px solid #4285f4;
  border-right: none;
  padding: 5px;
  height: 36px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #4285f4;
}

.searchButton {
  width: 40px;
  height: 36px;
  border: 1px solid #4285f4;
  background: #4285f4;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}
form {
    display: contents;
}
</style>
</br>
    <div class="container-fluid">
                    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px">
            <div class="btn-group pull-right">
                <a href="/services/USD" class="btn btn-warning btn-lg" style="background-color: {{ getOption('theme_color') }};color: #e9ebee;"> Switch Currency to USD </a>
            </div>
        </div>
    </div>
<div class="row">
        <div class="col-md-12">
            <div class="wrap">
               <div class="search">
                <form role="form" method="POST" action="{{ url('/services/search') }}">
                {{ csrf_field() }}
                  <input name="search_value" type="text" value="{{old('search_value')}}" class="form-control searchTerm" placeholder="What are you looking for?">
                  <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                 </button>
                 </form>
               </div>
            </div>
<div class="inner-dashboard servicePage">
    <div class="row">
      <div class="col-lg-12">
        <div class="well">
          <ul class="serNameButtons">
            <li>
              <a href="#instaScroll">Instagram</a>
            </li>
            <li>
              <a href="#youtubeScroll">Youtube</a>
            </li>
            <li>
              <a href="#facebookScroll">Facebook</a>
            </li>
            <li>
              <a href="#twitterScroll">Twitter</a>
            </li>
            <li>
              <a href="#linkedInScroll">Linkedin</a>
            </li>
          </ul>
        </div>
      </div>
    </div>



@if( ! empty($packagesNew) )
    @php
        $serviceId=null;
    @endphp
    @foreach($packagesNew as $k => $package)
        @if(is_null($serviceId))
            <!--CATEGORY NAME PRINT-->
            <div class="row" id="">
              <div class="col-sm-12">
                <div class="well wellHeader">
                  <h2>{{ $k }}</h2>
                </div>
              </div>
            </div>
            <!--CATEGORY NAME PRINT-->
            @php
            $serviceId=$package['id'];
            @endphp
        @endif
        @if($serviceId != $package['service_id'])
            <!--CATEGORY NAME PRINT-->
            <div class="row" id="">
              <div class="col-sm-12">
                <div class="well wellHeader">
                  <h2>{{ $k }}</h2>
                </div>
              </div>
            </div>
            <!--CATEGORY NAME PRINT-->
            @php
            $serviceId = $package['service_id'];
            @endphp
        @endif
        <!--SERVICE NAME TABLE-->
        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <div class="table-responsive">
                        <table class="serviceTable table table-striped table-sm ">
                            <thead class="thead-dark">
                                <tr>
                                  <th class="nowrap"><i class="material-icons">format_list_numbered</i >@lang('general.package_id')</th>
                                  <th class="width-service-name"><i class="material-icons">storage</i> @lang('general.name')</th>
                                  <th class="nowrap"><i class="material-icons">bar_chart</i> @lang('general.price_per_item') {{ getOption('display_price_per') }}</th>
                                  <th class="nowrap"><i class="material-icons">call_received</i> @lang('general.minimum_quantity')</th>
                                  <th class="nowrap"><i class="material-icons">call_made</i> @lang('general.maximum_quantity')</th>
                                  <th><i class="material-icons">format_align_left</i> @lang('general.description')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($package['data'] as $k1 => $v1)
                                <tr>
                                    <td data-th="@lang('general.package_id')">{{ $v1->id }}</td>
                                    <td data-th="@lang('general.name')">{{ $v1->name }}</td>
                                    <td data-th="@lang('general.price_per_item') {{ getOption('display_price_per') }}">@php $price = isset($userPackagePrices[$v1->id]) ? $userPackagePrices[$v1->id] : $v1->price_per_item;
                                        @endphp
                                        {{ ('R') . number_formats(($price * getOption('display_price_per')),2, getOption('currency_separator'), '')*  14.13 }}</td>
                                    <td data-th="@lang('general.minimum_quantity')"><span class="badge" style="background:#4ede80;">{{ $v1->minimum_quantity }}</span></td>
                                    <td data-th="@lang('general.maximum_quantity')"><span class="badge" style="background:#36a3f7;">{{ $v1->maximum_quantity }}</span></td>
                                    <td data-th="@lang('general.description')">
                                        <button type="button" class="btn-alternate" data-toggle="modal" data-target="#serviceDesc{{ $v1->id }}"><i class="material-icons">notes</i></button>
                                        <div class="modal fade" id="serviceDesc{{ $v1->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">{{ $v1->name }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                  {{ $v1->description }}
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
<div class="row">
    <div class="col-sm-12">
        <div class="well">
            <div class="table-responsive">
                <table class="serviceTable table table-striped table-sm ">
                    <thead class="thead-dark">
                        <tr>
                          <th class="nowrap"><i class="material-icons">format_list_numbered</i >@lang('general.package_id')</th>
                          <th class="width-service-name"><i class="material-icons">storage</i> @lang('general.name')</th>
                          <th class="nowrap"><i class="material-icons">bar_chart</i> @lang('general.price_per_item') {{ getOption('display_price_per') }}</th>
                          <th class="nowrap"><i class="material-icons">call_received</i> @lang('general.minimum_quantity')</th>
                          <th class="nowrap"><i class="material-icons">call_made</i> @lang('general.maximum_quantity')</th>
                          <th><i class="material-icons">format_align_left</i> @lang('general.description')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">No Record Found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endif



    
    

@endsection
