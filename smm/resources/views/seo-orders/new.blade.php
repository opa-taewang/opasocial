@extends('layouts.app')
@section('title', getOption('app_name') . ' - New Seo Order' )
@section('content')
@php
$scroll = getOption('neworder_scroll',true);
@endphp
<style>
/*.mobile {*/
/*  display: none;*/
/*}*/
@media (max-width: 400px) {
  /*.mobile {*/
  /*  display: block;*/
  /*}*/
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
                  <li class="active"><a href="newOrder" data-toggle="tab"><i class="material-icons">add_circle_outline</i> New Seo Order</a></li>
                  <li><a href="{{ url('/seo-orders/all') }}"><i class="material-icons">queue</i> All Seo Orders</a></li>
                </ul>
                <div class="tab-content newOrderTabs">
                    <div id="newOrder" class="tab-pane fade in active" role="tabpanel">
                        @if(request()->is('seo-orders'))
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
                        <form role="form" method="POST" id="newform" action="{{ url('/seo-order') }}">
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
                                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label for="category" class="control-label">Select Category</label>
                                    <select name="category" id="category" data-validation="required" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach( $categories as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name  }}</option>
                                            @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('service') ? ' has-error' : '' }}">
                                    <label for="service" class="control-label">Select Service</label>
                                    <select name="service" id="service" data-validation="required" class="form-control">
                                            <option value="">Select Category First</option>
                                    </select>
                                    @if ($errors->has('service'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('service') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('package') ? ' has-error' : '' }}">
                                    <label for="package" class="control-label">Select Package</label>
                                    <select name="package" id="package" data-validation="required" class="form-control">
                                            <option value="">Select Service First</option>
                                    </select>
                                    @if ($errors->has('package'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('package') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="description" class="control-label">@lang('forms.description')</label>
                                    <textarea name="description" id="description" rows="8" style="resize:none;height: auto;" class="form-control" readonly></textarea>
                                </div>
                                <div class="requirements-div" id="requirements-div" style="display: none"></div>
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
                                <div class="extras" style="display:none;">
                                    <label for="extras"></label>
                                    <div class="extra text-center"></div>
                                </div>
                                <div class="form-group">
                                    <p>Total Price: <span id="order_items">0</span></p>
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
        var userFunds = parseFloat({{ getConvertedRate(Auth::user()->funds)}});
        var sp=0;
        function category(){
            if($('#category').val()!='') {
                    $.ajax({
			          type: "POST",
			          url: "{{url('get/seo-services/')}}/"+$('#category').val(),
			          data: {_token: '{{csrf_token()}}',service:{{(isset($_GET['services']) && !empty($_GET['services']))?$_GET['services']:0}} },
			          success: function(data){
			        	$('#service').html(data);
			        	service();
			          }, error: function (error) {
			            console.log(error);
			            alert('Oops!, System encountered an problem');
			          }
					});
                }
        }
        function service() {
            if($('#service').val()!='') {
                $.ajax({
		          type: "POST",
		          url: "{{url('get/seo-packages/')}}/"+$('#service').val(),
		          data: {_token: '{{csrf_token()}}',package:{{(isset($_GET['packages']) && !empty($_GET['packages']))?$_GET['packages']:0}} },
		          success: function(data){
		        	$('#package').html(data);
		        	package();
		          }, error: function (error) {
		            console.log(error);
		            alert('Oops!, System encountered an problem');
		          }
				});
            }
        }
        function package(){
            var package_id = $('#package').val();
            $('#newform > fieldset > div.extras').hide();
            $('#newform #not-enough-funds').hide();
            $('#newform #requirements-div').hide();
            $('#newform #requirements-div').html('');
            $('#newform #dripfeeddiv').hide();
            $('#newform #runsdiv').hide();
            $('#newform #intervaldiv').hide();
            $('#newform #description').val('');
            $('#newform #order_items').html('$0');
            if (package_id !== '') {
                $('#newform > fieldset > div.extras').show();
                $('#newform > fieldset > div.extras > div.extra').html('<i class="fa fa-spinner fa-spin" style="font-size: 24px;"></i>');
                $('#newform #btn-proceed').attr('disabled',true);
                $.ajax({
		          type: "POST",
		          url: "{{url('get/extra/')}}/"+package_id,
		          data: {_token: '{{csrf_token()}}'},
		          success: function(data){
		        	$('#newform div.extras .extra').html(data);
		        	$('#newform #btn-proceed').attr('disabled',false);
		          }, error: function (error) {
		            $('#newform div.extras .extra').html('');
		            $('#newform #btn-proceed').attr('disabled',false);
		            console.log(error);
		            alert('System encountered an problem.');
		          }
				});
				$.ajax({
                    url: baseUrl + '/package/get/' + package_id,
                    type: "GET",
                    success: function (data) {
                        data=JSON.parse(data);
                        sp=data['price'];
                        $('#newform #description').val(data['description']);
                        $('#newform #order_items').html('$'+data['price']);
                        if(sp>userFunds) {
                            $('#newform #not-enough-funds').show();
                            $('#newform #btn-proceed').attr('disabled',true);
                        }
                        if(data['custom_field']){
                            $('#newform #requirements-div').show();
                            if(data['custom_field_name']) {
                                fields=data['custom_field_name'].split(',');
                                for(var i=0; i<fields.length; i++) {
                                    $('#newform #requirements-div').append('<div class="form-group"><label>'+fields[i]+'</label><textarea name="'+convertToSlug(fields[i])+'" class="form-control" required></textarea></div>')
                                }
                            }
                        }
                        if(data['dripfeed']){
                            $('#newform #dripfeeddiv').show();
                        }
                    }, error: function (error) {
                        console.log(error);
                    }
                });
            }
        }
        $(function () {
            category();
            $('#category').change(function(){
                category();
            });
            $('#service').change(function(){
                service();
            });
            $('#package').change(function () {
                package();
            });
            $('#newform #dripfeeddiv #dripfeedselect').on('change',function(){
                if($(this).is(':checked')){
                    $('#newform #runsdiv').show();
                    $('#newform #intervaldiv').show();
                } else {
                    $('#newform #runsdiv').hide();
                    $('#newform #intervaldiv').hide();
                }
            })
        });
        function selectextra(el,id,esp) {
            if ($(el).is(':checked')) {
                sp=parseFloat(sp)+parseFloat($(el).attr('data-price'));
            } else {
                sp=parseFloat(sp)-parseFloat($(el).attr('data-price'));
                $('#newform > fieldset > div.extras > div.extra > table > thead > tr >th:nth-child(2) > input').prop('checked',false);
            }
            sp=parseFloat(sp).toFixed(2);
            if(sp>userFunds) {
                $('#newform #not-enough-funds').show();
                $('#newform #btn-proceed').attr('disabled',true);
            }
            else {
                $('#newform #not-enough-funds').hide();
                $('#newform #btn-proceed').attr('disabled',false);
            }
            if($('#newform #runsdiv #runs').val()!='') {
                $('#newform #order_items').html('$'+parseFloat(sp*$('#newform #runsdiv #runs').val()).toFixed(2));
            } else {
                $('#newform #order_items').html('$'+sp);
            }
        }
        $('#newform #runsdiv #runs').on('change keyup',function(el,id,esp) {
            if($(this).val()!=''){
                tp=sp;
                $('#newform #order_items').html('$'+parseFloat(tp*$(this).val()).toFixed(2));
            }else {
             $('#newform #order_items').html('$'+sp);   
            }
        });
        function selectAll(sid){
            var check=false;
            if($('#newform > fieldset > div.extras > div.extra > table > thead > tr >th:nth-child(2) > input').is(":checked")) {
                check=true;
            }
            $('#newform > fieldset > div.extras > div.extra > table > tbody > tr').each(function(){
                if(!$(this).find('.selectbox > input').is(":checked") && check) {
                    $(this).find('.selectbox > input').prop('checked',true);
                    sp=parseFloat(sp)+parseFloat($(this).find('td:nth-child(4)').attr('data-price'));
                }
                if(!check) {
                    $(this).find('.selectbox > input').prop('checked',false);
                    sp=parseFloat(sp)-parseFloat($(this).find('td:nth-child(4)').attr('data-price'));
                }
                sp=parseFloat(sp).toFixed(2);
                if(sp>userFunds) {
                    $('#newform #not-enough-funds').show();
                    $('#newform #btn-proceed').attr('disabled',true);
                }
                else {
                    $('#newform #not-enough-funds').hide();
                    $('#newform #btn-proceed').attr('disabled',false);
                }
                $('#newform #order_items').html('$'+sp);
            });
        }
        function auto_grow(element) {
		    element.style.height = "5px";
		    element.style.height = (element.scrollHeight+10)+"px";
		}
		function convertToSlug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-')
                ;
        }
    </script>
@endpush