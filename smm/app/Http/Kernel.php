<?php 
namespace App\Http;
use App\Http\Middleware\VerifyIsModerator;
use App\Http\Middleware\VerifyIsNotModerator;


class Kernel extends \Illuminate\Foundation\Http\Kernel
{
    protected $middleware = array( "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode" );
    protected $middlewareGroups = array( "web" => array( "App\\Http\\Middleware\\EncryptCookies", "Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse", "Illuminate\\Session\\Middleware\\StartSession", "Illuminate\\View\\Middleware\\ShareErrorsFromSession", "App\\Http\\Middleware\\VerifyCsrfToken", "Illuminate\\Routing\\Middleware\\SubstituteBindings" ), "api" => array( "throttle:60,1", "bindings" ) );
    protected $routeMiddleware = array( "auth" => "Illuminate\\Auth\\Middleware\\Authenticate", "auth.basic" => "Illuminate\\Auth\\Middleware\\AuthenticateWithBasicAuth", "bindings" => "Illuminate\\Routing\\Middleware\\SubstituteBindings", "can" => "Illuminate\\Auth\\Middleware\\Authorize", "guest" => "App\\Http\\Middleware\\RedirectIfAuthenticated", "throttle" => "Illuminate\\Routing\\Middleware\\ThrottleRequests", "admin" => "App\\Http\\Middleware\\VerifyIsAdmin","moderator" => "App\\Http\\Middleware\\VerifyIsModerator",
 "user" => "App\\Http\\Middleware\\VerifyIsUser",'notModerator' => "App\\Http\\Middleware\\VerifyIsNotModerator",
 "notAdmin" => "App\\Http\\Middleware\\VerifyIsNotAdmin", "VerifyAppIsNotInstalled" => "App\\Http\\Middleware\\VerifyAppIsNotInstalled", "VerifyAppInstalled" => "App\\Http\\Middleware\\VerifyAppInstalled", "VerifyModuleAPIEnabled" => "App\\Http\\Middleware\\VerifyModuleAPIEnabled", "VerifyModuleSupportEnabled" => "App\\Http\\Middleware\\VerifyModuleSupportEnabled", "VerifyModuleSubscriptionEnabled" => "App\\Http\\Middleware\\VerifyModuleSubscriptionEnabled", "VerifyUpdateNeeded" => "App\\Http\\Middleware\\VerifyUpdateNeeded" );

}


