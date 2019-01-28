<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $users = User::when($request->search, function ($q) use ($request) {
        //     return $q->where('email', $request->search);
        // })->inRandomOrder()
        //   ->get();

        // $users = User::search($request->search)
        //             ->inRandomOrder()
        //             ->get();
        \App\Post::test()->get();

        ///

//        $q = User::query();
//
//        if ($request->has('search')) {
//            $q->where('email', $request->get('search'));
//        }
//
//        $users = $q->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        abort_unless($user->isCollaborator(), 404, 'No se puede editar el administrador');

        return view('admin.users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        abort_if($user->isAdmin(), 404, 'El usuario con ID 1 no puede ser editado');

        $this->validate($request, [
            'email' => 'required'
        ]);

        $user->fill($request->all());

        $user->save();

        return back()->with('success', true);
    }
}
