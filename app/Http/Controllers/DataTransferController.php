<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mapping;
use App\Jobs\RunPythonScript;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DataTransferController extends Controller
{
    public function showTransferForm(Request $request)
    {
        if ($request->isMethod('post')) {
            // Extract form data
            $source_database = $request->input('database');
            $table_pair = $request->input('table');
            list($source_table, $target_table) = explode(' -> ', $table_pair);

            // Dispatch the job
            try {
                RunPythonScript::dispatch($source_database, $source_table, $target_table);
                $successMessage = 'Script is running in the background.';
            } catch (\Exception $e) {
                \Log::error('Job dispatch failed: ' . $e->getMessage());
                return response()->json(['error' => 'Failed to start the script.'], 500);
            }

            // Return immediate response for AJAX requests
            return response()->json(['success' => $successMessage]);
        } else {
            // Reset log and status files on initial load (GET request)
            $this->resetLogAndStatusFiles();

            // Return the view
            return view('transfer');
        }
    }

    private function resetLogAndStatusFiles()
    {
        file_put_contents(storage_path('logs/current_log_filename.txt'), '');
        file_put_contents(storage_path('logs/script_status.log'), json_encode(['status' => 'not started']));
        file_put_contents(storage_path('logs/last_script_error.txt'), '');
    }
    
    
    
    



    public function getMappingsForTable($mapping)
    {
        $parts = explode(' -> ', $mapping);
        if (count($parts) !== 2) {
            \Log::error('Invalid mapping format', ['mapping' => $mapping]);
            return response()->json(['error' => 'Invalid mapping format'], 400);
        }
        list($sourceTable, $targetTable) = $parts;
    
        $mappings = DB::connection('1office')->table('column_mappings')
            ->where('source_table', $sourceTable)
            ->where('target_table', $targetTable)
            ->get();
    
        return response()->json($mappings);
    }
    
    


    // Second attempt
    public function getDatabases()
    {
        $databases = DB::connection('1office')->table('column_mappings')->select('source_db')->distinct()->get();

        return response()->json($databases);
    }

public function getTablesForDatabase($database)
{
    $mappings = DB::connection('1office')->table('column_mappings')
        ->where('source_db', $database)
        ->select('source_table', 'target_table')
        ->distinct()
        ->get()
        ->map(function($item) {
            return $item->source_table . ' -> ' . $item->target_table;
        });

    return response()->json($mappings);
}



//New
// public function getScriptOutput()
// {
//     $currentLogFilename = file_get_contents(storage_path('logs/current_log_filename.txt'));

//     if ($currentLogFilename && file_exists($currentLogFilename)) {
//         $output = file_get_contents($currentLogFilename);
//         return response()->json(['output' => $output]);
//     }

//     return response()->json(['output' => 'No output yet.']);
// }

//NEW
public function getScriptOutput(Request $request)
{
    $currentLogFilename = file_get_contents(storage_path('logs/current_log_filename.txt'));
    $lastPosition = $request->session()->get('last_position', 0);

    if ($currentLogFilename && file_exists($currentLogFilename)) {
        $outputFile = fopen($currentLogFilename, "r");
        fseek($outputFile, $lastPosition);
        $output = stream_get_contents($outputFile); // Read the rest of the file

        $newPosition = ftell($outputFile);
        $request->session()->put('last_position', $newPosition);

        fclose($outputFile);

        return response()->json(['output' => $output]);
    }

    return response()->json(['output' => '']);
}






//New
public function checkScriptStatus()
{
    $statusFilePath = storage_path('logs/script_status.log');

    if (file_exists($statusFilePath)) {
        $status = json_decode(file_get_contents($statusFilePath), true);
        return response()->json($status);
    }

    return response()->json(['status' => 'not started']);
}

//NEW
public function getLatestScriptError()
{
    $errorFilePath = storage_path('logs/last_script_error.txt');

    if (file_exists($errorFilePath)) {
        $error = file_get_contents($errorFilePath);
        return response()->json(['error' => $error]);
    }

    return response()->json(['error' => 'No error found.']);
}


}
