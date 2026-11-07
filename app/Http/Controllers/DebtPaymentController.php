<?php

namespace App\Http\Controllers;

use App\Models\DebtPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DebtPaymentRequest;

use App\Models\Debt;

class DebtPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debtPayments = DebtPayment::with('debt')->where('user_id', Auth::id())->latest()->paginate(10);
        return view('admin.debt_payment.index', compact('debtPayments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $debts = Debt::where('user_id', Auth::id())->get();
        return view('admin.debt_payment.create', compact('debts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DebtPaymentRequest $request)
    {
        //guardado seguro
        DebtPayment::create([
            'debt_id' => $request->debt_id,
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => now(),
        ]);
        return redirect()->route('debt_payments.index')->with('success', 'Pago de deuda registrado correctamente'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(DebtPayment $debtPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DebtPayment $debtPayment)
    {
        $debts = Debt::where('user_id', Auth::id())->get();
        return view('admin.debt_payment.edit', compact('debtPayment', 'debts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DebtPaymentRequest $request, DebtPayment $debtPayment)
    {
        $debtPayment->update($request->validated());
        return redirect()->route('debt_payments.index')->with('success', 'Pago de deuda actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DebtPayment $debtPayment)
    {
        $debtPayment->delete();
        return redirect()->route('debt_payments.index')->with('success', 'Pago de deuda eliminado correctamente');
    }
}
