<?php

namespace Mahesvaran\LaravelAcl\Middleware;

use Closure;

class LaravelAcl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $route = \Route::getCurrentRoute();
        $actionName = $route->getActionName();
        if (!empty($actionName) && $actionName !== 'Closure') {
             $segments = explode('@', $actionName);
             $controller = \App::make($segments[0]);
             $controller->authorize($route->getName());
        }
        return $next($request);
    }
}
