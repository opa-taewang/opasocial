<?php


namespace App\Http\Middleware;

class VerifyAppIsNotInstalled
{
    public function handle($request, \Closure $next)
    {
        if (config("database.installed") !== "%installed%") {
            return redirect("/");
        }
        return $next($request);
    }
}

?>