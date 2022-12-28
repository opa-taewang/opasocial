<?php 
namespace App\Providers;


class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    protected $listen = array( "App\\Events\\OrderPlaced" => array( "App\\Listeners\\SendOrderToReseller" ), "Illuminate\\Auth\\Events\\Login" => array( "App\\Listeners\\LogLastLogin" ) );

    public function boot()
    {
        parent::boot();
    }

}


