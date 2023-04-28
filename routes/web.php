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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
    Route::get("",[HomeController::class, 'index'])->middleware(["auth","verified"]);
    Route::get("home",[HomeController::class, 'index'])->middleware(["auth","verified"])->name("home");
    Route::get("register", [RegisterController::class, 'index'])->middleware("guest")->name('auth.register');
    Route::post("register", [RegisterController::class, 'store']);
    Route::get("login",[LoginController::class, 'index'])->middleware("guest")->name("auth.login");
    Route::post("login",[LoginController::class, 'store']);
    Route::post("logout",[LogoutController::class, 'store'])->middleware("auth")->name("auth.logout");
    /*Kafeel*/
    Route::get("kafeel/create",[KafeelController::class, 'create'])->middleware(["auth","verified"])->name("kafeel.create");
    Route::post("kafeel/create",[KafeelController::class, 'store'])->middleware(["auth","verified"]);
    Route::get("kafeel/edit/{id}",[KafeelController::class,'edit'])->middleware(["auth","verified"])->name("kafeel.edit");
    Route::post("kafeel/update/{id}",[KafeelController::class,'update'])->middleware(["auth","verified"])->name("kafeel.update");
    /*Installment Request*/
    Route::get("installments",[InstallmentRequestController::class,'index'])->middleware(["auth","verified"])->name("installmentRequest.index");
    Route::get('installments/create',[InstallmentRequestController::class,'create'])->middleware(["auth","verified"])->name("installmentRequest.create");
    Route::post('installments/create',[InstallmentRequestController::class,'store'])->middleware(["auth","verified"]);
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
    Route::get("/installments",[InstallmentRequestController::class,'all'])->middleware('role:super-admin')->name("allInstallmentRequests");
    Route::get("/installments/rejected",[InstallmentRequestController::class,'allRejected'])->middleware('role:super-admin')->name("allRejectedInstallmentRequests");
    Route::get("/installments/approved",[InstallmentRequestController::class,'allApproved'])->middleware('role:super-admin')->name("allApprovedInstallmentRequests");
    Route::get("/installments/pending",[InstallmentRequestController::class,'allPending'])->name("allPendingInstallmentRequests");

    Route::get("/installments/create",[InstallmentRequestController::class, 'adminAddInstallmentRequest'])->middleware('role:super-admin')->name("adminAddInstallmentRequest");
    Route::post("/installments/create",[InstallmentRequestController::class, 'adminStoreInstallmentRequest'])->middleware('role:super-admin')->name("adminStoreInstallmentRequest");


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
    Route::resource("moderators",'App\Http\Controllers\ModeratorsController');
    Route::post("/sms/send",[\App\Http\Controllers\SMSController::class,'send'])->name("sendSMS");
});
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
