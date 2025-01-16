<?php

namespace App\Http\Middleware;

use App\Models\AdminLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OrderModificationByAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \Illuminate\Http\Response $response */

        $response = $next($request);

        AdminLog::query()->create([
            'user_id' => Auth::guard('web')->id(),
            'request' => $request->all(),
            'response' => $response->status(),
        ]);

        return $response;
    }
}
