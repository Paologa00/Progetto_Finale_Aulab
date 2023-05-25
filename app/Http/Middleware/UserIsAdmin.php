<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\UserIsAdmin;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserIsAdmin
{

    public function handle(Request $request, Closure $next)
    {

        if(Auth::user() && Auth::user()->is_admin){
            return $next($request);
        }

        return redirect(route('homepage'))->with('message', 'Non sei autorizzato');
    }

}
