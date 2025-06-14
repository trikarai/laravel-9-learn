<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
 use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
   
    /**
     * Test that dependency injection works correctly within the service container.
     *
     * This test verifies that the service container is able to resolve and inject
     * dependencies as expected when resolving classes or interfaces.
     *
     * @return void
     */
    public function testDependencyInjection()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo->foo());
        self::assertEquals("Foo", $foo2->foo());

        self::assertNotSame($foo, $foo2);

    }

    /**
     * Test the binding functionality of the service container.
     *
     * This test verifies that the service container can successfully bind
     * and resolve dependencies as expected.
     *
     * @return void
     */
    public function testBind(){
        // $person = $this->app->make(Person::class); // new Person()
        // self::assertNotNull($person)
        $this->app->bind(Person::class, function($app) {
            return new Person("Tri", "LastName");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Tri", $person->firstName);
        self::assertEquals("Tri", $person2->firstName);
        self::assertNotSame($person, $person2);

    }

    /**
     * Test that a service registered as a singleton in the service container
     * returns the same instance on multiple resolves.
     *
     * @return void
     */
    public function testSingleton(){
        $this->app->singleton(Person::class, function($app) {
            return new Person("Tri", "LastName");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Tri", $person->firstName);
        self::assertEquals("Tri", $person2->firstName);
        self::assertSame($person, $person2);

    }

    public function testInstance() {
        $person = new Person("Tri", "Sutrisno");

        $this->app->instance(Person::class, $person);
        
        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Tri", $person->firstName);
        self::assertEquals("Tri", $person2->firstName);
        self::assertSame($person, $person2);
    }

    /**
     * Test the dependency injection functionality within the service container.
     *
     * This test verifies that dependencies are correctly resolved and injected
     * by the Laravel service container when requested.
     *
     * @return void
     */
    public function testDependencyInjection2()
    {
        $this->app->singleton(Foo::class, function() {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app) {
            return new Bar($app->make(Foo::class));
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);

        self::assertSame($bar, $bar2);

    }

    /**
     * Test that the HelloService interface is correctly bound to the HelloServiceIndonesia implementation
     * in the service container, and that the hello method returns the expected greeting.
     *
     * This test registers HelloServiceIndonesia as the singleton implementation for HelloService,
     * resolves it from the container, and asserts that calling hello('Tri') returns 'Halo, Tri!'.
     */
    public function testInterfaceToClass() {

        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo, Tri!', $helloService->hello('Tri'));
    }
}
