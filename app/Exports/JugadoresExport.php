<?php

namespace App\Exports;

use App\Models\Capitan;
use App\Models\Jugador;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JugadoresExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return DB::table('jugadores')
            ->join('capitanes', 'capitanes.cedula', '=', 'jugadores.cedulalider')
            ->select('capitanes.cedula as cedulacapi', 'capitanes.nombres as nombrecapi', 'jugadores.cedula', 'jugadores.nombres', 'jugadores.depvot', 'jugadores.munvot', 'jugadores.lugvot', 'jugadores.mesvot', 'jugadores.celular', 'jugadores.municipio', 'jugadores.comuna', 'jugadores.barrio', 'jugadores.direccion', 'jugadores.email', 'jugadores.fecnac', 'jugadores.genero', 'jugadores.poblacion', 'jugadores.ocupacion', 'jugadores.profesion', 'jugadores.aporte')
            ->get();

    }

    public function headings(): array
    {
        return [
            'Cédula Capitan',
            'Nombre Capitan',
            'Cédula',
            'Nombres',
            'Departamendo Votación',
            'Municipio Votación',
            'Lugar Votación',
            'Mesa Votación',
            'Celular',
            'Municipio Residencia',
            'Comuna',
            'Barrio',
            'Dirección',
            'Email',
            'Fecha Nacimiento',
            'Género',
            'Población',
            'Ocupación',
            'Profesión',
            'Aporte',
        ];
    }
}
