<?php

namespace Beh7ad\User\Tests\Feature;

use App\Providers\RouteServiceProvider;
use Tests\TestCase;
use Beh7ad\User\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_can_login_by_email(): void
    {
        $user = User::create(
            [
                'name' => $this->faker->name,
                'email' => $this->faker->safeEmail,
                'password' => bcrypt('!Rhw123456'),
            ]
        );

        $response = $this->post('/login', [
            'username' => $user->email,
            'password' => '!Rhw123456'
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_user_can_login_by_phone(): void
    {
        $user = User::create(
            [
                'name' => $this->faker->name,
                'email' => $this->faker->safeEmail,
                'phone' => '9833922784',
                'password' => bcrypt('!Rhw123456'),
            ]
        );

        $response = $this->post('/login', [
            'username' => $user->phone,
            'password' => '!Rhw123456'
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(RouteServiceProvider::HOME);
    }


    public function test_user_can_logout(): void
    {
        $user = User::create(
            [
                'name' => $this->faker->name,
                'email' => $this->faker->safeEmail,
                'password' => bcrypt('!Rhw123456'),
            ]
        );

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
