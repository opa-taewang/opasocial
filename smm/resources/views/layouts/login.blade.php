@php
    // alignment direction according to language
    $dir = "ltr";
    $rtlLang = ['ar'];
    if(in_array(getOption('language'),$rtlLang)):
        $dir="rtl";
    endif;
@endphp
<!doctype html>
<html class="no-js " lang="{{ getOption('language') }}">

<!-- Mirrored from thememakker.com/templates/oreo/html/light/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Mar 2019 14:04:02 GMT -->
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset(getOption('logo')) }}" type="image/x-icon"> <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset(getOption('logo')) }}">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/authentication.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/color_skins.css')}}">
    <style type="text/css">
        .dropdown-lang>li a{
            color: #000 !important;
        }
    </style>
</head>

<body class="theme-purple authentication sidebar-collapse">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank">
                <img  src="{{asset(getOption('logo'))}}" style="width:50px;" />
            </a>
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav">    
                @if(getOption('show_service_list_without_login') == 'YES')
                    <li><a href="{{ url('/services') }}"><i class="zmdi zmdi-orders"></i>@lang('menus.service_list')</a></span></li>
                @endif
                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-expanded="false">
                        Language <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-lang" role="menu">
                        <li>
                            <form id="lang-form" action="{{ url('/change-lang') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" value="en" name="locale" id="locale">
                            </form>
                            <a href="#" data-locale="en">English</a>
                        </li>
                        <li><a href="#" data-locale="es">Spanish</a></li>
                        <li><a href="#" data-locale="ru">Russian</a></li>
                        <li><a href="#" data-locale="de">German</a></li>
                        <li><a href="#" data-locale="fr">French</a></li>
                        <li><a href="#" data-locale="pt">Portuguese</a></li>
                        <li><a href="#" data-locale="zh">Chinese</a></li>
                        <li><a href="#" data-locale="it">Italian</a></li>
                        <li><a href="#" data-locale="tr">Turkish</a></li>
                        <li><a href="#" data-locale="ar">Arabic</a></li>
                        <li><a href="#" data-locale="th">Thai</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/login') }}">@lang('menus.login')</a></li>
                <li><a href="{{ url('/register') }}">@lang('menus.register')</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="page-header">
    <div class="page-header-image" style="background-image:url('{{asset('assets/images/login.jpg')}}')"></div>
    @yield('content')
</div>

<!-- Jquery Core Js -->
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->

<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
//=============================================================================
$('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
}).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
});
</script>
</body>

<!-- Mirrored from thememakker.com/templates/oreo/html/light/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Mar 2019 14:04:03 GMT -->
</html>