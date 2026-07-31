<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-500 leading-tight">
            {{ __('Gastos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                    Editar Gasto
                                </h3>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Error al actualizar el gasto</strong>
                                </div>
                            @endif

                            <form action="{{ route('expenses.update', $expense) }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')

                                {{-- TIPO DE GASTO --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Tipo de gasto
                                    </label>

                                    <select name="expense_type_id"
                                        class="w-full rounded-lg shadow-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                                        <option value="">
                                            Seleccione un tipo de gasto
                                        </option>

                                        @foreach ($expenseTypes as $expenseType)
                                            <option value="{{ $expenseType->id }}"
                                                {{ old('expense_type_id', $expense->expense_type_id) == $expenseType->id ? 'selected' : '' }}>
                                                {{ $expenseType->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('expense_type_id')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- MONTO --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Monto
                                    </label>

                                    <input
                                        type="number"
                                        name="amount"
                                        value="{{ old('amount', $expense->amount) }}"
                                        placeholder="Ingrese el valor"
                                        class="w-full rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500
                                        {{ $errors->has('amount') ? 'border-red-500' : 'border-gray-300' }}">

                                    @error('amount')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- DESCRIPCIÓN --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Descripción
                                    </label>

                                    <textarea
                                        name="description"
                                        rows="3"
                                        placeholder="Descripción del gasto"
                                        class="w-full rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500
                                        {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}">{{ old('description', $expense->description) }}</textarea>

                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- BOTONES --}}
                                <div class="flex justify-end">
                                    <a href="{{ route('expenses.index') }}"
                                        class="bg-red-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded mr-2">
                                        Cancelar
                                    </a>

                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded">
                                        Actualizar
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