@extends('layouts.windmill')

@section('contenido')
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"><br>
              Nomina
            </h4>
            <form action="{{ route('horario.nominaF') }}" method="post">
              @csrf
                <span class="text-gray-700 dark:text-gray-400">
                  Semana
                </span>
                <table>
                  <th>
                    <select name="semana" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" style="margin-bottom: 5px" style="width: 100px" value="{{ $empleado->departamento ?? ''}}">
                      @foreach ($horario as $renglon)
                        <option>{{ $renglon->semana }}</option>
                      @endforeach
                    </select>
                  </th>
                  <th>
                    <button type="submit" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 200px">
                      Consultar
                    </button>
                    </th>
                </table><br>
            </form>
@endsection