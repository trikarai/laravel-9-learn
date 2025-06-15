<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testView()
    {
        $response = $this->get('/hello');

        $response->assertSeeText('Hello Tri');
    }

    public function testTemplate()
    {
        $this->view('hello.world', ['name' => 'Sasuke'])
            ->assertSeeText('Hello Sasuke');

    }
}
