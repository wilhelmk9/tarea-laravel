<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $table = 'estudiantes';
    protected $primaryKey = 'id_estudiante';

    public $timestamps = false;

    // Define las columnas que se pueden llenar masivamente
    protected $fillable = [
        'carne',
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'correo_electronico',
        'id_tipo_sangre',
        'fecha_nacimiento',
    ];
}
