<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLang($locale)
    {
        // App::setLocale($locale);
        // Cookie::expire('lang');
        // $cookie = request()->cookie('lang', $locale, 60);
        // return  redirect()->back()->withCookie($cookie);

        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
