<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserBuController extends Controller
{
    public function updateCurrentBu(Request $request)
    {
        $request->validate([
            'bu_id' => 'required|exists:bu,id',
        ]);

        $buId = $request->input('bu_id');

        // Set the current BU ID in the session
        session(['current_bu_id' => $buId]);

        // Redirect or return response
        return redirect()->back()->with('status', 'Current BU updated successfully.');
    }
}
