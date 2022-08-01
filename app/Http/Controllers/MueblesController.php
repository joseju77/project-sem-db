<?php

namespace App\Http\Controllers;

use App\Models\Muebles;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MueblesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $muebles = DB::select('select id, nombre, descripcion, precio from muebles');
        return view('muebles/listaMuebles', compact('muebles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('muebles/insertarMuebles');
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
            'nombre'=> 'required|max:255|unique:App\Models\Muebles,nombre',
            'descripcion'=> 'required|max:255',
            'id'=> 'required|numeric|unique:App\Models\Muebles,id', 
            'precio'=> 'required|numeric'
            ]);
            DB::insert('insert into muebles(id, nombre, descripcion, precio) values (?, ?, ?, ?)',
            [$request->id, $request->nombre, $request->descripcion, $request->precio]);
            return redirect()->route('muebles.index');
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
    public function edit(Muebles $mueble)
    {
        $muebles=$mueble;
        return view('muebles/insertarMuebles', compact('muebles'));
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
            'descripcion'=> 'required|max:255', 
            'precio'=> 'required|numeric'
            ]);
        DB::update('update muebles set nombre=?, descripcion=?, precio=? where id=?',
        [$request->nombre, $request->descripcion, $request->precio, $id]);
        return redirect()->route('muebles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from muebles where id=?', [$id]);
        return redirect()->route('muebles.index');
    }
}
