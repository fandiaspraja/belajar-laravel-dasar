<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertSame($firstName1, $firstName2);
    }

    public function testConfigDependency()
    {
        $config = $this->app->make("config");
        $firstName1 = $config->get('contoh.author.first');
        $firstName2 = Config::get("contoh.author.first");

        self::assertEquals($firstName1, $firstName2);
    }

    public function testConfigMock()
    {
        Config::shouldReceive('get')
        ->with('contoh.author.first')
        ->andReturn("Fikry Keren");

        $firstName = Config::get('contoh.author.first');

        self::assertEquals("Fikry Keren", $firstName);
    }
}
