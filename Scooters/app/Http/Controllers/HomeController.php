<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            // Logika dla kierownika
            return view('home')->with('role', 'admin');
        } elseif (auth()->user()->isEmployee()) {
            // Logika dla pracownika
            return view('home')->with('role', 'employee');
        } else {
            // Logika dla innych typów użytkowników
            return view('home')->with('role', 'default');
        }
    
}
}
