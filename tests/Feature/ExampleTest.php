<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
       /*  $response = $this->get('http://127.0.0.1:8000/explore');

        $response->assertStatus(200); */
        $response = $this->getJson('http://127.0.0.1:8000/api/faculties/faculties');

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
