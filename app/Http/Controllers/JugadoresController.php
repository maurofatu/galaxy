<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormularioRequest;
use App\Models\Capitan;
use App\Models\Jugador;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function store(FormularioRequest $request)
    {

        try {
            $validado = $request->validated();

            Jugador::create($validado);

            return redirect()->route('jugadores')->with(['success' => 'Agregado con exito!']);
        } catch (Exception $ex) {
            return redirect()->route('jugadores')->with(['error' => 'Error ' . $ex->getMessage()]);
        }
    }

    public function SearchCapitan($id)
    {

        try {

            $nombre = Capitan::where("cedula", $id)->select("nombres")->first();

            if ($nombre) {
                return response()->json($nombre, 200);
            } else {
                return response()->json(['message' => 'No se encontró capitan'], 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function ConsultaJugadores()
    {

        $cedula = auth()->user()->cedula;
        // $jugadoreslist = Jugador::select('cedula', 'nombres')->get();
        $jugadoreslist = Jugador::where('cedulalider', $cedula)->get();
        $result = Capitan::where('cedula', '111')->where('nombres', '<>', 'mauro')->get();
        $data = [
            'result' => $result,
            'jugadoreslist' => $jugadoreslist,
            'status' => 200
        ];
        // return view('pages/consulta',["data"=>$data]);
        return view('pages/consultajugadores', ["data" => $data]);
    }

    public function InfoJugador($cedula)
    {

        try {

            $jugadorlist = Jugador::where("cedula", $cedula)->get();

            if ($jugadorlist) {
                return response()->json($jugadorlist, 200);
            } else {
                return response()->json(['message' => 'No se encontró jugadores'], 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function EditarJugador(Request $request)
    {


        $jugador = Jugador::firstWhere('cedula', $request['cedula']);

        try {
            $jugador->update([
                'nombres' => $request['nombres'],
                'depvot' => $request['depvot'],
                'munvot' => $request['munvot'],
                'lugvot' => $request['lugvot'],
                'mesvot' => $request['mesvot'],
                'celular' => $request['celular'],
                'municipio' => $request['municipio'],
                'comuna' => $request['comuna'],
                'barrio' => $request['barrio'],
                'direccion' => $request['direccion'],
                'email' => $request['email'],
                'fecnac' => $request['fecnac'],
                'genero' => $request['genero'],
                'poblacion' => $request['poblacion'],
                'ocupacion' => $request['ocupacion'],
                'profesion' => $request['profesion'],
                'aporte' => $request['aporte'],
            ]);

            return redirect()->route('consultajugadores')->with(['success' => 'Actualizado con exito!']);
        } catch (Exception $ex) {
            return redirect()->route('consultajugadores')->with(['error' => 'Error: ' . $ex->getMessage()]);
        }
    }

}
