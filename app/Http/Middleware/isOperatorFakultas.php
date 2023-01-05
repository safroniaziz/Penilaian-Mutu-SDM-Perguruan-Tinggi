<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isOperatorFakultas
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
        return $next($request);if($request->user() && $request->user()->akses == 'operator_fakultas'){
            return $next($request);
        }
        $notification = array(
            'message' => 'Gagal, anda tidak memiliki akses sebagai operator fakultas!',
            'alert-type' => 'error'
        );
        return redirect()->route('login')->with($notification);
    }
}
