<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index() {
        return Module::all();
    }
    
    public function components(Module $module) {
        return $module->components;
    }
    
}
