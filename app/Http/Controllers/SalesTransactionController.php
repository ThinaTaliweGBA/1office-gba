<?php

namespace App\Http\Controllers;

use App\Models\SalesTransaction;
use App\Models\CommissionRate;
use Illuminate\Http\Request;
use PDF;

class SalesTransactionController extends Controller
{
    public function index()
    {
        $transactions = SalesTransaction::with('commissionRate')->get();
        return view('sales.index', compact('transactions'));
    }

    public function create()
    {
        $rates = CommissionRate::all();
        return view('sales.create', compact('rates'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_name' => 'required',
            'amount' => 'required|numeric',
            'commission_rate_id' => 'required|exists:commission_rates,id',
        ]);

        SalesTransaction::create($data);
        return redirect()
            ->route('sales.index')
            ->with('success', 'Transaction added successfully');
    }

    public function generateReport()
    {
        $transactions = SalesTransaction::with('commissionRate')->get();
        $pdf = PDF::loadView('sales.report', compact('transactions'));
        return $pdf->download('sales_report.pdf');
    }
}
