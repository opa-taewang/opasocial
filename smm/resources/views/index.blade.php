<!doctype html>
<html lang="en">

   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- Basic Page Needs =====================================-->
      
      <link rel="shortcut icon" href="/images/OPA-MINI.png">
      <!-- Mobile Specific Metas ================================-->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      {!! getOption('home_page_meta') !!}
      <title>{{ getOption('app_name') }}</title>
      <!-- Site Title- -->
      <!-- CSS==================================================== -->
      <!--Libraries -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
	  <link rel="stylesheet" href="https://instaraja.b-cdn.net/custom_main/custom_main/19/css/font-awesome.min.css" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://instaraja.b-cdn.net/custom_main/custom_main/19/css/bootstrap.css">
      <!--Style CSS -->
      <link rel="stylesheet" href="https://instaraja.b-cdn.net/custom_main/custom_main/19/css/style.css">
      <!--Responsive CSS -->
      <!--<link rel="stylesheet" href="custom_main/19/css/responsive.css">-->
      <link rel="stylesheet" href="https://instaraja.b-cdn.net/custom_main/custom_main/19/css/font.css">
      <!--Animation css-->
      <link rel="stylesheet" href="https://res.cloudinary.com/panelguru/raw/upload/v1580584488/lib/keyframes7.min.css">
      


      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <style>
        @media (max-width: 550px)
.top-hero h6 {
    font-size: 15px;
}
.top-hero h6 {
    text-align: center;
    font-size: 15px;
    color: #ffffff;
    font-weight: 400;
    margin: 10px 0 15px;
}
    </style>  
   </head>

<body class="guest">
 
<!-- End Google Tag Manager (noscript) -->

<!-- header======================-->
<nav id="guest-nav" class="@if(Request::path() === '/') guestNav @endif navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">
           <img src="{{ asset(getOption('logo')) }}" alt="SMM Panel">
        </a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/services">Services</a></li>
          <li><a href="/howitwork">How It Works</a></li>
          <li><a href="/kb">Blog</a></li>
          <li><a href="/page/terms-and-conditions">Terms</a></li>
          <li class="signin"><a href="/login">Sign In</a></li>
          <li class="signup"><a href="/signup">Sign Up</a></li>
        </ul>
      </div>
    </div>
</nav>
<!-- End of Header area=-->


<section class="top-hero">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
               <h1>SMM Panel</h1>
               <p>The #1 and ONLY Cheap SMM Panel that you will need!
<br>{{ getOption('app_name') }} is the best And Cheapest SMM Panel.</br> The Best SMM Panel for all resellers.</p>
               <form  class="home-form" role="form" method="POST" action="{{ url('/login') }}">
                    <div class="form-group inputDiv{{ $errors->has('username') || $errors->has('email') ? ' has-error' : '' }}">
                        <input id="login" type="text" class="form-control login-field" placeholder="Email/Username" name="login" value="{{ old('username') ?: old('email') }}"  autofocus>
                         @if ($errors->has('username') || $errors->has('email'))
                            <span class="help-block">{{ $errors->first('username') ?: $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group inputDiv{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control login-field" placeholder="@lang('forms.password')" name="password" data-validation="required">
                        <a href="{{ url('/password/reset') }}" class="forgot-password">Forgot?</a>
                        @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
      
      <input type="checkbox" name="remember" value="1">
      <label for="remember" style="color:white;">Remember me</label>
</div>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">@lang('buttons.login') <i class="fas fa-sign-in-alt"></i></button>
                                <a href="{{url('login/google')}}" class="btn btn-primary" style="background:#df4a32;border-color:#df4a32;"><i class="fab fa-google"></i> Login with Google</a>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <span class="text-right">Do not have an account? <a href="/signup">Sign up</a></span>
                            <label class="checkbox" for="remember" style="display: none;"><input type="checkbox" id="remember" name="remember" data-toggle="checkbox"> @lang('forms.remember_me')</label>
                        </div>
                    </div>
                    @if ($errors->has('email') || $errors->has('g-recaptcha-response'))
                    <div class="khopcha form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        @php
                            config(["no-captcha.sitekey" => getOption('recaptcha_public_key')]);
                            config(["no-captcha.secret" => getOption('recaptcha_private_key')]);
                        @endphp
                        {!! Captcha::setLang(App::getLocale())->display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                        @endif
                    </div>
                    @endif
                </form>
			</div>
			<div class="col-sm-6">
			    <div class="animation-box">
			    <span class="rocket"></span>
			    <span class="falling-star star-1"></span>
			    <span class="falling-star star-2"></span>
			    <span class="falling-star star-3"></span>
			    <span class="falling-star star-4"></span>
			    <span class="tiny-star tstar-1"></span>
			    <span class="tiny-star tstar-2"></span>
			    <span class="tiny-star tstar-3"></span>
			    <span class="tiny-star tstar-4"></span>
			    <span class="tiny-star tstar-5"></span>
			    <span class="tiny-star tstar-6"></span>
			    <span class="tiny-star tstar-7"></span>
			    <span class="tiny-star tstar-8"></span>
			    <span class="tiny-star tstar-9"></span>
			    <span class="tiny-star tstar-10"></span>
			    <span class="tiny-star tstar-11"></span>
			    <span class="tiny-star tstar-12"></span>
			    <span class="tiny-star tstar-13"></span>
			</div>
			</div>
		</div>
	</div>
</section>
<section id="why-us">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>The Cheapest SMM Reseller Panel</h2>
                <p>We are the leading and #1 Cheapest SMM Panel and SEO Experts in the world.<br>All of our services are priced fairly, much lower price than any of our competitors in the market.<br>Test us, try Us, and then you will believe the power of {{ getOption('app_name') }}, the SMM Panel and SEO Experts. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="why-wrap">
                    <div class="why-icon"><img src="https://instaraja.b-cdn.net/custom_main/custom_main/19/images/why-icon-1.jpg" alt="SMM Panel"/></div>
                    <div class="why-content">
                        <h4>Quality Service</h4>
                        <h5>We provide only quality services. <br>At {{ getOption('app_name') }}, your happiness <br>is Gauranteed! </h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="why-wrap">
                    <div class="why-icon"><img src="https://instaraja.b-cdn.net/custom_main/custom_main/19/images/why-icon-2.jpg" alt="Best SMM Panel"/></div>
                    <div class="why-content">
                        <h4>Friendly Dashboard</h4>
                        <h5>Our SMM Panel is made with<br>User Friendly Dashboard <br>We Care about You!</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="why-wrap">
                    <div class="why-icon"><img src="https://instaraja.b-cdn.net/custom_main/custom_main/19/images/why-icon-3.jpg" alt="Nigerian SMM Panel"/></div>
                    <div class="why-content">
                        <h4>Instant Delivery</h4>
                        <h5>Most Services are Deivered within 12- 24 hrs. <br>Some Services are delivered within Minutes. <br>You Dont Have to Wait!</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<section id="quick-boost">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2>What is SMM Panel?</h2>
                <p> Nigerian SMM Panel  ( Social Media Marketing Panel ) is a website where People Buy Social Media Services Such as Facebook likes, Twitter Followers, Instagram fans, YouTube views, Website Traffic and more services.</p>
                <p> Cheapest SMM Panel in Nigeria You can get the Cheapest SMM services with most attracting offers. Now you can grow your social media brand with the most Cheapest , {{ getOption('app_name') }}. The World's #1 Best SMM Reseller panel. {{ getOption('app_name') }} is the Nigeria's best panel The Cheapest Panel. With cheaper SMM services In the market of cheap Service, {{ getOption('app_name') }} has grown too fast. Now is the only Cheapest SMM in the world Social Media Marketing(SMM) market.</p>
                <p>Social media marketing (SMM Panel Nigeria) refers to techniques that target social media networks and apps to spread brand awareness or promote particular products.</p>
                <br>
                <a href="/signup" class="btn btn-primary">Signup <i class="fas fa-sign-in-alt"></i></a> 
            </div>
            <div class="col-sm-6">
                <img src="https://instaraja.b-cdn.net/custom_main/custom_main/19/images/quick-boost.webp" alt="SMM Panel">
            </div>
        </div>
    </div>
</section>
<section id="service-sec">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="arrowCont"></div>
                <div class="service-slider">
                    <div>
                        <div class="service-box">
                            <div class="service-icon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="service-content">
                                <h4>Facebook SMM Panel</h4>
                                <h5>Looking to get your Facebook Page to go crazy? At {{ getOption('app_name') }} we have all services to <br> promote your Facebook Page and profile!</h5>
                                <a href="/services">View Service</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="service-box">
                            <div class="service-icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="service-content">
                                <h4>Twitter SMM Panel</h4>
                                <h5>Boost your lovely tweets with our services. Twitter Retweets, Twitter Favorites<br>Check Our Twitter Services Now!</h5>
                                <a href="/services">View Service</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="service-box">
                            <div class="service-icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="service-content">
                                <h4>Instagram SMM Panel</h4>
                                <h5>Instagram is one of the best and hottest social networks around!<br>Get in front of your competitors!</h5>
                                <a href="/services">View Service</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="service-box">
                            <div class="service-icon">
                                <i class="fab fa-youtube"></i>
                            </div>
                            <div class="service-content">
                                <h4>YouTube SMM Panel</h4>
                                <h5>Promote Your Youtube Channel with {{ getOption('app_name') }} Services. <br>Get Monetized Today!</h5>
                                <a href="/services">View Service</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="our-feature">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Our Best Features</h2>
                <p>Numbers show that we are the most used SMM Panel with a total of 2 Million orders.
<br>But let us tell you why we are the first in what we do.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <ul class="feature-list text-right">
                    <li>
                        <h4>Multiple Payments</h4>
                        <h5>Unlike Other SMM Panels, We do accept flutterwave, coinpayment and manual payment.</h5>
                    </li>
                    <li>
                        <h4>Cheapest Price</h4>
                        <h5>We are the <b>cheapest SMM Panel</b> in the market, starting at 0.01$. Unbelievable Prices!</h5>
                    </li>
                    <li>
                        <h4>Reseller Friendly</h4>
                        <h5>In Our SMM Panel, We give Special Discounts For <b>SMM Reseller Panels</b>. Just Shoot a Support Ticket.</h5>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
                <img src="/images/feature-opa.png">
            </div>
            <div class="col-sm-3">
                <ul class="feature-list">
                    <li>
                        <h4>Bulk Orders</h4>
                        <h5>You Can Easily Order Bulk Orders through our Mass Order Form. Reduce your Work in Our <b>Best SMM Panel.</b></h5>
                    </li>
                    <li>
                        <h4>NigeriaN SMM Panel</h4>
                        <h5>Most SMM Panels doesnt support Nigerian Payment  Gateways. Here We do Support Nigerian Payment Gateways</h5>
                    </li>
                    <li>
                        <h4>Support 24/7</h4>
                        <h5>We are proud to have the best support in the World, replying to your tickets 24/7.</h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Our Clients</h2>
                <p>At {{ getOption('app_name') }}, your happiness is guaranteed. If the client is happy then the relationship with us   <br> can only get better thus we only care about YOU being HAPPY! <br>The opinion of Customers matters!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="testi-wrap">
                    <div class="testi-icon"><img src="https://instaraja.b-cdn.net/custom_main/custom_main/19/images/testi-1.png" alt="testi-icon"></div>
                    <div class="ratting">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testi-content">
                        <h4>Mike Andereson</h4>
                        <h5>Wow! This is amazing,i have been<br> purchasing Instagram Likes for over a year  <br>and never got a delay!</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="testi-wrap">
                    <div class="testi-icon"><img src="https://instaraja.b-cdn.net/custom_main/custom_main/19/images/testi-2.png" alt="testi-icon"></div>
                    <div class="ratting">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testi-content">
                        <h4>Julie Martin</h4>
                        <h5>Purchased 2000 Facebook Likes <br>for our company and worked indeed!<br>Support is also in time always.</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="testi-wrap">
                    <div class="testi-icon"><img src="https://instaraja.b-cdn.net/custom_main/custom_main/19/images/testi-1.png" alt="testi-icon"></div>
                    <div class="ratting">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testi-content">
                        <h4>Kevin Obrie</h4>
                        <h5>Got my instagram followers as promised <br>in time! Thanks a Lot<br>Good Job!</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img class="footer-logo" src="{{ asset(getOption('logo')) }}" alt="footer-logo"style="width:200px;height:50px;">
                    <p>{{ getOption('app_name') }} was launched in 2016,<br> it is the fastest growing SMM Panel <br>in the SMM World!</p>
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
                        <li><a href="/services">Services</a></li>
                        <li><a href="/faqs">FAQ</a></li>
                        <li><a href="/api">API</a></li>
                        <li><a href="/login">Sign In</a></li>
                        <li><a href="/signup">Sign Up</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h4 class="widget-title">Services</h4>
                    <ul class="footer-nav">
                        <li><a href="/services">Facebook</a></li>
                        <li><a href="/services">YouTube</a></li>
                        <li><a href="/services">Instagram</a></li>
                        <li><a href="/services">Twitter</a></li>
                        <li><a href="/services">Soundcloud</a></li>
                        <li><a href="/services">Linkedin</a></li>
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
    <a href="//www.dmca.com/Protection/Status.aspx?ID=b25f065c-c99b-42e0-a7dc-6ef250092c3b" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/_dmca_premi_badge_3.png?ID=b25f065c-c99b-42e0-a7dc-6ef250092c3b"  alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-6"><p>© {{ getOption('app_name') }} 2022. All Rights Reserved. Website Made With ❤ by <a href="https://dcreato.com/" target="_blank" style="color: white;">DCreato</a></p></div>
                <div class="col-sm-6">
                    <ul class="footer-links">
                        <li><a href="page/terms-and-conditions">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<script type="text/javascript">
    function loginform(response) {
        document.getElementById("loginform").submit();
    }
</script>
<!-- End Footer -->

<!-- Javascripts File
   =============================================================================-->

<!-- initialize jQuery Library -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- Popper JS -->
<!--<script src="custom_main/19/js/popper.min.js"></script>-->
<!-- Bootstrap jQuery -->
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

<script src="https://instaraja.b-cdn.net/custom_main/custom_main/19/js/bootstrap.js"></script>
<!-- Template Custom -->
<script src="https://instaraja.b-cdn.net/custom_main/custom_main/19/js/main.js"></script>
<script src="https://instaraja.b-cdn.net/custom_main/custom_main/19/js/slick.min.js"></script>
<script type="text/javascript">
    $('.service-slider').slick({
        dots: false,
        infinite: true,
    	slidesToShow: 3,
  		slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
   		cssEase: 'linear',
    	appendArrows: ".arrowCont",
    	prevArrow: '<button class="slide-arrow prev-arrow"><i class="fas fa-chevron-left"></i></button>',
  	    nextArrow: '<button class="slide-arrow next-arrow"><i class="fas fa-chevron-right"></i></button>',
    	responsive: [
    		{
              breakpoint: 550,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
    	]
    });
</script>
@if(env('Popup_Notifications') == "Enabled")
<script>
    $(window).load(function(){        
        $('#popupModal').modal('show');
    }); 
</script>
@endif
{!! Captcha::script() !!}
</body>

</html>