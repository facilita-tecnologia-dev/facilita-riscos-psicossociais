<?php

namespace App\Http\Controllers\Private\User;

use App\Models\User;
use App\Services\Auth\AuthenticationService;
use Illuminate\Support\Facades\Gate;

class UserController
{   
    public function home()
    {
        return view('private.home.user.index');
    }

    public function login()
    {
        return view('auth.login.user.index');
    }

    public function index()
    {
        Gate::forUser(AuthenticationService::user())->authorize('viewAny', [User::class]);
        return view('private.user.index.index');
    }

    public function create()
    {
        Gate::forUser(AuthenticationService::user())->authorize('create', [User::class]);
        return view('private.user.create.index');
    }
    
    public function import()
    {
        Gate::forUser(AuthenticationService::user())->authorize('create', [User::class]);
        return view('private.user.import.index');
    }

    public function show(User $user)
    {
        if($user->id === session('auth:user')->id){
            Gate::forUser(AuthenticationService::user())->authorize('view', [User::class, $user]);
        } else {
            Gate::forUser(AuthenticationService::user())->authorize('edit', [User::class, $user]);
        }

        return view('private.user.show.index', compact('user'));
    }
}
