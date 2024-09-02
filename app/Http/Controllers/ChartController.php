<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use Spatie\QueryBuilder\QueryBuilder;
use App\Services\DistributionReport;
use Carbon\Carbon;
use App\Models\Gender;

// Classes used within the Person and Membership datatables
class ChartController extends Controller
{
    // Main function that uses the filtered data inputs to provide outputs
    public function index(Request $request)
    {
        $genders = Gender::all()->pluck('id', 'id')->toArray();
        $genderColors = [
            '1' => '#007bff', // Blue for Male
            '2' => '#ff7db0', // Pink for Female
            'F' => '#ff7db0', // Pink for Female
            'M' => '#007bff', // Blue for Male
            'N' => '#f0ad4e', // Orange for Gender Neutral
            'U' => '#6c757d', // Grey for Undeclared Gender
            'XD' => '#17a2b8', // Cyan for Undefined Data
            'XK' => '#28a745', // Green for Unknown Data
        ];

        $filters = [
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'gender_id' => $request->input('gender_id'), // Gender filter
            'language_id' => $request->input('language_id'), // Language filter
        ];

        $data = $this->fetchData($filters);

        $oldest = $data->max('membership_code');
        //dd($oldest);

        // Calculate male and female members
        $maleMembers = $data->where('gender_id', 'M')->count();
        $femaleMembers = $data->where('gender_id', 'F')->count();

        // Calculate english and afrikaans speaking members
        $enMembers = $data->where('language_id', 1)->count();
        $afMembers = $data->where('language_id', 2)->count();

        // Get all the Total data in membership table
        $totalMemberships = DB::table('membership')->count();
        $totalMembershipsActive = DB::table('membership')->whereNull('deleted_at')->count();
        $totalMembershipsDeleted = $totalMemberships - $totalMembershipsActive;

        // Get memberships based on gender
        $membershipsByGender = DB::table('membership')->select('gender_id', DB::raw('count(id) as count'))->groupBy('gender_id')->get();
        $membershipsByGenderActive = DB::table('membership')->whereNull('deleted_at')->select('gender_id', DB::raw('count(id) as count'))->groupBy('gender_id')->get();
        $membershipsByGenderDeleted = DB::table('membership')->whereNotNull('deleted_at')->select('gender_id', DB::raw('count(id) as count'))->groupBy('gender_id')->get();

        // Get membership based on its type
        $membershipsByType = DB::table('membership')->select('bu_membership_type_id', DB::raw('count(id) as count'))->groupBy('bu_membership_type_id')->get();
        $membershipsByTypeActive = DB::table('membership')->whereNotNull('deleted')->select('bu_membership_type_id', DB::raw('count(id) as count'))->groupBy('bu_membership_type_id')->get();
        $membershipsByTypeDeleted = DB::table('membership')->whereNull('deleted')->select('bu_membership_type_id', DB::raw('count(id) as count'))->groupBy('bu_membership_type_id')->get();

        // Average membership fee by region
        $averageFeeByRegion = DB::table('membership')->select('bu_membership_region_id', DB::raw('AVG(membership_fee) as average_fee'))->groupBy('bu_membership_region_id')->get();
        $averageFeeByRegionActive = DB::table('membership')->whereNotNull('deleted')->select('bu_membership_region_id', DB::raw('AVG(membership_fee) as average_fee'))->groupBy('bu_membership_region_id')->get();
        $averageFeeByRegionDeleted = DB::table('membership')->whereNull('deleted')->select('bu_membership_region_id', DB::raw('AVG(membership_fee) as average_fee'))->groupBy('bu_membership_region_id')->get();

        // Get membership data based on trends
        $yearlyMembershipTrends = DB::table('membership')->select(DB::raw('YEAR(join_date) as year'), DB::raw('count(id) as count'))->groupBy(DB::raw('YEAR(join_date)'))->orderBy(DB::raw('YEAR(join_date)'), 'asc')->get();
        $yearlyMembershipTrendsActive = DB::table('membership')->whereNotNull('deleted')->select(DB::raw('YEAR(join_date) as year'), DB::raw('count(id) as count'))->groupBy(DB::raw('YEAR(join_date)'))->orderBy(DB::raw('YEAR(join_date)'), 'asc')->get();
        $yearlyMembershipTrendsDeleted = DB::table('membership')->whereNull('deleted')->select(DB::raw('YEAR(join_date) as year'), DB::raw('count(id) as count'))->groupBy(DB::raw('YEAR(join_date)'))->orderBy(DB::raw('YEAR(join_date)'), 'asc')->get();

        // Reasons for ending membership
        $membershipsEndedByReason = DB::table('membership')->whereNotNull('end_reason')->select('end_reason', DB::raw('count(id) as count'))->groupBy('end_reason')->get();

        // Get all members that have not paid in the last month
        $unpaidMembersGrouped = DB::table('membership')
            ->select(
                DB::raw('CASE
            WHEN TIMESTAMPDIFF(MONTH, join_date, NOW()) <= 6 THEN TIMESTAMPDIFF(MONTH, join_date, NOW())
            ELSE 7
        END AS months_owed_group'),
                DB::raw('COUNT(*) as member_count'),
            )
            ->groupBy(DB::raw('months_owed_group'))
            ->orderBy('months_owed_group', 'asc')
            ->get();

        $genderOwingCounts = DB::table('membership')->select('gender_id', DB::raw('COUNT(*) as member_count'))->groupBy('gender_id')->get();

        // dd($membershipsEndedByReason);
        $membershipTypeMapping = [
            '1' => 'Age : [0-35]',
            '2' => 'Age : [36-55]',
            '3' => 'Age : [56+]',
        ];

        // $highestValue = max($membershipsByType->pluck('count')->toArray());
        // $lowestValue = min($membershipsByType->pluck('count')->toArray());

        // $highestValueActive = max($membershipsByTypeActive->pluck('count')->toArray());
        // $lowestValueActive = min($membershipsByTypeActive->pluck('count')->toArray());

        // $highestValueDeleted = max($membershipsByTypeDeleted->pluck('count')->toArray());
        // $lowestValueDeleted = min($membershipsByTypeDeleted->pluck('count')->toArray());

        $highestValue = $this->getMaxValueOrDefault($membershipsByType);
        $lowestValue = $this->getMinValueOrDefault($membershipsByType);

        $highestValueActive = $this->getMaxValueOrDefault($membershipsByTypeActive);
        $lowestValueActive = $this->getMinValueOrDefault($membershipsByTypeActive);

        $highestValueDeleted = $this->getMaxValueOrDefault($membershipsByTypeDeleted);
        $lowestValueDeleted = $this->getMinValueOrDefault($membershipsByTypeDeleted);

        // $genderOwingCounts = GenderCount::all(); // Replace with your query logic

        $maxCount = $genderOwingCounts->max('member_count');
        $minCount = $genderOwingCounts->min('member_count');
        $averageCount = $genderOwingCounts->avg('member_count'); // Calculate average

        // Get all the Total data in membership table
        //$newtotalMemberships =DB::connection('mapping')->table('lededata')->first();
        //dd($newtotalMemberships);

        return view('report.index', compact('data', 'genders', 'genderColors', 'averageCount', 'genderOwingCounts', 'maxCount', 'minCount', 'lowestValueDeleted', 'highestValueDeleted', 'lowestValueActive', 'highestValueActive', 'highestValue', 'lowestValue', 'membershipTypeMapping', 'genderOwingCounts', 'unpaidMembersGrouped', 'membershipsEndedByReason', 'yearlyMembershipTrends', 'yearlyMembershipTrendsActive', 'yearlyMembershipTrendsDeleted', 'averageFeeByRegion', 'averageFeeByRegionActive', 'averageFeeByRegionDeleted', 'totalMemberships', 'totalMembershipsActive', 'totalMembershipsDeleted', 'membershipsByGender', 'membershipsByGenderActive', 'membershipsByGenderDeleted', 'membershipsByType', 'membershipsByTypeActive', 'membershipsByTypeDeleted', 'filters', 'oldest', 'maleMembers', 'femaleMembers', 'enMembers', 'afMembers'));
    }

    // Helper function to get filter's data
    private function fetchData($filters)
    {
        // Retrieve and filter data from your database
        $query = DB::table('membership')->whereBetween('created_at', [$filters['date_from'], $filters['date_to']]);
        //dd($query);

        // Apply gender filter if provided
        if (isset($filters['gender_id']) && !empty($filters['gender_id'])) {
            $query->where('gender_id', $filters['gender_id']);
        }

        // Apply language filter if provided
        if (isset($filters['language_id']) && !empty($filters['language_id'])) {
            $query->where('language_id', $filters['language_id']);
        }

        // Execute the query and return the data
        $data = $query->get();

        return $data;
    }

    public function show()
    {
        return view('chart');
    }

    public function generatePdf(Request $request)
    {
        $imgData = $request->input('imgData');
        $pdf = PDF::loadView('pdf', ['imgData' => $imgData]);
        return $pdf->download('report.pdf');
    }

    public function getData()
    {
        $dataset1 = DB::table('person_has_person')->pluck('primary_person_id');
        $dataset2 = DB::table('person_has_person')->pluck('secondary_person_id');
        $dataset3 = DB::table('person_has_person')->pluck('person_relationship_id');

        return response()->json([
            'dataset1' => $dataset1,
            'dataset2' => $dataset2,
            'dataset3' => $dataset3,
        ]);
    }

    public function personIndex(Request $request)
    {
        $persons = DB::table('person')->get();
        // $persons = DB::table('person');

        $firstPerson = DB::table('person')->first();
        $oldestMember = DB::table('person')->orderBy('birth_date', 'asc')->first();
        $youngestMember = DB::table('person')->orderBy('birth_date', 'desc')->first();

        // Calculating average age
        $totalAge = 0;
        $totalPersons = 0;

        foreach ($persons as $person) {
            $totalAge += Carbon::parse($person->birth_date)->age;
            $totalPersons++;
        }

        $averageAge = $totalPersons ? $totalAge / $totalPersons : 0;

        $genderData = DB::table('person')->select('gender_id', DB::raw('count(*) as count'))->groupBy('gender_id')->get();
        // Calculate male and female members
        $countMaleMembers = $persons->where('gender_id', 'M')->count();
        $countFemaleMembers = $persons->where('gender_id', 'F')->count();

        $maritalData = DB::table('person')->select('married_status', DB::raw('count(*) as count'))->groupBy('married_status')->get();
        // $genderLabels = $genderReport->getLabels();

        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        // $weeks = $request->input('weeks', 8); // default to 8 week

        $weeks = $request->input('weeks', 1); // default to 1 week
        $recentPersons = DB::table('person')
            ->where('created_at', '>=', now()->subWeeks($weeks))
            ->orderBy('updated_at') // sorting by rank
            ->get();

        // $recentPersons = DB::table('person')
        //     ->where('created_at', '>', Carbon::now()->subWeeks($weeks))
        //     ->get();
        //////////////////////////////////////////////////////////////////////////////////////////////////////

        $chartData = DB::table('person')->select(DB::raw('gender_id, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) as age, count(*) as count'))->groupBy(DB::raw('gender_id, TIMESTAMPDIFF(YEAR, birth_date, CURDATE())'))->get();

        $filters = [
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'gender_id' => $request->input('gender_id'), // Gender filter
            'birth_date' => $request->input('birth_date'),
            'married_status' => $request->input('married_status'),
        ];

        $data = $this->fetchPersonData($filters);

        // distributionReport();
        return view('report.person', ['data' => $data, 'filters' => $filters, 'persons' => $persons, 'genderData' => $genderData, 'maritalData' => $maritalData, 'recentPersons' => $recentPersons, 'weeks' => $weeks, 'firstPerson' => $firstPerson, 'averageAge' => $averageAge, 'countMaleMembers' => $countMaleMembers, 'countFemaleMembers' => $countFemaleMembers, 'youngestMember' => $youngestMember, 'oldestMember' => $oldestMember, 'chartData' => json_encode($chartData)]);
    }

    private function fetchPersonData($filters)
    {
        // Retrieve and filter data from your database
        $query = DB::table('person')->whereBetween('created_at', [$filters['date_from'], $filters['date_to']]);

        // Apply gender filter if provided
        if (isset($filters['gender_id']) && !empty($filters['gender_id'])) {
            $query->where('gender_id', $filters['gender_id']);
        }

        // Apply language filter if provided
        if (isset($filters['birth_date']) && !empty($filters['birth_date'])) {
            $query->where('birth_date', $filters['birth_date']);
        }

        // Apply language filter if provided
        if (isset($filters['married_status']) && !empty($filters['married_status'])) {
            $query->where('married_status', $filters['married_status']);
        }

        // Execute the query and return the data
        $data = $query->get();

        return $data;
    }

    public function distributionReport()
    {
        $genderReport = new DistributionReport('person', 'gender_id');
        $genderReport->setLabelMapping([
            1 => 'Male',
            2 => 'Female',
        ]);

        $maritalReport = new DistributionReport('person', 'married_status');
        $maritalReport->setLabelMapping([
            1 => 'Married',
            2 => 'Single',
            3 => 'Divorced',
            4 => 'Widowed',
        ]);

        return view('report.person', [
            'genderLabels' => $genderReport->getLabels(),
            'genderValues' => $genderReport->getValues(),
            'maritalLabels' => $maritalReport->getLabels(),
            'maritalValues' => $maritalReport->getValues(),
        ]);
    }

    ///////////////////////////// Start Helper functions    //////////////////////////////
    /**
     * Get the maximum value from an array with a default fallback.
     *
     * @param  \Illuminate\Support\Collection  $collection
     * @return int
     */
    private function getMaxValueOrDefault($collection): int
    {
        $values = $collection->pluck('count')->toArray();
        return empty($values) ? 0 : max($values);
    }

    /**
     * Get the minimum value from an array with a default fallback.
     *
     * @param  \Illuminate\Support\Collection  $collection
     * @return int
     */
    private function getMinValueOrDefault($collection): int
    {
        $values = $collection->pluck('count')->toArray();
        return empty($values) ? 0 : min($values);
    }
    // ////////////////////////  End Helper Functions //////////////////////////////////////////////
}
