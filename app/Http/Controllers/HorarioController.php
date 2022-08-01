<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horario = DB::select('select distinct dia from nominas');
        return view('horario/horario', compact('horario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados=DB::select('select nombre, id as empleado from empleados limit 2');
        return view('horario/listaHorario', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Horario $horarios, Request $request)
    {
            $request->validate([
                'dia'=> 'required|unique:App\Models\Nomina,dia'
                ]);
            for ($i = 0; $i < count($request->id); $i ++) {
                DB::insert('insert into nominas(empleado, dia, semana, entrada, salida_comida, entrada_comida, salida, extra) values (?, ?, ?, ?, ?, ?, ?, ?)', 
                [$request->id[$i], $request->dia, date("W", strtotime($request->dia)), $request->entrada[$i], $request->salida_comida[$i], $request->entrada_comida[$i], $request->salida[$i], $request->extra[$i]]);
            }
            return redirect()->route('horario.index');
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
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Horario $horarios, Request $request)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function actualizar(Request $request)
    {
        for ($i = 0; $i < count($request->id); $i ++) {
            DB::update('update nominas set entrada=?, salida_comida=?, entrada_comida=?, salida=?, extra=? where empleado=?', 
            [$request->entrada[$i], $request->salida_comida[$i], $request->entrada_comida[$i], $request->salida[$i], $request->extra[$i], $request->id[$i]]);
        }
        return redirect()->route('horario.index');
    }
    
    public function editar(Request $request){
        $horario=DB::select('select empleados.nombre, nominas.empleado, nominas.entrada, nominas.entrada_comida, nominas.salida_comida, nominas.salida, nominas.extra from nominas left join empleados on nominas.empleado=empleados.id where dia=?', [$request->dia]);
        return view('horario/listaHorario', compact('horario'));
    }

    public function nomina(){
        $horario = DB::select('select distinct semana from nominas');
        return view('horario/nomina', compact('horario'));
    }

    public function nominaInforme(Request $request){
        $empleadoS = DB::select('select distinct nominas.empleado, empleados.nombre, empleados.apellido from nominas left join empleados on nominas.empleado=empleados.id where semana=?', [$request->semana]);
        //foreach ($empleados as )
        $horarioS = DB::select('select nominas.dia, nominas.empleado as id, nominas.entrada, nominas.entrada_comida, nominas.salida_comida, nominas.salida, nominas.total_horas, nominas.extra, nominas.salario from nominas where semana=?',
        [$request->semana]);
        $semana=$request->semana;
        return view('horario/horarioInforme', compact('horarioS', 'empleadoS', 'semana'));
    }

}
