<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\DebtRequest;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debts = Debt::with('user')->where('user_id', auth()->id())->latest()->paginate(10);
        return view('admin.debt.index', compact('debts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.debt.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(DebtRequest $request)
    {
        Debt::create([
            'user_id' => auth()->id(),
            'creditor' => $request->creditor,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => now(), 
        ]);
        return redirect()
        ->route('debts.index')
        ->with('success', 'Tipo de gasto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $debt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        //
    }
}
