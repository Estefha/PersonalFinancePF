<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('expenseType')->where('user_id', auth()->id())->latest()->paginate(10);
        return view('admin.expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenseTypes = ExpenseType::all();
        return view('admin.expense.create', compact('expenseTypes'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_type_id' => 'required|exists:expense_types,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ], [
            //EXP4ENSE TYPE
            'expense_type_id.required' => 'El tipo de gasto es obligatorio',
            'expense_type_id.exists' => 'El tipo de gasto seleccionado no existe',
            // AMOUNT
            'amount.required' => 'El valor es obligatorio',
            'amount.numeric' => 'El valor debe ser numerico',
            'amount.min' => 'El valor no puede ser negativo',

            // DESCRIPTION
            'description.required' => 'La descripción es obligatoria',
            'description.max' => 'La descripción no puede tener más de 255 caracteres',    
        ]);
        //guardado seguro
        Expense::create([
            'expense_type_id' => $request->expense_type_id,
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => now(), 
        ]);
        //redirecion con mensaje
        return redirect()
        ->route('expenses.index')
        ->with('success', 'Gasto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $expenseTypes = ExpenseType::all();
        return view('admin.expense.edit', compact('expense', 'expenseTypes'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_type_id' => 'required|exists:expense_types,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ], [
            //EXP4ENSE TYPE
            'expense_type_id.required' => 'El tipo de gasto es obligatorio',
            'expense_type_id.exists' => 'El tipo de gasto seleccionado no existe',
            // AMOUNT
            'amount.required' => 'El valor es obligatorio',
            'amount.numeric' => 'El valor debe ser numerico',
            'amount.min' => 'El valor no puede ser negativo',

            // DESCRIPTION
            'description.required' => 'La descripción es obligatoria',
            'description.max' => 'La descripción no puede tener más de 255 caracteres',    
        ]);

        $expense->update([
            'expense_type_id' => $request->expense_type_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()
        ->route('expenses.index')
        ->with('success', 'Gasto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
         $expense->delete();

        return redirect()
            ->route('incomes.index')
            ->with('success', 'Gasto eliminado correctamente');
    }
    
}
