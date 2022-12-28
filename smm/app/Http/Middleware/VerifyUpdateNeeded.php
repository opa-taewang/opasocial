<?php


namespace App\Http\Middleware;

class VerifyUpdateNeeded
{
    public function handle($request, \Closure $next)
    {
        if (!\Illuminate\Support\Facades\Storage::exists("images/update")) {
            return redirect("/");
        }
        return $next($request);
    }
}

?>