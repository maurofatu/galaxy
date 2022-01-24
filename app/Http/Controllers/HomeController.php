<?php

namespace App\Http\Controllers;

use App\Models\Capitan;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $totalcapi = Capitan::count();
        $totaljuga = Jugador::count();
        session(['totalcapi' => $totalcapi]);
        session(['totaljuga' => $totaljuga]);

        return view('dashboard');
    }
}
