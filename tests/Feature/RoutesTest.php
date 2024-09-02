<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    public function testHomePageRoute()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function testMemberViewRoute()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get('/member');

        $response->assertStatus(200);
        $response->assertViewIs('view-member');
    }

    public function testWelcomeRoutes()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('welcome', ['user' => $user->id]));

        $response->assertStatus(200);
        $response->assertViewIs('my-welcome-form');

        $response = $this->actingAs($user)
            ->post(route('savePassword', ['user' => $user->id]), [
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ]);

        $response->assertRedirect(route('onboarding', ['user' => $user->id]));
    }

    public function testOnboardingRoutes()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('onboarding', ['user' => $user->id]));

        $response->assertStatus(200);
        $response->assertViewIs('add-user-info');
    }
}
