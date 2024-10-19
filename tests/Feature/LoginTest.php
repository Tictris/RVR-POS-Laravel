<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_function(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@email.com',
            'password' => '1234567890'
        ]);

        $this->assertAuthenticated();
    }
}
