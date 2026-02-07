<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testController()
    {
        $this->get('/controller/hello')
        ->assertSeeText("Hello World");
    
    }


    public function testControllerDependency()
    {
        $this->get('/controller/halo/Fikry')
        ->assertSeeText("Halo Fikry");
    
    }

    public function testRequest()
    {
        $this->get('/controller/halo/request', [
            'Accept' => 'plain/text'
        ])->assertSeeText("/controller/halo/request")
        ->assertSeeText('http://localhost/controller/halo/request')
        ->assertSeeText('GET')
        ->assertSeeText('plain/text');
    }
}
