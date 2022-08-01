@extends('layouts.windmill')

@section('contenido')
          <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"><br>
            Registro de Horario
          </h4>
            <form action="" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                  >
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Ingreso</th>
                    <th class="px-4 py-3">Salida a comida</th>
                    <th class="px-4 py-3">Entrada de comida</th>
                    <th class="px-4 py-3">Salida</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div>
                          <p class="font-semibold">Juan José</p>
                          <p class="text-xs text-gray-600 dark:text-gray-400">
                            Hernández De Anda
                          </p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="00:00">
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="00:00">
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="00:00">
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <input type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="00:00">
                    </td>
                  </tr>
                </tbody>
            </table>
            <input type="submit" class="px-1 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="width: 200px" value="Registrar">
            <br>
          </form>   
@endsection