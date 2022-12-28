<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Session;
use App\Config;
use App\Group;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use App\PaymentMethod;
use App\User;
use App\Visit;
use App\Ip;
use File;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $proxy = '';
    protected $redirectTo = "/";
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function authenticated($request, $user)
    {
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
        if( $user->status === title_case("DEACTIVATED") ) 
        {
            \Illuminate\Support\Facades\Auth::logout();
            return redirect("/login")->withInput($request->only($this->username(), "remember"))->withErrors(array( $this->username() => __("messages.account_suspended") ));
        }
        $options = \App\Config::pluck("value", "name")->all();
        \Session::put("options", $options);
        if( $user->role == "ADMIN" ) 
        {
           $ip=Ip::create([
            'address' => $_SERVER['REMOTE_ADDR'],
            'blocked' => 0,
            'reason' => 'New Login admin',
            'user_id' => $user->id
        ]);
       if( isset($_GET['redirect_to']) && !empty($_GET['redirect_to']) && strpos($_GET['redirect_to'],$_SERVER['HTTP_HOST'])) 
        {
            return redirect()->to($_GET['redirect_to']);
        }
        else {
            $this->redirectTo = session()->get('url.intended');
                
            }
        }
               if ($user->role == 'MODERATOR') {
                   $ip=Ip::create([
            'address' => $_SERVER['REMOTE_ADDR'],
            'blocked' => 0,
            'reason' => 'New Login Moderator',
            'user_id' => $user->id
        ]);
                   
            return redirect('/moderator/orders');
        }
        $ip=Ip::create([
            'address' => $_SERVER['REMOTE_ADDR'],
            'blocked' => 0,
            'reason' => 'New Login User',
            'user_id' => $user->id
        ]);
        \Log::error($this->redirectTo);
        if(isset($_GET['redirect_to']) && !empty($_GET['redirect_to']) && strpos($_GET['redirect_to'],$_SERVER['HTTP_HOST'])) {
            return redirect()->to($_GET['redirect_to']);
        }
        else {
        $this->redirectTo = session()->get('url.intended');
            
        }
         
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
     private function checkProxy($ip){
    	$contactEmail="null@mail.com";
    	$timeout=5;
    	$banOnProbability=0.99;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    	curl_setopt($ch, CURLOPT_URL, "http://check.getipintel.net/check.php?ip=$ip&contact=$contactEmail");
    	$response=curl_exec($ch);
    	curl_close($ch);
    	if ($response > $banOnProbability) {
    			return true;
    	} else {
    		if ($response < 0 || strcmp($response, "") == 0 ) {}
    			return false;
    	}
    }
    protected function validateLogin(Request $request)
    {
        
        $rules = [
            $this->username() => 'required',
            'password' => 'required'
        ];

        // if request have captcha then
        // include captcha validation rules
        if ($request->input('g-recaptcha-response') !== null) {
            $rules['g-recaptcha-response'] = ['required', new CaptchaRule];
        }
        $this->validate($request, $rules);
    }
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->proxy=\Request::getClientIp(true);
        $this->username = $this->findUsername();
        session(['url.intended' => url()->previous()]);
        $this->redirectTo = session()->get('url.intended');
        config(["no-captcha.sitekey" => getOption('recaptcha_public_key')]);
        config(["no-captcha.secret" => getOption('recaptcha_private_key')]);
    }
    public function findUsername()
    {
        $login = request()->input('login');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }
    public function username()
    {
        return $this->username;
    }
    public function redirectToProvider($socail)
    {
        if(empty(config('services.'.$socail.'.client_id')) || empty(config('services.'.$socail.'.client_secret')) || empty(config('services.'.$socail.'.redirect'))) {
            abort('507');
        }
        return Socialite::driver($socail)->redirect();
    }

    public function handleProviderCallback($social)
    {
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
       $login_type='';
     if($social==='google'){
           $login_type='g_id';
           $usersocialite = Socialite::driver($social)->stateless()->user();
     }else if($social==='facebook'){

         $login_type='fb_id';
          $usersocialite = Socialite::driver($social)->user();

       }else {
           $login_type='simple';
           $usersocialite = Socialite::driver($social)->user();
       }
 
        $user=new User;
       if($login_type=='simple'){
             $findUser=User::where('email',$usersocialite->getEmail())->first();

           if(!empty($findUser))
           {
               return redirect('/login')->with('error','You already have an account.');
           }
       } else {

            $findUser=User::where('email',$usersocialite->getEmail())->first();

           if(!empty($findUser))
           {
               if ($findUser->status === title_case('DEACTIVATED')) {
            return redirect('/login')->with('error', __('messages.account_suspended'));
               } 
               else {
                                  Auth::login($findUser);
                                  $ip=Ip::create([
            'address' => $_SERVER['REMOTE_ADDR'],
            'blocked' => 0,
            'reason' => 'New Login by Social',
            'user_id' => $findUser->id
        ]);
                                 if(isset($_GET['redirect_to']) && !empty($_GET['redirect_to']) && strpos($_GET['redirect_to'],$_SERVER['HTTP_HOST'])) {
            return redirect()->to($_GET['redirect_to']);
        }
        else {
        $this->redirectTo = session()->get('url.intended');
            
        }
               }
        

           }
           else {
                $paymentMethods = PaymentMethod::where(['config_key' => null, 'status' => 'ACTIVE', 'is_disabled_default' => 0])->groupBy('slug')->get()->pluck('id')->toArray();
                $payment_methods = '';
                $groups = Group::where(['isdefault' => 1])->get()->pluck('id')->toArray();
                $groups = implode($groups);
                if (!empty($paymentMethods)) {
                    $payment_methods = implode(',', $paymentMethods);
                }
                $options = Config::where('name','users_per_ip')->value('value');
                $ip =$_SERVER['REMOTE_ADDR'];
                $email1 = $usersocialite->getEmail();
                
               if(User::where('ip',$ip)->count() >= (int)$options) {
                $user->name=$usersocialite->getName();
                $user->email=$usersocialite->getEmail();
                $user->username=strstr($email1, '@', true);
                $user->funds=0.00;
                $user->group_id= $groups;
                $user->status='DEACTIVATED';
                $user->password=bcrypt($usersocialite->getEmail());
                $user->role='USER';
                $user->verified='1';
                $user->enabled_payment_methods=$payment_methods;
                if($login_type=='fb_id'){
                   $user->fb_id=$usersocialite->getId();
                   $user->user_from='f';
                }else if($login_type=='g_id'){
                   $user->g_id=$usersocialite->getId();
                   $user->user_from='g';
                }
                $user->ip = $_SERVER['REMOTE_ADDR'];
                $user->save();
                $ip=Ip::create([
            'address' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'blocked' => 0,
             'reason' => 'Number of Accounts Per IP Crossed'
        ]);
        \Illuminate\Support\Facades\Auth::logout();
            return redirect('/login')->with('error', __('messages.account_limit'));
        } else {
            $user->name=$usersocialite->getName();
                $user->email=$usersocialite->getEmail();
                $user->username=strstr($email1, '@', true);
                $user->funds=0.00;
                $user->status='ACTIVE';
                $user->password=bcrypt($usersocialite->getEmail());
                $user->role='USER';
                $user->verified='1';
                $user->group_id= $groups;
                $user->enabled_payment_methods=$payment_methods;
                if($login_type=='fb_id'){
                   $user->fb_id=$usersocialite->getId();
                   $user->user_from='f';
                }else if($login_type=='g_id'){
                   $user->g_id=$usersocialite->getId();
                   $user->user_from='g';
                }
                $user->ip = $_SERVER['REMOTE_ADDR'];
                $user->save();
                
        $ip=Ip::create([
            'address' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $user->id,
            'blocked' => 0,
            'reason' => 'New Registration by Social'
        ]);
        }
        $refVid = $user->id;
        $refUid=Session::get('refUid');
        if($refUid!=null){
        $refuser = User::findOrFail($refUid);
        if($refuser!=''){
        $visit= new Visit;
        $visit->refVid = $refVid;
        $visit->refUid = $refUid;
        $visit->visitorIp =$_SERVER['REMOTE_ADDR'];
        $visit->save();
        }
        }
        $res=$this->checkProxy($_SERVER['REMOTE_ADDR']);
        if($res) {
           $user->status="Deactivated";
           $user->save();
           $ip->blocked=1;
           $ip->user_id=$user->id;
           $ip->reason="Using VPN, OR proxy of Bad IP";
           $ip->save();
           try {
                $client = new Client();
                $domain = base64_encode(\Request::server ("SERVER_NAME"));
                $url = "http://smm-script.com/api/v2/blackips";
                $params['headers'] = ['X-XSRF-TOKEN' => csrf_token()];
                $params['form_params'] = array('address' => $ip->address,'reason' => $ip->reason ,'email' => $user->email , 'domain' => $domain);
                $client->post($url, $params);
           } catch(\Exception $e){}
           abort(403,"Using VPN, OR proxy of Bad IP");
        }
                Auth::login($user);
           }
          }
        \Session::flash('alert','Your password is '.Auth::user()->email.' Please reset your password.');
        Session::flash('alertClass', 'success');
         return redirect('/order/new');
        }
}
