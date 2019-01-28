<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;

    protected $firstName = 'Duilio';
    protected $lastName = 'Palacios';

    function test_user_can_register()
    {
        $this->visit('/')
            ->click('Register')
            ->see('Register')
            ->seePageIs('register')
            ->type('Duilio', 'first_name')
            ->type('Palacios', 'last_name')
            ->type('admin@styde.net', 'email')
            ->type('laravel', 'password')
            ->type('laravel', 'password_confirmation')
            ->press('Register');

        $this->seeCredentials([
            'first_name' => 'Duilio',
            'last_name' => 'Palacios',
            'email' => 'admin@styde.net',
            'password' => 'laravel'
        ]);


        $this->see('/')
            ->see('Welcome')
            ->see('Duilio Palacios');
    }

    function test_a_user_can_login()
    {
        $user = $this->createUser();

        $this->visit('/')
            ->click('Login')
            ->type('admin@styde.net', 'email')
            ->type('laravel', 'password')
            ->press('Login');

        $this->seeIsAuthenticated();

        $this->seeIsAuthenticatedAs($user);

        $this->seePageIs('/')
            ->see('Welcome')
            ->see('Duilio Palacios');
    }

    function test_a_user_can_logout()
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->visit('/')
            ->seeLink('Logout')
            ->click('Logout');

        $this->dontSeeIsAuthenticated();

        $this->visit('/')
            ->dontSee('Duilio Palacios');
    }

    function test_an_admin_can_login_as_another_user()
    {
        $user = $this->createUser();

        $anotherUser = factory(User::class)->create();

        $this->actingAs($user)
            ->seeIsAuthenticatedAs($user)
            ->visit('/admin/login-as/'.$anotherUser->id)
            ->seePageIs('/')
            ->see($anotherUser->name)
            ->seeIsAuthenticatedAs($anotherUser);
    }
}
