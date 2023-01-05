<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isReviewer
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
        return $next($request);if($request->user() && $request->user()->akses == 'reviewer'){
            return $next($request);
        }
        $notification = array(
            'message' => 'Gagal, anda tidak memiliki akses sebagai reviewer!',
            'alert-type' => 'error'
        );
        return redirect()->route('login')->with($notification);
    }
}
