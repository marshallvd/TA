<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // Convert role ID to role name for comparison
        $userRole = $this->getRoleName($request->user()->id_role);
        
        // Check if user's role is in allowed roles
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // If role doesn't match, return forbidden response
        return response()->json([
            'message' => 'Forbidden access'
        ], 403);
    }

    /**
     * Convert role ID to role name
     */
    private function getRoleName(int $roleId): string
    {
        $roles = [
            1 => 'admin',
            2 => 'hrd',
            3 => 'pegawai'
            // Tambahkan role lain jika ada
        ];

        return $roles[$roleId] ?? 'unknown';
    }
}