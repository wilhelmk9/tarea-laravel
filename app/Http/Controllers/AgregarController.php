<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgregarController extends Controller
{
    public function showAdd()
    {
        $tipos = DB::table("tipos_sangre")
        ->select('*')
        ->get();
        return view('agregar',  ['tipos' => $tipos]);
    }
}
