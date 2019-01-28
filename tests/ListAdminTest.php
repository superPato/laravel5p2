<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListAdminTest extends TestCase
{
    use DatabaseTransactions;


    function a_admin_user_can_see_no_admin_users()
    {
        $admin = factory(\App\User::class)->create([
            'first_name' => 'Cesar',
            'last_name' => 'Acual',
            'email' => 'chechaacual@gmail.com',
            'admin' => true,
            'password' => bcrypt('laravel')
        ]);
        
        $normalUser = factory(\App\User::class)->create([
            'first_name' => 'Miguel',
            'last_name' => 'Perez'
        ]);
        
        $this->actingAs($admin)
            ->visit('/admin/users')
            ->see($normalUser->name);
    }

    function an_admin_can_login_in_list_of_users()
    {
        $admin = factory(\App\User::class)->create([
            'first_name' => 'Cesar',
            'last_name' => 'Acual',
            'email' => 'chechaacual@gmail.com',
            'admin' => true,
            'password' => bcrypt('laravel')
        ]);

        $normalUser = factory(\App\User::class)->create([
            'first_name' => 'Miguel',
            'last_name' => 'Perez'
        ]);

        $this->actingAs($admin)
            ->visit('/admin/users')
            ->seeLink('Loguearse como: ' . $normalUser->name, url('admin/login-as/' . $normalUser->id))
            ->visit('admin/login-as/' . $normalUser->id)
            ->see($normalUser->name)
            ->seePageIs('/')
            ->dontSee($admin->name)
            ->seeIsAuthenticatedAs($normalUser);
    }

    function admin_cannot_login_as_another_admin()
    {
        // Having
        $admin = factory(\App\User::class)->create([
            'first_name' => 'Cesar',
            'last_name' => 'Acual',
            'admin' => true,
        ]);

        $anotherAdmin = factory(User::class)->create([
            'first_name' => 'Miguel',
            'last_name' => 'Ramirez',
            'admin' => true
        ]);

        $this->actingAs($admin);

        // When
        $this->visit('admin/login-as/' . $anotherAdmin->id);

        // Than
        $this->seeIsAuthenticatedAs($admin)
            ->dontSee($anotherAdmin->name)
            ->see($admin->name);
    }
}
