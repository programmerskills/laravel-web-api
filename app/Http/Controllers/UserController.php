<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth;
use Validator;
use Cookie;
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
       $remember=$request->input('remember');
       $email=$request->input('email');
       $pass=$request->input('password');
    //    if($remember==1)
    //         {
    //             //Cookie::forever('email_cookies',$email);
    //             Cookie::make('email_cookies', $email, 120);
    //             //Cookie::forever('password_cookies',$pass);
    //             return Cookie::get('email_cookies');
    //         }
        if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password'),'role'=>1]))
        {
            //$user=auth()->User();
            //print_r($user);
            //return $remember;
            
           
            return redirect('admin/dashboard');
        }
    }
}
