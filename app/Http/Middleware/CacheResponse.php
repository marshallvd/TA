<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class CacheResponse
{
    public function handle($request, Closure $next)
    {
        // Menggunakan URL lengkap sebagai kunci cache
        $key = $request->fullUrl();
        $cachedResponse = Cache::get($key);

        // Jika ada response yang sudah di-cache, kembalikan response tersebut
        if ($cachedResponse) {
            return response($cachedResponse);
        }

        // Jika tidak ada, teruskan permintaan ke aplikasi
        $response = $next($request);

        // Simpan response dalam cache
        Cache::put($key, $response->getContent(), 60); // Simpan selama 60 detik

        return $response;
    }
}
