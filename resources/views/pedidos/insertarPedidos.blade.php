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
		</script>
    <br>
    <h2 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
    {{ isset($pedidos) ? 'Editar': 'Añadir' }} pedidos
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
@if(@isset($pedidos))
<form action="{{ route('pedidos.update', $pedidos, $pedidos->id) }}" method="post" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
@method('PATCH')
  @else
<form action="{{ route('pedidos.store') }}" method="POST" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">  
@endif
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
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3 text-sm">
                <input name="id" type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px"}/>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="fecha" type="date" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px"}/>
              </td>
              <td class="px-4 py-3 text-sm">
                <select name="cliente" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px" value="{{ $empleado->departamento ?? ''}}">
                  @foreach ($clientes as $renglon)
                    <option>{{ $renglon->nombre }}</option>
                  @endforeach
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
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3 text-sm">
                <input name="cantidad[]" type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px"/>
              </td>
              <td class="px-4 py-3 text-sm">
                <select name="mueble[]" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px">
                  @foreach ($muebles as $renglon)
                    <option>{{ $renglon->nombre }}</option>
                  @endforeach
                </select>
              </td>
              <td class="px-4 py-3 text-sm">
                <select name="color[]" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px">
                  <option>Rojo</option>
                  <option>Verde</option>
                  <option>Cafe</option>
                </select>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="nota[]" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px"/>
              </td>
              <td class="px-4 py-3 text-sm">
                <input name="extra[]" type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px"/>
              </td>
              <td class="eliminar px-4 py-3 text-sm">
                <input type="button" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 100px; margin-top: 3px" value="Borrar fila"/>
              </td>
            </tr>
          </tbody>
        </table>
        <button class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 100px; margin-top: 3px" id="adicional" name="adicional" type="button">Agregar fila</button>
      </div>
    </div>
    <input type="submit" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 200px; margin-top: 3px" value="{{ isset($pedidos) ? 'Actualizar': 'Añadir' }}">
    <br>
    </form>    
@endsection