<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfig()
    {
        $firstName1 = config('app.name');
        $firstName2 = Config::get('app.name');

        self::assertEquals($firstName1, $firstName2);
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');

        $firstName1 = $config->get('app.name');
        $firstName2 = Config::get('app.name');

        self::assertEquals($firstName1, $firstName2);
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('app.name')
            ->andReturn('Laravel Learn');

        $firstName = Config::get('app.name');

        self::assertEquals('Laravel Learn', $firstName);
    }
}
