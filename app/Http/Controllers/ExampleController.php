<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show($id)
    {
        return view('home');
    }

    public function lang($lang)
    {
        if ($lang) {
            $locale = $lang;
        } else {
            $locale = 'en'; // Default to English
        }
        app()->setLocale($locale);

        return redirect()->back();
        // app('translator')->getLocale()
    }

//
}
