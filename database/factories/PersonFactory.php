<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fname =  $this->faker->firstName(); 
        $Sname = $this->faker->lastName();

        $minYear = Carbon::now()->year - 60;
        $maxYear = Carbon::now()->year - 21;

        $year = $this->faker->numberBetween($minYear, $maxYear);
        // $year = $this->faker->year($max = 'now');
        $monthAndDay = $this->faker->date($format = 'm-d', $max = 'now');
        $month = substr($monthAndDay, 0, 2);
        $day =substr($monthAndDay, 3, 5);

        return [

        'first_name' => $fname,
        'initials' => substr($fname, 0, 1).".".ucfirst(substr($Sname, 0, 1)),
        'last_name' => $Sname,
        'screen_name' => $fname . " " . $Sname,
        'id_number' => substr($year, 2, 4).$month.$day.$this->faker->unique()->numerify('#######'),
        'birth_date' => $year.'-'.$monthAndDay.' 00:00:00',
        'married_status' => $this->faker->numberBetween(1, 4),
        'gender_id' => $this->faker->randomElement(['M','F']),
        'residence_country_id'=> '197',
        ];
    }
}
