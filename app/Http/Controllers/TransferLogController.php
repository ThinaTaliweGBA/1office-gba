<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Component;
use App\Models\DataTransferFix;
use App\Models\SpecialColumnsConfig;
use Illuminate\Http\Request;
use App\Models\TransferLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransferLogController extends Controller
{
    protected $replacementValuesCache = [];

    public function index()
    {
        $logs = TransferLog::with('oo_model')->where('fixed', 0)->get();
        return view('fixer', compact('logs'));
    }
    
    // public function getModules()
    // {
    //     $modules = Module::withCount(['components', 'transfer_logs'])->get();
    //     return $modules;
    // }

//     public function getModules()
// {
//     $modules = Module::with('components.transfer_logs')->get();
//     $modules->each(function($module) {
//         $logCount = 0;
//         foreach ($module->components as $component) {
//             $logCount += $component->transfer_logs->count();
//         }
//         $module->logCount = $logCount;
//     });
//     return $modules;
// }

    public function getModules()
    {
        $modules = Module::with(['components' => function ($query) {
            $query->withCount('transfer_logs');
        }])->get();

        return $modules;
    }

    
    
    public function getComponents($module_id)
    {
        $module = Module::find($module_id);
        $components = $module->components()->withCount('transfer_logs')->get();
        return $components;
    }
    
    // public function getLogs($moduleId, $componentId)
    // {
    //     $logs = TransferLog::whereHas('oo_model', function ($query) use ($moduleId, $componentId) {
    //         $query->where('module_id', $moduleId)->where('component_id', $componentId);
    //     })->with('oo_model')->where('fixed', 0)->get();
    
    //     // Fetch related record data for each log
    //     $logs = $logs->map(function ($log) {
    //         $targetModelName = 'App\\Models\\' . ucfirst($log->oo_model->model_name);
    //         $targetRecord = null;
    //         if (class_exists($targetModelName)) {
    //             $targetRecord = $targetModelName::find($log->target_id);
    //         }
    //         // Convert log and related record to array
    //         return array_merge($log->toArray(), ['target_record' => $targetRecord]);
    //     });
    
    //     return $logs;
    // }
    
public function getLogs($moduleId, $componentId)
{
    $logs = TransferLog::whereHas('oo_model', function ($query) use ($moduleId, $componentId) {
        $query->where('module_id', $moduleId)->where('component_id', $componentId);
    })->with(['oo_model', 'special_columns_config'])->where('fixed', 0)->get();

    // Fetch related record data for each log
    $logs = $logs->map(function ($log) {
        $targetModelName = 'App\\Models\\' . ucfirst($log->oo_model->model_name);
        $targetRecord = null;
        if (class_exists($targetModelName)) {
            $targetRecord = $targetModelName::find($log->target_id);
        }

        // Get the match table and match field from the special columns config
        $matchTable = $log->special_columns_config->match_table;
        $matchField = $log->special_columns_config->match_field;

        // Fetch the replacement values, if not already fetched for this match table and field
        if (!isset($this->replacementValuesCache[$matchTable][$matchField])) {
            $this->replacementValuesCache[$matchTable][$matchField] = DB::connection('1office')->table($matchTable)->pluck($matchField, 'id');
            \Log::error('SAIZA Just fetched replacementValues', ['matchTable' => $matchTable, 'matchField' => $matchField, 'replacementValues' => $this->replacementValuesCache[$matchTable][$matchField]]);
        }
        $replacementValues = $this->replacementValuesCache[$matchTable][$matchField];

        // Convert log, related record, and replacement values to array
        return array_merge($log->toArray(), ['target_record' => $targetRecord, 'replacement_values' => $replacementValues]);
    });

    return $logs;
}


public function fixLog(Request $request, $logId)
{
    // Find the log
    $log = TransferLog::findOrFail($logId);

    // Get the model name from oo_model
    $modelName = 'App\\Models\\' . ucfirst($log->oo_model->model_name);

    // Check if model class exists
    if (!class_exists($modelName)) {
        \Log::error('Invalid model name', ['log_id' => $logId]);
        return back()->with('error', 'Failed to fix log: Invalid model name');
    }

    // Fetch the target record
    $targetRecord = $modelName::find($log->target_id);

    // Check if target record exists
    if (!$targetRecord) {
        \Log::error('Target record not found', ['log_id' => $logId]);
        return response()->json(['success' => false, 'error' => 'Target record not found']);
    }

    // Update the target record
    $targetRecord->{$log->missing_field} = $request->fix_value;
    $targetRecord->save();

    // Mark the log as fixed
    $log->fixed = 1;
    $log->save();

    \Log::info('Successfully fixed log', ['log_id' => $logId]);

    // After fixing the log, save the mapping if source_value is not empty or whitespace
    if(!empty(trim($log->source_value))) {
        $fix = new DataTransferFix;
        $fix->source_table = $log->source_table;
        $fix->source_column = $log->source_column;
        $fix->source_value = $log->source_value;
        $fix->target_table = $log->target_table;
        $fix->target_field = $log->missing_field;
        $fix->target_value = $request->fix_value;
        $fix->save();
    }

    return response()->json(['success' => true]);
}



// public function fixLog(Request $request, TransferLog $log)
// {
//     \Log::info('Attempting to fix log', ['log_id' => $log->id]);

//     $specialColumnConfig = $log->special_column_config;
//     if (!$specialColumnConfig) {
//         \Log::error('Missing special column config', ['log_id' => $log->id]);
//         return redirect('/fixer')->with('error', 'Could not fix log - missing special column configuration.');
//     }

//     $matchTableName = $specialColumnConfig->match_table;
//     $matchFieldName = $specialColumnConfig->match_field;

//     $matchModelName = 'App\\Models\\' . ucfirst(Str::camel($matchTableName));
//     if (!class_exists($matchModelName)) {
//         \Log::error('Invalid match table name', ['match_table_name' => $matchTableName]);
//         return redirect('/fixer')->with('error', 'Could not fix log - invalid match table name.');
//     }

//     $fixValue = $request->input('fix_value');
//     if (!$fixValue) {
//         \Log::error('Missing fix value', ['log_id' => $log->id]);
//         return redirect('/fixer')->with('error', 'Could not fix log - missing fix value.');
//     }

//     $matchRecord = $matchModelName::find($fixValue);
//     if (!$matchRecord) {
//         \Log::error('Invalid fix value', ['fix_value' => $fixValue]);
//         return redirect('/fixer')->with('error', 'Could not fix log - invalid fix value.');
//     }

//     // Update the target record
//     $targetModelName = 'App\\Models\\' . ucfirst($log->oo_model->model_name);
//     if (!class_exists($targetModelName)) {
//         \Log::error('Invalid target model name', ['target_model_name' => $targetModelName]);
//         return redirect('/fixer')->with('error', 'Could not fix log - invalid target model name.');
//     }

//     $targetRecord = $targetModelName::find($log->target_id);
//     if (!$targetRecord) {
//         \Log::error('Missing target record', ['target_id' => $log->target_id]);
//         return redirect('/fixer')->with('error', 'Could not fix log - missing target record.');
//     }

//     $targetRecord->{$log->missing_field} = $matchRecord->{$matchFieldName};
//     $targetRecord->save();

//     // Mark the log as fixed
//     $log->fixed = 1;
//     $log->save();

//     \Log::info('Log fixed successfully', ['log_id' => $log->id]);
//     return redirect('/fixer')->with('success', 'Log fixed successfully!');
// }



}
