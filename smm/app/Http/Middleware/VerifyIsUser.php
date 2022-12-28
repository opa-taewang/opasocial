<?php 
namespace App\Http\Middleware;


class VerifyIsUser
{
    public function handle($request, \Closure $next)
    {
        if( \Illuminate\Support\Facades\Auth::user()->role == "ADMIN" ) 
        {
            return redirect("/admin");
        }
        config(array( "app.timezone" => \Illuminate\Support\Facades\Auth::user()->timezone ));
        return $next($request);
    }

}


