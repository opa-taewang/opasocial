@extends('layouts.app')
@section('title', getOption('app_name') . ' - Howitworks')
@section('content')
<seciton class="blog-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1>How It Works</h1>
                <p>Learn Some Basics and You're Good to Go !</p>
            </div>
            <div class="col-sm-8">
                <img src="custom_main/19/images/how-banner2.png">
            </div>
        </div>
    </div>
</seciton>
<section class="main-work">
    <div class="container">
        <div class="row timeline">
            <div class="col-sm-6 ribbon-left">
                <div class="ribbon">
                    <h2 class="ribbon-title">Create Account</h2>
                    <h3 class="ribbon-count">1</h3>
                </div>
                <p>First, you need to have an account for login then you can see the dashboard, we make signup easy and this is basic, same like you make an account in social media. and don't worry all your details are safe, we will not share your details with others.</p>
                <img class="step-img" src="custom_main/19/images/screen-1.png">
            </div>
            <div class="col-sm-6"></div>
            <div class="clearfix"></div>
            <div class="col-sm-6"></div>
            <div class="col-sm-6 ribbon-right">
                <div class="ribbon">
                    <h2 class="ribbon-title">Add Funds</h2>
                    <h3 class="ribbon-count">2</h3>
                </div>
                <p>Second, you need to deposit fund to your account. In Opasocial deposit is easy and secure , and we have much payment options for you. For deposit please go to “<a href="https://Opasocial.com/payment/add-funds">https://Opasocial.com/payment/add-funds</a>” you can find “<a href="https://Opasocial.com/payment/add-funds">Add funds</a>” in sidebar.</p>
                <img class="step-img" src="/images/Screenshot.png">
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-6 ribbon-left">
                <div class="ribbon">
                    <h2 class="ribbon-title">Now Order</h2>
                    <h3 class="ribbon-count">3</h3>
                </div>
                <p>Third, after you have balance in your account , so now you can place orders in new order form, see step by step . you can check “<a href="https://Opasocial.com/services">https://Opasocial.com/services</a>” to see all the services and price.</p>
                <img class="step-img" src="custom_main/19/images/screen-3.png">
            </div>
            <div class="col-sm-6"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <br><br>
                <h2 class="main-head">Break-it Down</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="step-wrap">First you need to select the category service you needed. for example you need service "<a href="https://Opasocial.com/howitwork">⭐ Instagram Likes</a>"</div>
                <div class="step-wrap">Fourth, you must fill in the link "<a href="https://Opasocial.com/howitwork">https://www.instagram.com/p/BvcoQVlAJUx/</a>" this example you can copy in your instagram post .</div>
                <div class="step-wrap">Finally you will see the total amount you have to pay, this will take on your balance. then click submit to place orders</div>
            </div>
            <div class="col-sm-6">
                <div class="break-down">
                    <div class="step step-1">01</div>
                    <div class="step step-2">02</div>
                    <div class="step step-3">03</div>
                    <img class="step-img" src="custom_main/19/images/screen-3.png">
                    <div class="step step-4">04</div>
                    <div class="step step-5">05</div>
                    <div class="step step-6">06</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="step-wrap">Second you select the service from category you select , example "<a href="https://Opasocial.com/howitwork">ID:652  Instagram Likes Min10 Max 30K [ Recommended] -- $0.98 Per 1000</a>" and you also can see price / 1000 quantity</div>
                <div class="step-wrap">Third you can see the description about your service select so before you orders you can know quality this service, because we want <a href="https://Opasocial.com/howitwork">our service transparent without being covered</a></div>
                <div class="step-wrap">Fifth you have to fill in the amount you want from the service, and underneath you will see the minimum and maximum</div>
            </div>
        </div>
    </div>
</section>


@endsection