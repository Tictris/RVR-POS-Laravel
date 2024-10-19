<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_register_function(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Jason',
            'email' => 'admin@email.com',
            'password' => '1234567890',
            'password_confirmation' => '1234567890'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ]);
    }


}
