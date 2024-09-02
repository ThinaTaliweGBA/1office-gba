<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    public function definition()
    {
        $faker = Faker::create();
        
        static $membership_code = 1212124;
        static $id_number_set = [];
        static $email_set = [];
        
        do {
            $id_number = $faker->numerify('#############');
        } while (in_array($id_number, $id_number_set));
        $id_number_set[] = $id_number;

        do {
            $primary_email = $faker->email;
        } while (in_array($primary_email, $email_set));
        $email_set[] = $primary_email;

        do {
            $secondary_email = $faker->email;
        } while (in_array($secondary_email, $email_set));
        $email_set[] = $secondary_email;

        $name = $faker->firstName;
        $initials = strtoupper(substr($name, 0, 1));
        $surname = str_replace("'", "''", $faker->lastName);

        return [
            'membership_code' => $membership_code++,
            'name' => $name,
            'initials' => $initials,
            'surname' => $surname,
            'id_number' => $id_number,
            'join_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'end_date' => null,
            'end_reason' => null,
            'gender_id' => $faker->randomElement(['F', 'M']),
            'bu_id' => 7,
            'bu_membership_type_id' => $faker->numberBetween(1, 18),
            'bu_membership_region_id' => 1,
            'bu_membership_status_id' => $faker->numberBetween(1, 2),
            'person_id' => $faker->numberBetween(1, 9),
            'language_id' => 2,
            'primary_contact_number' => $faker->numerify('##########'),
            'secondary_contact_number' => $faker->numerify('##########'),
            'tertiary_contact_number' => $faker->numerify('##########'),
            'sms_number' => $faker->numerify('##########'),
            'primary_e_mail_address' => $primary_email,
            'secondary_e_mail_address' => $secondary_email,
            'preferred_payment_method_id' => 1,
            'membership_fee' => $faker->numberBetween(50, 500),
            'fee_currency_id' => 149,
            'last_payment_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'paid_till_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'deleted' => 0,
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
