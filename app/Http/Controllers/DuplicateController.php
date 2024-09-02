<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GenericDuplicateModel;

class DuplicateController extends Controller
{
    /**
     * Display a listing of the grouped duplicates that are not fixed.
     *
     * @param string $tableName
     * @return \Illuminate\Http\Response
     */
    public function index($tableName)
    {
        $model = new GenericDuplicateModel();
        $model->setTable($tableName);

        // Fetch and group duplicates by target_duplicate_id and target_table_name where fixed = 0
        $duplicates = $model->select('target_duplicate_id', 'target_table_name')
                            ->where('fixed', 0)
                            ->groupBy('target_duplicate_id', 'target_table_name')
                            ->get();

        return view('duplicates.index', compact('duplicates', 'tableName'));
    }

    /**
     * Show the form for fixing a specific group of duplicates.
     *
     * @param  string  $tableName
     * @param  int  $targetDuplicateId
     * @return \Illuminate\Http\Response
     */
    public function fix($tableName, $targetDuplicateId)
    {
        $model = new GenericDuplicateModel();
        $model->setTable($tableName);

        // Fetch duplicates for the specific group where fixed = 0
        $duplicates = $model->where('target_duplicate_id', $targetDuplicateId)
                            ->where('fixed', 0)
                            ->get();

        return view('duplicates.fix', compact('duplicates', 'tableName', 'targetDuplicateId'));
    }

    /**
     * Update the specified duplicates in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $tableName
     * @param  int  $targetDuplicateId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tableName, $targetDuplicateId)
    {
        $model = new GenericDuplicateModel();
        $model->setTable($tableName);

        // Logic to fix the duplicates, which depends on your specific requirements
        // Here, typically, you'd update the 'fixed' column to 1 for the fixed records
        // ...

        return redirect()->route('duplicates.index', $tableName)->with('success', 'Duplicates fixed successfully');
    }
}
