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



class MembershipSeeder extends Seeder
{

     /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    public $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    public function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        

    // Membership::factory()->count(50)->create(); //Dont use this for now

    
    //Creates Person(20) each with Membership(1) and Dependants(4)
       Person::factory()
        ->has(
            Membership::factory()
            ->has(
                MembershipAddress::factory()
                ->count($this->faker->numberBetween(1,2))
                )
                        ->count(1)
                        ->state(function (array $attributes, Person $person) {
            return [
                'name' => $person->first_name,
                'initials' => $person->initials,
                'surname' => $person->last_name,
                'gender_id' => $person->gender_id ,
                'id_number' => $person->id_number
            ]   ;}))
        ->has(
            Dependant::factory()
                        ->count(4)
                        ->state(function (array $attributes, Person $person) {
                           // $year = $this->faker->year($min = '-21 years');
                           $twentyOneYearsBack = Carbon::now()->year - 21;
                            $year = $this->faker->numberBetween($twentyOneYearsBack, Carbon::now()->year);
                            $monthAndDay = $this->faker->date($format = 'm-d', $max = 'now');
                            $month = substr($monthAndDay,0,2);
                            $day =substr($monthAndDay,3,5);
            return [
                'primary_person_id' => $person->id,
                'secondary_person_id' => Person::factory()->create([

                    

                    'id_number' => substr($year,2,4).$month.$day.$this->faker->unique()->numerify('#######'),
                    'birth_date' => $year.'-'.$monthAndDay.' 00:00:00'
                    
                    // 'id_number' => substr($this->faker->year('-21 years'),2,4).substr($this->faker->date($format = 'm-d', $max = 'now'),0,2).substr($this->faker->date($format = 'm-d', $max = 'now'),3,5).$this->faker->unique()->numerify('#######'),
                    // 'birth_date' => $this->faker->year('-21 years').'-'.$this->faker->date($format = 'm-d', $max = 'now').' 00:00:00',
                ])->id,
                // 'person_relationship_id' => '',
            ];})->sequence(['person_relationship_id' => 1],['person_relationship_id' => 2],['person_relationship_id' => 2],['person_relationship_id' => 2],)
                )
        ->count(20)
        ->create();



        // $person = Person::factory()
        // ->count(2)
        // ->has(
        //     Dependant::factory()
        //                 ->count(4)
        //                 ->state(function (array $attributes, Person $person) {
        //     return [
        //         'primary_person_id' => $person->id,
        //         'secondary_person_id' => Person::factory()->create()->id,
        //         // 'person_relationship_id' => $person->last_name,
        //         ];})->sequence(['person_relationship_id' => 1],['person_relationship_id' => 2],['person_relationship_id' => 2],['person_relationship_id' => 2],)
        //         )
        // ->create();

    }
}
