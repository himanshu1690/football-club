<?php


namespace App\Http\Middleware;

use Closure;

class RoleCheck
{
    public function handle($request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->hasRole($role)) {
            return $next($request);
        }

        return redirect('login');
    }
}
