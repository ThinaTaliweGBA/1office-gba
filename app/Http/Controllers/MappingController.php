<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


use App\Models\System;
use App\Models\Company;
use App\Models\Bu;
use App\Models\Warehouse;
use App\Models\Address;
use App\Models\Component;
use App\Models\Preset;
use App\Models\Mapping;
use App\Models\Module;
use App\Models\OneoModel;
use App\Models\Site;
use App\Models\SourceErpSystem;

class MappingController extends Controller
{
    public function showMappingAndPreset()
{
    $erp_systems = SourceErpSystem::all();
    $models = OneoModel::all();
    $modules = Module::all();
    $components = Component::all();

    $systems = System::all();
    $companies = Company::all();
    $bus = Bu::all();
    $warehouses = Warehouse::all();
    $addresses = Address::all();

    $presets = Preset::all();
    $sites = Site::all();

    return view('mapping', compact('erp_systems','systems','companies','bus','warehouses','addresses','presets', 'sites', 'models', 'modules', 'components' /*, other variables...*/));
}


    public function getTables($connection)
    {
        try {
            $tables = DB::connection($connection)->select('SHOW TABLES');
            return response()->json($tables);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getColumns($connection, $table)
    {
        try {
            $columns = DB::connection($connection)->getSchemaBuilder()->getColumnListing($table);
            return response()->json($columns);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function saveMapping(Request $request)
    {
        Log::info('Starting to save mapping', ['request' => $request->all()]);
    
        try {
            $data = $request->validate([
                'system_id' => 'required',
                'company_id' => 'required',
                'bu_id' => 'required',
                'source_db' => 'required',
                'source_table' => 'required',
                'source_column' => 'required',
                'target_db' => 'required',
                'target_table' => 'required',
                'target_column' => 'required',
                'database_presets_id' => 'required',
                'source_erp_system_id' => 'required',
                'oo_model_id' => 'required',
            ]);

            Log::info('Before trying to save', ['data' => $data]);
    
            $mapping = DB::connection('1office')->table('column_mappings')->insert($data);
            
            Log::info('Mapping saved successfully', ['data' => $data]);
    
            return response()->json(['message' => 'Mapping saved successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to save mapping', ['error' => $e->getMessage(), 'request' => $request->all()]);
            return response()->json(['message' => 'Failed to save mapping', 'error' => $e->getMessage()], 500);
        }
    }

    public function getMappings()
    {
        try {
            $mappings = DB::connection('1office')->table('column_mappings')->get();
            return response()->json($mappings);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteMapping($id)
    {
        try {
            $mapping = Mapping::find($id);
            if ($mapping) {
                $mapping->delete();
                return response()->json(['success' => 'Mapping deleted successfully']);
            } else {
                return response()->json(['error' => 'Mapping not found'], 404);
            }
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
