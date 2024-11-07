<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Notification extends Controller
{
    public function home()
    {
        return view('Home')->with([
            'type' => 'success',
            'message' => 'Welcome to the Home page!'
        ]);
    }

    public function about()
    {
        return view('About')->with([
            'type' => 'info',
            'message' => 'About us page loaded successfully!'
        ]);
    }

    public function contact()
    {
        return view('Contact')->with([
            'type' => 'warning',
            'message' => 'Feel free to contact us!'
        ]);
    }
}
