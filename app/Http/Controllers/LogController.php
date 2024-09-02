<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Address;
use Illuminate\Http\Request;

class LogController extends Controller
{

    public function show(Request $request)
    {
        //$logs = $this->getLogs();
        //return view('logs.show', compact('logs'));


        

            $addresses = Address::all();
            //dd($addresses);
            return response()->json($addresses);
            //return view('logs.show', compact('addresses'));

    }

    private function getLogs(): string
    {
        $logPath = storage_path('logs/laravel.log');
        if (File::exists($logPath)) {
            return File::get($logPath);
        }

        return 'Log file does not exist.';
    }

    public function showtable(Request $request)
    {
        return view('logs.showtable');
    }
    
}
