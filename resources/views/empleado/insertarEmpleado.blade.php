@extends('layouts.windmill')

@section('contenido')
    <br>
    <h2 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
    {{ isset($empleado) ? 'Editar': 'Añadir' }} empleado
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
@if(@isset($empleado))
<form action="{{ route('empleado.update', $empleado, $empleado->id) }}" method="post" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
@method('PATCH')
  @else
<form action="{{ route('empleado.store') }}" method="POST" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">  
@endif
    @csrf
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Identificador</span>
      <input name="id" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $empleado->id ?? ''}}" {{ isset($empleado) ? ' disabled ': '' }}/>
    </label>
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Nombre (s)</span>
      <input name="nombre" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $empleado->nombre ?? ''}}"/>
    </label>
    <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Apellido (s)</span>
        <input name="apellido" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $empleado->apellido ?? ''}}"/>
    </label>
      <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Fecha de Ingreso</span>
        <input name="fecha" type="date" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $empleado->fecha_ingreso ?? ''}}" {{ isset($empleado) ? ' disabled ': '' }}/>
    </label>
    <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Salario</span>
        <input name="salario" type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $empleado->salario ?? ''}}"/>
    </label>
    <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">NSS</span>
        <input name="nss" type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $empleado->nss ?? ''}}" {{ isset($empleado) ? ' disabled ': '' }}/>
    </label>
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">
        Departamento
      </span>
      <select name="departamento" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px" value="{{ $empleado->departamento ?? ''}}">
        @foreach ($departamentos as $renglon)
          <option>{{ $renglon->nombre }}</option>
        @endforeach
      </select>
    </label>
    <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Puesto</span>
        <input name="puesto" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $empleado->puesto ?? ''}}"/>
    </label>
    <input type="submit" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 200px; margin-top: 3px" value="{{ isset($empleado) ? 'Actualizar': 'Añadir' }}">
    <br>
    </form>    
@endsection