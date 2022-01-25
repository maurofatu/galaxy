<?php

namespace App\Exports;

use App\Models\Capitan;
use App\Models\Jugador;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;



class JugadoresExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        // $objeto = (Illuminate\Support\Collection)array(
        //     (object)array(
        //         'cedula lider' => '1234',
        //         'ceudla' => '1234', 
        //         'nombres' => 'pedro',
        //     ),
        //     (object)array(
        //         'cedula lider' => '1234',
        //         'ceudla' => '1234', 
        //         'nombres' => 'maria',
        //     ),
        //     (object)array(
        //         'cedula lider' => '1234',
        //         'ceudla' => '1234', 
        //         'nombres' => 'luis',
        //     ),

        // );
        // var_dump(Jugador::select('cedulalider','cedula','nombres')->get());
        // return $objeto;

        // var_dump(
        //     \DB::table('jugadores')
        //     ->join('capitanes','capitanes.cedula', '=','jugadores.cedulalider')
        //     ->limit(2)
        //     ->get()
        // );

        return DB::table('jugadores')
            ->join('capitanes', 'capitanes.cedula', '=', 'jugadores.cedulalider')
            ->select('capitanes.cedula as cedulacapi', 'capitanes.nombres as nombrecapi', 'jugadores.cedula', 'jugadores.nombres', 'jugadores.depvot', 'jugadores.munvot', 'jugadores.lugvot', 'jugadores.mesvot', 'jugadores.celular', 'jugadores.municipio', 'jugadores.comuna', 'jugadores.barrio', 'jugadores.direccion', 'jugadores.email', 'jugadores.fecnac', 'jugadores.genero', 'jugadores.poblacion', 'jugadores.ocupacion', 'jugadores.profesion', 'jugadores.aporte')
            ->get();


        // return Jugador::select('capitanes.cedula','capitanes.nombres','jugadores.cedula','jugadores.nombres')
        // ->join('capitanes','capitanes.cedula', '=', 'jugadores.cedulalider')
        // ->limit(2)
        // ->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'cedulalider',
            'cedula',
            'nombres',
            'depvot',
            'munvot',
            'lugvot',
            'mesvot',
            'celular',
            'municipio',
            'comuna',
            'barrio',
            'direccion',
            'email',
            'fecnac',
            'genero',
            'poblacion',
            'ocupacion',
            'profesion',
            'aporte',
        ];
    }
}
