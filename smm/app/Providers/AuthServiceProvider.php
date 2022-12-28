<?php 
namespace App\Providers;


class AuthServiceProvider extends \Illuminate\Foundation\Support\Providers\AuthServiceProvider
{
    protected $policies = array( "App\\Model" => "App\\Policies\\ModelPolicy" );

    public function boot()
    {
        $this->registerPolicies();
    }

}


