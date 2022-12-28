@extends('layouts.app')
@section('title', getOption('app_name') . ' - New Order' )
@section('content')
@php
$scroll = getOption('neworder_scroll',true);
@endphp
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
<style>
/*.dashBox:hover {*/
/*  background-color: yellow;*/
/*}*/
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
                                <h3 id="totalOrder">{{$ordercnt}}</h3>
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
                        <h3 class="tile-title">OpaSocial Points<span>

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
                <ul id="myTabs" class="nav nav-pills" role="tablist" data-tabs="tabs">
                  <li class="active"><a href="newOrder" data-toggle="tab">@lang('menus.new_order')</a></li>
                  <li><a href="{{ url('/order/mass-order') }}">@lang('menus.mass_order')</a></li>
                  <li><a href="{{ url('/order/my-favorites') }}">My Favorite</a></li>
                  
                </ul>
                <div class="tab-content newOrderTabs">
                    <div id="newOrder" class="tab-pane fade in active" role="tabpanel">
                        @if(request()->is('order/new*'))
                            @if(Session::has('alert'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="font-size: 15px" class="alert alert-{{ Session::get('alertClass') }}">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        {{ Session::get('alert') }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                        <form role="form" method="POST" action="{{ url('/order') }}">
                            {{ csrf_field() }}
                            <fieldset class="scheduler-border">
                                <!--<legend class="scheduler-border">@lang('forms.new') @lang('forms.order')</legend>-->
                                @if( $scroll != '' )    
                                  <div class="row">
                                      <div class="col-md-6 col-md-offset-3">
                                          <center style="padding-top: 1px">
                                              <marquee>
                                                  <div dir="ltr" style="text-align: left;" trbidi="on"> 
                                                      <span style="color: red;">{!! $scroll !!}</span>
                                                  </div>
                                              </marquee>
                                          </center>
                                      </div>
                                  </div><br>
                                @endif
                                <div class="form-group{{ $errors->has('service_id') ? ' has-error' : '' }}">
                                    <label for="service_id" class="control-label">@lang('forms.service')</label>
                                    <select name="service_id" id="service_id" data-validation="required" class="form-control">
                                        <option value="">Select a service</option>
                                        @if( ! $services->isEmpty() )
                                            @foreach( $services as $service)
                                            <option value="{{ $service->id }}"> {{ $service->name  }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('service_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('service_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('package_id') ? ' has-error' : '' }}">
                                    <label for="package_id" class="control-label">@lang('forms.package')</label>
                                    <select name="package_id" id="package_id" data-validation="required" class="form-control">
                                        <option value="">Select service first</option>
                                    </select>
                                    @if ($errors->has('package_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('package_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label">@lang('forms.description')</label>
                                    <textarea name="description" id="description" rows="8" style="resize:none" class="form-control" readonly></textarea>
                                </div>
                                <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}" id="link-div">
                                    <label for="link" class="control-label">@lang('forms.link')<span style="color: #96119E;"> (Must be Public)</span></label>
                                    <input name="link" id="link" value="{{ old('link') }}" type="text" data-validation="required" class="form-control" placeholder="">
                                    @if ($errors->has('link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}" id="quantity-div">
                                    <label for="quantity" class="control-label">@lang('forms.quantity')</label>
                                    <input name="quantity" id="quantity" type="text" value="{{ old('quantity') }}" class="form-control" data-validation="number" data-validation-allowing="range[1;100]" placeholder="">
                                    <span class="help-block">
                                    <span class="label label-default">@lang('forms.minimum_quantity') : <span id="min-q">0</span></span> <span class="label label-default">@lang('forms.maximum_quantity') : <span id="max-q">0</span></span>
                                </span>
                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}" id="custom-comments-div" style="display: none">
                                    <label for="custom_comments" class="control-label">@lang('forms.custom_comments')</label>
                                    <textarea class="form-control" id="custom_comments" onkeyup="auto_grow(this)" style="resize: none;overflow: hidden;min-height: 50px;" placeholder="1 on each line" name="custom_comments">{{old('custom_comments')}}</textarea>
                                    @if ($errors->has('custom_comments'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('custom_comments') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div id="auto-like-block"  style="display: none">
                                    <input name="autolike" id="autolike" type="hidden" value="">
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label for="username" class="control-label">@lang('new.iguser')</label>
                                        <input name="username" id="username" value="{{ old('username') }}" type="text" data-validation="required" class="form-control" placeholder="">
                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                        @endif
                                    </div>                            
                                    <div class="form-group{{ $errors->has('alquantity') ? ' has-error' : '' }}">
                                        <label for="alquantity" id="allabel" class="control-label">@lang('forms.quantity') (No. of likes in each post)</label>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <label for="minqty" class="control-label">@lang('new.min')</label>
                                            <input name="minqty" id="minqty" type="text" value="{{ old('minqty') }}" class="form-control" data-validation="number" data-validation-allowing="range[1;100]" placeholder="">
                                          </div>
                                          <div class="col-md-6">
                                            <label for="maxqty" class="control-label">@lang('new.max')</label>
                                            <input name="maxqty" id="maxqty" type="text" value="{{ old('maxqty') }}" class="form-control" data-validation="number" data-validation-allowing="range[1;100]" placeholder="">
                                          </div>
                                        </div>
                                        <span class="help-block">
                                            <span class="label label-default">@lang('forms.minimum_quantity') : <span id="min-q1">0</span></span> 
                                            <span class="label label-default">@lang('forms.maximum_quantity') : <span id="max-q1">0</span></span>
                                        </span>
                                        @if ($errors->has('alquantity'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alquantity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('postcount') ? ' has-error' : '' }}">
                                        <label for="postcount" class="control-label">@lang('new.postnum')</label>
                                        <input name="postcount" id="postcount" type="text" value="{{ old('postcount') }}" class="form-control" data-validation="number" data-validation-allowing="range[1;1000000]" placeholder="">
                                        @if ($errors->has('postcount'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('postcount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group" id="dripfeeddiv" style="display: none">
                                    <label class="control-label" for="dripfeedselect">@lang('new.df')</label>
                                    <input class="magic-checkbox" type="checkbox" name="dripfeedselect" id="dripfeedselect" value="1">
                                </div>
                                <div class="form-group{{ $errors->has('runs') ? ' has-error' : '' }}"  id="runsdiv" style="display: none">
                                    <label for="runs" class="control-label">@lang('new.runs')</label>
                                    <input name="runs" id="runs"type="text" value="{{ old('runs') }}" class="form-control" data-validation="number" placeholder="">
                                </div>
                                <div class="form-group{{ $errors->has('interval') ? ' has-error' : '' }}"  id="intervaldiv" style="display: none">
                                    <label for="interval" class="control-label">@lang('new.interval')</label>
                                    <input name="interval" id="interval" type="text" value="{{ old('interval') }}" class="form-control" data-validation="number" placeholder="">
                                </div>
                                <div class="form-group">
                                    <p>Price per <span id="order_items">0</span> Item: {{ getConversionSymbol() }}<span id="order_total">0</span></p>
                                    <p id="not-enough-funds" style="display:none;color:red">@lang('forms.order_amount_exceed')</p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="btn-proceed" class="btn btn-primary">@lang('buttons.place_order')</button>
                                </div>
                                @if ($errors->has('runs'))
                                    <span class="help-block" style="color: #e74c3c;">
                                        <strong>{{ $errors->first('runs') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('interval'))
                                    <span class="help-block" style="color: #e74c3c;">
                                        <strong>{{ $errors->first('interval') }}</strong>
                                    </span>
                                @endif
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
                    <li><a href="#bcd" data-toggle="tab">Please Read!</a></li>
                    
                </ul>
                <div class="tab-content">
                    <div id="featured" class="tab-pane fade in active" role="tabpanel">
                        <div class="timeLineWrapper">
                            {!!  getPageContent('today-trend') !!}
                        </div>
                    </div>
                    <div id="bcd" class="tab-pane fade" role="tabpanel">
                        <b>Some clients place orders with us for huge accounts, for example they order 1,000 followers for an account with tens or hundreds or thousands of followers, such accounts are bound to drop at some point due to the large numbers of previously bought followers, and would not be eligible for refill or refund if the order dint complete or drops.</br></br> 

Once an order is entered it cannot be cancelled unless the link entered is for a different service, for example a YouTube link in a Facebook service.</br></br>
Do not place duplicate orders for same link on our site, otherwise both orders will get completed but all likes/followers/views will not be given. We cannot do anything in such case.</b>
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

        var userFunds = '{{ getConvertedRate(Auth::user()->funds)}}';
        $(function () {

            $('#service_id').change(function () {
                var service_id = $(this).val();
                if (service_id !== '') {
                    resetValues();
                    
                    $.ajax({
                        url: baseUrl + '/service/get-packages/' + service_id,
                        type: "GET",
                        success: function (packages) {
                            $('#package_id').html(packages);
                        }
                    });
                    $('#auto-like-block').hide();
                    $('#quantity-div').show();
                    $('#link-div').show();
                }
            });

            // On select display minimum quantity of package
            $('#package_id').change(function () {
                var sel = $('#package_id option:selected');
                if (sel.val() != '') {
                    $('#min-q').html(sel.data('min'));
                    $('#max-q').html(sel.data('max'));
                    $('#description').text(sel.data('description'));
                    $('#description').trigger('change');
                    $('#quantity').attr('data-validation-allowing', 'range[' + sel.data('min') + ';' + sel.data('max') + ']')
                    $('#link').focus();

                    if (sel.data('comments') == 1) {
                        $('#custom-comments-div').show();
                        $('#quantity')
                            .val(0)
                            .attr('readonly', true);
                    } else {
                        $('#custom-comments-div').hide();
                        $('#quantity').removeAttr('readonly');
                    }

                    $('#order_total').text(0);
                    $('#order_items').text(0);
                    $('#dripfeedselect').attr('checked', false);
                    if (sel.data('features') == 'Drip Feed') {
                        $('#dripfeeddiv').show();
                        $('#autolike').val(0);
                        $('#auto-like-block').hide();
                        $('#quantity-div').show();
                        $('#link-div').show();
                    } else if (sel.data('features') == 'Auto Like' || sel.data('features') == 'Auto View') {
                        $('#autolike').val(1);
                        $('#minqty').val(0);
                        $('#maxqty').val(0);
                        $('#postcount').val(0);
                        $('#username').val('');
                        $('#min-q1').html(sel.data('min'));
                        $('#max-q1').html(sel.data('max'));
                        $('#minqty').attr('data-validation-allowing', 'range[' + sel.data('min') + ';' + sel.data('max') + ']')
                        $('#maxqty').attr('data-validation-allowing', 'range[' + sel.data('min') + ';' + sel.data('max') + ']')
                        $('#auto-like-block').show();
                        $('#custom-comments-div').hide();
                        $('#quantity-div').hide();
                        $('#link-div').hide();
                        $('#dripfeeddiv').hide();
                    } else {
                        $('#dripfeeddiv').hide();
                        $('#autolike').val(0);
                        $('#auto-like-block').hide();
                        $('#quantity-div').show();
                        $('#link-div').show();
                    }
                    $('#dripfeedselect').trigger('change');
                }
            });

            $('#description').change(function () {
                this.style.height = '10px';
                this.style.height = (this.scrollHeight+10)+'px';
            });
            $('#dripfeedselect').change(function () {
                var t = $(this);
                $('#runs').val(0);
                $('#interval').val(0);
                if (this.checked) {
                        $('#intervaldiv').show();
                        $('#runsdiv').show();
                } else {
                        $('#intervaldiv').hide();
                        $('#runsdiv').hide();
                }
                $('#runs').trigger('keyup');
                $('#quantity').trigger('keyup');
            });

            $('#custom_comments').on('keyup', function () {
                var text = $(this).val();
                var lines = text.split(/\r|\r\n|\n/);
                var q = lines.length;
                $('#quantity').val($.trim(q));

                var sel = $('#package_id option:selected');
                var orderTotal = 0;
                if (q > 0) {
                    var price_per_item = sel.data('peritem');
                    if($('#dripfeedselect').is(':checked') && $('#runs').val() > 0){
                        orderTotal = q * $('#runs').val() * price_per_item;
                    }else if(!$('#dripfeedselect').checked){
                        orderTotal = q * price_per_item;
                    }
                }
                $('#order_items').text(q);
                $('#order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

                if (orderTotal > userFunds) {
                    $('#not-enough-funds').show();
                } else {
                    $('#not-enough-funds').hide();
                }
            });

            $('#quantity').on('keyup', function () {

                var sel = $('#package_id option:selected');
                var orderTotal = 0;
                var q = $(this).val();
                if (q > 0) {
                    var price_per_item = sel.data('peritem');
                    if($('#dripfeedselect').is(':checked')){
                        orderTotal = q * $('#runs').val() * price_per_item;
                    }else if(!$('#dripfeedselect').checked){
                        orderTotal = q * price_per_item;
                    }
                }
                $('#order_items').text(q);
                $('#order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

                if (orderTotal > userFunds) {
                    $('#not-enough-funds').show();
                } else {
                    $('#not-enough-funds').hide();
                }

            });

            $('#runs').on('keyup', function () {

                var sel = $('#package_id option:selected');
                var orderTotal = 0;
                var runs = $(this).val();
                var q = $('#quantity').val();
                var price_per_item = sel.data('peritem');
                
                if (q > 0 && runs > 0) {
                    orderTotal = q * runs * price_per_item;
                }
                $('#order_items').text(q);
                $('#order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

                if (orderTotal > userFunds) {
                    $('#not-enough-funds').show();
                } else {
                    $('#not-enough-funds').hide();
                }

            });

            $('#maxqty').on('keyup', function () {

                var sel = $('#package_id option:selected');
                var orderTotal = 0;
                var mq = $(this).val();
                var price_per_item = sel.data('peritem');
                var pc = $('#postcount').val();

                orderTotal = mq * pc * price_per_item;
                $('#order_items').text(mq);
                $('#order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

                if (orderTotal > userFunds) {
                    $('#not-enough-funds').show();
                } else {
                    $('#not-enough-funds').hide();
                }

            });

            $('#postcount').on('keyup', function () {

                var sel = $('#package_id option:selected');
                var orderTotal = 0;
                var pc = $(this).val();
                var price_per_item = sel.data('peritem');
                var mq = $('#maxqty').val();

                orderTotal = mq * pc * price_per_item;
                $('#order_items').text(mq);
                $('#order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

                if (orderTotal > userFunds) {
                    $('#not-enough-funds').show();
                } else {
                    $('#not-enough-funds').hide();
                }

            });

        });

        function resetValues() {
            $('#order_items').text(0);
            $('#order_total').text(0);
            $('#description').text('');
            $('#quantity').val(0);
            $('#min-q').html(0);
            $('#max-q').html(0);
            $('#dripfeeddiv').hide();
            $('#dripfeedselect').attr('checked', false);
            $('#runs').val(0);
            $('#interval').val(0);
            $('#intervaldiv').hide();
            $('#runsdiv').hide();
        }
        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight+10)+"px";
        }       
        $(function () {
            $("textarea").each(function () {
                this.style.height = (this.scrollHeight+10)+'px';
            });
        });        
    </script>
@endpush