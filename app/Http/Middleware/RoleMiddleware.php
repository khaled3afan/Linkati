<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @param array                     $roles
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if ( ! auth()->check()) {
            if (str_is('*/admin*', $request->url())) {
                return response()->view('auth.login');
            } elseif (str_is('*/api/*', $request->url())) {
                return response([
                    'data' => trans('auth.failed')
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->view('auth.login');
        } elseif ( ! in_array($request->user()->role, $roles)) {
            return redirect('/');
        }

        return $next($request);
    }
}
