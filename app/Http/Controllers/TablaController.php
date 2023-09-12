<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TablaController extends Controller
{
    public function showTable()
    {
        $hostPort = env('APP_PORT');
        $hostDirection = env('DB_HOST');
        $estudiantes = DB::table("estudiantes")
            ->join('tipos_sangre', 'tipos_sangre.id_tipo_sangre', '=', 'estudiantes.id_tipo_sangre')
            ->select('*')
            ->get();
        return view(
            'tabla',
            [
                'hostPort' => $hostPort,
                'estudiantes' => $estudiantes,
                'hostDirection' => $hostDirection
            ]
        );
    }
}
