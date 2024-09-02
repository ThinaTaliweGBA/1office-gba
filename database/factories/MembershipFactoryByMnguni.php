<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Membership;

class MembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Membership::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'membership_code' => Str::random(10),
            'name' => $this->faker->name,
            'initials' => $this->faker->randomLetter . $this->faker->randomLetter,
            'surname' => $this->faker->lastName,
            'id_number' => $this->faker->unique()->randomNumber(8),
            'join_date' => $this->faker->dateTime,
            'end_date' => $this->faker->dateTime,
            'end_reason' => $this->faker->sentence,
            'gender_id' => $this->faker->randomElement(['M', 'F']),
            'bu_membership_type_id' => $this->faker->randomElement(['1']),
            'bu_membership_region_id' => $this->faker->randomElement(['1', '2', '3']),
            'bu_membership_status_id' => $this->faker->randomElement(['1', '2', '3']),
            'language_id' => $this->faker->randomElement(['1', '2']),
            'person_id' => $this->faker->randomNumber(4),
            'previous_membership_id' => $this->faker->randomNumber(4),
            'primary_contact_number' => $this->faker->phoneNumber,
            'secondary_contact_number' => $this->faker->phoneNumber,
            'tertiary_contact_number' => $this->faker->phoneNumber,
            'sms_number' => $this->faker->phoneNumber,
            'primary_e_mail_address' => $this->faker->email,
            'secondary_e_mail_address' => $this->faker->email,
            'membership_fee' => $this->faker->randomFloat(4, 0, 1000),
            'fee_currency_id' => 1,
            'last_payment_date' => $this->faker->dateTime,
            'paid_till_date' => $this->faker->dateTime,
            'deleted' => $this->faker->randomElement([null, 1]),
        ];
    }
}