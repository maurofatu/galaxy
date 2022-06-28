<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormularioRequest;
use App\Models\Capitan;
use App\Models\Gener03;
use App\Models\Gener04;
use App\Models\Gener05;
use App\Models\Gener06;
use App\Models\Gener07;
use App\Models\Gener08;
use App\Models\Gener09;
use App\Models\Gener10;
use App\Models\Gener11;
use App\Models\Gener12;
use App\Models\Gener13;
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

        $facvul = Gener03::get();
        $vivienda = Gener04::get();
        $discapacidad = Gener05::get();
        $ocupacion = Gener06::get();
        $nivedu = Gener07::get();
        $etnia = Gener08::get();
        $profesion = Gener09::get();
        $municipio = Gener10::get();
        $comuna = Gener11::get();
        $lider = Gener13::get();

        $data = [
            'result' => $result,
            'jugadoreslist' => $jugadoreslist,
            'facvul' => $facvul,
            'ocupacion' => $ocupacion,
            'vivienda' => $vivienda,
            'discapacidad' => $discapacidad,
            'nivedu' => $nivedu,
            'etnia' => $etnia,
            'profesion' => $profesion,
            'municipio' => $municipio,
            'comuna' => $comuna,
            'lider' => $lider,
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

        // return response()->json($request);
        $jugador = Jugador::firstWhere('cedula', $request['cedula']);

        try {
            // $mcargo = $request['empleado'] == 'N' ? '' : $request['empleado'];
            $comuna = $request['municipio'] == '81001' ? $request['comuna'] : $request['comuna2'];
            $barrio = $request['municipio'] == '81001' ? $request['barrio'] : $request['barrio2'];
            $jugador->update([
                'nombres' => $request['nombres'],
                'depvot' => $request['depvot'],
                'munvot' => $request['munvot'],
                'lugvot' => $request['lugvot'],
                'mesvot' => $request['mesvot'],
                'celular' => $request['celular'],
                'municipio' => $request['municipio'],
                'comuna' => $comuna,
                'barrio' => $barrio,
                'direccion' => $request['direccion'],
                'email' => $request['email'],
                'fecnac' => $request['fecnac'],
                'genero' => $request['genero'],
                'poblacion' => $request['poblacion'],
                'ocupacion' => $request['ocupacion'],
                'profesion' => $request['profesion'],
                'vivienda' => $request['vivienda'],
                'zona' => $request['zona'],
                'tipdis' => $request['tipdis'],
                'empleado' => $request['empleado'],
                'cargo' =>  $request['cargo'],
                'aporte' => $request['aporte'],
                'whatsapp' => $request['whatsapp'],
                'nivedu' => $request['nivedu'],
                'etnia' => $request['etnia'],
                'postgrado' => $request['postgrado'],
                'lider' => $request['lider'],
                'liderotro' => $request['liderotro'],
            ]);

            return redirect()->route('consultajugadores')->with(['success' => 'Actualizado con exito!']);
        } catch (Exception $ex) {
            return redirect()->route('consultajugadores')->with(['error' => 'Error: ' . $ex->getMessage()]);
        }
    }

    public function SearchBarrio($id)
    {

        try {

            $barrios = Gener12::where("comuna", $id)->orderBy("detalle")->get(["id","detalle"]);
            if ($barrios) {
                return response()->json($barrios, 200);
            } else {
                return response()->json(['message' => 'No se encontró barrios'], 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
