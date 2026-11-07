<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-500 leading-tight">
            {{ __('Editar pago de deuda') }}
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
                                    Editar Pago de Deuda
                                </h3>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Error al actualizar el pago de deuda</strong>
                                </div>
                            @endif

                            <form action="{{ route('debt_payments.update', $debtPayment) }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')

                                {{-- Campos del formulario --}}     
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Tipo de Deuda
                                    </label>

                                    <select name="debt_id"
                                        class="w-full rounded-lg shadow-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">
                                            Seleccione un tipo de deuda
                                        </option>
                                        @foreach ($debts as $debt)
                                            <option value="{{ $debt->id }}"
                                                {{ old('debt_id', $debtPayment->debt_id) == $debt->id ? 'selected' : '' }}>
                                                {{ $debt->creditor }} Credito ${{ number_format($debt->amount, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('debt_id')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Monto del pago
                                    </label>

                                    <input type="text"
                                        name="amount"
                                        value="{{ old('amount', number_format($debtPayment->amount, 0, ',', '.')) }}"
                                        oninput="this.value = this.value.replace(/\D/g, '')
                                            .replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
                                        placeholder="Ingrese el monto del pago"
                                        class="w-full rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500
                                        {{ $errors->has('amount') ? 'border-red-500' : 'border-gray-300' }}">
                                    @error('amount')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Descripción del pago
                                    </label>

                                    <textarea name="description"
                                        rows="3"
                                        placeholder="Ingrese una descripción del pago"
                                        class="w-full rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500
                                        {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}">{{ old('description', $debtPayment->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror 
                                </div>
                                {{-- BOTONES --}}
                                <div class="flex justify-end">
                                    <a href="{{ route('debt_payments.index') }}"
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