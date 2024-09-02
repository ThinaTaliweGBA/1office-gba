<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MembershipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 1500) as $index) {
            DB::table('membership')->insert([
                'membership_code' => $faker->unique()->numerify('M#####'),
                'name' => $faker->firstName,
                'initials' => strtoupper($faker->randomLetter . $faker->randomLetter),
                'surname' => $faker->lastName,
                'id_number' => $faker->unique()->numerify('##########'),
                'join_date' => $faker->dateTimeThisDecade,
                'end_date' => $faker->optional()->dateTimeThisDecade,
                'end_reason' => $faker->optional()->randomElement(['Move to other', 'Unemployed', 'Others']),
                'gender_id' => $faker->randomElement(['M', 'F']),
                'bu_membership_type_id' => $faker->randomElement([1, 2, 3]),
                'bu_membership_region_id' => $faker->randomElement(['1']),
                'bu_membership_status_id' => $faker->randomElement(['1']),
                'language_id' => $faker->randomElement(['1', '2']),
                'person_id' => (null),
                'previous_membership_id' => (null),
                'primary_contact_number' => $faker->phoneNumber,
                'secondary_contact_number' => $faker->optional()->phoneNumber,
                'tertiary_contact_number' => $faker->optional()->phoneNumber,
                'sms_number' => $faker->phoneNumber,
                'primary_e_mail_address' => $faker->unique()->safeEmail,
                'secondary_e_mail_address' => $faker->optional()->safeEmail,
                'membership_fee' => $faker->randomFloat(4, 0, 1000),
                'fee_currency_id' => (1),
                'last_payment_date' => $faker->optional()->dateTimeThisYear,
                'paid_till_date' => $faker->optional()->dateTimeThisYear,
                'deleted' => $faker->optional()->randomElement([0, 1]),
                'deleted_at' => $faker->optional()->dateTimeThisYear,
                'created_at' => $faker->dateTimeThisDecade,
                'updated_at' => $faker->dateTimeThisDecade,
            ]);
        }
    }
}
