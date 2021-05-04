<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;  
use Hash;

class UserController extends Controller
{
    public function login(Request $req)
    {
        $req->validate([
            'email'=>'required|email',
            'password'=>'required'            
        ]);
        $user=User::where(['email'=>$req->email])->first();
        
        if(!$user){
            return "username and password is wrong";
        }
        else
        {
             if(Hash::check($req->password,$user->password)){
                 $req->session()->put('userinfo',$user);
                 return redirect('/');
             }
        }
        // return $req->input();
    }
}
