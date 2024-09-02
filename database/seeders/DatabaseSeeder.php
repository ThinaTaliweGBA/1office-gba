<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Bu;
use App\Models\Business;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Membership;
use App\Models\Person;
use App\Models\Province;
use App\Models\System;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(LayoutsTableSeeder::class);

        $BusinessName = 'Group Burial Association';
        $currency = 'ZAR';
        $country = 'ZA';
        
       
        $provinces = [
            
            ['id' => 1, 'name' => 'Gauteng','country_id' => 197],
            ['id' => 2, 'name' => 'Mpumalanga','country_id' => 197],
            ['id' => 3, 'name' => 'KwaZulu-Natal','country_id' => 197],
            ['id' => 4, 'name' => 'North West','country_id' => 197],
            ['id' => 5, 'name' => 'Limpopo','country_id' => 197],
            ['id' => 6, 'name' => 'Western Cape','country_id' => 197],
            ['id' => 7, 'name' => 'Free State','country_id' => 197],
            ['id' => 8, 'name' => 'Eastern Cape','country_id' => 197],
            ['id' => 9, 'name' => 'Northern Cape','country_id' => 197],
         ];

        Province::insert($provinces);
      

        //Random Cities
        City::factory()->count(20)->create(); 


//       DB::table('adress_type')->insert([
//            'id' => 1 ,
//            'name' => 'Residential' ,
//        ]);

        
       //Random Addresses
       Address::factory()->count(20)->create(); 
        

        DB::table('users')->insert([
            'name' => 'Mr. abc',
            'email' => 'abc@abc.com',
            'password' => Hash::make('abc@abc.com'),
        ]);

        DB::table('business')->insert([
            'business_name' => $BusinessName ,
            'country_id' => Country::where('short_code',  $country)->first()->id ,
        ]);

        DB::table('system')->insert([
            'system_name' => $BusinessName,
            'system_size' => 'l' ,
            'base_currency_id' => Currency::where('code', $currency)->first()->id ,
            'master_users_id' => 2 ,
        ]);

        DB::table('company')->insert([
         //   'id' => 7, //Manually assigned because no default value (doesnt Auto increment)
            'name' => $BusinessName,
            'legal_name' => $BusinessName,
            'system_id' => System::where('system_name', $BusinessName)->first()->id  ,
            'country_id' => Country::where('short_code',  $country)->first()->id ,
            'currency_id' =>  Currency::where('code', $currency)->first()->id,
            'business_id' => Business::where('business_name', $BusinessName)->first()->id ,
        ]);

        DB::table('bu')->insert([
            'bu_name' => $BusinessName ,
            'company_id' => Company::where('name',  $BusinessName)->first()->id ,
            'system_id' => System::where('system_name', $BusinessName)->first()->id  ,
            'ops_currency_id' =>  Currency::where('code', $currency)->first()->id,
            'report_currency_id' =>  Currency::where('code', $currency)->first()->id,
            'country_id' => Country::where('short_code', $country)->first()->id ,
        ]);    

         DB::table('bu_membership_type')->insert([
            'id' => 1 ,
            'name' => 'A1' ,
            'description' => 'Member Age 0-35' ,
            'membership_fee' => 35.00 ,
            'fee_currency_id' =>  Currency::where('code', $currency)->first()->id,
            'start_age' => 0 ,
            'end_age' => 35,
            'full_paid_age' => 63,
            'bu_id' => Bu::where('bu_name', $BusinessName)->first()->id,
        ]);

        DB::table('bu_membership_region')->insert([
            'id' => 1 ,
            'name' => 'South Africa' ,
            'bu_id' => Bu::where('bu_name', $BusinessName)->first()->id,
        ]);

        DB::table('bu_membership_status')->insert([
            'id' => 1 ,
            'name' => 'Active' ,
            'bu_id' => Bu::where('bu_name', $BusinessName)->first()->id,
        ]);

      
        DB::table('language')->insert([
            'id' => 1 ,
            'name' => 'English' ,
            'iso_639_1' => 'en',
            'iso_639_3' => 'eng',
        ]);

        DB::table('language')->insert([
            'id' => 2 ,
            'name' => 'Afrikaans' ,
            'iso_639_1' => 'af',
            'iso_639_3' => 'afr',
        ]);

        DB::table('person_relationship')->insert([
            'id' => 1 ,
            'name' => 'Wife/Husband' ,
        ]);

        DB::table('person_relationship')->insert([
            'id' => 2 ,
            'name' => 'Child' ,
        ]);

        


      
        
    }
}
