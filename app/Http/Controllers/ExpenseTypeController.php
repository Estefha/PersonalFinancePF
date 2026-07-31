<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseType;
use Illuminate\Support\Str;


class ExpenseTypeController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenseTypes = ExpenseType::paginate(10);
        return view('admin.expense_type.index', compact('expenseTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.expense_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validacion
        $request->validate([
            'name' => 'required|string|max:50|unique:expense_types,name',
            'description' => 'required|string|max:255',
        ], [
            // NAME
            'name.required' => 'El nombre es obligatorio',
            'name.unique' => 'Este tipo de gasto ya existe',
            'name.max' => 'El nombre no puede tener más de 50 caracteres',

            // DESCRIPTION
            'description.required' => 'La descripción es obligatoria',
            'description.max' => 'La descripción no puede tener más de 255 caracteres',    
        ]);
        //guardado seguro
        ExpenseType::create([
            'name' => $request->name,
            'description' =>$request->description 
        ]);
        //redirecion con mensaje
        return redirect()
        ->route('expense_types.index')
        ->with('success', 'Tipo de gasto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseType $expenseType)
    {
        return view('admin.expense_type.edit', compact('expenseType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExpenseType $expenseType)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:expense_types,name,' . $expenseType->id,
            'description' => 'required|string|max:255',
        ]);

        $expenseType->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('expense_types.index')
            ->with('success', 'Tipo de gasto actualizado correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseType $expenseType)
    {
    $expenseType->delete();

        return redirect()
            ->route('expense_types.index')
            ->with('success', 'Tipo de gasto eliminado correctamente');
    }
}
