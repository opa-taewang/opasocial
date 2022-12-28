<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
class VerifyAppInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    private function ip(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }     
    public function handle($request, Closure $next)
    {
        
        if ((request()->server('SERVER_NAME')) != base64_decode(config('database.connections.mysql.xdriver'))) {
            $client = new Client();
            try {
                $url = "https://smm-script.com/api/DomainChecker";
                $ip = base64_encode($_SERVER['SERVER_ADDR']);
                $params['headers'] = ['X-XSRF-TOKEN' => csrf_token()];
                $params['form_params'] = array('app_name'=> base64_encode(getOption('app_name')),'client_email' => base64_encode(getOption('notify_email')),'username'=>base64_encode(config('console.username')),'version'=>base64_encode(config('console.version')),'secretcode'=>base64_encode(config('console.secretcode')), 'domain' => base64_encode($request->server('SERVER_NAME')), 'installtime' => base64_encode(config('console.installtime')),'ip'=>($ip), 'token' => base64_encode('smm-script.com'));
                $res = $client->post($url, $params);
                $body =$res->getBody()->getContents();
            }
            catch (\PDOException $ex) {
            }
           abort('506'); 
        }
        
        if (config('database.transfer_mode') == "1") {
            if (password_verify($request->server('SERVER_NAME'), getOption('app_key', true))
                && password_verify(strrev($request->server('SERVER_NAME')), getOption('app_code', true))) {
                return redirect('/transfer/restore');
            }
            return redirect('/transfer/ready');
        }

        if (config('database.installed') == '%installed%') {
            return redirect('/install');
        }

        if (Storage::exists('images/update')) {
            return redirect('/update-progress');
        }
       
            
        \App::setLocale(request()->session()->get('locale', getOption('language')));
        $ip=\App\Ip::where('address',$this->ip())->where('blocked',1)->first();
        if($ip)
            abort(403,$ip->reason);
        return $next($request);
    }
}
