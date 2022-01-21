<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormularioRequest;
use App\Models\Capitan;
use App\Models\Jugador;
use Illuminate\Http\Request;

class JugadoresController extends Controller
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
        return view('pages/jugadores');
    }

    public function store(FormularioRequest $request){

        $validado = $request->validated();
        
        $capitan = Jugador::create($validado);

        return redirect()->route('jugadores')->with(['message'=>'Listo']);

    }

    public function SearchCapitan($id){

        try{

            $nombre = Capitan::where("cedula",$id)->select("nombres")->first();
            
            if($nombre){
                return response()->json($nombre, 200);
            }else{
                return response()->json(['message'=> 'No se encontró capitan'],404);
            }
        }catch(\Illuminate\Database\QueryException $e ) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }
}
