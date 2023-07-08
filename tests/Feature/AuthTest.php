<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testLogin()
    {
        $testPassword = 'password';
        $user = User::factory()->create(['password' => Hash::make($testPassword)]);

        $response = $this->postJson('/api/auth/login', ['email' => $user->email, 'password' => $testPassword, 'device' => ['type' => 'web']]);
        $response
            ->assertStatus(200)
            ->assertJsonPath('token_type', 'bearer')
            ->assertJsonPath('expires_in', 3600)
            ->assertJsonPath('device_id', null)
            ->assertJsonIsObject('user')
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
                'device_id',
                'user'
            ]);
    }

    public function testLoginWithDevice()
    {
        $testPassword = 'password';
        $user = User::factory()->create(['password' => Hash::make($testPassword)]);

        $response = $this->postJson('/api/auth/login', ['email' => $user->email, 'password' => 'password', 'device' => ['type' => 'mobile']]);
        $response
            ->assertStatus(200)
            ->assertJsonPath('token_type', 'bearer')
            ->assertJsonPath('expires_in', 3600)
            ->assertJsonPath('device_id', null)
            ->assertJsonIsObject('user')
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
                'device_id',
                'user'
            ]);
    }

    public function testLogout()
    {
        $testPassword = 'password';
        $user = User::factory()->create(['password' => Hash::make($testPassword)]);
        $response = $this->post('/api/auth/logout');

        $response->assertStatus(200);
    }

    public function testRefresh()
    {
        $testPassword = 'password';
        $user = User::factory()->create(['password' => Hash::make($testPassword)]);
        $response = $this->post('/api/auth/refresh');

        $response->assertStatus(200);
    }

    public function testMe()
    {
        $testPassword = 'password';
        $user = User::factory()->create(['password' => Hash::make($testPassword)]);
        $response = $this->get('/api/auth/me');

        $response->assertStatus(200);
    }

    public function testRegister()
    {
//        $testPassword = 'password';
//        $user = User::factory()->create(['password' => $testPassword]);
        $response = $this->get('/api/auth/register');

        $response->assertStatus(200);
    }
}
