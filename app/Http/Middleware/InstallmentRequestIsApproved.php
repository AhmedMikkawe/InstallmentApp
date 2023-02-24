<?php

namespace App\Http\Middleware;

use App\Models\InstallmentRequest;
use Closure;
use Illuminate\Http\Request;

class InstallmentRequestIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $installmentRequest = InstallmentRequest::findOrFail($request->id);
        if ($installmentRequest->request_status == 'approved'){
            return $next($request);
        }
        return redirect()->route('installmentRequest.index');
    }
}
