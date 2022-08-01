<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = DB::select('select id, nombre, apellido, domicilio, telefono from clientes');
        return view('clientes/listaClientes', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes/insertarClientes');
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
            'id'=> 'required|numeric|unique:App\Models\Clientes,id', 
            'domicilio'=> 'required',
            'telefono'=> 'required|digits:10'
            ]);
            DB::insert('insert into clientes(id, nombre, apellido, domicilio, telefono) values (?, ?, ?, ?, ?)',
            [$request->id, $request->nombre, $request->apellido, $request->domicilio, $request->telefono]);
            return redirect()->route('clientes.index');
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
    public function edit(Clientes $cliente)
    {
        $clientes=$cliente;
        return view('clientes/insertarClientes', compact('clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'=> 'required|max:255',
            'apellido'=> 'required|max:255', 
            'domicilio'=> 'required',
            'telefono'=> 'required|digits:10'
            ]);
        DB::update('update clientes set nombre=?, apellido=?, domicilio=?, telefono=? where id=?',
        [$request->nombre, $request->apellido, $request->domicilio, $request->telefono, $id]);
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from clientes where id=?', [$id]);
        return redirect()->route('clientes.index');
    }
}
