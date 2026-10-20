<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Http\Requests\IncomeRequest;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomes = Income::with('user')->where('user_id', auth()->id())->latest()->paginate(10);
        return view('admin.icome.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.icome.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomeRequest $request)
    {
        Income::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => now(), 
        ]);

        return redirect()
        ->route('incomes.index')
        ->with('success', 'Tipo de gasto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        return view('admin.icome.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IncomeRequest $request, Income $income)
    {
        $income->update([
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()
        ->route('incomes.index')
        ->with('success', 'Ingreso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        $income->delete();

        return redirect()
            ->route('incomes.index')
            ->with('success', 'Ingreso eliminado correctamente');
    }
    
}
