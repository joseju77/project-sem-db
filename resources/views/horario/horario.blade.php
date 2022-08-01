@extends('layouts.windmill')

@section('contenido')

<style>
    .form-insertar {
	border-style: solid;
	border-width: 2px;
	border-color: black;
    margin-bottom: 10px;
}
</style>
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"><br>
              Horario
            </h4>
            <a href="{{ route('horario.create') }}"><button class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 200px">
              Registrar</button></a><br>
            <form action="{{ route('horario.editar') }}" method="post">
              @csrf
                <span class="text-gray-700 dark:text-gray-400">
                  Dia
                </span>
                <table>
                  <th>
                    <select name="dia" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px" style="width: 100px" value="{{ $empleado->departamento ?? ''}}">
                      @foreach ($horario as $renglon)
                        <option>{{ $renglon->dia }}</option>
                      @endforeach
                    </select>
                  </th>
                  <th>
                    <button type="submit" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 200px">
                      Editar
                    </button>
                    </th>
                </table><br>
            </form>
@endsection