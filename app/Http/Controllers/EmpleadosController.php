<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleado = DB::select('select empleados.id, empleados.nombre, empleados.apellido, empleados.fecha_ingreso, departamentos.nombre as departamento, empleados.puesto, empleados.salario from empleados left join departamentos on departamentos.id=empleados.departamento');
        return view('empleado/listaEmpleados', compact('empleado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos=DB::select('select nombre from departamentos');
        return view('empleado/insertarEmpleado', compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'nombre'=> 'required|max:255',
        'apellido'=> 'required|max:255',
        'id'=> 'required|numeric|unique:App\Models\Empleados,id', 
        'fecha'=> 'required',
        'salario'=> 'required|numeric',
        'nss'=> 'required|digits:11',
        'puesto'=> 'required|max:255',
        ]);
        $numD = DB::select('select id from departamentos where nombre = ?', [$request->departamento]);
        DB::insert('insert into empleados(id, nombre, apellido, salario, nss, departamento, puesto, fecha_ingreso) values (?, ?, ?, ?, ?, ?, ?, ?)',
        [$request->id, $request->nombre, $request->apellido, $request->salario, $request->nss, $numD[0]->id, $request->puesto, $request->fecha]);
        return redirect()->route('empleado.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleados $empleado)
    {
        //$empleado=DB::select('select * from empleados where id=? limit 1', [$empleados]);
        //foreach ($empleado as $p) {
		//}
        $departamentos=DB::select('select nombre from departamentos');
        return view('empleado/insertarEmpleado', compact('empleado', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleados $empleados, $id)
    {
        $request->validate([
            'nombre'=> 'required|max:255',
            'apellido'=> 'required|max:255',
            'salario'=> 'required|numeric',
            'departamento'=> 'required|max:255',
            'puesto'=> 'required|max:255',
            ]);
        $numD = DB::select('select id from departamentos where nombre = ?', [$request->departamento]);
        DB::update('update empleados set nombre=?, apellido=?, salario=?, departamento=?, puesto=? where id=?',
        [$request->nombre, $request->apellido, $request->salario, $numD[0]->id, $request->puesto, $id]);
        return redirect()->route('empleado.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from empleados where id=?', [$id]);
        return redirect()->route('empleado.index');
    }
}
