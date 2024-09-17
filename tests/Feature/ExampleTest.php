<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $data = [
            
            "name"=> "jason",
            "total"=>   1000,
            "bc" => [
                [
                    "cottage_id" => 1,
                    "quantity"  => 1
                ],
                [
                    "cottage_id" => 2,
                    "quantity"  => 1
                ]
                ],
                "cc"  => [
                    [
                        "customer_id" => 1,
                        "count" => 5
                    ],
                    [
                        "customer_id" => 2,
                        "count" => 5
                    ]
                ]
    ];

    $response = $this->post('/api/create-entrance', $data);
    $response->assetCreated();
    $this->assertDatabaseHas('entrances', $data);
    }
}
