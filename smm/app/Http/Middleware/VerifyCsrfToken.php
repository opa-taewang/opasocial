<?php 
namespace App\Http\Middleware;


class VerifyCsrfToken extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken
{
    protected $except = array( "/payment/add-funds/bitcoin/bit-ipn", "/cashmaal/ipn","/payment/cashmaal/success","/payment/cashmaal/cancel" , "/payment/add-funds/payza/status", "/payment/add-funds/paypal/status","/payment/add-funds/payu/fail","/payment/add-funds/payu/success", "/payment/add-funds/instamojo/webhook", "/payment/add-funds/skrill/ipn", "/payment/add-funds/paywant/status", "/payment/add-funds/paytm/status" ,"/payment/status/perfectmoney","/payment/validate/perfectmoney","payment/checkout/perfectmoney");

}


