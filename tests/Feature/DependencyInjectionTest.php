<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    function testDependencyInjection()
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        print($bar->bar());

        self::assertEquals("Foo and Bar", $bar->bar());
    }
}
