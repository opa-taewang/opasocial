<?php


namespace App\Http\Middleware;

class VerifyIsNotAdmin
{
    public function handle($request, \Closure $next)
    {
        if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role === "ADMIN") {
            return redirect("/admin");
        }
        return $next($request);
    }
}

?>