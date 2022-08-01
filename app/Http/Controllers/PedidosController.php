<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = DB::select('select pedidos.id, pedidos.fecha_pedido, pedidos.estado, clientes.nombre as nombre, total from pedidos left join clientes on clientes.id=pedidos.cliente');
        return view('pedidos/listaPedidos', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = DB::select('select nombre from clientes');
        $muebles = DB::select('select nombre from muebles');
        return view('pedidos/insertarPedidos', compact('clientes', 'muebles'));
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
            'id'=> 'required|numeric|unique:App\Models\Pedidos,id',
            'fecha'=> 'required'
            ]);
        $numC = DB::select('select id from clientes where nombre=?', [$request->cliente]);
        DB::insert('insert into pedidos(id, cliente, fecha_pedido) values (?, ?, ?)', 
            [$request->id, $numC[0]->id, $request->fecha]);
        for ($i = 0; $i < count($request->cantidad); $i ++) {
            $numM = DB::select('select id from muebles where nombre=?', [$request->mueble[$i]]);   
            DB::insert('insert into pedidos_muebles(id_pedido, cantidad, mueble, color, nota, extra, codigo) values (?, ?, ?, ?, ?, ?, ?)', 
            [$request->id, $request->cantidad[$i], $numM[0]->id, $request->color[$i], $request->nota[$i], $request->extra[$i], $request->id."-".$i]);
        }
        return redirect()->route('pedidos.index');
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
    public function edit(Pedidos $pedido)
    {
        $pedidos=$pedido;
        $cliente=DB::select('select nombre from clientes where id=?', [$pedidos->cliente]);
        $pedidos_muebles = DB::select('select pedidos_muebles.cantidad, muebles.nombre as nombre, pedidos_muebles.color, pedidos_muebles.nota, pedidos_muebles.extra, pedidos_muebles.codigo, pedidos_muebles.carpinteria, pedidos_muebles.carpinteria_fecha, pedidos_muebles.pulido_fecha, pedidos_muebles.pintura_fecha, pedidos_muebles.terminado_fecha, pedidos_muebles.pulido, pedidos_muebles.pintura, pedidos_muebles.terminado from pedidos_muebles left join muebles on pedidos_muebles.mueble=muebles.id where pedidos_muebles.id_pedido=?',
        [$pedidos->id]);
        $empleados = DB::select('select empleados.id, empleados.nombre, departamentos.nombre as departamento from empleados left join departamentos on empleados.departamento=departamentos.id');
        return view('pedidos/actualizarPedidos', compact('pedidos', 'pedidos_muebles', 'cliente', 'empleados'));;
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
        DB::update('update pedidos set estado=? where id=?', [$request->estatus, $request->id]);
        $ctem= DB::select("select carpinteria, pulido, pintura, terminado, carpinteria_fecha, pulido_fecha, pintura_fecha, terminado_fecha from pedidos_muebles where id_pedido=?", [$id]);
        DB::delete('delete from pedidos_muebles where id_pedido=?', [$id]);
        for ($i=0; $i < count($request->codigo); $i++) { 
            $numM = DB::select('select id from muebles where nombre=?', [$request->mueble[$i]]);
            DB::insert('insert into pedidos_muebles(id_pedido, cantidad, mueble, color, nota, extra, codigo) values (?, ?, ?, ?, ?, ?, ?)', 
            [$id, $request->cantidad[$i], $numM[0]->id, $request->color[$i], $request->nota[$i], $request->extra[$i], $id."-".$i]);
            if ($request->carpinteria[$i] != "Sin registro") {
                $temp=$request->carpinteria[$i];
                $temp2="";
                $x=0;
                for ($y=0; $y < strlen($temp); $y++) {
                    if ($temp[$y-1] == "("){
                        $x=1;
                    } elseif ($temp[$y] == ")") {
                        $x=0;
                    }
                    if ($x == 1) {
                        $temp2=$temp2.$temp[$y];
                    }
                }
                DB::update('update pedidos_muebles set carpinteria=?, carpinteria_fecha=? where codigo=?',
                [$temp2, date("Y-m-d H:i:s"), $id."-".$i]);
            }
            if ($request->pulido[$i] != "Sin registro") {
                $temp=$request->pulido[$i];
                $temp2="";
                $x=0;
                for ($y=0; $y < strlen($temp); $y++) {
                    if ($temp[$y-1] == "("){
                        $x=1;
                    } elseif ($temp[$y] == ")") {
                        $x=0;
                    }
                    if ($x == 1) {
                        $temp2=$temp2.$temp[$y];
                    }
                }
                DB::update('update pedidos_muebles set pulido=?, pulido_fecha=? where codigo=?',
                [$temp2, date("Y-m-d H:i:s"), $id."-".$i]);
            }
            if ($request->pintura[$i] != "Sin registro") {
                $temp=$request->pintura[$i];
                $temp2="";
                $x=0;
                for ($y=0; $y < strlen($temp); $y++) {
                    if ($temp[$y-1] == "("){
                        $x=1;
                    } elseif ($temp[$y] == ")") {
                        $x=0;
                    }
                    if ($x == 1) {
                        $temp2=$temp2.$temp[$y];
                    }
                }
                DB::update('update pedidos_muebles set pintura=?, pintura_fecha=? where codigo=?',
                [$temp2, date("Y-m-d H:i:s"), $id."-".$i]);
            }
            if ($request->terminado[$i] != "Sin registro" or isset($ctem[3])) {
                $temp=$request->terminado[$i];
                $temp2="";
                $x=0;
                for ($y=0; $y < strlen($temp); $y++) {
                    if ($temp[$y-1] == "("){
                        $x=1;
                    } elseif ($temp[$y] == ")") {
                        $x=0;
                    }
                    if ($x == 1) {
                        $temp2=$temp2.$temp[$y];
                    }
                }
                DB::update('update pedidos_muebles set terminado=?, terminado_fecha=? where codigo=?',
                [$temp2, date("Y-m-d H:i:s"), $id."-".$i]);
            }
        }
        return redirect()->route('pedidos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from pedidos where id=?', [$id]);
        return redirect()->route('pedidos.index');
    }
}
