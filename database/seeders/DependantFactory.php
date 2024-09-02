<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dependant>
 */
class DependantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $person = Dependant::class;
     

   // private static $id = 1;

    public function definition()
    {
        //$person = Person::all();
        return [
           // 'id' => self::$id++,
           // 'primary_person_id' => Person::factory()->create()->id,
            //'secondary_person_id' => Person::factory()->create()->id,
            //'person_relationship_id' => $this->faker->numberBetween(1,2)
        ];
    }

    public function getFaker()
    {
        return $this->faker;
    }
}
