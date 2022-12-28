<?php 
namespace App\Providers;


class BroadcastServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        \Illuminate\Support\Facades\Broadcast::routes();
        \Illuminate\Support\Facades\Broadcast::channel("App.User.*", function($user, $userId)
        {
            return (int) $user->id === (int) $userId;
        });
    }

}


