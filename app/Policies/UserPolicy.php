<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\RedirectResponse;

class UserPolicy
{
    public function index($user): bool
    {
        return $user->role_id == 1 ? true : false;
    }

    public function search($user): bool
    {
        return $user->role_id == 1 ? true : false;
    }

    public function store($user): bool
    {
        return $user->role_id == 1 ? true : false;
    }

    public function update($user): bool
    {
        return  $user->role_id == 1 ? true : false;
    }

    public function delete($user): bool
    {
        return  $user->role_id == 1 ? true : false;
    }
}
