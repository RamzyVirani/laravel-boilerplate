<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class CheckAdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = str_replace([$request->route()->action['prefix'] . '.', 'store', 'update'], ['', 'create', 'edit'], $request->route()->action['as']);
        $permissionName = ($routeName == "") ? "dashboard" : $routeName;

        if (\Auth::guest()) {
            if (in_array($routeName, ['login', 'logout', 'password.request', 'password.email', 'password.reset', ''])) {
                // ,'register'
                return $next($request);
            } else {
                // Save Current Route to Redirect the user to this.
                return redirect(route('admin.login'));
            }
        } else if (\Auth::user() &&
            \Entrust::can('adminpanel') &&
            (\Entrust::ability(['super-admin'], [$permissionName]))) {
            return $next($request);
        } else if (\Auth::user() && in_array($routeName, ['logout'])) {
            // Allow the user to logout.
            return $next($request);
        } else if (\Auth::user() && in_array($routeName, ['login'])) {
            // Allow the user to logout.
            return redirect(route('admin.dashboard'));
        } elseif ($permissionName == 'users.profile') {
            if (\Entrust::can('adminpanel')) {
                return $next($request);
            } else {
                return abort(403, 'Unauthorized action . ');
            }
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
