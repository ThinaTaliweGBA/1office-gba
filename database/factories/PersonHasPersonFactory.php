<?php

namespace Database\Factories;

use App\Models\PersonHasPerson;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonHasPersonFactory extends Factory
{
    protected $model = PersonHasPerson::class;

    public function definition()
    {
        static $id = 9;

        return [
            'id' => $id++,
            'primary_person_id' => $this->faker->numberBetween(1, 10),
            'secondary_person_id' => $this->faker->numberBetween(2, 17),
            'person_relationship_id' => $this->faker->numberBetween(1, 2),
            'start_date' => null,
            'end_date' => null,
            'end_reason' => null,
            'deleted' => null,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ];
    }
}
