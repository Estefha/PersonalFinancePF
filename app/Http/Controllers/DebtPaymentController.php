<?php

namespace App\Http\Controllers;

use App\Models\DebtPayment;
use Illuminate\Http\Request;

use App\Models\Debt;

class DebtPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debtPayments = DebtPayment::with('debt')->where('user_id', auth()->id())->latest()->paginate(10);
        return view('admin.debt_payment.index', compact('debtPayments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DebtPayment $debtPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DebtPayment $debtPayment)
    {
        //
    }
}
