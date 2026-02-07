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
    function testDependency()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }


    function testBind() {
        $this->app->bind(Person::class, function($app){
            return new Person("Fikry", "Andias Praja");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Fikry", $person1->firstname);
        self::assertEquals("Fikry", $person2->firstname);
        self::assertNotSame($person1, $person2);
    }


    function testSingleton() {
        $this->app->singleton(Person::class, function($app){
            return new Person("Fikry", "Andias Praja");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Fikry", $person1->firstname);
        self::assertEquals("Fikry", $person2->firstname);
        self::assertSame($person1, $person2);
    

    }

    function testInstance() {

            $person = new Person("Fikry", "Andias Praja");


        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Fikry", $person1->firstname);
        self::assertEquals("Fikry", $person2->firstname);
        self::assertSame($person1, $person2);
    

    }

    function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app){
            $foo = $this->app->make(Foo::class);
            return new Bar($foo);
        });

        $bar1 = $this->app->make(Bar::class);
                $bar2 = $this->app->make(Bar::class);



        self::assertSame($bar1, $bar2);
        
    }

    function testHelloService() {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Halo Fikry", $helloService->hello("Fikry")); 
    }
}
