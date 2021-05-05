<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin; 
use App\Models\User; 
use App\Models\Product; 
use App\Models\Order; 
use Validator; 
use Hash;

class AdminController extends Controller
{
    public function login(Request $req)
    {
        $req->validate([
            'email'=>'required|email',
            'password'=>'required'            
        ]);
        $admin=Admin::where(['email'=>$req->email])->first();
        
        if(!$admin){
            return "username and password is wrong";
        }
        else
        {
             if(Hash::check($req->password,$admin->password)){
                 $req->session()->put('admininfo',$admin);
                 return redirect('adminhome');
             }
        }
        
    }
    public function register(Request $req){
       
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required'
        ]);

        $admin= New Admin;
        $admin->name=$req->name;
        $admin-> email=$req->email;
        $admin->password=Hash::make($req->password);
        $admin->save();
        return redirect('adminLogin');
    }
    function registeredUser(){
        $data=User::all();
        return view('admin.registeredUser',['registeredUser'=>$data]);
    }
    function registedProducts(){
        $data=Product::all();
        return view('admin.registedProducts',['registedProducts'=>$data]);
    }
    function OrderDetails()
    {
        $data=Order::all();
        return view('admin.OrderDetails',['OrderDetails'=>$data]);
    }
}
