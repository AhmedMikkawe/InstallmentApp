<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ExportsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\InstallmentRequestController;
use App\Http\Controllers\InviteCodeController;
use App\Http\Controllers\KafeelController;
use App\Http\Controllers\ProfileController;
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
    /*Installment Request*/
    Route::get("installments",[InstallmentRequestController::class,'index'])->middleware('auth')->name("installmentRequest.index");
    Route::get('installments/create',[InstallmentRequestController::class,'create'])->middleware('auth')->name("installmentRequest.create");
    Route::post('installments/create',[InstallmentRequestController::class,'store'])->middleware('auth');
    Route::get("installments/{id}",[InstallmentController::class, 'show'])->middleware(["auth","installment_request_is_approved"])->name("installmentRequest.show");
    Route::post("installments/{id}",[InstallmentController::class, 'store'])->middleware("auth")->name("installment.store");

});
Route::group(['prefix'=>"admin","middleware"=>["auth","role:super-admin|moderator"]],function(){
    Route::get('/',[AdminController::class,'index'])->name("admin");
    Route::get("/invite_code", [InviteCodeController::class, 'index'])->name("invite_code.index");

    Route::get("/invite_code/create", [InviteCodeController::class, 'create'])->name("invite_code.create");
    Route::get("/invite_code/edit/{id}", [InviteCodeController::class, 'edit'])->name("invite_code.edit");
    Route::post("/invite_code/update/{id}", [InviteCodeController::class, 'update'])->name("invite_code.update");

    Route::post("/invite_code/create", [InviteCodeController::class, 'store']);
    /*Installments*/
    Route::get("/installments",[InstallmentRequestController::class,'all'])->name("allInstallmentRequests");
    Route::get("/installments/rejected",[InstallmentRequestController::class,'allRejected'])->name("allRejectedInstallmentRequests");
    Route::get("/installments/approved",[InstallmentRequestController::class,'allApproved'])->name("allApprovedInstallmentRequests");
    Route::get("/installments/pending",[InstallmentRequestController::class,'allPending'])->name("allPendingInstallmentRequests");

    Route::get("/installments/create",[InstallmentRequestController::class, 'adminAddInstallmentRequest'])->name("adminAddInstallmentRequest");
    Route::post("/installments/create",[InstallmentRequestController::class, 'adminStoreInstallmentRequest'])->name("adminStoreInstallmentRequest");


    Route::get("/installments/{id}",[InstallmentRequestController::class, 'showInstallmentRequest'])->name("certainRequest");
    Route::get("/installments/edit/{id}",[InstallmentRequestController::class, 'editInstallmentRequest'])->name("editCertainRequest");
    Route::post("/installments/edit/{id}",[InstallmentRequestController::class, 'updateInstallmentRequest'])->name("updateCertainRequest");
    Route::post("/installments/{id}",[InstallmentController::class, 'adminStoreInstallment'])->name("adminStoreInstallment");
    Route::delete("/installments/{id}/delete/{id2}",[InstallmentController::class, 'adminDeleteInstallment'])->name("adminDeleteInstallment");
    Route::get("/installments/{id}/edit/{id2}",[InstallmentController::class, 'adminEditInstallment'])->name("adminEditInstallment");
    Route::post("/installments/{id}/edit/{id2}",[InstallmentController::class, 'adminUpdateInstallment'])->name("adminUpdateInstallment");
    /*Exports*/
    Route::get('/exports/users',[ExportsController::class,'users'])->name('export.users');
    Route::get('/exports/kafeels',[ExportsController::class,'kafeels'])->name('export.kafeels');
    Route::get('/exports/installment_requests',[ExportsController::class,'installment_requests'])->name('export.installment_requests');
    Route::get('/exports/installments',[ExportsController::class,'installments'])->name('export.installments');
    /*Edit Profile*/
    Route::get("/profile/edit",[ProfileController::class, 'edit'])->name('profile.edit');
    Route::post("/profile/edit",[ProfileController::class, 'update'])->name('profile.update');
    Route::post("/profile/changePassword",[ProfileController::class,'changePassword'])->name('changePassword');
});
