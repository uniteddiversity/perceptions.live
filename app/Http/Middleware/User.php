<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if(!Auth::user()->is('user')){
//            Auth::logout();
            return redirect('/');
        }
        $response = $next($request);
        $content = $response->original;
        if ($content instanceof Success) {
            $response->header('Content-Type', 'application/json');
            $response->setStatusCode($content->getStatusCode());
        }
        return $response;
    }
}
