<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginForm(Request $request){

        try{
            $email = $request->txtEmail;
            $password = $request->txtPassword;

            if (Auth::attempt(['email' => $email, 'password' => $password], true)) {
                // Authentication passed...

                return response()->json(["status" => 200, "redirect" => '/agent_dashboard']);

            } else {
                return "201";
            }
        }catch(Exception $ex){
            return $ex;
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
