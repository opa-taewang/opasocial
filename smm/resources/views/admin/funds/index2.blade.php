@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - My Orders')
@section('content')
<style type="text/css">
.pagination .active span{
    background-color:#337ab7 !important;
    color: white !important;
}
.width-30 {
    width: 30% !important;
    word-break: break-all;
    min-width: 250px;
}
</style>
@php
 $path = 'autolike';
@endphp
    <div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills ">
          <li class="pull-right search">
            <form action="/admin/fund-records/{{$id}}" method="get" id="history-search">
              <div class="input-group" style="width: 25%;float: right;">
                <input style="" type="text" name="search" class="form-control" value="{{$search}}" placeholder="Search">
                <span class="input-group-btn">
                  <button type="submit" style="padding: 6px 5px;" class="btn btn-default"><i class="fa fa-search fa-fw" aria-hidden="true"></i></button>
                </span>
              </div>
            </form>
          </li>
        </ul>
        <div class="panel panel-default">
          <table class="table ">
            <thead>
              <tr>
                <th>@lang('general.user_id')</th>
                <th>@lang('general.user')</th>
                <th>Reason</th>
                <th>@lang('general.date') & Time</th>
                <th>Before</th>
                <th>Change Amount</th>
                <th>After</th>
                <th>@lang('general.details')</th>
              </tr>
            </thead>
            <tbody>
              @if($fundCs->count() > 0 )
                @foreach($fundCs as $fc)
                   @php
                      $type = '';
                      switch ($fc->type) {
                        case 'ADD':
                            $type = 'Fund Add by User';
                            break;
                        case 'ADDADMIN':
                            $type = 'Fund Add By Admin';
                            break;
                        case 'ORDER':
                            $type = 'Order Placed';
                            break;
                        case 'REFUND':
                            $type = 'Refund';
                            break;
                        case 'CHANGEADMIN':
                            $type = 'Admin Changed Fund';
                            break;
                      } 
                   @endphp
                  <tr>
                    <td>{{$fc->user_id}}</td>
                    <td>{{$fc->user->name}}</td>
                    <td>{{$type}}</td>
                    <td>{{$fc->created_at}}</td>
                    <td>{{getOption('currency_symbol') .$fc->before}}</td>
                    <td>{{getOption('currency_symbol') .$fc->amount}}</td>
                    <td>{{getOption('currency_symbol') .$fc->after}}</td>
                    <td>{!! nl2br($fc->details) !!}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="8" style="text-align: center;">No Records Found</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>

                  {{ $fundCs->render() }}
        
      </div>
    </div>
@endsection
