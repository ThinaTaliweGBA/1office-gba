<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;


class WarehouseController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'bu_id' => 'required|exists:bu,id', // assuming the table name for 'bu' is 'bu'
            'site_id' => 'required|exists:site,id', // assuming the table name for 'site' is 'sites'
            'short_code' => 'required|max:255',
            'description' => 'nullable|max:255',
            'address_id' => 'required|exists:address,id', // assuming the table name for 'address' is 'addresses'
            'intransit_warehouse' => 'required|in:1,0'
        ]);

        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        $warehouse->bu_id = $request->bu_id;
        $warehouse->site_id = $request->site_id;
        $warehouse->short_code = $request->short_code;
        $warehouse->description = $request->description;
        $warehouse->address_id = $request->address_id;
        $warehouse->intransit_warehouse = $request->intransit_warehouse == 1 ? true : false; // assuming the intransit_warehouse is a boolean field
        $warehouse->save();

        return response()->json($warehouse);
    }
}

