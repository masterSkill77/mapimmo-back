<?php

namespace App\Http\Middleware;

use App\Exceptions\IsNotAdminException;
use App\Services\AdminService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminService = new AdminService();
        if ($adminService->isAdmin($request->user()))
            return $next($request);
        throw new IsNotAdminException;
    }
}
