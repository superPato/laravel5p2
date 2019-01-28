<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WelcomeTest extends TestCase
{
    public function test_welcome_user()
    {
        $this->visit('/')
            ->seeElement('img', ['src' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3d/LaravelLogo.png/1200px-LaravelLogo.png', 'alt']);
    }
}
