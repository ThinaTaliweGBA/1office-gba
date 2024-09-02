<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $cityID =  City::all()->random()->id;
        $provinceID =  Province::all()->random()->id;

        return [
            'adress_type_id' => 1,
            'line1' =>$this->faker->streetAddress(),
            'suburb' =>$this->faker->citySuffix(),
            'city_id' => $cityID,
            'city' => City::where('id', $cityID)->first()->name,
            'ZIP' =>$this->faker->postcode(),
            // 'district' =>$this->faker->,
            'province_id' =>$provinceID,
            'province' =>Province::where('id', $provinceID)->first()->name,
            'country_id' => Country::all()->random()->id,
        ];
    }
}
