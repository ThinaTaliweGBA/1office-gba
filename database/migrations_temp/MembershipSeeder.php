<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Dependant;
use App\Models\Membership;
use App\Models\MembershipAddress;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Membership::factory(500)->create();
    }
}
