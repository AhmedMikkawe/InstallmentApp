<?php

namespace App\Http\Controllers;

use App\Exports\InstallmentRequestsExport;
use App\Exports\InstallmentsExport;
use App\Exports\KafeelsExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportsController extends Controller
{
    public function users()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function kafeels(){
        return Excel::download(new KafeelsExport, 'kafeels.xlsx');
    }
    public function installment_requests(){
        return Excel::download(new InstallmentRequestsExport, 'installmentRequests.xlsx');

    }
    public function installments(){
        return Excel::download(new InstallmentsExport, 'installments.xlsx');
    }

}
