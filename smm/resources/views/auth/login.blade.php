<!doctype html>
<html lang="en">

   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- Basic Page Needs =====================================-->
      
          <link rel="shortcut icon" href="/images/OPA-MINI.png">

      <!-- Mobile Specific Metas ================================-->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>{{getOption('app_name')}}</title>

      <!-- Site Title- -->
      <!-- CSS==================================================== -->
      <!--Libraries -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900|Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
	  <link rel="stylesheet" href="custom_main/19/css/font-awesome.min.css" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="custom_main/19/css/bootstrap.css">
      <!--Style CSS -->
      <link rel="stylesheet" href="custom_main/19/css/style.css">
      <!--Responsive CSS -->
      <link rel="stylesheet" href="custom_main/19/css/responsive.css">
      <link rel="stylesheet" href="custom_main/19/css/font.css">
     <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8H08NEV0CN"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8H08NEV0CN');
</script>
      
      <!--Animation css-->
      <link rel="stylesheet" href="https://res.cloudinary.com/instaraja/raw/upload/v1594576197/keyframes7.min_w3iaqd.css">
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
<nav id="guest-nav" class="@if(Request::path() === 'login') guestNav @endif navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">
           <img src="{{ asset(getOption('logo')) }}" alt="seobin">
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
            <h1>#1 Best Smm Panel,
Cheapest Smm Panel</h1>
               <p>The #1 and ONLY Cheap SMM Panel that you will need!
<br>Try OpaSocial to accelerate your Social Media and Website Growth. We Grow with You, Completed 2M Orders.</p> 
               @if(Session::has('error'))
                            <p style="color:white;background:red;">{{ Session::get('error') }}</p>
                        @endif
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
                <h2>Why Choose Us</h2>
                <p>We are the leading and #1 SMM Panel and SEO Experts in Nigeria and Now Available to the world.<br>All of our services are priced fairly, much lower price than any of our competitors in the market.<br>Test us, try Us, and then you will believe the power of OpaSocial, the SMM Panel and SEO Experts. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="why-wrap">
                    <div class="why-icon"><img src="custom_main/19/images/why-icon-1.jpg" alt="why-icon"/></div>
                    <div class="why-content">
                        <h4>Quality Service</h4>
                        <h5>We provide only quality services. <br>At OpaSocial, your happiness <br>is Gauranteed! </h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="why-wrap">
                    <div class="why-icon"><img src="custom_main/19/images/why-icon-2.jpg" alt="why-icon"/></div>
                    <div class="why-content">
                        <h4>Friendly Dashboard</h4>
                        <h5>Our Website is made with<br>User Friendly Dashboard <br>We Care about You!</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="why-wrap">
                    <div class="why-icon"><img src="custom_main/19/images/why-icon-3.jpg" alt="why-icon"/></div>
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
                <h2>Quick Boost in Sale</h2>
                <p>In this fast world, everyone wants the fastest and good quality services. <br>OpaSocial Provides what this world needs.</p>
                <p> OpaSocial only serve High Quality products and products that work. <br>OpaSocial bring you the most competitive prices on the market. </p>
                <p>We have support working daily to assist any of your issues.<br>Daily updating our services with the latest trends.</p>
                <br>
                <a href="/signup" class="btn btn-primary">Signup <i class="fas fa-sign-in-alt"></i></a> 
            </div>
            <div class="col-sm-6">
                <img src="custom_main/19/images/quick-boost.png" alt="quick-boost-pic">
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
                                <h4>Facebook Service</h4>
                                <h5>Looking to get your Facebook Page to go crazy? At OpaSocial we have all services to <br> promote your Facebook Page and profile!</h5>
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
                                <h4>Twitter Service</h4>
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
                                <h4>Instagram Service</h4>
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
                                <h4>YouTube Service</h4>
                                <h5>Promote Your Youtube Channel with OpaSocial Services. <br>Get Monetized Today!</h5>
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
                <p>Numbers show that we are the most used panel with a total of 2 Million orders.
<br>But let us tell you why we are the first in what we do.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <ul class="feature-list text-right">
                    <li>
                        <h4>Quick Sales</h4>
                        <h5>Our delivery is automated and usually it takes minutes if not seconds to deliver your order.</h5>
                    </li>
                    <li>
                        <h4>Cheapest Price</h4>
                        <h5>Our prices are the cheapest in the market, starting at 0.01$. Unbelievable Prices!</h5>
                    </li>
                    <li>
                        <h4>Organic Target</h4>
                        <h5>Organic services to help you boost your online presence across ALL social media platforms for the cheapest prices.</h5>
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
                        <h5>You Can Easily Order Bulk Orders through our Mass Order Form. Reduce your Work.</h5>
                    </li>
                    <li>
                        <h4>Mobile Friendly</h4>
                        <h5>We have the friendliest dashbord in the World! Updated regularly with the best user friendly features.</h5>
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
                <p>At OpaSocial, your happiness is guaranteed. If the client is happy then the relationship with us   <br> can only get better thus we only care about YOU being HAPPY! <br>The opinion of Customers matters!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="testi-wrap">
                    <div class="testi-icon"><img src="custom_main/19/images/testi-1.png" alt="testi-icon"></div>
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
                    <div class="testi-icon"><img src="custom_main/19/images/testi-2.png" alt="testi-icon"></div>
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
                    <div class="testi-icon"><img src="custom_main/19/images/testi-1.png" alt="testi-icon"></div>
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
                    <img class="footer-logo" src="{{ asset(getOption('logo')) }}" alt="Best SMM Panel"style="width:200px;height:50px;">
                    <p>OpaSocial.com was launched in 2016,<br> it is the fastest growing SMM Panel <br>in the SMM World!</p>
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
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-6"><p>© OpaSocial 2022. All Rights Reserved.</p></div>
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


<script src="custom_main/19/js/bootstrap.js"></script>
<!-- Template Custom -->
<script src="custom_main/19/js/main.js"></script>
<script src="custom_main/19/js/slick.min.js"></script>
<script type="text/javascript">
    $('.service-slider').slick({
        dots: false,
        infinite: true,
    	slidesToShow: 3,
  		slidesToScroll: 1,
        speed: 300,
    	//fade: true,
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