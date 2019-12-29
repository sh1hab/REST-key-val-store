<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
// use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_can_save_values()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', '/values',
            [
            'name'          => 'Shihab',
            'personality'   =>'Very Good'
            ]
        );

        $response->assertStatus(201);
    }

    public function test_can_get_values()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('GET', '/values',
            [
                'name'          => 'Shihab',
            ]
        );

        $response
            ->assertStatus(200);
    }

    public function test_can_update_values()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('PATCH', '/values',
            [
                'name'          => 'Shihab',
                'personality'   =>'Very Good'
            ]
        );

        $response->assertStatus(201);
    }
}
