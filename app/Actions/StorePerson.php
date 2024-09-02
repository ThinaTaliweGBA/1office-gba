<?php
/**
 * PHP version 9
 *
 * @author    Siyabonga Alexander Mnguni <alexmnguni57@gmail.com>
 * @author    Thina Taliwe <thina.taliwe2@gmail.com>
 * @copyright 2023 1Office
 * @license   MIT License
 * @link      https://github.com/alexmnguni57/1Office-GBA
 */
namespace App\Actions;

use App\Models\Person;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Log;


/**
 * Class StorePerson
 *
 * @package App\Actions
 */
class StorePerson
{
   
    /**
     * Handles the data to store a new person record
     *
     * @param mixed $data //
     * 
     * @return Person
     */
    public function handle($data): Person
    {
        Log::info("Data received", (array) $data);
        // dd($data); Uncomment this line for debugging purposes

        $initials = ucfirst(substr($data->Name, 0, 1)) . '.' . ucfirst(substr($data->Surname, 0, 1));

        $person = new Person();
        $person->first_name = ucfirst($data->Name);
        $person->initials = $initials;
        $person->last_name = ucfirst($data->Surname);
        $person->screen_name = $data->Name . ' ' . ucfirst($data->Surname);
        $person->id_number = $data->IDNumber;
        $person->birth_date = $data->inputYear . '-' . $data->inputMonth . '-' . $data->inputDay;
        $person->married_status = $data->marital_status;
        $person->gender_id = $data->radioGender;
        $person->residence_country_id = 197;

        Log::info("Attempting to save person with ID: {$data->IDNumber}");

        try {
            $person->save();
            Log::alert("Person saved successfully");
            return $person;
        } catch (\Exception $exception) {
            Log::error("Couldn't save person: " . $exception->getMessage());
            throw $exception; // Just throw the exception
        }
        
        

        return $person;
    }
}
