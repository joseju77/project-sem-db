<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = DB::select('select departamentos.id, departamentos.nombre, count(empleados.departamento) as cantidad from departamentos left join empleados on empleados.departamento=departamentos.id group by departamentos.id, departamentos.nombre');
        return view('departamento/listaDepartamentos', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departamento/insertarDepartamento');
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
            'nombre'=> 'required|max:255|unique:App\Models\Departamentos,nombre',
            'id'=> 'required|numeric|unique:App\Models\Departamentos,id',
            ]);
            DB::insert('insert into departamentos(id, nombre) values (?, ?)',
            [$request->id, $request->nombre]);
            return redirect()->route('departamento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamentos $departamento)
    {
        return view('departamento/insertarDepartamento', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamentos $departamentos, $id)
    {
        $request->validate([
            'nombre'=> 'required|max:255|unique:App\Models\Departamentos,nombre',
            ]);
        DB::update('update departamentos set nombre=? where id=?',
        [$request->nombre, $id]);
        return redirect()->route('departamento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from departamentos where id=?', [$id]);
        return redirect()->route('departamento.index');
    }
}
