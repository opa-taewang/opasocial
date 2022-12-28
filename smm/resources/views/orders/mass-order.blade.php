@extends('layouts.app')
@section('title', getOption('app_name') . ' - Mass Order')
@section('content')
<style>
/*.mobile {*/
/*  display: none;*/
/*}*/
@media (max-width: 400px) {
 .tab-content #contactUs h2 {
    font-size: 15px;
    color: #575962;
}
</style>
<div class="inner-dashboard neworderPage">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="/custom_main/19/images/icon-2.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                <h3 class="totalOrdersHere"></h3>
                            </div>
                        </div>
                        <h3 class="tile-title">Total Orders On OpaSocial</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="/custom_main/19/images/icon-1.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                @php 
                                $points = (Auth::user()->points)/100;
                                $data=convertCurrency($points);
                                @endphp
                                <h3 class="totalSpentHere">{{Auth::user()->points}} ≈ {{$data['symbol'] .number_format($data['price'],2, getOption('currency_separator'), '') }}</h3>
                            </div>
                        </div>
                        <h3 class="tile-title">OpaSocial Points <span>

</span></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="/custom_main/19/images/icon-10.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                
                                <h3 id="totalFunds"><a href="/makemoney">MAKE MONEY</a></h3>
                            </div>
                        </div>
                        <h3 class="tile-title">Start Reselling Today</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashBox">
                        <div class="dashWrap">
                            <div class="dash-icon">
                                <img src="/custom_main/19/images/icon-11.png" alt="dash-icon"/>
                            </div>
                            <div class="dashValue">
                                <ul class="bars">
                                    <li></li>
                                    <li></li>
                                </ul>
                                <h3><a data-toggle="modal" data-target="#packageModal" style="cursor:pointer;">{{Auth::user()->group->name}}</a></h3>
                            </div>
                        </div>
                        <h3 class="tile-title">Account Status</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="well neworderStats tab">
                <ul id="myTabs" class=" nav nav-pills" role="tablist" data-tabs="tabs">
                  <li><a href="{{ url('/order/new') }}">@lang('menus.new_order')</a></li>
                  <li class="active"><a href="#mass-order" data-toggle="tab">@lang('menus.mass_order')</a></li>
                  <li><a href="{{ url('/order/my-favorites') }}">My Favorite</a></li>
                  
                </ul>
                <div class="tab-content">
                    <div id="massOrder" class="tab-pane fade in active" role="tabpanel">
                        <form role="form" method="POST" action="{{ url('/order/mass-order') }}">
                            {{ csrf_field() }}
                            <fieldset class="scheduler-border">
                                <div class="form-group">
                                    <h6 style="margin: 0">@lang('forms.mass_order')</h6>
                                    <p class="label label-default">@lang('forms.each_order_on_new_line')</p>
                                </div>
                                <div class="form-group">
                                    <span class="label label-success">@lang('forms.mass_order_format')</span>
                                    <textarea rows="15" name="content" id="content" data-validation="required" style=" resize: vertical;" class="form-control">{{ old('content') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">@lang('buttons.place_order')</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
              <!--  <div class="wellHeader">
                    <h2>How InstaRaja Works</h2>
                </div> -->
                <ul id="myTabs2" class="nav nav-pills" role="tablist" data-tabs="tabs">
                    <li class="active"><a href="#featured" data-toggle="tab">Todays Trending</a></li>
                    <li><a href="#bcd" data-toggle="tab">What is My Favorite?</a></li>
                    
                </ul>
                <div class="tab-content">
                    <div id="featured" class="tab-pane fade in active" role="tabpanel">
                        <div class="timeLineWrapper">
                            {!!  getPageContent('today-trend') !!}
                        </div>
                    </div>
                    <div id="bcd" class="tab-pane fade" role="tabpanel">
                        <b>Go to the Serice List page and ❤ your favorite services, then come here and order them! This way you will only see the services that you like!</b>
                    </div>
                    <div id="def" class="tab-pane fade" role="tabpanel">
                        For Easy Ordering, we have developed this system. just enter the link and quantity and place order. All services in this system will be high quality!
                    </div>
                </div>
            </div>
            <div class="well">
                <ul id="myTabs" class="nav nav-pills" role="tablist" data-tabs="tabs">
                    <li class="active"><a href="#latestNews" data-toggle="tab">Latest News</a></li>
                    <li><a href="#contactUs" data-toggle="tab">Get in Touch</a></li>
                </ul>
                <div class="tab-content">
                    
                    <div id="latestNews" class="tab-pane fade in active" role="tabpanel">
                        <div class="timeLineWrapper">
                            <ul class="news-wrap">
                            {!! getNotes() !!}  
                            </ul>
                            </div>
                    </div>
                    <div id="contactUs" class="tab-pane fade" role="tabpanel">
                        <div class="contactInfo">
                            <p>Need help? We are always ready to help you in any of your needs! Choose the best way to get in touch and we'll contact you ASAP!</p>
                        </div>
                        <h2>Support Ticket <span>(easiest &amp; fastest)</span><a href="/support" class="btn btn-primary btn-sm pull-right">Open New Ticket</a></h2>
                        
                        <div class="media">
                            <div class="media-left">
                              <a href="#" style="color:#5ee78d;">
                                <i class="fa fa-envelope"></i>
                              </a>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading">Email</h4>
                              <p>info@opasocial.com</p>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function(){
        $.get('https://InstaRaja.com/order/new/', function(result){
          var totalOrder = $(result).find("#totalOrder").html();
          var totalSpent = $(result).find("#totalSpent").html();
          var totalFunds = $(result).find("#totalFunds").html();
          $(".totalOrdersHere").html(totalOrder);
          $(".totalSpentHere").html(totalSpent);
          $(".totalFundsHere").html(totalFunds);
        });
    });
</script>
@endpush