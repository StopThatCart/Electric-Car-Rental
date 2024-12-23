<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Session::get("locale") !=null){
            App::setLocale(Session::get("locale"));

        }else{
            Session::put("locale","pl");
            App::setLocale(Session::get("locale"));
        }
        //request()->cookie('lang', 'pl', 60);
        //request()->cookie('itm_name');

        //$request->session()->get('lang');
        // if(request()->cookie("lang") !=null){
        //     //App::setLocale(Session::get("locale"));
        //     App::setLocale(request()->cookie("lang"));

        // }else{
        //     request()->cookie('lang', 'pl', 60);
        //    // Session::put("locale","pl");
        //     App::setLocale(request()->cookie("lang"));
        // }

        return $next($request);
    }
}

