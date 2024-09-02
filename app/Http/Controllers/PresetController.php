<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preset; 

class PresetController extends Controller
{
    public function store(Request $request)
    {
        // This line will log a message when the function is called.
        //\Log::info('Store function in PresetController was called.');
        $data = $request->all();
        $preset = Preset::create($data);
        return response()->json($preset, 201);
    }

    public function show($id)
    {
        $preset = Preset::findOrFail($id);
        return response()->json($preset);
    }

    public function destroy(Preset $preset)
    {
        $preset->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
