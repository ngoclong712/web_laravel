<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function form()
    {
        return view('form');
    }

    public function post(Request $request)
    {
        $a = $request -> input('a');

        return view('show', compact('a'));
    }
}
