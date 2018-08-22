<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MainPageTest extends TestCase
{

    public function testMainPageIsReachableAndCorrect()
    {
        $this->get('/')
			->assertStatus(200)
			->assertSee("Exclamo");
    }
}
