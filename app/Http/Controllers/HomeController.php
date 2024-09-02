<?php

namespace App\Http\Controllers;
use App\Models\Person;
use App\Models\UserCustomStyles;
use App\Models\BuMembershipType ;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facade as Debugbar;
use App\Models\LayoutPreference;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // This will fetch the current layout from the configuration file and pass it to the view.
    public function index()
    {
        // Determine if the access should be denied
        $accessDenied = false;
        if (Auth::check() && (!Auth::user()->person || !Auth::user()->person->employee) && !session('bypass_access')) {
            $accessDenied = true;
        }

        $layout = config('layout.current');
        
        $styles = UserCustomStyles::where('users_id', Auth::id())->first();

        // Fetch the latest 10 notifications for the logged-in user
        $latestNotifications = auth()->user()->notifications()->latest()->take(10)->get();
        
        // Fetch all records from bu_membership_type table
        $membershipTypes = BuMembershipType::all();

        // Pass the accessDenied variable to the view
        return view('home', compact('layout', 'styles', 'latestNotifications', 'membershipTypes', 'accessDenied'));
    }
    
    

    public function index2()
    {
        $layout2 = config('layout.current');
        // dd($layout);
        Debugbar::info($layout2);

        return view('home', compact('layout2'));
        // return view('landing', compact('layout'));
    }

    public function getChartData()
    {
        $currentYear = Carbon::now()->year;

        $monthlyData = Person::selectRaw(
            "
                MONTH(created_at) as month,
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18 THEN 1 END) as '<18',
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 34 THEN 1 END) as '18-34',
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 35 AND 49 THEN 1 END) as '35-49',
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 50 AND 64 THEN 1 END) as '50-64',
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 65 THEN 1 END) as '65+'
            ",
        )
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $summaryTotals = Person::selectRaw(
            "
                COUNT(CASE WHEN gender_id = '1' THEN 1 END) as 'main_member',
                COUNT(CASE WHEN gender_id = '2' THEN 1 END) as 'dependant',
                COUNT(CASE WHEN gender_id = 'M' THEN 1 END) as 'spouse',
                COUNT(CASE WHEN gender_id = 'F' THEN 1 END) as 'child',
                COUNT(CASE WHEN gender_id = 1 THEN 1 END) as 'male',
                COUNT(CASE WHEN gender_id = 2 THEN 1 END) as 'female'
            ",
        )
            ->get()
            ->first();

        return response()->json([
            'monthlyData' => $monthlyData,
            'summaryTotals' => $summaryTotals,
        ]);
    }

    public function getChartData2()
    {
        $data = DB::table('membership')
              ->join('bu_membership_type', 'membership.bu_membership_type_id', '=', 'bu_membership_type.id')
              ->select(
                  'bu_membership_type.name as typeName',
                  'bu_membership_type.description as typeDescription',
                  'bu_membership_type.membership_fee as typeFee',
                  DB::raw('count(*) as count')
              )
              ->groupBy('bu_membership_type_id')
              ->get();

        return response()->json($data);
    }

}
