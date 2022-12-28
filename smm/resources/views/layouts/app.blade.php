@php
// alignment direction according to language
$dir = "ltr";
$rtlLang = ['ar'];
if(in_array(getOption('language'),$rtlLang)):
$dir="rtl";
endif;
@endphp
<!DOCTYPE html>
<html lang="{{ getOption('language') }}">
<head><meta charset="windows-1252">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<link rel="shortcut icon" href="/images/OPA-MINI.png">
@if(Auth::user()['role']=="ADMIN")
<link href="/css/vendor/bootstrap/css/bootstrap.min.css?v={{ config('console.domain') }}" rel="stylesheet">
<link href="/css/vendor/datatable/datatables.min.css?v={{ config('console.domain') }}" rel="stylesheet">
@if(getOption('panel_theme') == 'material')
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="/css/flat-ui.min.css?v={{ config('console.domain') }}" rel="stylesheet">
<link href="/css/ympnl.css?v={{ config('console.domain') }}" rel="stylesheet">
<style>
body {
background-color: {{ getOption('background_color') }} !important;
}
.navbar-default {
background-color: {{ getOption('theme_color') }};
}
.btn-primary,
.btn-primary:hover,
.btn-primary:active,
.btn-primary:focus {
background-color: {{ getOption('theme_color') }};
border-color: #000;
}
.login-form .login-field:focus {
border-color: {{ getOption('theme_color') }};
}
a,
a:active,
a:focus,
a:hover {
color: {{ getOption('theme_color') }};
}
.login-link:hover {
color: {{ getOption('theme_color') }};
}
input[type=text]:focus,
.form-control:focus {
border-color: {{ getOption('theme_color') }};
}
.pagination li.active > a, .pagination li.active > span, .pagination li.active > a:hover, .pagination li.active > span:hover, .pagination li.active > a:focus, .pagination li.active > span:focus {
background-color: {{ getOption('theme_color') }};
}
#footer-menu li a {
color: {{ getOption('theme_color') }};
font-size: 14px;
}
.pagination li > a:hover, .pagination li > span:hover {
background-color: {{ getOption('theme_color') }};
}
.dropdown-lang li a{
padding-top: 3px;
padding-bottom: 3px;
}
.theme-bg{
background-color: {{ getOption('theme_color') }} !important;
}
</style>
@elseif(getOption('panel_theme') == 'simple')
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
<link href="/css/ympnl-theme-simple.css?v={{ config('console.domain') }}" rel="stylesheet">
<style>
.theme-bg{
background-color: #b9b6b6 !important;
}
</style>
@elseif(getOption('panel_theme') == 'fancy')
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
<link href="/css/ympnl-theme-fancy.css?v={{ config('console.domain') }}" rel="stylesheet">
@endif
<link href="/css/my-style.css?v={{ config('console.domain') }}" rel="stylesheet">
@elseif(Auth::user()['role']=="USER")
<link href="/custom_main/19/css/bootstrap.css?v={{ config('console.domain') }}" rel="stylesheet">
<link href="/css/vendor/datatable/datatables.min.css?v={{ config('console.domain') }}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Material+Icons" rel="stylesheet">
<link href="/custom_main/19/css/style.css?v={{ config('console.domain') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/custom_main/19/css/font.css">
@else
<link rel="stylesheet" type="text/css" href="/custom_main/19/css/font.css">
<link href="/custom_main/19/css/bootstrap.css?v={{ config('console.domain') }}" rel="stylesheet">
<link href="/css/vendor/datatable/datatables.min.css?v={{ config('console.domain') }}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="/custom_main/19/css/font-awesome.min.css" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="/custom_main/19/css/bootstrap.css?v={{ config('console.domain') }}">
<!--Style CSS -->
<link rel="stylesheet" href="/custom_main/19/css/style.css?v={{ config('console.domain') }}">
@endif
@if(in_array(getOption('language'),$rtlLang))
<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
text-align: right;
}
</style>
@endif
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8H08NEV0CN"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-8H08NEV0CN');
</script>
<style>
.rwd-table th {
background-color: #25aae1;
}
.mobile {
display: none;
}
@media (max-width: 320px) {
.mobile {
display: block;
/* Add other properties here */
}
}
.login-bg-image {
height: 100vh;
background: url(/images/geometry.png) repeat;
/* filter: blur(6px); */
/* -webkit-filter: blur(6px); */
}
</style>
<!-- Scripts -->
<script>
window.Laravel = <?php echo json_encode([
'csrfToken' => csrf_token(),
]); ?>;
window.baseUrl = "<?php echo url('/') ?>";
var spinner = "<span class='loader'></span>";
</script>
<!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
<script src="/js/vendor/jquery.min.js?v={{ config('console.domain') }}"></script>
<script src="/js/vendor/form-validator/jquery.form-validator.min.js?v={{ config('console.domain') }}"></script>
<script type="text/javascript">
$(function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.validate({
modules: 'date',
validateOnBlur: false,
lang: '{{ getOption('language') }}'
});
$(document).on('click','.dropdown-lang a',function (e) {
e.preventDefault();
 var locale = $(this).data('locale');
$('#locale').val(locale);
document.getElementById('lang-form').submit();
});
$(document).on('click','.dropdown-currency a',function (e) {
e.preventDefault();
var locale = $(this).data('locale');
$('#locale').val(locale);
document.getElementById('currency-form').submit();
});
});
</script>
</head>
@if(auth()->check())
@if(Auth::user()['role']=="USER")
<body dir="{{ $dir }}" onload="getBCs()" class="user-dashboard">
@else
<body dir="{{ $dir }}" onload="getBCs()" class="guest">
@endif
@else
@if(Auth::user()['role']=="USER")
<body dir="{{ $dir }}" class="user-dashboard">
@else
<body dir="{{ $dir }}" class="guest">
@endif
@endif
@if(auth()->check())
<script>
function getBCs()
{
funBroadcast(getCookie("MsgID"));
}
function funBroadcast(val)
{
//Perform Ajax request.
$.ajax({
url: "{!!url("broadcast/")!!}" + "/" + val,
type: 'get',
success: function(data){
if(data['recordsFiltered']==1){
val = data['data'][0]['id'];
$('body').append('<div id="dumtext" style="display:none;">'+data['data'][0]['MsgText']+'</div>');
$('#dumtext').html($.parseHTML($('#dumtext').text()));
data['data'][0]['MsgText']=$('#dumtext').html();
swal({
title:"<span style='font-size:25px'>" + data['data'][0]['MsgTitle'] + "</span>",
html:"<p style='font-size:20px;margin-top:10px'>" + $('#dumtext').html() + "</p>",
type:data['data'][0]['Icon'],
allowOutsideClick: false,
confirmButtonText:'<span style="font-size:25px"><i class="fa fa-thumbs-up"></i> Ok! </span>',
width: '650px'
}).then((result) => {
$('#dumtext').remove();
if(val != 0){
setCookie('MsgID',val,30);
funBroadcast(val);
}else{
funBroadcast(getCookie("MsgID"));
}
});
if(val == 0){
$(".swal2-modal").css('background-color', '#fff');
}
else{
$(".swal2-modal").css('background-color', '#fff');
}
}
},
error: function (xhr, ajaxOptions, thrownError) {
var errorMsg = 'Ajax request failed: ' + xhr.responseText;
{{-- swal(errorMsg); --}}
}
});
}
function setCookie(cname,cvalue,exdays) {
var d = new Date();
d.setTime(d.getTime() + (exdays*24*60*60*1000));
var expires = "expires=" + d.toGMTString();
document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(name) {
function escape(s) { return s.replace(/([.*+?\^${}()|\[\]\/\\])/g, '\\$1'); };
var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
return match ? match[1] : 0;
}
</script>
@endif
@php
$tick = 0;
if(auth()->check()){
$tick = app('App\Http\Controllers\SupportController')->tickCount();
}
@endphp
<!--MODAL WINDOW-->
@if(Auth::user())
<button class="hide" id="package_modal_btn" data-toggle="modal" data-target="#packageModal">{{Auth::user()->group->name}}</button>
@if(Auth::user())
@php
$group=Auth::user()->group;
@endphp
<div class="modal fade" id="packageModal" tabindex="-1" role="dialog" aria-labelledby="packageModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title"><i class="fas fa-user-circle"></i> Account Status: {{$group->name}}</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="table-responsive">
<table class="table table-sm">
<thead class="thead-dark">
<tr>
<th></th>
<th><center>NEW</center></th>
<th><center>JUNIOR VIP</center></th>
<th><center>VIP</center></th>
<th><center>PREMIUM</center></th>
<th><center>ELITE</center></th>
<th><center>MASTER</center></th>
</tr>
</thead>
<tbody>
<tr>
<th>Ticket support (24x7)</th>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
</tr>
<tr>
<th>Skype/Email Support</th>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
 </tr>
<tr>
<th>Free SMM Panel</th>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
</tr>
<tr>
<th>Priority Ticket Support</th>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
</tr>
<tr>
<th>Custom services</th>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
</tr>
<tr>
<th>5% Discount</th>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
</tr>
<tr>
<th>WhatsApp/Call support</th>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
</tr>
<tr>
<th>Orders/Support Handled By Admins</th>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-times"></i></center></td>
<td><center><i class="fas fa-check-double" style="color:#4510c2"></i></center></td>
</tr>
</tbody>
</table>
</div>
<br>
<div class="text-left">
NEW : Start Placing Orders<br>
JUNIOR VIP : Total spent worth : $100<br>
VIP : Total spent worth : $1000<br>
PREMIUM : Total spent worth : $2500<br>
ELITE : Total spent worth : $10000<br>
MASTER : Total spent worth : $15000
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
@endif
@endif
<!--MODAL WINDOW-->
@if(Auth::user()['role']=="USER")
<div id="main-wrap" class="launched">
<div id="sidebar-container">
<div class="navText">
<div class="hideDesktop balance">
@php
$data=convertCurrency(Auth::user()->funds);
@endphp
<span class="badge badge-primary">{{ $data['symbol'] . number_format($data['price'],2, getOption('currency_separator'), '') }}</span>
</div>
<div class="list-group panel sidebar-nav">
<a href="{{ url('/dashboard') }}" class="{{ (request()->is('dashboard*')) ? 'active' : '' }} list-group-item" data-parent="#MainMenu"><i class="material-icons">dashboard</i> @lang('menus.dashboard')</a>
<a href="{{ url('/order/new') }}" class="@if(request()->is('order/new*')) active @elseif(request()->is('order/mass-order*')) active @elseif(request()->is('order/my-favorites*')) active @elseif(request()->is('order/digitalnew*')) active @elseif(request()->is('/seo-orders*')) active @else @endif list-group-item" data-parent="#MainMenu"><i class="material-icons">add_shopping_cart</i> New Order</a>
<!--<a href="#demo1" class="@if(request()->is('order/new*')) active @elseif(request()->is('order/mass-order*')) active @elseif(request()->is('order/premiumnew*')) active @elseif(request()->is('order/digitalnew*')) active @elseif(request()->is('/seo-orders*')) active @else @endif list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="material-icons">history</i> New Order <i class="fa fa-caret-down"></i></a>
<div class="collapse" id="demo1">
<a href="{{ url('/order/new') }}" class="sub-item list-group-item">New Order</a>
<a href="{{ url('/seo-orders') }}" class="sub-item list-group-item">New SEO Order</a>
<!-- <a href="{{ url('/order/premiumnew') }}" class="sub-item list-group-item">New Premium Order</a>
<a href="{{ url('/order/digitalnew') }}" class="sub-item list-group-item">New Digital Order</a>
</div> -->
<a href="#demo2" class="@if(request()->is('orders')) active @elseif(request()->is('autolike')) active @elseif(request()->is('dripfeed')) active @elseif(request()->is('orders-filter*')) active @else @endif list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="material-icons">history</i> @lang('menus.orders') <i class="fa fa-caret-down"></i></a>
<div class="collapse" id="demo2">
<a href="{{ url('/orders') }}" class="sub-item list-group-item">@lang('menus.order_history')</a>
<!--<a href="{{ url('/autolike') }}" class="sub-item list-group-item">@lang('new.alvh')</a> -->
<a href="{{ url('/dripfeed') }}" class="sub-item list-group-item">@lang('new.dfh')</a>
</div>
<a href="{{ url('/services') }}" class="@if(request()->is('services')) active @elseif(request()->is('seo-services')) active @elseif(request()->is('changelog')) active @else @endif list-group-item" data-parent="#MainMenu"><i class="material-icons">storage</i> Service List</a>
<!-- <a href="#demo3" class="@if(request()->is('services')) active @elseif(request()->is('seo-services')) active @elseif(request()->is('changelog')) active @else @endif list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="material-icons">storage</i> Service List <i class="fa fa-caret-down"></i></a>
<div class="collapse" id="demo3">
<!-- <a href="{{ url('/services') }}" class="sub-item list-group-item">@lang('menus.service_list')</a>
<a href="{{ url('/seo-services') }}" class="sub-item list-group-item">SEO @lang('menus.service_list')</a>
<!--
<a href="{{ url('/servicetracker') }}" class="sub-item list-group-item">Service Tracker</a>
<a href="{{ url('/changelogs') }}" class="sub-item list-group-item">Change Logs</a>
</div> -->
<a href="#demo6" class="@if(request()->is('child-panels')) active @elseif(request()->is('affiliates')) active @elseif(request()->is('makemoney')) active @else @endif list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="material-icons">device_hub</i> Resellers <i class="fa fa-caret-down"></i></a>
<div class="collapse" id="demo6">
<a href="{{ url('/makemoney') }}" class="sub-item list-group-item">Make Money</a>
<a href="{{ url('/affiliates') }}" class="sub-item list-group-item">Affiliates</a>
<a href="{{ url('/child-panels') }}" class="sub-item list-group-item">Buy Panel</a>
<!--
<a href="{{ url('/servicetracker') }}" class="sub-item list-group-item">Service Tracker</a>
<a href="{{ url('/changelogs') }}" class="sub-item list-group-item">Change Logs</a> -->
</div>
@if(getOption('module_api_enabled') == 1)
<a href="{{ url('/api') }}" class="{{ (request()->is('api*')) ? 'active' : '' }} list-group-item" data-parent="#MainMenu"><i class="material-icons">layers</i> @lang('menus.api')</a>
@endif
<a href="{{ url('/payment/add-funds') }}" class="{{ (request()->is('payment/add-funds*')) ? 'active' : '' }} list-group-item" data-parent="#MainMenu"><i class="material-icons">attach_money</i> @lang('menus.add_funds')</a>
@if(session('imitator') != "")
<a href="{{ url('/backof') }}" class="{{ (request()->is('backof*')) ? 'active' : '' }} list-group-item" data-parent="#MainMenu"><i class="material-icons">sync</i> @lang('new.switch')</a>
@endif
<a href="{{ url('/support') }}" class="@if(request()->is('support')) active @else @endif list-group-item" data-parent="#MainMenu"><i class="material-icons">contact_support</i> Support<span class="badge" style="background-color: #42d1f5;color:white;padding-top: 5px;">{{$tick }}</span></a>
@if(Auth::user()->adminmessages()->count() > 0)
<a href="{{ url('/messages') }}" class="@if(request()->is('messages')) active @else @endif list-group-item" data-parent="#MainMenu"><i class="material-icons">contact_support</i>@lang('new.messages')</a>
@endif
<a href="#demo4" class="@if(request()->is('faqs')) active @elseif(request()->is('kb*')) active @else @endif list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="material-icons">brightness_low</i>Knowledge Base<i class="fa fa-caret-down"></i></a>
<div class="collapse" id="demo4">
<a href="{{ url('/faqs') }}" class="sub-item list-group-item">@lang('menus.faqs')</a>
<a href="{{ url('/kb') }}" class="sub-item list-group-item">Knowledge Base </a>
</div>

</div>
<div class="list-group panel sidebar-nav hideDesktop">
@php
$title=(Session::get('title'));
@endphp
@if(count($title)>0)
@foreach($title as $titlee)
<a href="#demo5" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="material-icons">money</i> {{ $titlee->name}} <i class="fa fa-caret-down"></i></a>
@endforeach
@else
<a href="#demo5" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="material-icons">money</i> USD <i class="fa fa-caret-down"></i></a>
@endif
<div class="collapse dropdown-currency" id="demo5">
<li style="display: none;">
<form id="currency-form" action="{{ url('/change-currency') }}" method="POST" style="display: none;">
{{ csrf_field() }}
<input type="hidden" value="1" name="locale" id="locale">
</form>
</li>
@php
$title=Session::get('title');
@endphp
@foreach(Session::get('currency') as $currency)
@foreach($title as $hide)
@if($currency['id']==$hide->id)
<a href="#" class="sub-item list-group-item" data-locale="{{$currency['id']}}">{{$currency['name']}}</a>
@else
<a href="#" class="sub-item list-group-item" data-locale="{{$currency['id']}}">{{$currency['name']}}</a>
@endif
@endforeach
@endforeach
</div>
</div>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
<a href="{{ url('/') }}" class="navbar-brand"><img src="{{ asset(getOption('logo')) }}" alt="{{ getOption('app_name') }} Logo" ></a>
</div>
<div id="scrollNav">
<ul class="nav navbar-nav navbar-left-block">
<li class="sidebar-pinner">
<button id="toi" class="btn btn-secondary">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</li>
</ul>
<ul class="nav navbar-nav navbar-right navbar-right-block">
<li class="hideMobile">
@php
$data=convertCurrency(Auth::user()->funds);
@endphp
<span class="badge badge-primary">{{ $data['symbol'] . number_format($data['price'],2, getOption('currency_separator'), '') }}</span>
</li>
<li class="dropdown hideMobile">
@php
$title=(Session::get('title'));
@endphp
@if(count($title)>0)
@foreach($title as $titlee)
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $titlee->name}}<span class="caret"></span></a>
@endforeach
@else
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">USD<span class="caret"></span>
</a>
@endif
<ul class="dropdown-menu dropdown-currency" role="menu">
<li>
<form id="currency-form" action="{{ url('/change-currency') }}" method="POST" style="display: none;">
{{ csrf_field() }}
<input type="hidden" value="1" name="locale" id="locale">
</form>
</li>
@php
$title=Session::get('title');
@endphp
@foreach(Session::get('currency') as $currency)
@foreach($title as $hide)
@if($currency['id']==$hide->id)
<li style="display:none;"><a href="#" data-locale="{{$currency['id']}}">{{$currency['name']}}</a></li>
@else
<li><a href="#" data-locale="{{$currency['id']}}">{{$currency['name']}}</a></li>
@endif
@endforeach
@endforeach
</ul>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="nav-text">{{ Auth::user()->name }}</span><span class="icon-box blue-back"><i class="material-icons">account_circle</i></span><span class="caret"></span></a>
<ul class="dropdown-menu">
<li><a href="{{ url('/account/funds-load-history') }}">@lang('menus.funds_load_history')</a></li>
<li class="active" ><a href="{{ url('/account/settings') }}">@lang('menus.settings')</a></li>
<li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
</ul>
</li>
</ul>
</div>
</div>
</nav>
<div id="main-content" >
<div class="container-fluid">
<div class="row">
<div class="col-sm-7">
<h2 class="page-title">{{ (request()->is('dashboard*')) ? 'Dashboard' : '' }}
{{ (request()->is('order/new*')) ? 'New Order' : '' }}
{{ (request()->is('seo-orders*')) ? 'SEO Order' : '' }}
{{ (request()->is('order/mass-order*')) ? 'Mass Order' : '' }}
{{ (request()->is('order/premiumnew*')) ? 'New Premium Order' : '' }}
{{ (request()->is('order/digitalnew*')) ? 'New Digital Order' : '' }}
{{ (request()->is('orders*')) ? 'Orders' : '' }}
{{ (request()->is('autolike*')) ? 'Auto Like' : '' }}
{{ (request()->is('dripfeed*')) ? 'Drip Feed' : '' }}
{{ (request()->is('orders-filter*')) ? 'Orders' : '' }}
{{ (request()->is('services')) ? 'Services' : '' }}
{{ (request()->is('seo-services')) ? 'Seo Services' : '' }}
{{ (request()->is('servicetracker')) ? 'Service Tracker' : '' }}
{{ (request()->is('changelog')) ? 'Change Logs' : '' }}
{{ (request()->is('child-panels*')) ? 'Buy Panel' : '' }}
{{ (request()->is('api*')) ? 'API' : '' }}
{{ (request()->is('payment/add-funds*')) ? 'Add Funds' : '' }}
{{ (request()->is('affiliates')) ? 'Affiliates' : '' }}
{{ (request()->is('faqs*')) ? 'FAQ' : '' }}
{{ (request()->is('messages*')) ? 'Tickets' : '' }}
{{ (request()->is('support*')) ? 'Tickets' : '' }}
{{ (request()->is('account/settings*')) ? 'Account' : '' }}
{{ (request()->is('account/funds-load-history*')) ? 'Funds History' : '' }}
{{ (request()->is('makemoney*')) ? 'Make Money' : '' }}
{{ (request()->is('order/my-favorites*')) ? 'My Favorite' : '' }}
{{ (request()->is('order/topservices*')) ? 'Top Services' : '' }}
{{ (request()->is('kb*')) ? 'Knowledge Base' : '' }}
{{ (request()->is('points-history*')) ? 'OpaSocial Points History' : '' }}
{{ (request()->is('enter-otp*')) ? 'Enter OTP' : '' }}
{{ (request()->is('change-email*')) ? 'Change Email' : '' }}
</h2>
<ul class="breadcrumbs">
<li><a href="/"><span class="ico"><i class="fas fa-home"></i></span> Home</a></li>
<li class="currentPage"><a>{{ (request()->is('dashboard*')) ? 'Dashboard' : '' }}
{{ (request()->is('order/new*')) ? 'New Order' : '' }}
{{ (request()->is('seo-orders*')) ? 'SEO Order' : '' }}
{{ (request()->is('order/mass-order*')) ? 'Mass Order' : '' }}
{{ (request()->is('order/premiumnew*')) ? 'New Premium Order' : '' }}
{{ (request()->is('order/digitalnew*')) ? 'New Digital Order' : '' }}
{{ (request()->is('orders*')) ? 'Orders' : '' }}
{{ (request()->is('autolike*')) ? 'Auto Like' : '' }}
{{ (request()->is('dripfeed*')) ? 'Drip Feed' : '' }}
{{ (request()->is('orders-filter*')) ? 'Orders' : '' }}
{{ (request()->is('services')) ? 'Services' : '' }}
{{ (request()->is('seo-services')) ? 'Seo Services' : '' }}
{{ (request()->is('servicetracker')) ? 'Service Tracker' : '' }}
{{ (request()->is('changelogs')) ? 'Change Logs' : '' }}
{{ (request()->is('child-panels*')) ? 'Buy Panel' : '' }}
{{ (request()->is('api*')) ? 'API' : '' }}
 {{ (request()->is('payment/add-funds*')) ? 'Add Funds' : '' }}
{{ (request()->is('affiliates')) ? 'Affiliates' : '' }}
{{ (request()->is('faqs*')) ? 'FAQ' : '' }}
{{ (request()->is('messages*')) ? 'Tickets' : '' }}
{{ (request()->is('support*')) ? 'Tickets' : '' }}
{{ (request()->is('account/settings*')) ? 'Account' : '' }}
{{ (request()->is('account/funds-load-history*')) ? 'Funds History' : '' }}
{{ (request()->is('order/my-favorites*')) ? 'My Favorite' : '' }}
{{ (request()->is('order/topservices*')) ? 'Top Services' : '' }}
{{ (request()->is('kb*')) ? 'Knowledge Base' : '' }}
{{ (request()->is('makemoney*')) ? 'Make Money' : '' }} {{ (request()->is('points-history*')) ? 'OpaSocial Points History' : '' }}
{{ (request()->is('change-email*')) ? 'Change Email' : '' }}{{ (request()->is('enter-otp*')) ? 'Enter OTP' : '' }}</a></li>
</ul>
</div>
<div class="col-sm-5">
@if(request()->is('services'))
<form role="form" method="POST" action="{{ url('/services/search') }}">
{{ csrf_field() }}
<div class="search-group">
<input name="search_value" type="text" value="{{old('search_value')}}" class="form-control searchTerm" placeholder="Services Search">
<button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
</div>
</form>
@elseif(request()->is('servicetracker'))
<form role="form" method="POST" action="{{ url('/servicetracker/search') }}">
{{ csrf_field() }}
<div class="search-group">
<input name="search_value" type="text" value="{{old('search_value')}}" class="form-control searchTerm" placeholder="Services Tracker Search">
<button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
</div>
</form>
@elseif(request()->is('orders') or request()->is('autolike') or request()->is('dripfeed') or request()->is('child-panels') or request()->is('account/funds-load-history') or request()->is('seo-orders/all'))
<div class="search-group">
<input id="dataSearchBox" type="text" name="search" class="form-control searchTerm" value="" placeholder="Search orders">
<button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
</div>
@endif
</div>
</div>
@if(request()->is('order/new*'))
@else
@if(Session::has('alert'))
<div class="row">
<div class="col-md-12">
<div style="margin-top: -15px;" class="alert alert-{{ Session::get('alertClass') }}">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('alert') }}
</div>
</div>
</div>
@endif
@endif
@yield('content')

</div>
</div>
</div>
@elseif(Auth::guest())
<div id="app">
<!-- header======================-->
<nav id="guest-nav" class="navbar navbar-default navbar-static-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
 <span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="/">
<img src="{{ asset(getOption('logo')) }}" alt="seobin">
</a>
</div>
<div id="navbar" class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<li><a href="/howitwork">How It Works</a></li>
<li><a href="/page/terms-and-conditions">Terms</a></li>
<li class="signin"><a href="/login">Sign In</a></li>
<li class="signup"><a href="/signup">Sign Up</a></li>
</ul>
</div>
</div>
</nav>
<!-- End of Header area=-->
<div class="not-authenticate">
@if((request()->is('kb*')))
@elseif((request()->is('howitwork')))
@else
<div class="container">
@endif
@yield('content')
@if((request()->is('kb*')))
@elseif((request()->is('howitwork')))
@else
</div>
@endif
</div>
<footer>
<div class="footer-top">
<div class="container">
<div class="row">
<div class="col-sm-4">
<img class="footer-logo" src="{{ asset(getOption('logo')) }}" alt="footer-logo"style="width:200px;height:50px;">
<p>OpaSocial.com was launched in 2016,<br> it is the fastest growing Website <br>in the SMM World!</p>
<ul class="social-links">
<li><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
<li><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
</ul>
</div>
<div class="col-sm-2">
<h4 class="widget-title">Quick Links</h4>
<ul class="footer-nav">
<li><a href="/">Home</a></li>
<li><a href="/faqs">FAQ</a></li>
<li><a href="/api">API</a></li>
<li><a href="/login">Sign In</a></li>
<li><a href="/signup">Sign Up</a></li>
</ul>
</div>
<div class="col-sm-3">
<h4 class="widget-title">Services</h4>
<ul class="footer-nav">
<li><a href="javascript:void(0);">Facebook</a></li>
<li><a href="javascript:void(0);">YouTube</a></li>
<li><a href="javascript:void(0);">Instagram</a></li>
 <li><a href="javascript:void(0);">Twitter</a></li>
<li><a href="javascript:void(0);">Soundcloud</a></li>
<li><a href="javascript:void(0);">Linkedin</a></li>
</ul>
</div>
<div class="col-sm-3">
<h4 class="widget-title">Subscribe</h4>
<input class="form-control" type="text">
<button type="submit" class="btn btn-alternate">Subscribe</button>
</div>
</div>
</div>
</div>
<div class="footer-bottom">
<div class="container">
<div class="row">
<div class="col-sm-6"><p>© OpaSocial 2022. All Rights Reserved. Website Made With ❤ by <a href="https://dcreato.com/" target="_blank" style="color: white;">DCreato</a></p></div>
<div class="col-sm-6">
<ul class="footer-links">
<li><a href="/page/terms-and-conditions">Terms of Service</a></li>
</ul>
</div>
</div>
</div>
</div>
</footer>
</div>
@endif
<!-- Scripts -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript">
//eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(3(){(3 a(){8{(3 b(2){7((\'\'+(2/2)).6!==1||2%5===0){(3(){}).9(\'4\')()}c{4}b(++2)})(0)}d(e){g(a,f)}})()})();',17,17,'||i|function|debugger|20|length|if|try|constructor|||else|catch||5000|setTimeout'.split('|'),0,{}))
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61550715d326717cb683fc10/1fgq27b99';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- Global site tag (gtag.js) - Google Ads: 751736721 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-751736721"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-751736721');
</script>

<script src="/js/vendor/datatable/datatables.min.js?v={{ config('console.domain') }}"></script>
<script src="/js/flat-ui.min.js?v={{ config('console.domain') }}"></script>
<script src="/js/application.js?v={{ config('console.domain') }}"></script>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script>
$(function () {
// if (!$(".alert").hasClass('no-auto-close')) {
// $(".alert").delay(3000).slideUp(300);
// }
});
// function showPackageModal(){
// $('#app #package_modal_btn').trigger('click');
// }
</script>
@stack('scripts')
<script src="/js/my-script.js?v={{ config('console.domain') }}"></script>
</body>
</html>