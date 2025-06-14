<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHelloRoute()
    {
        $response = $this->get('/test');
        $response->assertStatus(200);
        $response->assertSeeText('Hello World!');
    }

    public function testRedirectRoute()
    {
        $response = $this->get('/redirect');

        $response->assertStatus(302);
        $response->assertRedirect('/test');
    }
}
