@extends('layouts.windmill')

@section('contenido')
    <br>
    <h2 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
    {{ isset($departamento) ? 'Editar': 'Añadir' }} departamento
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
@if(@isset($departamento))
<form action="{{ route('departamento.update', $departamento, $departamento->id) }}" method="post" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
@method('PATCH')
  @else
<form action="{{ route('departamento.store') }}" method="POST" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">  
@endif
    @csrf
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Identificador</span>
      <input name="id" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $departamento->id ?? ''}}" {{ isset($departamento) ? ' disabled ': '' }}/>
    </label>
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Nombre</span>
      <input name="nombre" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="{{ $departamento->nombre ?? ''}}"/>
    </label>
    <input type="submit" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 200px; margin-top: 3px" value="{{ isset($departamento) ? 'Actualizar': 'Añadir' }}">
    <br>
    </form>    
@endsection