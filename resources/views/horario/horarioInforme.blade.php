@extends('layouts.windmill')

@section('contenido')
            @php ($salario_final = 0)
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"><br>
              Informe de nomina - ({{ $semana }})
            </h4>
            @foreach ($empleadoS as $renglon)
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"><br>
              {{ $renglon->nombre }} {{ $renglon->apellido }} - ({{ $renglon->empleado }})
            </h4>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Dia</th>
                      <th class="px-4 py-3">Entrada</th>
                      <th class="px-4 py-3">Salida a comer</th>
                      <th class="px-4 py-3">Entrada de comer</th>
                      <th class="px-4 py-3">Salida</th>
                      <th class="px-4 py-3">Total de horas</th>
                      <th class="px-4 py-3">Extras</th>
                      <th class="px-4 py-3">Sueldo</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @for ($i = 0; $i < count($horarioS); $i++)
                        @if ($horarioS[$i]->id == $renglon->empleado)
                        <tr class="text-gray-700 dark:text-gray-400">
                          <td class="px-4 py-3 text-sm">
                            {{ $horarioS[$i]->dia }}
                          </td>
                          <td class="px-4 py-3 text-sm">
                            {{ $horarioS[$i]->entrada }}
                          </td>
                          <td class="px-4 py-3 text-sm">
                            {{ $horarioS[$i]->salida_comida }}
                          </td>
                          <td class="px-4 py-3 text-sm">
                            {{ $horarioS[$i]->entrada_comida }}
                          </td>
                          <td class="px-4 py-3 text-sm">
                            {{ $horarioS[$i]->salida }}
                          </td>
                          <td class="px-4 py-3 text-sm">
                            {{ $horarioS[$i]->total_horas }}
                          </td>
                          <td class="px-4 py-3 text-sm">
                            {{ $horarioS[$i]->extra }}
                          </td>
                          <td class="px-4 py-3 text-sm">
                            {{ $horarioS[$i]->salario }}
                          </td>
                          @php ($salario_final = $salario_final + $horarioS[$i]->salario)
                        </tr>
                        @endif
                    @endfor
                  </tbody>
                </table>
                <div class="text-gray-700 dark:text-gray-400">
                  <p class="px-4 py-3 text-sm"> Total a pagar: ${{ $salario_final }}</p>
                  </div>
                @php ($salario_final = 0)
              </div>
            </div>
            @endforeach
@endsection