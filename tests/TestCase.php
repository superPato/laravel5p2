<?php

use App\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    protected function createUser()
    {
        return factory(User::class)->create([
            'first_name' => 'Duilio',
            'last_name' => 'Palacios',
            'email' => 'admin@styde.net',
            'admin' => true,
            'password' => bcrypt('laravel')
        ]);
    }
}
