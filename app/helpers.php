<?php
/**
 * PHP version 9
 *
 * @author    Siyabonga Alexander Mnguni <alexmnguni57@gmail.com>
 * @copyright 2023 1Office
 * @license   MIT License
 * @link      https://github.com/alexmnguni57/1Office-GBA
 */
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Membership;

//This Changes the background color of the age (Green/Yellow/Red)

# code...
if (!function_exists('changeAgeBackground')) {
    function changeAgeBackground($age)
    {
        if ($age < 15) {
            return 'bg-success';
        } elseif ($age < 20) {
            return 'bg-warning';
        } else {
            return 'bg-danger';
        }
    }
}

//This returns the age of a person from their date of birth
if (!function_exists('ageFromDOB')) {
    function ageFromDOB($dob)
    {
        return Carbon::parse($dob)->diff(Carbon::now())->y;
    }
}

if (!function_exists('dobBreakdown')) {
    function dobBreakdown($dob)
    {
        return new Carbon($dob);
    }
}

//These call a stored procedure in the database to check if a record exists, if it doesnt exist it is then added
//Stored Procedure Call For Country
if (!function_exists('checkCountry')) {
    function checkCountry($countryName)
    {
        DB::select('CALL store_country(?)', [$countryName]);
    }
}

if (!function_exists('checkProvince')) {
    //Stored Procedure Call For Province
    function checkProvince($provinceName, $countryID)
    {
        DB::select('CALL store_province(?,?)', [$provinceName, $countryID]);
    }
}

if (!function_exists('checkCity')) {
    //Stored Procedure Call For City
    function checkCity($cityName, $countryID, $provinceID)
    {
        DB::select('CALL store_city(?,?,?)', [$cityName, $countryID, $provinceID]);
    }
}

//SA ID Validation

if (!function_exists('verify_id_number')) {
    function verify_id_number($id_number)
    {
        $validated = false;

        if (is_numeric($id_number) && strlen($id_number) === 13) {
            $errors = false;

            $num_array = str_split($id_number);

            // Validate the day and month

            $id_month = $num_array[2] . $num_array[3];

            $id_day = $num_array[4] . $num_array[5];

            if ($id_month < 1 || $id_month > 12) {
                $errors = true;
            }

            if ($id_day < 1 || $id_day > 31) {
                $errors = true;
            }

            //Just added this for February but it doesnt check for leap-year
            if (($id_month == 2 && $id_day < 1) || $id_day > 28) {
                $errors = true;
            }

            // Validate gender

            //When using this validation, add a parameter for gender (, $gender = '') next to $id_number

            // $id_gender = $num_array[6] >= 5 ? 'male' : 'female';

            // if ($gender && strtolower($gender) !== $id_gender) {

            //     $errors = true;

            // }

            // if errors haven't been set to true by any one of the checks, we can change verified to true;
            if (!$errors) {
                $validated = true;
            }
        }

        return $validated;
    }


    if (!function_exists('generateUniqueMembershipCode')) {
        /**
         * Generate a unique membership code.
         *
         * @return string
         */
        function generateUniqueMembershipCode()
        {
            do {
                // Generate a numeric part (e.g., a random number between 10000 and 99999)
                $numbers = rand(10000, 99999);
                // Generate 3 random characters
                $randomCharacters = strtoupper(Str::random(3));
                // Combine to form the code without dashes
                $code = 'M' . $numbers . $randomCharacters;
            } while (Membership::where('membership_code', $code)->exists());
         
            // M54321QWE
            // M98765RTY
            // M23456UIO
            // M45678JKL
         
            return $code;
        }
    }
    
}
