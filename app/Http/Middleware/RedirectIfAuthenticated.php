<?php

namespace App\Http\Middleware;
use App\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                   
                   // foreach (Auth::user('admin')->role as $role) 
                   //        {
                   //          echo $role->name;
                   //        }
                    return redirect('admin/home');


                }
                break;

            case 'superadmin':
                if (Auth::guard($guard)->check()) {
                    return redirect('superadmin/home');
                }
                break;
            
            default:
               if (Auth::guard($guard)->check()) {
                   return redirect('/home');
               }
                break;
        }

       

        return $next($request);
    }
}
