<?php

namespace Beh7ad\User\Tests\Feature;

use Tests\TestCase;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

    $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response =  $this->insertUserData();

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_user_have_to_veriefy_account(): void
    {
        $this->insertUserData();

        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('verification.notice'));
    }

    public function test_verified_user_can_access_to_dashboard(): void
    {
        $this->insertUserData();

        $this->assertAuthenticated();

        auth()->user()->markEmailAsVerified();

        $response = $this->get(route('dashboard'));

        $response->assertOk();
    }



    public function insertUserData() {
        return $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '9893214569',
            'password' => '!!Password123',
            'password_confirmation' => '!!Password123',
        ]);
    }
}
