<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        if (method_exists($user, 'roles')) {
            $userRoles = $user->roles->pluck('name')->map(fn($r) => trim(strtolower($r)))->toArray();
        } else {
            $userRoles = [trim(strtolower((string) $user->role))];
        }

        $accepted = array_map(fn($r) => trim(strtolower($r)), $roles);

        // cek intersection
        if (empty(array_intersect($userRoles, $accepted))) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
