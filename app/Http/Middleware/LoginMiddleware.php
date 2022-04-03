<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request; 
use App\Models\Admin; 
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class LoginMiddleware
{
    /**
     * Handle an incoming request. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Admin::loginCheck()) {
            $admin = Admin::find(Session::get('userId')); 
            if( $admin->adminType==9 ){
                Session::forget('userId');
                Session::forget('userName');
                Alert::error('Blocked', 'An admin Blocked you for violence any rules.');
                return redirect('/admin-login');
            }else{
                return $next($request);
            }
        }else{
            Alert::error('Error','You Are not Loged in.');
            return redirect('/admin-login');
        }
    }
}
