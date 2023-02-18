<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InviteCodeController;
use App\Http\Controllers\KafeelController;
use Illuminate\Support\Facades\Route;

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


Route::group(["prefix"=>"/"],function(){
    Route::get("",[HomeController::class, 'index'])->middleware("auth");
    Route::get("home",[HomeController::class, 'index'])->middleware("auth")->name("home");
    Route::get("register", [RegisterController::class, 'index'])->middleware("guest")->name('auth.register');
    Route::post("register", [RegisterController::class, 'store']);
    Route::get("login",[LoginController::class, 'index'])->middleware("guest")->name("auth.login");
    Route::post("login",[LoginController::class, 'store']);
    Route::post("logout",[LogoutController::class, 'store'])->middleware("auth")->name("auth.logout");
    /*Kafeel*/
    Route::get("kafeel/create",[KafeelController::class, 'create'])->middleware('auth')->name("kafeel.create");
    Route::post("kafeel/create",[KafeelController::class, 'store'])->middleware('auth');
    Route::get("kafeel/edit/{id}",[KafeelController::class,'edit'])->middleware('auth')->name("kafeel.edit");
    Route::post("kafeel/update/{id}",[KafeelController::class,'update'])->middleware('auth')->name("kafeel.update");
});
Route::group(['prefix'=>"admin","middleware"=>["auth","role:super-admin"]],function(){
    Route::get('/',function(){
        return view('admin.index');
    })->name("admin");
    Route::get("/invite_code", [InviteCodeController::class, 'index'])->name("invite_code.index");

    Route::get("/invite_code/create", [InviteCodeController::class, 'create'])->name("invite_code.create");
    Route::get("/invite_code/edit/{id}", [InviteCodeController::class, 'edit'])->name("invite_code.edit");
    Route::post("/invite_code/update/{id}", [InviteCodeController::class, 'update'])->name("invite_code.update");

    Route::post("/invite_code/create", [InviteCodeController::class, 'store']);
});
