<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layout;
use App\Models\BuMembershipType;

class LayoutController extends Controller
{
    //Select the layo
    public function selectLayout(Request $request)
    {
        $layouts = Layout::all();
        dd($layouts);

        $user = auth()->user();
        $user->layout_id = $request->layout_id;
        $user->save();

        $membershipsTypes = BuMembershipType::all();
        dd($membershipsTypes);
        console.log($membershipsTypes);

        return redirect('home', compact('layouts', 'membershipsTypes'));
    }

    public function show()
    {
        $layouts = Layout::all();
        // dd($layouts);
        return view('home', compact('layouts'));
    }

     public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // Add other validation rules as necessary
        ]);

        // Process the data
        // ...

        // Redirect or return a response
        return redirect()->route('home')->with('success', 'Successfully Onboarded!');
    }
}
