<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaginasController extends Controller
{
    public function empleados()
    {
        return view('listaEmpleados');
    }

    public function insertarEmpleado()
    {
        return view('insertarEmpleado');
    }

    public function registroHorario()
    {
        return view('registroHorario');
    }

    public function insertarEmpleadoDB(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'max:50'],
        ]);
        DB::insert('insert into empleados(nombre, apellido, salario, nss, departamento, puesto, fecha_ingreso) values (?, ?, ?, ?, ?, ?, ?)',
        [$request->nombre, $request->apellido, $request->salario, $request->nss, $request->departamento, $request->puesto, $request->fecha]);
        return redirect()->route('insertarEmpleado');
    }







}
