@extends('layouts.app')
@section('title', getOption('app_name') . ' - New Favorite Order' )
@section('content')
@php
$scroll = getOption('neworder_scroll',true);
@endphp

<div class="inner-dashboard neworderPage">
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
                <h3 class="tile-title">Total Orders On InstaRaja</h3>
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
                        <h3 class="tile-title">InstaRaja Points<span>
<a href="https://instaraja.com/our-blog/what-is-instaraja-points-and-how-to-redeem-it/" style="float:right;color:#FFFFFF;" target="_blank"> <i class="fa fa-question-circle"></i></a>
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
                        <h3 id="totalOrder"><a data-toggle="modal" data-target="#packageModal" style="cursor:pointer;">{{Auth::user()->group->name}}</a></h3>
                    </div>
                </div>
                <h3 class="tile-title">Account Status</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="well neworderStats tab">
                <ul id="myTabs" class="nav nav-pills" role="tablist" data-tabs="tabs">
                  <li><a href="{{ url('/order/new') }}">@lang('menus.new_order')</a></li>
                  <li><a href="{{ url('/order/mass-order') }}">@lang('menus.mass_order')</a></li>
                  <li><a href="{{ url('/order/my-favorites') }}">My Favorite</a></li>
                  <li class="active"><a href="{{ url('/order/topservices') }}">Top Services</a></li>
                </ul>
                <div class="tab-content newOrderTabs">
                    <div id="newOrder" class="tab-pane fade in active" role="tabpanel">
                        <form role="form" method="POST" action="{{ url('top/order') }}">
                                {{ csrf_field() }}
                                <input type="hidden" id="aservice" name="aservice" value="{{$services[0]->id}}" />
                                <input type="hidden" id="apackage" name="apackage" value="{{$packages[0]->id}}" />
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="best-service mainBtn" style="margin-top: 15px">
                                            @foreach($services as $key => $service)
                                            <div id="{{$service->id}}-button" onclick="showsdiv('{{$service->slug}}',{{$service->id}})" class="change-service-button {{($key==0)?'active':''}}">
                                                <h5><i class="fa fa-fire"></i><span style="padding-top: 6px;">{{$service->name}}</span></h5>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="best-service">
                                            @foreach($services as $key => $service)
                                            <div id="div-{{$service->slug}}" class="top-service-box {{($key!=0)?'hide':''}}">
                                                <div class="btn-group btn-group-toggle form-group" style="width: 100%;" data-toggle="buttons">
                                            @foreach($packages as $key1 => $package)
                                            @if($package->service_id == $service->id)
                                            <label class="btn btn-toggle serviceBtn {{($key1==0)?'active':''}}" style="width: 33.3%;" onclick="packageBody('{{$package->slug}}','{{$service->slug}}',{{$package->id}})">
                                                        @if($package->name == "Followers")
                                                        <i class="fas fa-users"></i>
                                                        @elseif($package->name == "Likes")
                                                        <i class="fas fa-heart"></i>
                                                        @elseif($package->name == "Views")
                                                        <i class="fas fa-eye"></i>
                                                        @else
                                                        <i class="fas fa-cogs"></i>
                                                        @endif
                                                        <input type="radio" id="{{$package->slug}}" name="{{$package->slug}}" class="{{$package->slug}}-categories" checked="">{{$package->name}}</label>
                                            @endif
                                            @endforeach
                                            </div>
                                            @foreach($packages as $key1 => $package)
                                            @if($package->service_id == $service->id)
                                                <div id="body-{{$package->slug}}" class="text-group form-group {{$service->slug}} {{($key1==0)?'':'hide'}}" style="width: 100%;">
                                                    <div class="form-group">
                                        <label for="description" class="control-label">@lang('forms.description')</label>
                                        <textarea name="{{$package->id}}description" id="description" rows="8" style="resize:none" class="form-control description" readonly>{{$package->description}}</textarea>
                                    </div>
                                    <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}" id="link-div">
                                        <label for="link" class="control-label">@lang('forms.link')</label>
                                        <input name="{{$package->id}}link" id="link" value="{{ old('link') }}" type="text" data-validation="required" class="form-control" placeholder="">
                                        @if ($errors->has('link'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('link') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}" id="quantity-div">
                                        <label for="quantity" class="control-label">@lang('forms.quantity')</label>
                                        <input name="{{$package->id}}quantity" id="quantity" type="text" oninput="calculatePrice('{{$key1}}','{{$service->slug}}','{{$package->slug}}',this)" value="{{ old('quantity') }}" class="form-control" data-validation="number"  placeholder="">
                                        <span class="help-block">
                                        <span class="label label-default">@lang('forms.minimum_quantity') : <span id="min-q">{{$package->minimum_quantity}}	</span></span> <span class="label label-default">@lang('forms.maximum_quantity') : <span id="max-q">{{$package->maximum_quantity}}</span></span>
                                    </span>
                                        @if ($errors->has('quantity'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    @if($package->custom_comments)
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}" id="custom-comments-div">
                                        <label for="custom_comments" class="control-label">@lang('forms.custom_comments')</label>
                                        <textarea class="form-control" id="custom_comments" oninput="CustomComments('{{$key1}}','{{$service->slug}}','{{$package->slug}}',this)" onkeyup="auto_grow(this)" style="resize: none;overflow: hidden;min-height: 50px;" placeholder="1 on each line" name="{{$package->id}}custom_comments">{{old('custom_comments')}}</textarea>
                                        @if ($errors->has('custom_comments'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('custom_comments') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    @endif
                                    <div id="auto-like-block" class="{{($package->features == 'Auto Like')?'':'hide'}}">
                                        <input name="{{$package->id}}autolike" id="autolike" type="hidden" value="">
                                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                            <label for="username" class="control-label">@lang('new.iguser')</label>
                                            <input name="{{$package->id}}username" id="username" value="{{ old('username') }}" type="text" data-validation="required" class="form-control" placeholder="">
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
                                                <input name="{{$package->id}}minqty" id="minqty" type="text" value="{{ old('minqty') }}" class="form-control" data-validation="number" data-validation-allowing="range[1;100]" placeholder="">
                                              </div>
                                              <div class="col-md-6">
                                                <label for="maxqty" class="control-label">@lang('new.max')</label>
                                                <input name="{{$package->id}}maxqty" oninput="MaximumQty('{{$key1}}','{{$service->slug}}','{{$package->slug}}',this)" id="maxqty" type="text" value="{{ old('maxqty') }}" class="form-control" data-validation="number" data-validation-allowing="range[1;100]" placeholder="">
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
                                            <input name="{{$package->id}}postcount" oninput="PostCount('{{$key1}}','{{$service->slug}}','{{$package->slug}}',this)" id="postcount" type="text" value="{{ old('postcount') }}" class="form-control" data-validation="number" data-validation-allowing="range[1;1000000]" placeholder="">
                                            @if ($errors->has('postcount'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('postcount') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group" id="dripfeeddiv" class="{{($package->features == 'Drip Feed')?'':'hide'}}">
                                        <label class="control-label" for="dripfeedselect">@lang('new.df')</label>
                                        <input class="magic-checkbox" type="checkbox" onchange="dripFeedSelect('{{$key1}}','{{$service->slug}}','{{$package->slug}}',this)" name="{{$package->id}}dripfeedselect" id="dripfeedselect" value="1">
                                    </div>
                                    <div class="form-group{{ $errors->has('runs') ? ' has-error' : '' }} {{($package->features == 'Drip Feed')?'':'hide'}}"  id="runsdiv" style="display: none">
                                        <label for="runs" class="control-label">@lang('new.runs')</label>
                                        <input name="{{$package->id}}runs" oninput="Runs('{{$key1}}','{{$service->slug}}','{{$package->slug}}',this)" id="runs"type="text" value="{{ old('runs') }}" class="form-control" data-validation="number" placeholder="">
                                    </div>
                                    <div class="form-group{{ $errors->has('interval') ? ' has-error' : '' }} {{($package->features == 'Drip Feed')?'':'hide'}}"  id="intervaldiv" style="display: none">
                                        <label for="interval" class="control-label">@lang('new.interval')</label>
                                        <input name="{{$package->id}}interval" id="interval" type="text" value="{{ old('interval') }}" class="form-control" data-validation="number" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <p>Price per <span id="order_items">0</span> Item: {{ getOption('currency_symbol') }}<span id="order_total">0</span></p>
                                        <p id="not-enough-funds" style="display:none;color:red">@lang('forms.order_amount_exceed')</p>
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
                                    </div>
                                    @endif
                                    @endforeach
                                    <button type="submit" id="btn-proceed" class="btn btn-primary" onclick="orderInstagram()">Order</button>
                                    </div>
                                    @endforeach
                                    </div>
                                    </div>
                                </div>
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
                    <li><a href="#def" data-toggle="tab">What is Top Services?</a></li>
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
                        <h2>Support Ticket <span>(easiest &amp; fastest)</span><a href="/tickets" class="btn btn-primary btn-sm pull-right">Open New Ticket</a></h2>
                        <div class="media">
                            <div class="media-left">
                              <a href="#" style="color:#00aff1;">
                                <i class="fab fa-skype"></i>
                              </a>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading">Skype</h4>
                              <p>Instarajaoffl@gmail.com</p>
                            </div>
                          </div>
                        <div class="media">
                            <div class="media-left">
                              <a href="#" style="color:#5ee78d;">
                                <i class="fa fa-envelope"></i>
                              </a>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading">Email</h4>
                              <p>Instarajaoffl@gmail.com</p>
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

        var userFunds = '{{ Auth::user()->funds }}';
        $(function () {
            // $('.description').change(function () {
            //     this.style.height = '10px';
            //     this.style.height = (this.scrollHeight+10)+'px';
            // });
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
        var packages=@json($packages);
        function packageBody(slug,sslug,id) {
            $('#apackage').val(id);
            $('.'+sslug).addClass("hide"); 
            $('#body-'+slug).removeClass("hide");
        }
        function showsdiv(slug,id) {
            $('.change-service-button').removeClass('active');
            $('#aservice').val(id);
            $('#'+id+'-button').addClass('active');
            $('.top-service-box').addClass('hide');
            $('#div-'+slug).removeClass('hide');
            $('#div-'+slug+' > div:first-child > label').removeClass('active');
            $('#div-'+slug+' > div:first-child > label:first-child').addClass('active');
            $('#div-'+slug+' > div.'+slug).addClass('hide');
            $('#div-'+slug+' > div:nth-child(2)').removeClass('hide');
        }
        function calculatePrice(key,sid,pid,input) {
            var orderTotal=0;
            var price_per_item=packages[key]['price_per_item'];
            var q=input.value;
            if($('#div-'+sid+' > #body-'+pid+' > div#dripfeeddiv > #dripfeedselect').is(':checked')){
                orderTotal = q * $('#div-'+sid+' > #body-'+pid+' > div#runsdiv > #runs').val() * price_per_item;
            }else if(!$('#div-'+sid+' > #body-'+pid+' > div#dripfeeddiv > #dripfeedselect').checked){
                orderTotal = q * price_per_item;
            }
            $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_items').text(q);
            $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

            if (orderTotal > userFunds) {
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').show();
            } else {
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').hide();
            }
            
        }
        function CustomComments(key,sid,pid,input) {
                var text = input.value;
                var lines = text.split(/\r|\r\n|\n/);
                var q = lines.length;
                $('#div-'+sid+' > #body-'+pid+' > #quantity-div > #quantity').val($.trim(q));

                var orderTotal = 0;
                if (q > 0) {
                    var price_per_item = packages[key]['price_per_item'];
                    if($('#div-'+sid+' > #body-'+pid+' > div#dripfeeddiv > #dripfeedselect').is(':checked') && $('#div-'+sid+' > #body-'+pid+' > div#runsdiv > #runs').val() > 0){
                        orderTotal = q * $('#div-'+sid+' > #body-'+pid+' > div#runsdiv > #runs').val() * price_per_item;
                    }else if(!$('#div-'+sid+' > #body-'+pid+' > div#dripfeeddiv > #dripfeedselect').checked){
                        orderTotal = q * price_per_item;
                    }
                }
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_items').text(q);
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

                if (orderTotal > userFunds) {
                    $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').show();
                } else {
                    $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').hide();
                }
            }
        function PostCount(key,sid,pid,input) {
            var orderTotal = 0;
            var pc = input.value;
            var price_per_item = packages[key]['price_per_item'];
            var mq = $('#div-'+sid+' > #body-'+pid+' > #auto-like-block > div:nth-child(2) > div.row > div:nth-child(2) > #maxqty').val();

            orderTotal = mq * pc * price_per_item;
            $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_items').text(mq);
            $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

            if (orderTotal > userFunds) {
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').show();
            } else {
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').hide();
            }
        }
        function MaximumQty(key,sid,pid,input) {
            var orderTotal = 0;
            var mq = input.value;
            var price_per_item = packages[key]['price_per_item'];
            var pc = $('#div-'+sid+' > #body-'+pid+' > #auto-like-block > div:nth-child(3) > #postcount').val();

            orderTotal = mq * pc * price_per_item;
            $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_items').text(mq);
            $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

            if (orderTotal > userFunds) {
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').show();
            } else {
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').hide();
            }

        }
        function Runs(key,sid,pid,input) {
            var orderTotal = 0;
            var runs = input.value;
            var q = $('#div-'+sid+' > #body-'+pid+' > #quantity-div > #quantity').val();
            var price_per_item = packages[key]['price_per_item'];
            
            if (q > 0 && runs > 0) {
                orderTotal = q * runs * price_per_item;
            }
            $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_items').text(q);
            $('#div-'+sid+' > #body-'+pid+' > div:last-child > p:first-child > #order_total').text(orderTotal.toFixed(5).replace(".", "{{ getOption('currency_separator') }}"));

            if (orderTotal > userFunds) {
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').show();
            } else {
                $('#div-'+sid+' > #body-'+pid+' > div:last-child > p#not-enough-funds').hide();
            }

        }
        function dripFeedSelect(key,sid,pid,input) {
            $('#div-'+sid+' > #body-'+pid+' > div#runsdiv > #runs').val(0);
            $('#div-'+sid+' > #body-'+pid+' > div#intervaldiv > #interval').val(0);
            
            if (input.checked) {
                    $('#div-'+sid+' > #body-'+pid+' > div#intervaldiv').show();
                    $('#div-'+sid+' > #body-'+pid+' > div#runsdiv').show();
            } else {
                    $('#div-'+sid+' > #body-'+pid+' > div#intervaldiv').hide();
                    $('#div-'+sid+' > #body-'+pid+' > div#runsdiv').hide();
            }
            $('#div-'+sid+' > #body-'+pid+' > div#runsdiv > #runs').trigger('keyup');
            $('#div-'+sid+' > #body-'+pid+' > #quantity-div > #quantity').trigger('keyup');
        }
    </script>
@endpush