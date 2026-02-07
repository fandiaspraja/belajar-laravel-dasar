<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Fikry')->assertSeeText("Hello Fikry");
        $this->post('input/hello', [
            'name' => 'Fikry'
        ])->assertSeeText('Hello Fikry');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', ['name' => [
            'first' => 'Fikry'
        ]])->assertSeeText("Hello Fikry");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Fikry',
                'last' => 'Andias Praja'
            ]
        ])->assertSeeText("name")->assertSeeText("first")->assertSeeText("Fikry")
        ->assertSeeText("last")->assertSeeText("Andias Praja");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Budi',
            'married' => 'true',
            'birth_date' => '1990-10-10'
            ])->assertSeeText('Budi')->assertSeeText('true')->assertSeeText('1990-10-10');
    }
}
