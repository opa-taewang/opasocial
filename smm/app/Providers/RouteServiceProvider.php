<?php 
namespace App\Providers;


class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    protected $namespace = "App\\Http\\Controllers";

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        \Illuminate\Support\Facades\Route::group(array( "middleware" => "web", "namespace" => $this->namespace ), function($router)
        {
            require(base_path("routes/web.php"));
        });
    }

    protected function mapApiRoutes()
    {
        \Illuminate\Support\Facades\Route::group(array( "middleware" => "api", "namespace" => $this->namespace, "prefix" => "api" ), function($router)
        {
            require(base_path("routes/api.php"));
        });
    }

}


