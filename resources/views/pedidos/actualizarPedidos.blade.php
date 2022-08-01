@extends('layouts.windmill')

@section('contenido')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>

		<script>
			
    		$(function(){
				// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
				$("#adicional").on('click', function(){
					$("#muebles tbody tr:eq(0)").clone().appendTo("#muebles");
				});
			 
				// Evento que selecciona la fila y la elimina 
				$(document).on("click",".eliminar",function(){
					var parent = $(this).parents().get(0);
					$(parent).remove();
				});
			});
		</script><br>
    <h2 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
    Editar pedidos
    </h2>
    @if ($errors->any())
    <div class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br>
@endif
<form action="{{ route('pedidos.update', $pedidos, $pedidos->id) }}" method="post" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
  @method("PATCH")  
  @csrf
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
              <th class="px-4 py-3">Identificador</th>
              <th class="px-4 py-3">Fecha de pedido</th>
              <th class="px-4 py-3">Cliente</th>
              <th class="px-4 py-3">Estatus</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <tr class="text-gray-700 dark:text-gray-400">
              <td hidden class="px-4 py-3 text-sm">
                <input  name="id" type="numeric" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $pedidos->id }}" disabled/>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="fecha" type="date" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $pedidos->fecha_pedido }}" disabled/>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="cliente" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $cliente[0]->nombre }}" disabled/>
              </td>
              <td class="px-4 py-3 text-sm">
                <select name="estatus" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px">
                  <option>Pendiente</option>
                  <option>Finalizado</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
        <table class="w-full whitespace-no-wrap" id="muebles">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
              <th class="px-4 py-3">Cantidad</th>
              <th class="px-4 py-3">Mueble</th>
              <th class="px-4 py-3">Color</th>
              <th class="px-4 py-3">Nota</th>
              <th class="px-4 py-3">Extra</th>
              <th class="px-4 py-3">Carpinteria</th>
              <th class="px-4 py-3">Pulido</th>
              <th class="px-4 py-3">Pintura</th>
              <th class="px-4 py-3">Terminado</th>
              <th class="px-4 py-3"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @foreach ($pedidos_muebles as $renglon)
            <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3 text-sm">
                <input name="cantidad[]" type="numeric" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $renglon->cantidad }}"/>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="mueble[]" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $renglon->nombre }}"/>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="color[]" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $renglon->color }}"/>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="nota[]" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $renglon->nota }}"/>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="extra[]" type="numeric" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $renglon->extra }}"/>
              </td>
              <td class="px-4 py-3 text-sm">
                <select name="carpinteria[]" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px">
                @if (isset($renglon->carpinteria))
                    @foreach ($empleados as $renglon2)
                    @if ($renglon2->id == $renglon->carpinteria)
                      <option>{{ $renglon2->nombre }} - ({{ $renglon2->id }}) - {{ $renglon->carpinteria_fecha }}</option>
                    @endif
                    @endforeach
                @else
                  <option>Sin registro</option>
                  @foreach ($empleados as $renglon2)
                    @if (strtoupper($renglon2->departamento) == strtoupper("carpinteria"))
                      <option>{{ $renglon2->nombre }} - ({{ $renglon2->id }})</option> 
                    @endif
                  @endforeach
                @endif
                  </select>
              </td>
              <td class="px-4 py-3 text-sm">
                <select name="pulido[]" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px">
                  @if (isset($renglon->pulido))
                      @foreach ($empleados as $renglon3)
                      @if ($renglon3->id == $renglon->pulido)
                        <option>{{ $renglon3->nombre }} - ({{ $renglon3->id }}) - {{ $renglon->pulido_fecha }}</option>
                      @endif
                      @endforeach
                  @else
                    <option>Sin registro</option>
                    @foreach ($empleados as $renglon3)
                      @if (strtoupper($renglon3->departamento) == strtoupper("pulido"))
                        <option>{{ $renglon3->nombre }} - ({{ $renglon3->id }})</option> 
                      @endif
                    @endforeach
                  @endif
                    </select>
              </td>
              <td class="px-4 py-3 text-sm">
                <select name="pintura[]" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px">
                  @if (isset($renglon->pintura))
                      @foreach ($empleados as $renglon4)
                      @if ($renglon4->id == $renglon->pintura)
                        <option>{{ $renglon4->nombre }} - ({{ $renglon4->id }}) - {{ $renglon->pintura_fecha }}</option>
                      @endif
                      @endforeach
                  @else
                    <option>Sin registro</option>
                    @foreach ($empleados as $renglon4)
                      @if (strtoupper($renglon4->departamento) == strtoupper("pintura"))
                        <option>{{ $renglon4->nombre }} - ({{ $renglon4->id }})</option> 
                      @endif
                    @endforeach
                  @endif
                    </select>
              <td class="px-4 py-3 text-sm">
                <select name="terminado[]" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px">
                  @if (isset($renglon->terminado))
                      @foreach ($empleados as $renglon5)
                      @if ($renglon5->id == $renglon->terminado)
                        <option>{{ $renglon5->nombre }} - ({{ $renglon5->id }}) - {{ $renglon->terminado_fecha }}</option>
                      @endif
                      @endforeach
                  @else
                    <option>Sin registro</option>
                    @foreach ($empleados as $renglon5)
                      @if (strtoupper($renglon5->departamento) == strtoupper("terminado"))
                        <option>{{ $renglon5->nombre }} - ({{ $renglon5->id }})</option> 
                      @endif
                    @endforeach
                  @endif
                    </select>
              </td>
              <td class="eliminar px-4 py-3 text-sm">
                <input type="button" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 100px; margin-top: 3px" value="Borrar fila"/>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="codigo[]" type="text" hidden value="{{ $renglon->codigo }}"/>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <input type="submit" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 200px; margin-top: 3px" value="{{ isset($pedidos) ? 'Actualizar': 'Añadir' }}">
    <br>
    </form>    
@endsection