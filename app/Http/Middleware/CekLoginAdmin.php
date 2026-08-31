<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLoginAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}