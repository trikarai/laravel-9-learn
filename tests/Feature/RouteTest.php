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

    public function testFailRoute()
    {
        $response = $this->get('/fail');
        $response->assertSeeText('404 Not Found');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('product : 1');

        $this->get('/products/1/items/1')
            ->assertSeeText('product : 1 items : 1');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/1')
            ->assertSeeText('Category : 1');

        $this->get('/categories/abc')
            ->assertSeeText('404 Not Found');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/1')
            ->assertSeeText('User : 1');

        $this->get('/users/')
            ->assertSeeText('User :');
    }
}
