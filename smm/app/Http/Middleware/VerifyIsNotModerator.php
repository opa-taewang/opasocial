<?php

namespace App\Http\Middleware;

class VerifyIsNotModerator
{
    public function handle($request, \Closure $next)
    {
        if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role === "MODERATOR") {
            return redirect("/moderator");
        }
        return $next($request);
    }
}

?>