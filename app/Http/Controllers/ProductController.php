<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function index()
    {
        $data= Product::all();
        return view('product',['products'=>$data]);
    }

    function detail($id)
    {
        $data= Product::find($id);
        return view('detail',['product'=>$data]);
    }

    function search(Request $req){
        $data=Product::where('name','like','%'.$req->search.'%')->get();
        return view('search',['searchedProduct'=>$data]);
    }

    function addToCart(request $req)
    {

        if($req->session()->has('userinfo')){
            $cart = new Cart;
            $cart->user_id=$req->session()->get('userinfo')['id'];
            $cart->product_id=$req->product_id; 
            $cart->save();
            return redirect('/');
        }
        else{
            return view ('auth.login');
        }
    }

     static function cartItem(){
        $userId=Session::get('userinfo')['id'];
        return Cart::where('user_id',$userId)->count();   
    }

    function cartlist(){
        $userId=Session::get('userinfo')['id'];
         $data= DB::table('cart')
            ->join('products','cart.product_id','products.id')
            ->select('products.*','cart.id as cart_id')
            ->where('cart.user_id',$userId)
            ->get();
        return view('cartlist',['products'=>$data]);
    }

    function removeCart($id){
        Cart::destroy($id);
        return redirect('cartlist');
    }

    function orderNow(){
        $userId=Session::get('userinfo')['id'];
         $data= DB::table('cart')
            ->join('products','cart.product_id','products.id')
            ->where('cart.user_id',$userId)
            ->sum('products.price');
        return view('ordernow',['total'=>$data]);
    }
    function orderPlace(Request $req)
    {
        $userId= Session::get('userinfo')['id'];
        $allCart=Cart::where('user_id',$userId)->get();
        foreach($allCart as $cart)
        {
            $order= new Order;
            $order->product_id=$cart['product_id'];
            $order->user_id=$cart['user_id'];
            $order->address=$req->address;
            $order->status="pending";
            $order->payment_method=$req->payment;
            $order->payment_status="pending";
            $order->save();
        }
        Cart::where('user_id',$userId)->delete();
        return redirect('/');
        // return $req->input();
    }

    function myOrder()
    {
        $userId= Session::get('userinfo')['id'];
        $orders= DB::table('orders')
          ->join('products','orders.product_id','products.id')
          ->where('orders.user_id',$userId)
          ->get();
 
          return view('myorder',['orders'=>$orders]); 
    }
}
