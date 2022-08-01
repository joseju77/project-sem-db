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
              {{ isset($horario) ? 'Editar': 'Registrar' }} horario
            </h4>
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
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                @if(@isset($horario))
                <form action="{{ route('horario.actualizar') }}" method="POST">
                  @php
                    $hola = $horario; 
                  @endphp
                @else
                  <form action="{{ route('horario.store') }}" method="POST" queso>
                  @php
                      $hola = $empleados; 
                  @endphp
                @endif
                @csrf
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Nombre</th>
                      <th class="px-4 py-3">Entrada</th>
                      <th class="px-4 py-3">Salida a comer</th>
                      <th class="px-4 py-3">Entrada de comer</th>
                      <th class="px-4 py-3">Salida</th>
                      <th class="px-4 py-3">Extra</th>
                      <th class="px-4 py-3"></th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($hola as $renglon)
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <div>
                            <p class="font-semibold">
                              {{ $renglon->nombre }} - ({{ $renglon->empleado }})</p> 
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3">
                        <input name="entrada[]" type="time" min="01:00" max="23:00"  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" required
                        @if (isset($renglon->entrada))
                            value="{{ $renglon->entrada }}"
                        @endif/>
                      </td>
                      <td class="px-4 py-3">
                        <input name="salida_comida[]" type="time" min="01:00" max="23:00"  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" required
                        @if (isset($renglon->salida_comida))
                            value="{{ $renglon->salida_comida }}"
                        @endif/>
                      </td>
                      <td class="px-4 py-3">
                        <input name="entrada_comida[]" type="time" min="01:00" max="23:00" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" required
                        @if (isset($renglon->entrada_comida))
                            value="{{ $renglon->entrada_comida }}"
                        @endif/>
                      </td>
                      <td class="px-4 py-3">
                        <input name="salida[]" type="time" min="01:00" max="23:00"  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" required
                        @if (isset($renglon->salida))
                            value="{{ $renglon->salida }}"
                        @endif/>
                      </td>
                      <td class="px-4 py-3">
                        <input name="extra[]" type="number" min="01:00" max="23:00"  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px" value="0" required
                        @if (isset($renglon->extra))
                            value="{{ $renglon->extra }}"
                        @endif/>
                      </td>
                      <td class="px-4 py-3">
                        <input name="id[]" value="{{ $renglon->empleado }}" hidden/>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <table>
                  @if (!isset($renglon->entrada))
                  <th>
                    <td class="px-4 py-3">
                      <span class="text-gray-700 dark:text-gray-400">Semana</span>
                      <input name="dia" type="date" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="margin-bottom: 5px"/>
                    </td>
                  </th>
                  @endif
                  <th><br>
                    <button type="submit" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 200px">
                      {{ isset($renglon->entrada) ? 'Actualizar': 'Registrar' }}  
                    </button>
                    </th>
                </table>
              </form>
            </div>
          </div>
@endsection