<?php

namespace App\Http\Controllers;

use App\Models\CommissionRate;
use Illuminate\Http\Request;

class CommissionRateController extends Controller
{
    public function index()
    {
        $commissionRates = CommissionRate::all();
        return view('commission.index', compact('commissionRates'));
    }

    public function create()
    {
        $commissionRates = CommissionRate::all();
        // $rates = CommissionRate::all();
        return view('commission.create', compact('commissionRates'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'rate' => 'required|numeric',
        ]);

        CommissionRate::create($data);
        return redirect()->back()->with('success', 'Rate added successfully');
    }
}
