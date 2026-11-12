<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SavingRequest;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savings = Saving::with('expense')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.saving.index', compact('savings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenses = Expense::where('user_id', Auth::id())->get();
        return view('admin.saving.create', compact('expenses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SavingRequest $request)
    {
        Saving::create([
            'expense_id' => $request->expense_id,
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'savings_purpose' => $request->savings_purpose,
            'description' => $request->description,
            'date' => now(),
        ]);

        return redirect()->route('savings.index')->with('success', 'Ahorro registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Saving $saving)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saving $saving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saving $saving)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saving $saving)
    {
        //
    }
}
