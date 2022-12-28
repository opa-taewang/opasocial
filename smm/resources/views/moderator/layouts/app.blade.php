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
    <link href="/css/vendor/bootstrap/css/bootstrap.min.css?v={{ config('constants.VERSION') }}" rel="stylesheet">
    <link href="/css/vendor/datatable/datatables.min.css?v={{ config('constants.VERSION') }}" rel="stylesheet">
    @if(in_array(getOption('language'),$rtlLang))
    <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                text-align: right;
            }
        </style>
    @endif
    @if(getOption('panel_theme') == 'material')
 
     <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="/css/flat-ui.min.css?v={{ config('constants.VERSION') }}" rel="stylesheet">
    <link href="/css/ympnl.css?v={{ config('constants.VERSION') }}" rel="stylesheet">
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
    <link href="/css/ympnl-theme-simple.css?v={{ config('constants.VERSION') }}" rel="stylesheet">
    @elseif(getOption('panel_theme') == 'fancy')
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
    <link href="/css/ympnl-theme-fancy.css?v={{ config('constants.VERSION') }}" rel="stylesheet">
    @endif
    <link href="/css/my-style.css?v={{ config('constants.VERSION') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    window.baseUrl = "<?php echo url('/') ?>";
    var spinner = "<span class='loader'></span>";
    </script>
    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="/js/vendor/jquery.min.js?v={{ config('constants.VERSION') }}"></script>
    <script src="/js/vendor/form-validator/jquery.form-validator.min.js?v={{ config('constants.VERSION') }}"></script>
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
    <script src="/js/my-script.js?v={{ config('constants.VERSION') }}"></script>
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
            $tick = app('App\Http\Controllers\Moderator\SupportController')->tickCount();
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
                    <li class="dropdown text-right" >
                        <a href="#" class="dropdown-toggles" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="/images/male-avatar1.png
" style="height: 22px; width: 22px; border-radius: 50%">&nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/moderator/account/settings') }}"><i class="fa fa-user-o"></i>&nbsp;&nbsp;@lang('menus.account')</a></li>
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
                        <a class="navbar-brand" href="{{ url('/moderator/orders') }}" style="font-size: 14px;
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
                            
                            <li class="sidebar-dropdown">
                                
                                <div class="sidebar-submenu">
                                  <ul>
                <li>
                  <a href="{{ url('/moderator/system/settings') }}">@lang('menus.system')
                  </a>
                </li>
                <li>
                                <a href="{{ url('/moderator/payment-methods') }}">@lang('menus.payment_methods')</a>
                            </li>
                            <li>
                                <a href="{{ url('/moderator/services') }}">@lang('menus.services')</a>
                            </li>
                            <li>
                                <a href="{{ url('/moderator/packages') }}">@lang('menus.packages')</a>
                            </li>
                            
              </ul>
            </div>
                            
                            <li>
                                <a href="{{ url('/moderator/funds-load-history') }}">
                                    <i class="fa fa-history"></i>
                                    <span>@lang('menus.funds_load_history')</span>
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
                                <a href="{{ url('/moderator/orders') }}">Main Orders</a>
                            </li>

                            <li>
                                <a href="{{ url('/moderator/dripfeed') }}">DripFeed Orders</a>
                            </li>
                            
              </ul>
            </div>
                            
                            <li>
                                <a href="{{ url('/moderator/refills/list') }}">
                                    <i class="fa fa-refresh"></i>
                                    <span>Refill Requests</span>
                                </a>
                            </li>
                            
                     @if(session('imitator') != "")     
         	  <li>
             <a href="{{ url('/backof') }}">
              <i class="fa fa-home"></i>
              <span>Switch Back(If Admin)</span>
            </a>
          </li>
	@endif 	  
		             
                            
                          
                            
                               @if(getOption('module_api_enabled') == 1)
                            <li class="sidebar-dropdown">
                                
                                <div class="sidebar-submenu">
                                  <ul>
             <li>
                                <a href="{{ url('/moderator/automate/api-list') }}">@lang('menus.api_list')</a>
                            </li>
                            <li>
                                <a href="{{ url('/moderator/automate/send-orders') }}">@lang('menus.send_orders')</a>
                            </li>
                            <li>
                                <a href="{{ url('/moderator/automate/get-status') }}">@lang('menus.get_order_status')</a>
                            </li>
                            <li>
                                <a href="{{ url('/moderator/automate/response-logs') }}">@lang('menus.response_logs')</a>
                            </li>
              </ul>
            </div>
                            </li>
                            
                            
                            
                            @if(getOption('module_support_enabled') == 1)
                            <li>
                                <a href="{{ url('/moderator/support/tickets') }}">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                    <span>@lang('menus.support')<span class="badge" style="background-color: red;color:white;padding-top: 5px;">{{app('App\Http\Controllers\Moderator\SupportController')->tickCount()}}</span></span>
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
                 
                    <li><span style="color: white; font-size: 12px;">Version: Master</span></li>
                </ul>
            </footer>
        </div>
    </div>
         <!-- Scripts -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/js/vendor/datatable/datatables.min.js?v={{ config('constants.VERSION') }}"></script>
        <script src="/js/vendor/bootbox/bootbox.min.js?v={{ config('constants.VERSION') }}"></script>
        <script src="/js/flat-ui.min.js?v={{ config('constants.VERSION') }}"></script>
        <script src="/js/application.js?v={{ config('constants.VERSION') }}"></script>
        <script src="/js/custom.js?v={{ config('constants.VERSION') }}"></script>
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