<?php

namespace App\Http\Controllers;

use PDF;
use App\Http\Requests\StoreDependantRequest;
use App\Models\Dependant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\MembershipPaymentReceipt;
use DB;
use Carbon\Carbon;


class ReportsController extends Controller
{
    //
    public function index()
    {
        // you might want to get some data to pass to your view
        $reports = Report::all();
        return view('reports.index', ['reports' => $reports]);
    }

    public function show(Report $report)
    {
        // you might want to get some data to pass to your view
        
        return view('reports.show', ['report' => $report]);
    }

    public function store(Request $request)
    {
        // validate the request data
        $data = $request->validate([
            'report_type' => 'required',
            'report_data' => 'required',
        ]);

        // create a new report using the request data
        $report = Report::create($data);

        // redirect the user to the new report
        return redirect()->route('reports.show', ['report' => $report]);
    }

    public function exportCsv(Report $report)
    {
        $filename = 'report_' . $report->id . '.csv';
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $handle = fopen('php://output', 'w');
        // Add CSV headers
        fputcsv($handle, ['ID', 'Report Type', 'Report Data']);
        fputcsv($handle, [$report->id, $report->report_type, $report->report_data]);

        fclose($handle);

        return response()->stream(
            function () use ($handle) {
                fclose($handle);
            },
            200,
            $headers,
        );
    }

    public function exportPdf(Report $report)
    {
        $pdf = PDF::loadView('reports.pdf', ['report' => $report]);
        return $pdf->download('report_' . $report->id . '.pdf');
    }

    /////////////////////////  This is a function to get all the data from the database  ///////////////////////////////////////////////////
    public function getReport()
    {
        // Simulating report data
        $data = [
            'items' => [
                1 ,
                rand(4, 100) ,
                rand(4, 100) ,
                rand(4, 100) ,
                rand(4, 100) ,
                rand(4, 100)  // Random item to simulate real-time data
            ]
        ];

        // return response()->json($data);
        return view('reporting', ['data' => $data]);
    
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function person(Request $request)
    {
        $interval = $request->input('interval');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $query = DB::table('membership');

        // Handle the interval logic
        // ... (as provided in the previous answer)

        if ($dateFrom) {
            $query->where('join_date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('join_date', '<=', $dateTo);
        }

        $results = $query->get();

        // Pass the results and filters to the view
        return view('report.person', ['results' => $results,'filters' => ['interval' => $interval,'date_from' => $dateFrom,'date_to' => $dateTo]]);
    }

    public function pivotGrid()
    {
        return view('pivotGrid');
    }

    public function dependantsGrid()
    {
        // Fetch all addresses from the database
        $payments = MembershipPaymentReceipt::all(); // Make sure you have the Address model created and it is properly linked to your database table
        $paymentsJSON = (response()->json($payments));
        //dd($payments);
        // Pass the addresses to the view
        //response()->json($payments);
        return view('dependantsGrid', ['payments' => $payments, 'paymentsJSON' => $paymentsJSON]);
    }
}
