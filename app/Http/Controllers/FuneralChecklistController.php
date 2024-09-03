<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuneralChecklistItems;
use Illuminate\Support\Facades\Auth;

class FuneralChecklistController extends Controller
{
    /**
     * Store a newly created checklist item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:45',
            'required' => 'required|boolean',
            'description' => 'nullable|string|max:255',
        ]);

        // Create a new checklist item
        $checklistItem = new FuneralChecklistItems();
        $checklistItem->bu_id = Auth::user()->currentBu()->id; // Assuming you have a method to get currentBu
        $checklistItem->name = $request->name;
        $checklistItem->required = $request->required;
        $checklistItem->description = $request->description;
        $checklistItem->save();

        // Return a JSON response indicating success
        return response()->json(['success' => true, 'message' => 'Checklist item added successfully!']);
    }
}
