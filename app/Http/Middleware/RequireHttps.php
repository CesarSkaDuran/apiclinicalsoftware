<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireHttps
{
    public function handle(Request $request, Closure $next)
    {
        $remoteAddress = $request->server('REMOTE_ADDR');
        $localDevelopment = app()->environment('local') && in_array($remoteAddress, ['127.0.0.1', '::1'], true);

        if (!$request->secure() && !$localDevelopment) {
            return response()->json(['message' => 'Esta API solo acepta conexiones HTTPS.'], 426);
        }

        return $next($request);
    }
}
