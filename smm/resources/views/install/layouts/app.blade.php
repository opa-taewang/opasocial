@php
// alignment direction according to language
$dir = "ltr";
$rtlLang = ['ar'];
if(in_array(getOption('language'),$rtlLang)):
$dir="rtl";
endif;
$notifications=DB::table('notifications')->orderBy('created_at','desc')->get();
$unread_notifications=DB::table('notifications')->where('status',0)->count();
@endphp
<!DOCTYPE html>
<html lang="{{ getOption('language') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{--
    <link rel="shortcut icon" href="/img/favicon.ico">--}}
    <link rel="shortcut icon" href="{{ asset(getOption('logo')) }}">
    <link href="/css/vendor/bootstrap/css/bootstrap.min.css?v={{ config('console.version') }}" rel="stylesheet">
    <link href="/css/vendor/datatable/datatables.min.css?v={{ config('console.version') }}" rel="stylesheet">
    @if(in_array(getOption('language'),$rtlLang))
    <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                text-align: right;
            }
        </style>
    @endif
    @if(getOption('panel_theme') == 'material')
 
     <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="/css/flat-ui.min.css?v={{ config('console.version') }}" rel="stylesheet">
    <link href="/css/ympnl.css?v={{ config('console.version') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <style>

     body {
               /* background-color: {{ getOption('background_color') }} !important;*/
                font-family: 'Muli', sans-serif!important;
                background: white!important;
            }


          

 .navbar-default {
                /*background-color: {{ getOption('theme_color') }};*/
                    background: linear-gradient(45deg, #303f9f, #7b1fa2) !important;
            }
            .btn-primary,
            .btn-primary:hover,
            .btn-primary:active,
            .btn-primary:focus {
                background-color: {{ getOption('theme_color') }};
                border-color: #000;
            }
            .btn-xs, .btn-group-xs > .btn {
    padding: 9px;
    font-size: 10px;
    
    .btn-success {
    color: #fff;
    background-color: #2ecc71;


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
                color: white;
                font-size: 14px;
    font-weight: 500;
            }

            .pagination li > a:hover, .pagination li > span:hover {
                background-color: {{ getOption('theme_color') }};
            }

            g
        </style>
    @elseif(getOption('panel_theme') == 'simple')
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
    <link href="/css/ympnl-theme-simple.css?v={{ config('console.version') }}" rel="stylesheet">
    @elseif(getOption('panel_theme') == 'fancy')
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
    <link href="/css/ympnl-theme-fancy.css?v={{ config('console.version') }}" rel="stylesheet">
    @endif
    <link href="/css/my-style.css?v={{ config('console.version') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    window.baseUrl = "<?php echo url('/') ?>";
    var spinner = "<span class='loader'></span>";
    </script>
    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="/js/vendor/jquery.min.js?v={{ config('console.version') }}"></script>
    <script src="/js/vendor/form-validator/jquery.form-validator.min.js?v={{ config('console.version') }}"></script>
    <script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.validate({
            modules: 'date',
            validateOnBlur: false,
            lang: '{{ getOption('
            language ') }}'
        });
    })
    </script>
    <script src="/js/my-script.js?v={{ config('console.version') }}"></script>
    <style>
        td label[name^='api_service_name'], td label[name^='sno'], td label[name], label.control-label{
            position:static;
            font-weight:normal;
            padding:10px;
            font-size:inherit;
        }
        th .input.checkbox-all, th .input-sm.checkbox-all{
            min-width:14px;
            min-height:14px;
        }
        #show-sidebar i{
            background:none !important;
            color:white;
            padding-top:6px;
        }
    </style>
</head>

<body dir="{{ $dir }}">
    <div id="app">
         @php
        if(auth()->check()){
            $tick = app('App\Http\Controllers\Admin\SupportController')->tickCount();
        }
    @endphp
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header">
              <!--   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> -->
                
            </div>
             @if (Auth::user())
                <ul class="nav navbar-nav navbar-right" style="padding-right:20px;">
                                       <li style="float: right;z-index: 1;">
                        @if(Auth::user() && Auth::user()->role == "ADMIN")
            <style>
                a{
  text-decoration: none;
  color: black;
}

a:visited{
  color: black;
}

.box::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
  border-radius: 5px
}

.box::-webkit-scrollbar
{
	width: 10px;
	background-color: #F5F5F5;
  border-radius: 5px
}

.box::-webkit-scrollbar-thumb
{
	background-color: black;
	border: 2px solid black;
  border-radius: 5px
}

.icons{
  display: inline;
  /*float: right*/
}

.notification{
  position: relative;
  display: inline-block;
}

.number{
  height: 22px;
    width: 22px;
    background-color: #d63031;
    border-radius: 20px;
    color: white;
    text-align: center;
    position: absolute;
    top: 5px;
    left: 60px;
    border-style: solid;
    border-width: 2px;
}

.number:empty {
   display: none;
}

.notBtn{
  transition: 0.5s;
  cursor: pointer
}

.fas1{
    font-size: 19pt;
    padding-bottom: 10px;
    color: #ffffff;
    margin-right: 40px;
    margin-left: 40px;
    margin-top: 14px;
}

.box{
  width: 400px;
  height: 0px;
  border-radius: 10px;
  transition: 0.5s;
  position: absolute;
  overflow-y: scroll;
  padding: 0px;
  left: -300px;
  margin-top: 5px;
  background-color: #F4F4F4;
  -webkit-box-shadow: 10px 10px 23px 0px rgba(0,0,0,0.2);
  -moz-box-shadow: 10px 10px 23px 0px rgba(0,0,0,0.1);
  box-shadow: 10px 10px 23px 0px rgba(0,0,0,0.1);
  cursor: context-menu;
}

.fas1:hover {
  color: #d63031;
}

.notBtn:hover > .box{
  height: 60vh
}

.content{
  padding: 20px;
  color: black;
  vertical-align: middle;
  text-align: left;
}

.gry{
  background-color: #F4F4F4;
}

.top{
  color: black;
  padding: 10px
}

.display{
  position: relative;
}

.cont{
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: #F4F4F4;
}

.cont:empty{
  display: none;
}

.stick{
  text-align: center;  
  display: block;
  font-size: 50pt;
  padding-top: 70px;
  padding-left: 80px
}

.stick:hover{
  color: black;
}

.cent{
  text-align: center;
  display: block;
}

.sec{
  padding: 15px 10px;
  background-color: #F4F4F4;
  transition: 0.5s;
}

.profCont{
  padding-left: 15px;
}

.profile{
  -webkit-clip-path: circle(50% at 50% 50%);
  clip-path: circle(50% at 50% 50%);
  width: 75px;
  float: left;
}

.txt{
  vertical-align: top;
  font-size: 2.25rem;
  padding: 5px 10px 0px 5px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 400px;
}
.txt_desc {
  display: block; /* or inline-block */
  text-overflow: ellipsis;
  word-wrap: break-word;
  overflow: hidden;
  max-height: 7.2em;
  line-height: 1.8em;
  vertical-align: top;
  font-size: 1.25rem;
  padding: 5px 10px 0px 5px;
}

.sub{
  font-size: 1rem;
  color: grey;
}

.new{
  border-style: none none solid none;
  border-color: red;
}
.read {
    background-color: #BFBFBF !important;
}
.sec:hover{
  background-color: #BFBFBF;
}
.total {
    top: -1px !important;
    position: absolute;
    right: 6px;
    font-size: 11px;
}


            </style>
            <div class = "icons">
<div class = "notification">
  <a href = "#">
  <div class = "notBtn" href = "#">
    <!--Number supports double digets and automaticly hides itself when there is nothing between divs -->
    <div class = "number"><span class="total">{{ $unread_notifications }}</span></div>
    <i class="fa fa-bell fas1"></i>
      <div class = "box">
        <div class = "display">
          <div class = "nothing"> 
            <i class="fa fa-child stick fas1"></i> 
            <div class = "cent">Looks Like your all caught up!</div>
          </div>
          <div class = "cont"><!-- Fold this div and try deleting evrything inbetween -->
        @foreach($notifications as $notification)
             <div class = "sec new {{($notification->status==1)?'read':''}}">
               <a href = "{{url('admin/notification/'.base64_encode($notification->id))}}">
               <div class = "txt">{{$notification->title}}</div>
               <div class="txt_desc">
                   {{ $notification->description }}
               </div>
              <div class = "txt sub">Date: {{ date('d-F-Y, g:i a', strtotime($notification->created_at)) }}</div>
               </a>
            </div>
        @endforeach
         </div>
        </div>
     </div>
  </div>
    </a>
</div>
</div>
@endif
                    </li>

                    <li class="dropdown text-right" >
                        <a href="#" class="dropdown-toggles" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="/images/male-avatar1.png
" style="height: 22px; width: 22px; border-radius: 50%">&nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/admin/account/settings') }}"><i class="fa fa-user-o"></i>&nbsp;&nbsp;@lang('menus.account')</a></li>
                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>&nbsp;&nbsp;@lang('menus.logout')
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif
            <!-- <div class="collapse navbar-collapse" id="app-navbar-collapse">
               
            </div> -->
        </nav>
        <div class="page-wrapper chiller-theme ">
           <div id="show-sidebar">
                             <i class="fa fa-bars fa-xs"></i>
                        </div>
            </a>
            <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content">
                    <div class="sidebar-brand">
                        <a class="navbar-brand" href="{{ url('/dashboard') }}" style="font-size: 14px;
    padding: 0;">
                            <span> <img src="{{ asset(getOption('logo')) }}" alt="Retina" width="50" height="50">{{getOption('navbar_name')}}</span>
                            
                        </a>
                        <div id="close-sidebar">
                            <i class="fa fa-bars"></i>
                        </div>
                    </div>
                    <div class="sidebar-menu">
                        <ul>
                            <li class="header-menu ">
                                <span>General</span>
                            </li>
                            @if (Auth::check())
                            <li class="active">
                                <a href="{{ url('/admin') }}">
                                    <i class="fa fa-tachometer"></i>
                                    <span>@lang('menus.dashboard')</span>
                                </a>
                            </li>
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-gear"></i>
                                    <span>@lang('menus.settings')</span>
                                </a>
                                <div class="sidebar-submenu">
                                  <ul>
                <li>
                  <a href="{{ url('/admin/system/settings') }}">@lang('menus.system')
                  </a>
                </li>
                                <li>
                                <a href="{{ url('/admin/systeminfo') }}">System Info</a>
                            </li>
                <li>
                                <a href="{{ url('/admin/payment-methods') }}">@lang('menus.payment_methods')</a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/services') }}">@lang('menus.services')</a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/packages') }}">@lang('menus.packages')</a>
                            </li>
                            
              </ul>
            </div>
                            <li>
                                <a href="{{ url('/admin/pages') }}">
                                    <i class="fa fa-pencil"></i>
                                    <span>Edit Pages</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/funds-load-history') }}">
                                    <i class="fa fa-history"></i>
                                    <span>@lang('menus.funds_load_history')</span>
                                </a>
                            </li>
                             <li>
                                <a href="{{ url('/admin/users') }}">
                                    <i class="fa fa-user-o"></i>
                                    <span>@lang('menus.users')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/groups') }}">
                                    <i class="fa fa-object-group"></i>
                                    <span>User's Groups</span>
                                </a>
                            </li>
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Orders</span>
                                </a>
                                <div class="sidebar-submenu">
                                  <ul>
                <li>
                                <a href="{{ url('/admin/orders') }}">Main Orders</a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/autolike') }}">Autolike Orders</a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/dripfeed') }}">DripFeed Orders</a>
                            </li>
                            
              </ul>
            </div>

                            <li>
                                <a href="{{ url('/admin/codes') }}">
                                    <i class="fa fa-youtube-play"></i>
                                    <span>Premium ACC Orders</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/dowloads') }}">
                                    <i class="fa fa-download"></i>
                                    <span>Download Records</span>
                                </a>
                            </li>
                            @if(getOption('module_support_enabled') == 1)
                            <li>
                                <a href="{{ url('/admin/support/tickets') }}">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                    <span>@lang('menus.support')<span class="badge" style="background-color: #42d1f5;color:white;padding-top: 5px;">{{$tick }}</span></span>
                                </a>
                            </li>
                            
                            @endif
                            <li>
                                <a href="{{ url('/admin/ips') }}">
                                    <i class="fa fa-ban"></i>
                                    <span>Blocked IPs</span>
                                </a>
                            </li>
                                                        
                             <li>
                                <a href="{{ url('/admin/synced') }}">
                                    <i class="fa fa-ravelry"></i>
                                    <span>Seller Sync</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/commission') }}">
                                    <i class="fa fa-chain-broken"></i>
                                    <span>Affliates</span>
                                </a>
                            </li>
                          
                            <li>
                                <a href="{{ url('/admin/affiliate_transactions') }}">
                                    <i class="fa fa-exchange"></i>
                                    <span>Affliate Transactions</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/broadcast') }}">
                                    <i class="fa fa-bullhorn"></i>
                                    <span>Broadcasts</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/refills/list') }}">
                                    <i class="fa fa-refresh"></i>
                                    <span>Refill Requests</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/apifetch') }}">
                                    <i class="fa fa-paper-plane-o"></i>
                                    <span> API Fetch</span>
                                </a>
                            </li>
                               @if(getOption('module_api_enabled') == 1)
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-magic"></i>
                                    <span>@lang('menus.automate')</span>
                                </a>
                                <div class="sidebar-submenu">
                                  <ul>
                                                                  <li>
                                <a href="{{ url('/admin/cashes') }}">Balance checker</a>
                            </li>
             <li>
                                <a href="{{ url('/admin/automate/api-list') }}">@lang('menus.api_list')</a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/automate/send-orders') }}">@lang('menus.send_orders')</a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/automate/get-status') }}">@lang('menus.get_order_status')</a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/automate/response-logs') }}">@lang('menus.response_logs')</a>
                            </li>
              </ul>
            </div>
                            </li>
                            
                            @if(getOption('module_subscription_enabled') == 1)
                            <li>
                                <a href="{{ url('/admin/subscriptions') }}">
                                    <i class="fa fa-envelope-o"></i>
                                    <span>@lang('menus.subscriptions')</span>
                                </a>
                            </li>
                            @endif
                            
                            
                           
                            
                            @endif

                            @if (Auth::check())
                            
                            @endif
                            
                            @endif
                        </ul>
                    </div>
                    <!-- sidebar-menu  -->
                </div>
                <!-- sidebar-content  -->
            </nav>
            <!-- sidebar-wrapper  -->
            <div class="clearfix" style="height: 70px;"></div>
            <main class="page-content" style="margin-bottom: 50px;">
                <!--  <div class="{{ getOption('user_layout') }}"> -->
                <div class="container-fluid">
                    @if(Session::has('alert'))
                    <div class="row">
                        <div class="col-md-4 col-md-offset-8">
                            <div style="font-size: 15px; margin-top: -15px;" class="alert alert-{{ Session::get('alertClass') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                {{ Session::get('alert') }}
                            </div>
                        </div>
                    </div>
                    @endif
                    @yield('content')
                </div>
            </main>
            <footer id="footer" class="footer">
                <ul id="footer-menu">
                 
                    <li><span style="color: white; font-size: 12px;">{{ config('console.version') }}</span></li>
                </ul>
            </footer>
        </div>
    </div>
         <!-- Scripts -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/js/vendor/datatable/datatables.min.js?v={{ config('console.version') }}"></script>
        <script src="/js/vendor/bootbox/bootbox.min.js?v={{ config('console.version') }}"></script>
        <script src="/js/flat-ui.min.js?v={{ config('console.version') }}"></script>
        <script src="/js/application.js?v={{ config('console.version') }}"></script>
        <script src="/js/custom.js?v={{ config('console.version') }}"></script>
        <script>
    $(function () {

        if (!$(".alert").hasClass('no-auto-close')) {
            $(".alert").delay(3000).slideUp(300);
        }

    });
    jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});


   
   
});
</script>
        <script>
        $(function() {

            if (!$(".alert").hasClass('no-auto-close')) {
                $(".alert").delay(3000).slideUp(300);
            }

        });
        </script>
        @stack('scripts')
</body>

</html>