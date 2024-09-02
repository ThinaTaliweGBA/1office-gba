<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function memberProfilesReport()
    {
        $memberProfiles = DB::connection('mapping')
            ->table('lededata')
            ->limit(10)
            ->get();
        //dd($memberProfiles);

        //////////////////////////////////////////////
        $ageDistribution = DB::connection('mapping')
            ->table('lededata')
            ->selectRaw('TIMESTAMPDIFF(YEAR, gebdat, CURDATE()) AS age')
            ->groupBy('age')
            ->get();
        //dd($ageDistribution);
        $genderDistribution = DB::connection('mapping')
            ->table('lededata')
            ->selectRaw('SEX, COUNT(*) as total')
            ->groupBy('SEX')
            ->get();
        //dd($genderDistribution);
        ////////////////////////////////////////////////

        $regionDistribution = DB::connection('mapping')
            ->table('lededata')
            ->selectRaw('STREEK, COUNT(*) as total')
            ->groupBy('STREEK')
            ->get();
        //dd($regionDistribution);

        /////////////////////////////////////////////////////////
        $payments = DB::connection('mapping')
            ->table('lededata')
            ->select('BETDAT', 'BETAAL')
            ->get();
        //dd($payments);

        ///////////////////////////////////////////////////////////////
        $claims = DB::connection('mapping')
            ->table('lededata')
            ->select('VersekerKode', 'EISDAT')
            //->orderBy('VersekerKode') // You must specify a column to order by
            ->first();
        //dd($claims);

        ////////////////////////////////////////////////////////////////
        $emailPreferences = DB::connection('mapping')
            ->table('lededata')
            ->where('CorrespondenceEmail', 1)
            ->count();

        $smsPreferences = DB::connection('mapping')
            ->table('lededata')
            ->where('CorrespondenceSMS', 1)
            ->count();

        //dd($emailPreferences);
        //dd($smsPreferences);

        ////////////////////////////////////////////////////////////////
        $recordsToAudit = DB::connection('mapping')
            ->table('lededata')
            ->where('CheckAudit', 1)
            ->first();

        //dd( $recordsToAudit );

        ////////////////////////////////////////////////////////////////
        $lifecycleEvents = DB::connection('mapping')
            ->table('lededata')
            ->select('JOINDAT', 'AKTIEF', 'LIDDOOD', 'BEDANK')
            ->limit(10)
            ->get();
        //dd($lifecycleEvents);

        return view('lededata.profile', compact('memberProfiles', 'ageDistribution', 'genderDistribution', 'regionDistribution', 'payments', 'claims', 'emailPreferences', 'smsPreferences', 'recordsToAudit', 'lifecycleEvents'));
    }

    public function membershipGrowthAndRetentionReport()
    {
        // Fetch the data from the database
        $newMemberships = DB::connection('mapping')
            ->table('lededata')
            ->selectRaw('YEAR(joindat) as year, MONTH(joindat) as month, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderByRaw('YEAR(joindat) DESC, MONTH(joindat) DESC')
            ->limit(5)
            ->get();

        return view('lededata.growth')->with('membershipData', $newMemberships);
        //return view('lededata.overview', compact('newtotalMemberships'));
    }

    public function demographicReport()
    {
        // Fetch the data from the database
        $newMemberships = DB::connection('mapping')
            ->table('lededata')
            ->selectRaw('YEAR(joindat) as year, MONTH(joindat) as month, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderByRaw('YEAR(joindat) DESC, MONTH(joindat) DESC')
            ->limit(5)
            ->get();

        return view('lededata.demographic')->with('membershipData', $newMemberships);
        //return view('lededata.overview', compact('newtotalMemberships'));
    }

    public function geographicReport()
    {
        return view('lededata.geographic');
    }

    public function financialReport()
    {
        return view('lededata.financial');
    }

    public function lifecycleReport()
    {
        return view('lededata.lifecycle');
    }

    public function insuranceClaimsReport()
    {
        return view('lededata.insurance');
    }

    public function communicationReport()
    {
        return view('lededata.communication');
    }

    public function auditReport()
    {
        return view('lededata.audit');
    }
}
