<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class DependencyInjectionTest extends TestCase
{

    /**
     * Test the dependency injection functionality within the application.
     *
     * @return void
     */
    public function testDependencyInjection()
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        self:assertEquals('Foo and Bar', $bar->bar());
    }
}

