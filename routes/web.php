<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('logout', function () {
    Session::forget('userinfo');
    return redirect('login');
});
Route::view('login','auth.login');
Route::post('login',[UserController::class,'login']);
Route::view('register','auth.register');
Route::post('register',[UserController::class,'register']);
// Route::view('/','layouts.index');
Route::get('/',[ProductController::class,'index']);
Route::get('detail/{id}',[ProductController::class,'detail']);
Route::get('search',[ProductController::class,'search']);
Route::post('add_to_cart',[ProductController::class,'addToCart']);
Route::get('cartlist',[ProductController::class,'cartList']);
Route::get('removecart/{id}',[ProductController::class,'removeCart']);
Route::get('ordernow',[ProductController::class,'orderNow']);
Route::post('orderplace',[ProductController::class,'orderPlace']);
Route::get('myorder',[ProductController::class,'myOrder']);

// ------------------Admin side-----------------------------------------
Route::post('adminLogin',[AdminController::class,'login']);
Route::view('adminLogin','auth.adminLogin');

Route::post('adminRegister',[AdminController::class,'register']);
Route::view('adminRegister','auth.adminRegister');

Route::get('logoutAdmin', function () {
    Session::forget('admininfo');
    return redirect('adminLogin');
});

Route::view('adminhome','admin.index');

Route::get('registeredUser',[AdminController::class,'registeredUser']);

Route::get('registedProducts',[AdminController::class,'registedProducts']);

Route::get('OrderDetails',[AdminController::class,'OrderDetails']);



