<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get('/FAP')
        ->assertStatus(200)
        ->assertSeeText("Hello Fikry Andias Praja");
    }

    public function testRedirect()
    {
        $this->get("/youtube")
        ->assertRedirect("/FAP");
    }


    public function testFallback()
    {
        $this->get("/404")
        ->assertSeeText("404");
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
        ->assertSeeText('Products : 1');

        $this->get('products/1/items/xxx')
        ->assertSeeText('Products : 1 Items : xxx');

    }

    public function testRouteParameterRegex()
    {
        $this->get("/categories/12345")
        ->assertSeeText("Categories : 12345");

        $this->get('categories/salah')
        ->assertSeeText("404");
    }

    public function testRouteOptionalParameter()
    {
        $this->get('/users/12345')
        ->assertSeeText("Users : 12345");

        $this->get('/users/')
        ->assertSeeText("Users : 404");
    }

    public function testRoutingConflict()
    {
        $this->get('/conflict/budi')
        ->assertSeeText('Conflict Budi');

        $this->get('/conflict/fikry')
        ->assertSeeText('Conflict Fikry Andias Praja');

    }
}
