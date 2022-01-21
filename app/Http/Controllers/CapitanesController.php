<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormulariolRequest;
use App\Models\Capitan;

class CapitanesController extends Controller
{
    //
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
        return view('pages/capitanes');
    }

    public function store(FormulariolRequest $request){

        $validado = $request->validated();


        $capitan = Capitan::create($validado);

        return redirect()->route('capitanes')->with(['message'=>'Listo']);

    }

}
