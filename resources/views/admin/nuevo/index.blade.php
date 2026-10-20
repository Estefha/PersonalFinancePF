<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-green-600 leading-tight">
            {{ __('Deudas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             {{-- GRID PRINCIPAL --}}
            <div class="grid grid-cols-12 gap-4">

                {{-- MENU LATERAL --}}
                <div class="col-span-3">
                    @include('layouts.menu')
                </div>
                {{-- CONTENIDO --}}
                <div class="col-span-9">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-700">
                        
                            {{-- ALERTA --}}
                            @if (session('success'))
                                <div id="alerta"
                                    class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
                                    {{ session('success') }}
                                </div>

                                <script>
                                    setTimeout(() => {
                                        let alerta = document.getElementById('alerta');
                                        if(alerta){
                                            alerta.remove();
                                        }
                                    }, 2000);
                                </script>
                            @endif
                           

                            {{-- HEADER TABLA --}}
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-2xl font-bold text-green-700">
                                    Listado de Deudas
                                </h3>

                                <a href="{{ route('debts.create') }}"  
                                class="bg-green-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow inline-flex items-center gap-2">
                                     <!-- SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z" clip-rule="evenodd" />
                                    </svg>

                                    Deudas
                                </a>
                            </div>

                            {{-- TABLA --}}
                            <div class="overflow-x-auto">
                                <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">

                                    <thead class="bg-green-600 text-white">
                                        <tr>
                                            <th class="px-4 py-2 border">Credito</th>
                                            <th class="px-4 py-2 border">Monto</th>
                                            <th class="px-4 py-2 border">Descripción</th>
                                            <th class="px-4 py-2 border">Fecha</th>
                                            <th class="px-4 py-2 border">Status</th>
                                            <th class="px-4 py-2 border">Acción</th>

                                        </tr>
                                    </thead>

                                    <tbody class="bg-white">
                                        @forelse($debts as $debt)
                                            <tr class="hover:bg-gray-100">
                                                <td class="px-4 py-2 border">{{ $debt->creditor }}</td>
                                                <td class="px-4 py-2 border">{{ number_format($debt->amount, 0, ',', '.') }}</td>
                                                <td class="px-4 py-2 border break-words">{{ $debt->description }}</td>
                                                <td class="px-4 py-2 border break-words">{{ \Carbon\Carbon::parse($debt->date)->format('d/m/Y H:i') }}</td>
                                                <td class="px-4 py-2 border break-words">{{$debt->status ? 'Activo' : 'Inactivo' }}</td>
                                                <td class="flex gap-2 border">
                                                    {{-- EDITAR --}}
                                                    <a href="#"{{--{{ route('debts.edit', $debt->ulid) }}" --}}
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 h-5"
                                                            viewBox="0 0 24 24"
                                                            fill="currentColor">
                                                            <path d="M4 17.25V20h2.75L17.81 8.94l-2.75-2.75L4 17.25zm15.71-9.04
                                                                a1.003 1.003 0 000-1.42l-2.5-2.5
                                                                a1.003 1.003 0 00-1.42 0l-1.96 1.96
                                                                3.75 3.75 2.13-1.79z"/>
                                                        </svg>
                                                    </a>
                                                    {{-- ELIMINAR --}}
                                                    <form action="#"{{--{{ route('debts.destroy', $debt->ulid) }}"--}}
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded inline-flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-5 h-5 text-white-500"
                                                                viewBox="0 0 24 24"
                                                                fill="currentColor">

                                                                <path d="M9 3h6l1 2h4v2H4V5h4l1-2zm1 6h2v8h-2V9zm4 0h2v8h-2V9zM7 9h2v8H7V9z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>    
                                            </tr> 
                                        @empty
                                            <tr>
                                                <td colspan="3"
                                                    class="text-center px-4 py-4 border">
                                                    No hay datos registrados
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- PAGINACIÓN --}}
                            <div class="mt-4">
                                {{ $debts->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>         
        </div>
    </div>
</x-app-layout>