<?php 
namespace App\Http\Controllers\Auth;


class ForgotPasswordController extends \App\Http\Controllers\Controller
{
    use \Illuminate\Foundation\Auth\SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware("guest");
    }

}


