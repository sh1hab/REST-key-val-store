<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
// use Tests\TestCase;

class ApiTest extends TestCase
{
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testcan_save_values()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', '/api/v1/values', 
            [   
            'name'          => 'Shihab',
            'personality'   =>'Very Good'
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => true,
            ]);
    }
}
