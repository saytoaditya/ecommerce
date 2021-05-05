<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User; 
use Validator; 
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
    public function register(Request $req){
        // $this->validate($req, [
        //     'email'=> 'required|max:255|email|unique:users',
        //     'password'  => 'required',
        //     'name'    => 'required|unique:users,name',
        // ]);
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);

        $user= New User;
        $user->name=$req->name;
        $user-> email=$req->email;
        $user->password=Hash::make($req->password);
        $user->save();
        return redirect('login');
    }
}
