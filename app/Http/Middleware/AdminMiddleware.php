<?php

namespace CodeCommerce\Http\Middleware;

use Closure;

class AdminMiddleware extends Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            if ($this->auth->user()->isAdmin()) {
                return $next($request);
            } else {
                return response('Unauthorized.', 401);
            }
        } else {
            return redirect()->guest('auth/login');
        }
    }

}
