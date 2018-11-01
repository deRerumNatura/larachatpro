<?php

namespace App\Http\Middleware;

use Closure;

class IsAvailableToChat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->baned == 1 || $request->user()->disabled == 1) {
            return redirect()->route('user.dashboard');
        }
        return $next($request);
    }
}
