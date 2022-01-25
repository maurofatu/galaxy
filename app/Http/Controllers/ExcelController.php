<?php

namespace App\Http\Controllers;

use App\Exports\JugadoresExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\JsonResponse;
use App\Models\Jugador;
use Illuminate\Support\Facades\DB;

class ExcelController extends Controller
{
    
    public function JugadoresExport(){

        return Excel::download(new JugadoresExport, 'jugador.xlsx');

    }

}
