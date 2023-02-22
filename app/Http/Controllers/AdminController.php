<?php

namespace App\Http\Controllers;

use App\Models\InstallmentRequest;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index(){
        $newRequests = InstallmentRequest::where('request_status', 'pending')->count();
        $users = User::doesntHave('roles')->get()->count();
        return view("admin.index", ['newRequests'=>$newRequests, 'users'=>$users]);
    }
}
