<?php


namespace App\Http\Middleware;

class VerifyModuleSupportEnabled
{
    public function handle($request, \Closure $next)
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            if (getOption("module_support_enabled") == 0) {
                abort(403);
            }
        } else {
            $row = \DB::table("configs")->select("value")->where("name", "module_support_enabled")->first();
            if ($row->value == 0) {
                abort(403);
            }
        }
        return $next($request);
    }
}

?>