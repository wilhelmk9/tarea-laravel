<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TablaController;
use App\Http\Controllers\AgregarController;
use App\Http\Controllers\FormularioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 
Route::get('/', [TablaController::class, 'showTable']);
Route::get('agregar', [AgregarController::class, 'showAdd']);
Route::post('procesarFormulario', [FormularioController::class, 'divisionInformacion']);
