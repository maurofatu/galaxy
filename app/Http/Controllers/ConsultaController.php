<?php

namespace App\Http\Controllers;

use App\Models\Capitan;
use App\Models\Jugador;
use Illuminate\Http\Request;

class ConsultaController extends Controller
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
        $capitaneslist = Capitan::select('cedula', 'nombres')->get();
        // $nombre = Capitan::where("cedula",$id)->select("nombres")->first();
        $result = Capitan::where('cedula','111')->where('nombres','<>','mauro')->get();
        $data = [
            'result' => $result,
            'capitaneslist' => $capitaneslist,
            'status' => 200
        ];
        return view('pages/consulta',["data"=>$data]);
    }

    public function SearchJugadores($id){

        try{

            $jugadorlist = Jugador::where("cedulalider",$id)->get();
            
            if($jugadorlist){
                return response()->json($jugadorlist, 200);
            }else{
                return response()->json(['message'=> 'No se encontró jugadores'],404);
            }
        }catch(\Illuminate\Database\QueryException $e ) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }
}
