@extends('layouts.app')
@section('title', getOption('app_name') . ' - Dashboard')
@section('content')
<div class="inner-dashboard dasboardPage">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="custom_main/19/images/icon-1.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                @php
                                $data=convertCurrency(Auth::user()->funds);
                                @endphp
                                <h3>{{ $data['symbol'] .number_format($data['price'],2, getOption('currency_separator'),'') }}</h3>
                            </div>    
                        </div>
                        <h3 class="tile-title">@lang('general.funds_available')</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="custom_main/19/images/icon-2.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                @php 
                                $data=convertCurrency($spentAmount);
                                @endphp
                                <h3>{{$data['symbol'] .number_format($data['price'],2, getOption('currency_separator'), '') }}</h3>
                            </div>    
                        </div>
                        <h3 class="tile-title">@lang('general.total_spent')</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="custom_main/19/images/icon-3.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                <h3>{{ $unreadMessages }}</h3>
                            </div>
                        </div>
                        <h3 class="tile-title">@lang('general.new_messages')</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="custom_main/19/images/icon-4.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                <h3>{{ $ordersPending }}</h3>
                            </div>
                        </div>
                        <h3 class="tile-title">@lang('general.order_pending')</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="custom_main/19/images/icon-5.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                <h3>{{ $ordersInProgress }}</h3>
                            </div>
                        </div>
                        <h3 class="tile-title">@lang('general.orders_inprogress')</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="custom_main/19/images/icon-6.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                <h3>{{ $ordersProcessing }}</h3>
                            </div>
                        </div>
                        <h3 class="tile-title">Orders Processing</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="custom_main/19/images/icon-7.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                <h3>{{ $ordersCompleted }}</h3>
                            </div>
                        </div>
                        <h3 class="tile-title">@lang('general.order_completed')</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="custom_main/19/images/icon-8.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                <h3>{{ $ordersCancelled }}</h3>
                            </div>
                        </div>
                        <h3 class="tile-title">@lang('general.order_cancelled')</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="custom_main/19/images/icon-9.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                <h3>{{ $supportTicketOpen }}</h3>
                            </div>
                        </div>
                        <h3 class="tile-title">@lang('general.open_support_tickets')</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well">
                <div class="wellHeader">
                    <h2>@lang('general.note_from_admin')</h2>
                </div>
                <div class="notesAdmin">
                    {!! getOption('admin_note') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection