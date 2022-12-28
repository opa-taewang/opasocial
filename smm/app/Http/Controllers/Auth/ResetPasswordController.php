<?php 
namespace App\Http\Controllers\Auth;


class ResetPasswordController extends \App\Http\Controllers\Controller
{
    use \Illuminate\Foundation\Auth\ResetsPasswords;

    protected $redirectTo = "/login";

    public function __construct()
    {
        $this->middleware("guest");
    }

}


