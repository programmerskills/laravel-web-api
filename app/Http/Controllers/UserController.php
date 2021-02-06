<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Cookie;
class UserController extends Controller
{
    public function userLogin(Request $request)
    {
        // return $request->all();
        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required',
        ],
        [
            'email.required'=>'Enter Email Address',
            'password.required'=>'Enter Password',
        ]);
       $email=$request->input('email');
       $pass=$request->input('password');
       $remember=$request->input('remember');
       if($remember==''){$remember=0;}
   
        if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password'),'role'=>1]))
        {
            if($remember==1)
            {
                ;
                Cookie::queue('email', $email, 100);
                Cookie::queue('pass', $pass, 100);
                Cookie::queue('remember', $remember, 100);

            }
            if($remember==0)
            {
                Cookie::queue(Cookie::forget('email'));
                 Cookie::queue(Cookie::forget('pass'));
                  Cookie::queue(Cookie::forget('remember'));
            }
            return redirect('admin/dashboard');
        }
    }
}
