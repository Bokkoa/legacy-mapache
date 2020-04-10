<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models;
use Session;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected $redirectTo = '/index';
    
    public function login()
    {
        $this->validate(request(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);


        $credentials = array(
           'username' => request('username'),
           'password' => request('password'),
        ); 
      
        if(Auth::attempt($credentials)){
            
            return redirect('/home');
        }
        else
        {   
            alert()->error('Usuario incorrecto');
            return redirect('/');
        } 
    }


    public function username()
    {
      return 'username';
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

   
   
}
