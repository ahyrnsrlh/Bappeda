<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApprovalStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login
        if ($request->user()) {
            // Kepala Bidang tidak perlu approval
            if ($request->user()->role === 'kabid') {
                return $next($request);
            }
            
            // Cek apakah user sudah diapprove
            if (!$request->user()->is_approved) {
                // Logout user yang belum diapprove
                auth()->logout();
                
                return redirect()->route('login')->with('error', 'Akun Anda belum disetujui oleh Kepala Bidang. Silakan hubungi administrator.');
            }
        }
        
        return $next($request);
    }
}
