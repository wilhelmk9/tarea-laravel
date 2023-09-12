<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;


class FormularioController extends Controller
{
    public function divisionInformacion(Request $request)
    {
        try {
            if ($request['create']) {
                $this->crearEstudiante($request);
            } elseif ($request['delete']) {
                $this->eliminarEstudiante($request);
            } elseif ($request['update']) {
                $this->actualizarEstudiante($request);
            }

            // Asegúrate de que siempre haya una redirección al final de la función
            return redirect('tabla');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('error', ['error' => $e->getMessage()]);
        }
    }

    private function crearEstudiante($request): void
    {
        try {
            // Crear un arreglo con los datos del estudiante
            $datosEstudiantes = [
                'carne' => $request['carne'],
                'nombres' => $request['nombres'],
                'apellidos' => $request['apellidos'],
                'direccion' => $request['direccion'],
                'telefono' => $request['telefono'],
                'correo_electronico' => $request['correo_electronico'],
                'id_tipo_sangre' => $request['tipo_sangre'],
                'fecha_nacimiento' => $request['fecha_nacimiento'],
            ];

            // Crear un nuevo estudiante utilizando Eloquent ORM
            $estudiante =  Estudiante::create($datosEstudiantes);
        } catch (Exception $e) {
            // Manejar la excepción de manera apropiada, como registrarla o mostrar un mensaje de error
            throw new Exception('Error al crear estudiante: ' . $e->getMessage());
        }
    }


    private function actualizarEstudiante($request): void
    {
        try {
            DB::beginTransaction();
            // Encontrar el estudiante por id_estudiante y actualizar sus propiedades
            $estudianteExiste = Estudiante::find($request['id_estudiante']);
            if ($estudianteExiste) {
                $estudianteExiste->carne = $request['carne'];
                $estudianteExiste->nombres = $request['nombres'];
                $estudianteExiste->apellidos = $request['apellidos'];
                $estudianteExiste->direccion = $request['direccion'];
                $estudianteExiste->telefono = $request['telefono'];
                $estudianteExiste->correo_electronico = $request['correo_electronico'];
                $estudianteExiste->id_tipo_sangre = $request['tipo_sangre'];
                $estudianteExiste->fecha_nacimiento = $request['fecha_nacimiento'];
                // Guardar los cambios en el estudiante
                $estudianteExiste->save();
                DB::commit();
            } else {
                throw new Exception('Estudiante no encontrado');
            }
        } catch (Exception $e) { // Usa la clase Exception
            DB::rollBack();
            throw new Exception('Error al actualizar estudiante: ' . $e->getMessage());
        }
    }

    private function eliminarEstudiante($informacion): void
    {
        try {
            DB::beginTransaction();
            // Encontrar y eliminar el estudiante por id_estudiante
            Estudiante::where('id_estudiante', $informacion['id_estudiante'])->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception('Error al eliminar estudiante: ' . $th->getMessage());
        }
    }
}
