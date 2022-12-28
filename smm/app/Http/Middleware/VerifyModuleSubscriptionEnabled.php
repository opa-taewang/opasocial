<?php


namespace App\Http\Middleware;

class VerifyModuleSubscriptionEnabled
{
    public function handle($request, \Closure $next)
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            if (getOption("module_subscription_enabled") == 0) {
                abort(403);
            }
        } else {
            $row = getOption("module_subscription_enabled", true);
            if ($row->value == 0) {
                abort(403);
            }
        }
        return $next($request);
    }
}

?>