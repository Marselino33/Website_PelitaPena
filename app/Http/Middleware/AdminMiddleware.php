<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->cookie('user_data')) {
            return redirect()->route('user.login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        $userData = json_decode($request->cookie('user_data'), true);
        if ($userData && $userData['role'] === 'admin') {
            return $next($request);
        }
        return redirect()->back()->with('error', 'Akses Anda di tolak');
    }
}
