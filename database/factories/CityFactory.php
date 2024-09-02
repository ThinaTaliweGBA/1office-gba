<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\en_ZA\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => Address::cityPrefix(). " " . Address::citySuffix(),
            'province_id' => Province::all()->random()->id,
            'country_id' => Country::all()->random()->id,
        ];
    }
}
