<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
// use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate
{
    /**
     * Guard Implementation
     * @var Guard
     */
    protected $auth;

    /**
     * Create new filter instance.
     * @param Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth.signin');
            }
        }

        return $next($request);
    }
}

// class Authenticate extends Middleware
// {
//     *
//      * Get the path the user should be redirected to when they are not authenticated.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return string|null
     
//     protected function redirectTo($request)
//     {
//         if (! $request->expectsJson()) {
//             return route('auth.signin');

//             // return route('login');
//         }
//     }
// }
