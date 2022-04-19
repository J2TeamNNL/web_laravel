<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->get('level') === 0) {
            throw new \Exception('Khong duoc lam the, dung lai di');
        }
        return $next($request);
    }
}
