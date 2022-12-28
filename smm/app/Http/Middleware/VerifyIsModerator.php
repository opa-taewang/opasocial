<?php


namespace App\Http\Middleware;

class VerifyIsModerator
{
    public function handle($request, \Closure $next)
    {
        if (\Illuminate\Support\Facades\Auth::user()->role != "MODERATOR") {
            abort(403);
        }
        config(["app.timezone" => getOption("timezone")]);
        return $next($request);
    }
}

?>