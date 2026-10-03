<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-500 leading-tight">
            {{__('Ingresos')}}
        </h2> 
    </x-slot> 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- GRID PRINCIPAL --}}
            <div class="grid grid-cols-12 gap-4">
                {{-- MENU --}}
                <div class="col-span-3">
                    @include('layouts.menu')
                </div>  
                {{-- CONTENIDO --}}
                <div class="col-span-9">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            {{-- TITULO --}}
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-gray-700">
                                    Nuevo Ingreso
                                </h3>
                            </div>
                            {{-- Errores --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Error al crear Ingreso Nuevo</strong>
                                </div>
                            @endif
                            {{-- FORMULARIO --}}
                            <form action="{{ route('incomes.store') }}" method="POST" class="space-y-6">
                                @csrf    
                                <div class="mb-4">

                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Descripción
                                    </label>

                                    <textarea
                                        name="description"
                                        rows="3"
                                        placeholder="Descripción del gasto"

                                        class="w-full rounded-lg shadow-sm
                                            focus:border-blue-500 focus:ring-blue-500
                                            {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300'}}"
                                    >{{ old('description') }}</textarea>

                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror   

                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Monto
                                    </label>
                                    <input type="number" name="amount"  value="{{ old('amount') }}" placeholder="Ingrese el valor"
                                        class="w-full rounded-lg  shadow-sm focus:border-blue-500 focus:ring-blue-500
                                        {{ $errors->has('amount') ? 'border-red-500' : 'border-gray-300'}}">
                                    @error('amount')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror     
                                </div>
                                <div class="flex justify-end">
                                    <a href="{{ route('incomes.index') }}"
                                    class="bg-red-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded mr-2">
                                        Cancelar
                                    </a>

                                    <button type="submit"
                                            class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded">
                                        Guardar
                                    </button>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>

</x-app-layout>