<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('hello')
        ->assertSeeText("Hello Fikry");
        $this->get('hello-again')
        ->assertSeeText("Hello Fikry");
    }


    public function testViewNested()
    {
      
        $this->get('hello-world')
        ->assertSeeText("World Fikry");
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Fikry'])
        ->assertSeeText("Hello Fikry");
    }
}
