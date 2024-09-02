<?php

namespace Tests\Feature\Membership;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\MembershipsController;
use App\Http\Controllers\NewMemberController;
use App\Models\Membership;
use Tests\TestCase;

class CreateNewMembershipTest extends TestCase
{
    /**
     * @test
     */
    public function test_the_application_returns_a_successful_response()
    {

        $this->withoutExceptionHandling();
        

        $this
        // ->withHeaders(['Accept' => 'application/json'])
        ->post(action('App\Http\Controllers\NewMemberController@store'), [
            'Name' => 'TestName',
            'Surname' => 'TestSurname',
            'IDNumber' => '5703155083086',
            'Line1' => '123 Test Street',
            'City' => 'TestCity',
            'Province' => 'GAUTENG',
            'Country' => 'SOUTH AFRICA',
            // 'Telephone' => 'required|integer|digits:10',
            'inputDay' => '15',
            'inputMonth' => '03',
            'inputYear' => '1957',
            'Email' => 'test@test.com',
            'PostalCode' => '0123',
            'memtype' => '1',
        ])
        ->assertRedirect(action([MembershipsController::class, 'edit']));
        // ->assertStatus(302);

        // $this->assertDatabaseHas(Membership::class, [
        //     'name' => 'TestName',
        //     'surname' => 'TestSurname',
        //     'id_Number' => '5703155083086',

        // ]);
    }
}
