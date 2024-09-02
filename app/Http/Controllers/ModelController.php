<?php

namespace App\Http\Controllers;

use App\Models\OneoModel;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'model_name' => 'required|max:255',
        'model_table' => 'required|max:255',
        'component_id' => 'required|integer',
        'module_id' => 'required|integer',
    ]);

    $model = new OneoModel();
    $model->model_name = $request->model_name;
    $model->model_table = $request->model_table;
    $model->component_id = $request->component_id;
    $model->module_id = $request->module_id;
    $model->save();

    return response()->json(['id' => $model->id], 201);
}

}
