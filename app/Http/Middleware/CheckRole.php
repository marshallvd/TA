<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Debug logging
        \Log::info('=== Role Check Debug ===');
        \Log::info('Request URL: ' . $request->url());
        \Log::info('Required roles:', $roles);
        
        // Check if user is authenticated
        if (!$request->user()) {
            \Log::info('User is not authenticated');
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Log user info
        \Log::info('User ID: ' . $request->user()->id);
        \Log::info('User Role ID: ' . $request->user()->id_role);

        // Convert role ID to role name for comparison
        $userRole = $this->getRoleName($request->user()->id_role);
        \Log::info('User role name: ' . $userRole);

        // Check if user's role is in allowed roles
        if (in_array($userRole, $roles)) {
            \Log::info('Access granted for role: ' . $userRole);
            return $next($request);
        }

        // Log forbidden access
        \Log::info('Access forbidden. User role ' . $userRole . ' not in allowed roles: ' . implode(', ', $roles));
        return response()->json(['message' => 'Forbidden access'], 403);
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
        ];

        $roleName = $roles[$roleId] ?? 'unknown';
        \Log::info('Role conversion: ID ' . $roleId . ' => ' . $roleName);
        return $roleName;
    }
}