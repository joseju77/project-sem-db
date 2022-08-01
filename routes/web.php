<?php

use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MueblesController;
use App\Http\Controllers\PedidosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
})->middleware('auth');

route::get('inicio', function(){
    return view('inicio');
})->middleware('auth');

//route::get('/empleados', [PaginasController::class, 'empleados'])->name('empleados');
//route::get('/registroHorario', [PaginasController::class, 'registroHorario'])->name('registroHorario');
//route::get('/insertarEmpleado', [PaginasController::class, 'insertarEmpleado'])->name('insertarEmpleado');
//route::post('/insertarEmpleado', [PaginasController::class, 'insertarEmpleadoDB'])->name('insertarEmpleadoDB');

Route::resource('empleado', EmpleadosController::class)->middleware('auth');

Route::resource('departamento', DepartamentoController::class)->middleware('auth');

Route::resource('horario', HorarioController::class)->middleware('auth')->except([
    'update', 'edit'
]);
route::post('horario/update', [HorarioController::class, 'actualizar'])->name('horario.actualizar');
route::post('horario/edit', [HorarioController::class, 'editar'])->name('horario.editar');
route::get('/nomina', [HorarioController::class, 'nomina'])->name('horario.nomina');
route::post('/nominaF', [HorarioController::class, 'nominaInforme'])->name('horario.nominaF');
route::get('/nominaInforme', function(){
    return view('horario/horarioInforme');
});

Route::resource('clientes', ClientesController::class)->middleware('auth');

Route::resource('muebles', MueblesController::class)->middleware('auth');

Route::resource('pedidos', PedidosController::class)->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
